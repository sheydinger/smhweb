<?php
    if (isset($_GET['showsource']) && $_GET['showsource'])
    {
	show_source("sessions.php");
	die();
    }

    session_start();

    if (isset($_SESSION['views']))
        $_SESSION['views'] = $_SESSION['views']+1;
    else
        $_SESSION['views'] = 1;

    if (isset($_GET['dowhat']) && $_GET['dowhat'] == 'session_destroy')
    {
	// This must be called AFTER session_start()
	session_destroy();
    }
    else if (isset($_GET['dowhat']) && $_GET['dowhat'] == 'session_unset')
    {
	session_unset();
    }
    else if (isset($_GET['dowhat']) && $_GET['dowhat'] == 'session_regenerate_id')
    {
	session_regenerate_id();
    }
    else if (isset($_GET['dowhat']) && $_GET['dowhat'] == 'set_session_var')
    {
	$_SESSION['session_var'] = 'Hi Billy Bob';
    }



    // check to see if $_SESSION["timeout"] is set
    $timeout = 30; // seconds
    if (isset($_SESSION['start_time']))
    {
	$time_to_live = time() - $_SESSION['start_time'];
	if ($time_to_live > $timeout) {
	    session_unset();
	    session_destroy();
	    // header("Location: /logout.php");
	}
    }
    else
    {
        $_SESSION['start_time'] = time();
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Sessions</title>

<link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>

    <div id="page">

	<p><a href="./index.html">Home</a>&nbsp;Show source:&nbsp;
	<a href="./sessions.php?showsource=1">sessions.php</a>
	</p>

	<h1>Sessions</h1>
	<p>This page demonstrates the use of PHP sessions.  Try loading it in multiple tabs in one browser.
	Note on a WAMP installation that the sessions are stored in c:\wamp\tmp\sess_* where * is the session id.</p>

	<div class="entry">
	    <h3>$_SESSION</h3>
	    <?php
		foreach ($_SESSION as $key=>$val)
		    echo $key. ": ".$val. "<br>";
	    ?>

	    <h3>$_COOKIE</h3>
	    <?php
		foreach ($_COOKIE as $key=>$val)
		    echo $key. ": ".$val. "<br>";
	    ?>

	    <h3>$_GET</h3>
	    <?php
		foreach ($_GET as $key=>$val)
		    echo $key. ": ".$val. "<br>";
	    ?>
	    
	    <?php
		if (isset($_SESSION['start_time']))
		    echo "<br /><br />" . time() . " - " . $_SESSION['start_time'] . " = " . (time() - $_SESSION['start_time']) . " (vs. " . $timeout . ")";

		echo "<br /><br />";
		$arr = session_get_cookie_params();
		foreach ($arr as $key=>$val)
		    echo $key. ": ".$val. "<br>";
	    ?>
	</div>

	<form action="sessions.php" method="get">
	    <input type="submit" name="dowhat" value="reload">
	    <input type="submit" name="dowhat" value="session_unset">
	    <input type="submit" name="dowhat" value="session_regenerate_id">
	    <input type="submit" name="dowhat" value="session_destroy"><br />

	    <input type="submit" name="dowhat" value="set_session_var">
	</form> 

    </div>

</body>
</html>
