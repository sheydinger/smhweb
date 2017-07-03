<?php
    if (isset($_GET['showsource']) && $_GET['showsource'])
    {
	show_source("showphpvariables.php");
	die();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Show PHP Variables</title>

<link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>

    <div id="page">

	<p><a href="./index.html">Home</a>&nbsp;Show source:&nbsp;
	<a href="./showphpvariables.php?showsource=1">showphpvariables.php</a>
	</p>

	<div class="entry">
	    <h3>$_SERVER</h3>
	    <?php
		foreach ($_SERVER as $key=>$val)
		    echo $key. ": ".$val. "<br>";
	    ?>

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
	    
	    <h3>$_POST</h3>
	    <?php
		foreach ($_POST as $key=>$val)
		    echo $key. ": ".$val. "<br>";
	    ?>

	    <h3>$_GLOBALS</h3>
	    <?php
		foreach ($_GLOBALS as $key=>$val)
		    echo $key. ": ".$val. "<br>";
	    ?>

	</div>

    </div>

</body>
</html>
