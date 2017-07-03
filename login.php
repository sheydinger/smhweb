<?php
    if ($_GET['showsource'])
    {
	show_source("password.php");
	die();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Login</title>


<!-- Begin: Google+ Sign-In -->
<script type='text/javascript'>
function signinCallback(authResult) {
  if (authResult['access_token']) {
    // Successfully authorized
    // Hide the sign-in button now that the user is authorized, for example:
    document.getElementById('signinButton').setAttribute('style', 'display: none');
    console.log('logged in!');
  } else if (authResult['error']) {
    // There was an error.
    // Possible error codes:
    //   "access_denied" - User denied access to your app
    //   "immediate_failed" - Could not automatically log in the user
    console.log('There was an error: ' + authResult['error']);
  }
}
<!-- End: Google+ Sign-In -->


</script>

<link rel="stylesheet" type="text/css" href="style.css">

</head>
<body onload="done()">

    <div id="page">

	<p><a href="./index.html">Home</a>&nbsp;Show source:&nbsp;
	<a href="./login.php?showsource=1">password.php</a>
	</p>

	<h1>Google+ Sign-In</h1>
	<p>See <a href="https://developers.google.com/+/web/signin/">Google+ Sign-In</a>.</p>
	<p><a href="https://code.google.com/apis/console/?pli=1#project:192226233750:access">API Console: Scott's Google+ Sign-In Demo</a></p>
	<p>Client ID: 192226233750.apps.googleusercontent.com, Client Secret: p_ATijtANd44eYzpBRWJvUqS</p>
	<p><a href="https://accounts.google.com/b/0/IssuedAuthSubTokens?hl=en">Revoke Google Account Permissions</a></p>


	<div class="entry">
	    <span id="signinButton">
	      <span
		class="g-signin"
		data-callback="signinCallback"
		data-clientid="192226233750.apps.googleusercontent.com"
		data-cookiepolicy="single_host_origin"
		data-requestvisibleactions="http://schemas.google.com/AddActivity"
		data-scope="https://www.googleapis.com/auth/plus.login">
	      </span>
	    </span>

	</div>

    </div>

    <!-- Begin: Google+ Sign-In -->
    <!-- Place this asynchronous JavaScript just before your </body> tag -->
    <script type="text/javascript">
	(function() {
	    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
	    po.src = 'https://apis.google.com/js/client:plusone.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
	})();
    </script>
    <!-- End: Google+ Sign-In -->

</body>
</html>
