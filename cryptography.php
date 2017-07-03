<?php
	if ($_GET['showsource'])
	{
		show_source("cryptography.php");
		die();
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Cryptography</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div id="page">

		<p><a href="./index.html">Home</a>&nbsp;<a href="./cryptography.php?showsource=1">Show source</a></p>

	    <h1>Cryptography</h1>
		<p>This page shows how to do several cryptographic functions using both PHP and JavaScript (via <a href="http://code.google.com/p/crypto-js/">CryptoJS</a>).</p>

		<h2>SHA1</h2>
		<p>
			<b>PHP</b><br />
			<?php echo 'sha1("Hello, world!")<br />' . sha1("Hello, world!") . '<br />'; ?>
		</p>
		<p>
			<b>JavaScript</b><br />
			&lt;script src="http://crypto-js.googlecode.com/svn/tags/3.1.2/build/rollups/sha1.js"&gt;&lt;/script&gt;<br />
			&lt;script&gt;<br />
				CryptoJS.SHA1("Hello, world!");<br />
			&lt;/script&gt;<br />
			<script src="http://crypto-js.googlecode.com/svn/tags/3.1.2/build/rollups/sha1.js"></script>
			<script>document.write(CryptoJS.SHA1("Hello, world!"));</script>
		</p>


		<h2>MD5</h2>
		<p>
			<b>PHP</b><br />
			<?php echo 'md5("Hello, world!")<br />' . md5("Hello, world!") . '<br />'; ?>
		</p>
		<p>
			<b>JavaScript</b><br />
			&lt;script src="http://crypto-js.googlecode.com/svn/tags/3.1.2/build/rollups/md5.js"&gt;&lt;/script&gt;<br />
			&lt;script&gt;<br />
				CryptoJS.MD5("Hello, world!");<br />
			&lt;/script&gt;<br />
			<script src="http://crypto-js.googlecode.com/svn/tags/3.1.2/build/rollups/md5.js"></script>
			<script>document.write(CryptoJS.MD5("Hello, world!"));</script>
		</p>


		<h2>HMAC (SHA1)</h2>
		<p>
			<b>PHP</b><br />
			<?php echo 'hash_hmac("sha1", "Hello, world!", "BillyBob")<br />' . hash_hmac("sha1", "Hello, world!", "BillyBob") . '<br />'; ?>
		</p>
		<p>
			<b>JavaScript</b><br />
			&lt;script src="http://crypto-js.googlecode.com/svn/tags/3.1.2/build/rollups/hmac-sha1.js"&gt;&lt;/script&gt;<br />
			&lt;script&gt;<br />
				CryptoJS.HmacSHA1("Hello, world!", "BillyBob");<br />
			&lt;/script&gt;<br />
			<script src="http://crypto-js.googlecode.com/svn/tags/3.1.2/build/rollups/hmac-sha1.js"></script>
			<script>document.write(CryptoJS.HmacSHA1("Hello, world!", "BillyBob"));</script>
		</p>

	</div>

</body>
</html>

