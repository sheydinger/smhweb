<?php

    // Common functions

    // Send the database contents in JSON format
    function sendDB($result)
    {
	echo ',"passwords":[';
	$row = mysql_fetch_array($result);
	while ($row)
	{
	    echo '{"userid":"' . $row['userid'] . '"}';

	    $row = mysql_fetch_array($result);
	    if ($row)
		echo ',';
	}
	echo ']';
    }

    // Given a password and salt, hash the password.
    // This is similar to pbkdf2.
    function computeHashedPassword($password, $salt)
    {
	// Use this to make computing the hash take a long time to thwart
	// a hacker who is trying to build a library.
	$iterations = 10000;

	// Use this to add a "private" salt.  This value should be
	// read from elsewhere and kept hidden from an attacker.
	$hmac_key = "BillyBob";

	// Waste some time.  Make computations longer for a hacker who would
	// have to try many times.  A legitimate user only performs this once.
	// TODO: Should use sha256 instead of sha1
	$hash_password = $salt . $password;
	for ($i=0; $i<$iterations; $i++)
	    $hash_password = hash_hmac("sha1", $hash_password, $hmac_key);

	return $hash_password;
    }

    if ($_GET['showsource'])
    {
	show_source("passwordserver.php");
	die();
    }


    // Access a database with password information.
    // GoDaddy uses the same username and database name.
    $hostname = "smhweb.db.6531588.hostedresource.com";
    $username = "smhweb";
    $dbname = "smhweb";
    $password = "Maxwell1879#";

    // @ suppresses error messages
    $connection = @mysql_connect($hostname, $username, $password);
    if ($connection == FALSE)
    {
	die('{"action":"' . $_GET['action'] . '","status":"error","message":"mysql_connect"}');
    }

    if (@mysql_select_db($dbname, $connection) == FALSE)
    {
	@mysql_close();
	die('{"action":"' . $_GET['action'] . '","status":"error","message":"mysql_select_db"}');
    }

    $userid = $_POST['userid'];
    $password = $_POST['password'];
    $sha1 = sha1($password);

    $hmac_key = "BillyBob";
    $iterations = 300000;	// 300000 takes about 1 sec on GoDaddy

    if ($_GET['action'] == 'getdb')
    {
	// Send a string suitable for Google Charts, i.e. cols and rows

	// Send all passwords
	$query = "SELECT * FROM passwords";
	$result = @mysql_query($query, $connection);
	if ($result == FALSE)
	{
	    @mysql_close();
	    die('{"action":"getdb","status":"error","message":"mysql_query","query":"' . $query . '"}');
        }

	echo '
	{
	    "action":"getdb",
	    "status":"success",
	    "message":"Retrieved passwords.",
	    "query":"' . $query . '",
	    "passwords":
	    {
	      "cols": [
		    {"id":"","label":"User ID","pattern":"","type":"string"},
		    {"id":"","label":"Password","pattern":"","type":"string"},
		    {"id":"","label":"Salt","pattern":"","type":"string"},
		    {"id":"","label":"Hash Password","pattern":"","type":"string"}
		  ],
	      "rows": [';

	$row = mysql_fetch_array($result);
	while ($row)
	{
	    echo '{"c":[{"v":"' . $row['userid'] . '","f":null},{"v":"' . $row['password'] . '","f":null},{"v":"' . $row['salt'] . '","f":null},{"v":"' . $row['hash_password'] . '","f":null}]}';

	    $row = mysql_fetch_array($result);
	    if ($row)
		echo ',';
	}


	echo '
		  ]
	    }
	}
	';
	
	@mysql_close();
    }

    else if ($_GET['action'] == 'delete')
    {
	$query = "DELETE FROM passwords WHERE ";
	for ($i=0; $i<$_POST['count'] - 1; $i++)
	{
	    $query .= "userid='" . $_POST[$i] . "' OR ";
	}
	$query .= "userid='" . $_POST[$i] . "'";
	$result = @mysql_query($query, $connection);
	@mysql_close();

	if ($result == FALSE)
	{
	    die('{"action":"delete","status":"error","message":"mysql_query","query":"' . $query . '"}');
        }
	else
	{
	    die('{"action":"delete","status":"success","message":"Accounts deleted.","query":"' . $query . '"}');
        }
    }

    else if ($_GET['action'] == 'new')
    {
	// Check if this userid already exists
	$query = "SELECT userid FROM passwords WHERE userid='" . $userid . "'";
	$result = mysql_query($query, $connection);
	if ($result == FALSE)
	{
	    @mysql_close();
	    die('{"action":"new","status":"error","message":"mysql_query(SELECT)","query":"' . $query . '"}');
        }

	// Assume count_rows > 0 means already exists
	$count_rows = @mysql_num_rows($result);
	if ($count_rows > 0)
	{
	    @mysql_close();
	    die('{"action":"new","status":"failure","message":"Userid already exists.","query":"' . $query . '"}');
        }

	// Size is bytes.  20 bytes * 8 bits/byte = 160 bits, i.e. same as SHA1 number of bits
	// MCRYPT_DEV_URANDOM is faster than the default, MCRYPT_DEV_RANDOM
	$salt = bin2hex(mcrypt_create_iv(20, MCRYPT_DEV_URANDOM));

	// Waste some time.  Make computations longer for a hacker who would
	// have to try many times.  A legitimate user only performs this once.
	// TODO: Should use sha256 instead of sha1
	$hash_password = $salt . $password;
	for ($i=0; $i<$iterations; $i++)
	    $hash_password = hash_hmac("sha1", $hash_password, $hmac_key);

	// Insert a new userid into the database
	$query = "INSERT INTO passwords (userid, password, sha1, salt, hash_password) VALUES ('" .
	    $userid . "','" . $password . "','" . $sha1 . "','" . $salt . "','" . $hash_password . "')";
	$result = @mysql_query($query, $connection);

	@mysql_close();

	if ($result == FALSE)
	{
	    die('{"action":"new","status":"error","message":"mysql_query(INSERT)","query":"' . $query . '"}');
	}
	else
	{
	    die('{"action":"new","status":"success","message":"User added.","query":"' . $query . '"}');
	}
    }

    else if ($_GET['action'] == 'login')
    {
	// Check if this userid exists
	$query = "SELECT * FROM passwords WHERE userid='" . $userid . "'";
	$result = mysql_query($query, $connection);
	if ($result == FALSE)
	{
	    @mysql_close();
	    die('{"action":"login","status":"error","message":"Invalid userid.","query":"' . $query . '"}');
        }

	// Assume count_rows != 1 means no userid
	$count_rows = @mysql_num_rows($result);
	if ($count_rows != 1)
	{
	    @mysql_close();
	    die('{"action":"login","status":"error","message":"Invalid userid.","query":"' . $query . '"}');
        }

	$row = mysql_fetch_array($result);

	@mysql_close();

	// Read the stored result
	$salt = $row["salt"];

	// Waste some time.  Make computations longer for a hacker who would
	// have to try many times.  A legitimate user only performs this once.
	// TODO: Should use sha256 instead of sha1

	$time_start = microtime(true);
	$hash_password = $salt . $password;
	for ($i=0; $i<$iterations; $i++)
	    $hash_password = hash_hmac("sha1", $hash_password, $hmac_key);
	$time_end = microtime(true);
	$time = $time_end - $time_start;

	if ($hash_password == $row["hash_password"])
	{
	    die('{"action":"login","status":"success","message":"Valid login. ' . $time . ' seconds","query":"' . $query . '"}');
	}
	else
	{
	    die('{"action":"login","status":"failure","message":"Invalid login.","query":"' . $query . '"}');
	}
    }

    else
	die('{"status":"error","message":"No idea"}');
?>