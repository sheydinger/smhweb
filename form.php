<?php
    if (isset($_GET['showsource']))
    {
	show_source("form.php");
	die();
    }
    
    // Validate data
    // =============
    $first_name = "";
    $last_name  = "";

    // Display this next to the field
    $err_first_name = "";
    $err_last_name  = "";

    $err = 0;		/* Increment for each error */
    $show_form = TRUE;	/* TRUE when showing form, false to review cart */

    if (isset($_POST['docheck']) == TRUE)
    {
	if (isset($_POST['first_name']) == TRUE)
	{
	    $first_name = $_POST['first_name'];
	    $first_name = trim($first_name);
	    $first_name = stripslashes($first_name);
	    $first_name = htmlspecialchars($first_name);
	}
	if (empty($first_name))
	{
	    $err_first_name = "Required";
	    $err += 1;
	}

	if (isset($_POST['last_name']) == TRUE)
	{
	    $last_name = $_POST['last_name'];
	    $last_name = trim($last_name);
	    $last_name = stripslashes($last_name);
	    $last_name = htmlspecialchars($last_name);
	}
	if (empty($last_name))
	{
	    $err_last_name = "Required";
	    $err += 1;
	}

	if ($err == 0)
	    $show_form = FALSE;
    }

    /* Even if there are no errors, show the form if the user asked to modify it. */
    if (isset($_POST['modifycart_x']) == TRUE || isset($_POST['modifycart']) == TRUE)
	$show_form = TRUE;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Form</title>
<link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>

    <div id="page">

	<p><a href="./index.html">Home</a>&nbsp;Show source:&nbsp;
	<a href="./form.php?showsource=1">form.php</a></p>

	<h1>Form</h1>
	<p>This page shows how to handle forms.</p>

<?php if ($show_form) : { ?>
	<form action="form.php" method="post">
	    <label for="first_name">First Name:</label>
	    <input type="text" name="first_name" id="first_name" size="35" maxlength="60" value="<?php echo $first_name; ?>" />
	    <span class="reg_error"><?php echo $err_first_name; ?></span><br />

	    <label for="last_name">Last Name:</label>
	    <input type="text" name="last_name" id="last_name" size="35" maxlength="60" value="<?php echo $last_name; ?>" />
	    <span class="reg_error"><?php echo $err_last_name; ?></span><br />

	    <input type="hidden" name="docheck" value="1"/>
	    <input type="submit" name="updatecart" value="Continue >>" />
	</form>
<?php } else : { ?>
	<p>
	Name:
	    <?php
		echo $first_name ." " . $last_name;
	    ?>
	</p>

	<form action="form.php" method="post">
	    <input type="hidden" name="first_name" value="<?php echo $first_name; ?>" />
	    <input type="hidden" name="last_name" value="<?php echo $last_name; ?>" />

	    <input type="hidden" name="docheck" value="1"/>
	    <input type="submit" name="modifycart" value="<< Change" />
	</form>

        <form action="pay.php" method="post">
	    <input type="hidden" name="first_name" value="<?php echo $first_name; ?>" />
	    <input type="hidden" name="last_name" value="<?php echo $last_name; ?>" />

    	<input type="hidden" name="docheck" value="1"/>
	    <input type="submit" name="continue" value=">> Done" />
	</form>
<?php } endif; ?>
    </div>

</body>
</html>
