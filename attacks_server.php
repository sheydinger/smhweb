<?php
	session_start();

	// If the user entered anything via a form, save it in a session variable.
	if (isset($_POST['myname']) && !empty($_POST['myname']))
		$_SESSION['myname'] = $_POST['myname'];
	if (isset($_POST['mycreditcard']) && !empty($_POST['mycreditcard']))
		$_SESSION['mycreditcard'] = $_POST['mycreditcard'];

	// Write the blog content to a database.  Here, just store the most recent blog post.
	if (isset($_POST['myblogpost']) && !empty($_POST['myblogpost'])) {
		$file = fopen("blogposts.txt", "w");
		fwrite($file, $_POST['myblogpost']);
		fclose($file);
	}
        

	setcookie("password", "Str0ngPaSSw0rd", time()+3600);
?>
<html>
<body>
    <p>Your blog entry has been recorded. <a href="attacks.php">Go Back.</a></p>
</body>
</html>