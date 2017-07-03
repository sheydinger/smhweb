<?php
	if ($_GET['showsource'])
	{
		show_source("securityserver.php");
		die();
	}

// Articles about IV (initialization vector)
// http://stackoverflow.com/questions/11821195/use-of-initialization-vector-in-openssl-encrypt

// http://www.openssl.org/docs/crypto/RSA_public_encrypt.html

// http://etutorials.org/Programming/secure+programming/


// Before sending data here via POST, use encodeURIComponent on the JavaScript side.
// Lesser alternatives are: escape() (in JavaScript).  Note that the data do NOT
// require a corresponding urldecode on the PHP side!

    if ($_GET['action'] == 'sha1')
    {
	echo '{"sha1":"' . sha1($_POST['str']) . '"}';
    }

    else if ($_GET['action'] == 'md5')
    {
	echo '{"md5":"' . md5($_POST['str']) . '"}';
    }

    else if ($_GET['action'] == 'hash')
    {
	$algos_list = hash_algos();
	$algo = $algos_list[$_POST['algo_idx']];
	echo '{"hash":"' . hash($algo, $_POST['str']) . '","algo":"' . $algo . '"}';
    }

    else if ($_GET['action'] == 'hash_hmac')
    {
	$algos_list = hash_algos();
	$algo = $algos_list[$_POST['algo_idx']];
	$key = $_POST['key'];
	echo '{"hash":"' . hash_hmac($algo, $_POST['str'], $key) . '","algo":"' . $algo . '","key":"' . $key . '"}';
    }

    else if ($_GET['action'] == 'hash_pbkdf2')
    {
	$algos_list = hash_algos();
	$algo = $algos_list[$_POST['algo_idx']];
	$password = $_POST['password'];
	$salt = $_POST['salt'];
	$iterations = $_POST['iterations'];
//	echo '{"hash":"' . hash_pbkdf2($algo, $password, $salt, $iterations) . '","algo":"' . $algo . '","password":"' . $password . '","salt":"' . $salt . '","iterations":"' . $iterations . '"}';
	echo '{"hash":"' . "?" . '","algo":"' . $algo . '","password":"' . $password . '","salt":"' . $salt . '","iterations":"' . $iterations . '"}';
    }

    else if ($_GET['action'] == 'rsakeypair')
	{
		$config = array(
			"digest_alg" => "sha512",
			"private_key_bits" => 384,
			"private_key_type" => OPENSSL_KEYTYPE_RSA,
		);
		   
		// Create the private and public key
		$res = openssl_pkey_new($config);
		
		// Extract the private key from $res to $privKey
		openssl_pkey_export($res, $privKey);

		// Extract the public key from $res to $pubKey
		$key = openssl_pkey_get_details($res);
		$pubKey = $key["key"];

		// The public and private keys aren't suitable for transmission via JSON.  Make
		// two forms: base64 encoded to pass back later, and with <br /> for display on the client.
		$privKey64 = base64_encode($privKey);
		$pubKey64  = base64_encode($pubKey);

		$privKeyStr = str_replace("\n", "<br />", $privKey);
		$pubKeyStr  = str_replace("\n", "<br />", $pubKey);

		echo '{"privatekeystr":"' . $privKeyStr . '", "publickeystr":"' . $pubKeyStr .
			'", "privatekey64":"' . $privKey64 . '", "publickey64":"' . $pubKey64 .
			'", "privatekey64hash":"' . hash("crc32", $privKey64) . '", "publickey64hash":"' . hash("crc32", $pubKey64) .
			'", "privatekeyhash":"' . hash("crc32", $privKey) . '", "publickeyhash":"' . hash("crc32", $pubKey) . '"}';
	}

    else if ($_GET['action'] == 'encryptpublic')
	{
		$decrypted = $_POST['decrypted'];
		$pubKey64  = $_POST['publickey64'];
		$pubKey    = base64_decode($pubKey64);
		$privKey64 = $_POST['privatekey64'];
		$privKey   = base64_decode($privKey64);

		// Encrypt the data to $encrypted using the public key
		openssl_public_encrypt($decrypted, $encrypted, $pubKey);
		$encrypted64 = base64_encode($encrypted);

        echo '{"encrypted64":"' . $encrypted64 . '", "encrypted64hash":"' . hash("crc32", $encrypted64) .
			'", "decrypted":"' . $decrypted . '", "decryptedhash":"' . hash("crc32", decrypted) .
			'", "publickeyhash":"' . hash("crc32", $pubKey) . '", "publickey64hash":"' . hash("crc32", $pubKey64) . '"}';

	}

    else if ($_GET['action'] == 'decryptprivate')
	{
		$encrypted64 = $_POST['encrypted64'];

		// The encrypted64 string can contain + symbols.  When coming back here and
		// reading the encrypted64 string, the + symbols have been turned into spaces
		// by JavaScript and POST.  Therefore, convert them back to +'s.  This is NOT
		// necessary if the data are converted via encodeURIComponent on the JavaScript side.
		// $encrypted64 = str_replace(" ", "+", $encrypted64);

		$encrypted   = base64_decode($encrypted64);
		$privKey64   = $_POST['privatekey64'];
		$privKey     = base64_decode($privKey64);

		openssl_private_decrypt($encrypted, $decrypted, $privKey);

        echo '{"decrypted":"' . $decrypted . '", "encrypted64":"' . $encrypted64 . '", "encrypted64hash":"' . hash("crc32", $encrypted64) .
			'", "privatekeyhash":"' . hash("crc32", $privKey) . '", "privatekey64hash":"' . hash("crc32", $privKey64) . '"}';
	}

    else if ($_GET['action'] == 'sign')
	{
		$decrypted = $_POST['decrypted'];
		$privKey   = base64_decode($_POST['privatekey64']);

		$signature = "";
		openssl_sign($decrypted, $signature, $privKey);
		echo '{"signature64":"' . base64_encode($signature) . '"}';
	}

    else if ($_GET['action'] == 'verify')
	{
		$decrypted = $_POST['decrypted'];
		$pubKey    = base64_decode($_POST['publickey64']);
		$signature = base64_decode($_POST['signature64']);

		$result = openssl_verify($decrypted, $signature, $pubKey);
		if ($result == 1)
			echo '{"result":"correct", "signature64":"' . base64_encode($signature) . '"}';
		else if ($result == 0)
			echo '{"result":"incorrect", "signature64":"' . base64_encode($signature) . '"}';
		else
			echo '{"result":"error", "signature64":"' . base64_encode($signature) . '"}';
	}

    else
        echo "No idea";
?>