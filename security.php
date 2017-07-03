<?php
	if ($_GET['showsource'])
	{
		show_source("security.php");
		die();
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Security</title>
<script type="text/javascript">
function createRequest()
{
	try
	{
		request = new XMLHttpRequest();	// Non-IE
	}
	catch (trymicrosoft)
	{
		try
		{
			request = new ActiveXObject("Msxm12.XMLHTTP");
		}
		catch (othermicrosoft)
		{
			try
			{
				request = new ActiveXObject("Microsoft.XMLHTP");
			}
			catch (failed)
			{
				request = null;
			}
		}
	}

	return request;
}

// Create the request objects OUTSIDE of a function so they get created on page load
var request = createRequest();

function updateSHA1()
{
	// Data from the server are only valid when readyState is 4.
	if (request.readyState == 4)
        if (request.status == 200)
        {
			document.getElementById("json").innerHTML = request.responseText;

            // Transfer from JSON DOM to the HTML DOM by turning the JSON "into" Javascript
            var data = eval('('+request.responseText+')');

			document.getElementById("sha1done").innerHTML = "SHA1: <code>" + data.sha1 + "</code>";
		}
}

function getSHA1()
{
	var str=document.getElementById("text").value;

	var url="securityserver.php?action=sha1";

	// Use POST instead of GET to send larger amounts of information in the .send function below.
	request.open("POST", url, true);
	request.onreadystatechange = updateSHA1;

	// Must send the content type (except for Safari)
	// x-www-form-urlencoded means name value pairs, via text
	request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

	request.send("str=" + encodeURIComponent(str));
}

function updateMD5()
{
    // Data from the server are only valid when readyState is 4.
    if (request.readyState == 4)
	if (request.status == 200)
	{
	    document.getElementById("json").innerHTML = request.responseText;

	    // Transfer from JSON DOM to the HTML DOM by turning the JSON "into" Javascript
	    var data = eval('('+request.responseText+')');

	    document.getElementById("md5done").innerHTML = "MD5: <code>" + data.md5 + "</code>";
	}
}

function getMD5()
{
	var str=document.getElementById("text").value;

	var url="securityserver.php?action=md5";

	// Use POST instead of GET to send larger amounts of information in the .send function below.
	request.open("POST", url, true);
	request.onreadystatechange = updateMD5;

	// Must send the content type (except for Safari)
	// x-www-form-urlencoded means name value pairs, via text
	request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

	request.send("str=" + encodeURIComponent(str));
}

function updateHASH()
{
    // Data from the server are only valid when readyState is 4.
    if (request.readyState == 4)
	if (request.status == 200)
	{
	    document.getElementById("json").innerHTML = request.responseText;

	    // Transfer from JSON DOM to the HTML DOM by turning the JSON "into" Javascript
	    var data = eval('('+request.responseText+')');

	    document.getElementById("hashdone").innerHTML = "HASH: <code>" + data.hash + "</code>";
	}
}

function getHASH()
{
	var str=document.getElementById("text").value;
	var algo_idx=document.getElementById("algo_idx").value;

	var url="securityserver.php?action=hash";

	// Use POST instead of GET to send larger amounts of information in the .send function below.
	request.open("POST", url, true);
	request.onreadystatechange = updateHASH;

	// Must send the content type (except for Safari)
	// x-www-form-urlencoded means name value pairs, via text
	request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

	request.send("str=" + encodeURIComponent(str) + "&algo_idx=" + algo_idx);
}

function updateHASH_HMAC()
{
    // Data from the server are only valid when readyState is 4.
    if (request.readyState == 4)
	if (request.status == 200)
	{
	    document.getElementById("json").innerHTML = request.responseText;

	    // Transfer from JSON DOM to the HTML DOM by turning the JSON "into" Javascript
	    var data = eval('('+request.responseText+')');

	    document.getElementById("hashdone").innerHTML = "HASH: <code>" + data.hash + "</code>";
	}
}

function getHASH_HMAC()
{
	var str=document.getElementById("text").value;
	var algo_idx=document.getElementById("algo_idx").value;
	var key=document.getElementById("key").value;

	var url="securityserver.php?action=hash_hmac";

	// Use POST instead of GET to send larger amounts of information in the .send function below.
	request.open("POST", url, true);
	request.onreadystatechange = updateHASH_HMAC;

	// Must send the content type (except for Safari)
	// x-www-form-urlencoded means name value pairs, via text
	request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

	request.send("str=" + encodeURIComponent(str) + "&algo_idx=" + algo_idx + "&key=" + key);
}

function updateHASH_PBKDF2()
{
    // Data from the server are only valid when readyState is 4.
    if (request.readyState == 4)
	if (request.status == 200)
	{
	    document.getElementById("json").innerHTML = request.responseText;

	    // Transfer from JSON DOM to the HTML DOM by turning the JSON "into" Javascript
	    var data = eval('('+request.responseText+')');

	    document.getElementById("hashdone").innerHTML = "HASH: <code>" + data.hash + "</code>";
	}
}

function getHASH_PBKDF2()
{
	var str=document.getElementById("text").value;
	var algo_idx=document.getElementById("algo_idx").value;
	var password=document.getElementById("password").value;
	var salt=document.getElementById("salt").value;
	var iterations=document.getElementById("iterations").value;

	var url="securityserver.php?action=hash_pbkdf2";

	// Use POST instead of GET to send larger amounts of information in the .send function below.
	request.open("POST", url, true);
	request.onreadystatechange = updateHASH;

	// Must send the content type (except for Safari)
	// x-www-form-urlencoded means name value pairs, via text
	request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

	request.send("str=" + encodeURIComponent(str) + "&algo_idx=" + algo_idx + "&password=" + password + "&salt=" + salt + "&iterations=" + iterations);
}

privatekey64 = "";
publickey64  = "";

encrypted64 = "";
signature64 = "";

function updateKeypair()
{
	// Data from the server are only valid when readyState is 4.
	if (request.readyState == 4)
        if (request.status == 200)
        {
			document.getElementById("json").innerHTML = request.responseText;

            // Transfer from JSON DOM to the HTML DOM by turning the JSON "into" Javascript
            var data = eval('('+request.responseText+')');

			privatekey64 = data.privatekey64;
			publickey64  = data.publickey64;

			document.getElementById("privatekeydone").innerHTML = "<code>" + data.privatekeystr + "</code>";
			document.getElementById("publickeydone").innerHTML  = "<code>" + data.publickeystr  + "</code>";
        }
        else
        {
			document.getElementById("privatekeydone").innerHTML = "<b>Private Key: ERROR" + request.responseText + "</b>";
			document.getElementById("publickeydone").innerHTML  = "<b>Public Key: ERROR"  + request.responseText + "</b>";
        }
}

function getKeypair()
{
	// Browswers don't cache POSTs, just GETs, so don't add random values to the end
	var url="securityserver.php?action=rsakeypair" ; // &dummy=" + new Date().getTime();

	// Use POST instead of GET to send larger amounts of information in the .send function below.
	request.open("GET", url, true);
	request.onreadystatechange = updateKeypair;

	// Must send the content type (except for Safari)
	// x-www-form-urlencoded means name value pairs, via text
	request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

	request.send();
}



function updateEncryptPublic()
{
	// Data from the server are only valid when readyState is 4.
	if (request.readyState == 4)
        if (request.status == 200)
        {
			document.getElementById("json").innerHTML = request.responseText;

            var data = eval('('+request.responseText+')');
			encrypted64 = data.encrypted64;

			document.getElementById("text").value = encrypted64;
        }
        else
        {
			document.getElementById("text").value = "ERROR: " + request.responseText;
        }
}

function encryptPublic()
{
	var str=document.getElementById("text").value;

	var url="securityserver.php?action=encryptpublic";

	// Use POST instead of GET to send larger amounts of information in the .send function below.
	request.open("POST", url, true);
	request.onreadystatechange = updateEncryptPublic;

	// Must send the content type (except for Safari)
	// x-www-form-urlencoded means name value pairs, via text
	request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

	request.send("decrypted=" + encodeURIComponent(str) + "&publickey64=" + publickey64 + "&privatekey64=" + privatekey64);
}



function updateDecryptPrivate()
{
	// Data from the server are only valid when readyState is 4.
	if (request.readyState == 4)
        if (request.status == 200)
        {
			document.getElementById("json").innerHTML = request.responseText;

            var data = eval('('+request.responseText+')');

			document.getElementById("text").value = data.decrypted;
        }
        else
        {
			document.getElementById("text").value = "ERROR: " + request.responseText;
        }
}

function decryptPrivate()
{
//	var str=document.getElementById("text").value;

	// Browswers don't cache POSTs, just GETs, so don't add random values to the end
	var url="securityserver.php?action=decryptprivate" ; // &dummy=" + new Date().getTime();

	// Use POST instead of GET to send larger amounts of information in the .send function below.
	request.open("POST", url, true);
	request.onreadystatechange = updateDecryptPrivate;

	// Must send the content type (except for Safari)
	// x-www-form-urlencoded means name value pairs, via text
	request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

	// Use encodeURIComponent to URI encode POST data.  Apparently, base64
	// encoded keys don't have any digits that require the coding.  Use
	// the PHP urldecode() function to undo encodeURIComponent().
	request.send("encrypted64=" + encodeURIComponent(encrypted64) + "&privatekey64=" + privatekey64);
}





function updateSign()
{
	// Data from the server are only valid when readyState is 4.
	if (request.readyState == 4)
        if (request.status == 200)
        {
			document.getElementById("json").innerHTML = request.responseText;

            var data = eval('('+request.responseText+')');
			signature64 = data.signature64;

			document.getElementById("signature").innerHTML = "<code>" + signature64 + "</code>";
        }
        else
        {
			document.getElementById("signature").value = "ERROR: " + request.responseText;
        }
}

function sign()
{
	var url="securityserver.php?action=sign";

	var str=document.getElementById("text").value;

	// Use POST instead of GET to send larger amounts of information in the .send function below.
	request.open("POST", url, true);
	request.onreadystatechange = updateSign;

	// Must send the content type (except for Safari)
	// x-www-form-urlencoded means name value pairs, via text
	request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

	request.send("decrypted=" + encodeURIComponent(str) + "&publickey64=" + publickey64 + "&privatekey64=" + privatekey64);
}





function updateVerify()
{
	// Data from the server are only valid when readyState is 4.
	if (request.readyState == 4)
        if (request.status == 200)
        {
			document.getElementById("json").innerHTML = request.responseText;

            var data = eval('('+request.responseText+')');
			signature64 = data.signature64;

			document.getElementById("signature").innerHTML = "<code>" + signature64 + "</code>";

			if (data.result == "correct")
				alert('correct');
			else if (data.result == "incorrect")
				alert('incorrect');
			else if (data.result == "error")
				alert('error');
        }
        else
        {
			document.getElementById("signature").value = "ERROR: " + request.responseText;
        }
}

function verify()
{
	var url="securityserver.php?action=verify";

	var str=document.getElementById("text").value;

	// Use POST instead of GET to send larger amounts of information in the .send function below.
	request.open("POST", url, true);
	request.onreadystatechange = updateVerify;

	// Must send the content type (except for Safari)
	// x-www-form-urlencoded means name value pairs, via text
	request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

	request.send("decrypted=" + encodeURIComponent(str) + "&publickey64=" + publickey64 + "&signature64=" + encodeURIComponent(signature64));
}
</script>
<link rel="stylesheet" type="text/css" href="style.css">

</head>


<body>

	<div id="page">

		<p><a href="./index.html">Home</a>&nbsp;<a href="./security.php?showsource=1">Show source</a></p>

		<h1>Internet Security Demonstration</h1>
		<p>Use PHP to hash, sign, or encrypt a message.  The PHP is in the file <a href="./securityserver.php?showsource=1">securityserver.php</a>.
		Try cracking the hash at <a href="http://www.crackstation.net">CrackStation.net</a>.</p>

		<h2>Type something here...</h2>

		<form>
			<textarea rows="4" cols="80" id="text"></textarea><br />
		</form> 

		<h2>Do some encryption...</h2>

		<div class="entry">
			<h3>Hash</h3>
			<input type="button" value="sha1()" onclick="getSHA1()">
			<input type="button" value="md5()" onclick="getMD5()">
			<p id="sha1done">SHA1:</p>
			<p id="md5done">MD5:</p>
		</div>

		<div class="entry">
			<h3>Cryptographic Extensions</h3>
			<form action="">
			    Algorithm: 
			    <select id="algo_idx">
<?php
				$algos_list = hash_algos();
				foreach ($algos_list as $p => $v)
				{
				    echo '<option value="' . $p . '">' . $v . '</option>';
				} 
?>
			    </select>
			    Key: <input type="text" id="key">
			    Password: <input type="text" id="password">
			    Salt: <input type="text" id="salt">
			    Iterations: <input type="text" id="iterations"><br />
			    <input type="button" value="hash(algo, data)" onclick="getHASH()">
			    <input type="button" value="hash_hmac(algo, data, key)" onclick="getHASH_HMAC()">
			    <input type="button" value="hash_pbkdf2(algo, password, salt, iterations)" onclick="getHASH_PBKDF2()">
			</form>
			<p id="hashdone">HASH:</p>
		</div>

		<div class="entry">
			<h3>Signature</h3>
			<input type="button" value="Sign" onclick="sign()"> 
			<input type="button" value="Verify" onclick="verify()"><br />
			<p id="signature">signature</p>
		</div>

		<div class="entry">
			<h3>Generate RSA Keypair</h3>
			<input type="button" value="Encrypt with Public" onclick="encryptPublic()">
			<input type="button" value="Decrypt with Private" onclick="decryptPrivate()"><br />
			<input type="button" value="Generate Keypair" onclick="getKeypair()"> 
			<p id="privatekeydone">Private Key:</p>
			<p id="publickeydone">Public Key:</p>
		</div>

		<div class="entry">
			<h3>Response</h3>
			<p id="json"></p>
		</div>
</div>
</body>
</html>
