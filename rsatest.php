<?php
	if ($_GET['showsource'])
	{
		show_source("rsatest.php");
		die();
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>RSA Test</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div id="page">

		<p><a href="./index.html">Home</a>&nbsp;<a href="./rsatest.php?showsource=1">Show source</a></p>

	    <h1>RSA Test</h1>
		<p>Show the state behavior of a proper RSA implementation. The encoded string is 'abcde', which was encoded five times.
		Though the encodings are different, the decodings are the same.  The encodings/decodings are:</p>

<?php

	$privKey = "LS0tLS1CRUdJTiBQUklWQVRFIEtFWS0tLS0tCk1JSUJDZ0lCQURBTkJna3Foa2lHOXcwQkFRRUZBQVNCOVRDQjhnSUJBQUl4QUx3NzdHRWFUMGcvWjZFVjZmTmwKSnRJOTRXZ0VMTEdua0hVUThZK3BJR0l6ZkRiQVVPam4zV0YwSG9tcTRWaTAzUUlEQVFBQkFqQlVtQ1dpZWgxNQpYYTFuOHA1Q21ZbjU0SCtGcktLZGNLMHcyOHc2Y25GZWxGSmt0TEdoQXg5YzIydThLUEYrWEtFQ0dRRGgwb21uCnRSckRJdnp0MlNkWEdaOGhKYzRnUTZ4RnBpa0NHUURWWTNuSWNzQU5SNElIK1hBNEc3Zi9ZMzJzZEdEZzU1VUMKR0RyL2FGdGFZMjJMM0l5L2FSbkdaZDZoSStNbUN3SC9VUUlZQmhhMmpOK3BWemVwSUMwZjVKbjE0QldvcWxrUAp3cHNaQWhrQWhPWnY4alNQMytUdU1mK3BhWjNJWnYrbXM0RnhlVmtNCi0tLS0tRU5EIFBSSVZBVEUgS0VZLS0tLS0K";
	$pubKey  = "LS0tLS1CRUdJTiBQVUJMSUMgS0VZLS0tLS0KTUV3d0RRWUpLb1pJaHZjTkFRRUJCUUFET3dBd09BSXhBTHc3N0dFYVQwZy9aNkVWNmZObEp0STk0V2dFTExHbgprSFVROFkrcElHSXpmRGJBVU9qbjNXRjBIb21xNFZpMDNRSURBUUFCCi0tLS0tRU5EIFBVQkxJQyBLRVktLS0tLQo=";

	// These are five base64 encodings of the string $encrypted="abcde" generated using:
	// openssl_public_encrypt($decrypted, $encrypted, $pubKey);

	$encrypted1 = "r5x15ZAITy76PQbf7JG7MxcwF6OP/xrwur8sULKvUufPSk6rY3W8kiopBUv0osiK";
	$encrypted2 = "RsttyvHq1zafDYbXqLKE5CJYk9xSIi2sNA9StbLUoKPrSsnmYs1o08sNQXwMbRbM";
	$encrypted3 = "W4HjHIUlFDuV3M9w6Zful8Dturyk+SePspRC3Botu1Qv3+OfWmNR+S8xUw9g4a1j";
	$encrypted4 = "fotewyEyH6VMcAV8/lbPuTJIMSpf9TT8MFc8wWOcWIKutI7/ONbNL6VM7UkFHYT/";
	$encrypted5 = "hRxlCbdUoPm+vorYg655DlT1DvjUtkonXxkb87xAqHcFlqLFvF8JDSwdCAUhFYas";


	openssl_private_decrypt(base64_decode($encrypted5), $decrypted, base64_decode($privKey));
	echo "<code>" . $encrypted5 . "</code> -> " . $decrypted . "<br />";
	openssl_private_decrypt(base64_decode($encrypted2), $decrypted, base64_decode($privKey));
	echo "<code>" . $encrypted2 . "</code> -> " . $decrypted . "<br />";
	openssl_private_decrypt(base64_decode($encrypted3), $decrypted, base64_decode($privKey));
	echo "<code>" . $encrypted3 . "</code> -> " . $decrypted . "<br />";
	openssl_private_decrypt(base64_decode($encrypted1), $decrypted, base64_decode($privKey));
	echo "<code>" . $encrypted1 . "</code> -> " . $decrypted . "<br />";
	openssl_private_decrypt(base64_decode($encrypted4), $decrypted, base64_decode($privKey));
	echo "<code>" . $encrypted4 . "</code> -> " . $decrypted . "<br />";

?>

	</div>

</body>
</html>