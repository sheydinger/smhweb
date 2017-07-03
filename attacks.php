<?php
	if (isset($_GET['showsource']))
	{
		show_source("attacks.php");
		die();
	}

	session_start();
?>
<html lang="en">
<head>
	<title>Attacks</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

	<div id="page">

		<p><a href="http://www.theunclassroom.org/smhweb/index.html">Home</a>&nbsp;<a href="http://www.theunclassroom.org/smhweb/attacks.php?showsource=1">Show source</a></p>

		<h1>Attacks</h1>

		<p>Welcome to a horribly insecure web site!  This page simulates a store that needs your
		name and credit card information, and a blog.  </p>

		<form action="attacks_server.php" method="post">
			Name: <input type="text" width="10" name="myname"> Credit Card No: <input type="text" width="10" name="mycreditcard"><br />
			Enter your post:  (Only one post is stored on the server)<br />
			<textarea rows="8" cols="115" name="myblogpost"></textarea><br />
			<button type="clear">Clear</button><button type="submit" >Submit</button>
			<input type="hidden" name="rand" value="<?php echo rand(); ?>">
		</form>


		<h2>Blog entries</h2>
		<div style="padding:20px; background:#a0a0a0; color:#000000">
			<?php
				// Read the one stored entry from blogposts.txt.
				$entry = @file_get_contents("blogposts.txt");
				echo $entry;
			?>
		</div>


		<hr />

		<p>
			<b>htmlentities()</b><br />
			<?php
				if (isset($entry))
				{
					echo(htmlentities(stripslashes($entry)));
				}
			?>
		</p>
		<p>Welcome to the world's worst web sites. Cross Site Scripting (XSS) attacks can occur when a site allows someone
		to type into a form field and the result is "posted" on the site.  This site has no protections against
		XSS attacks.  A malicious user can enter content that appears like HTML and/or JavaScript
		which then gets executed.  For this "blog" the entries typed below aren't retained in a database.  Instead, they're just
		shown when you press submit.  If they were stored in a database and redisplayed then you could effectively
		add permanent new functionality to this page!</p>

		<p>This page also includes the use of sessions.  The sessions are stored on an Apache server at
		c:\wamp\tmp\sess_* where * is the session id.  Some types of attacks involve stealing someone's
		session.</p>

		<h1>Debug</h1>
		<?php
			echo '<h2>$_COOKIE</h2><br />';
			foreach ($_COOKIE as $p => $v)
			{
				echo "The cookie at '$p' is '" . htmlentities(stripslashes($v)) . "'<br />";
			}

			echo '<h2>$_SESSION</h2><br />';
			if (isset($_SESSION))
			{
				foreach ($_SESSION as $p => $v)
				{
					echo "The session at '$p' is '" . htmlentities(stripslashes($v)) . "'<br />";
				}
			}

			echo '<h2>$_POST</h2><br />';
			foreach ($_POST as $p => $v)
			{
				echo "The post at '$p' is '" . htmlentities(stripslashes($v)) . "'<br />";
			}

			echo '<h2>$_GET</h2><br />';
			foreach ($_GET as $p => $v)
			{
				echo "The get at '$p' is '" . htmlentities(stripslashes($v)) . "'<br />";
			}

			echo '<h2>$_SERVER</h2><br />';
			foreach ($_SERVER as $p => $v)
			{
				echo "The server at '$p' is '" . htmlentities(stripslashes($v)) . "'<br />";
			}
		?>
	</div>
</body>
</html>
