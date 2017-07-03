<?php
    if (isset($_GET['showsource']))
    {
	show_source("form.php");
	die();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Simple Form Demo</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body>

<div id="page">

	<p><a href="./index.html">Home</a>&nbsp;Show source:&nbsp;
	<a href="./phpform_simple.php?showsource=1">phpform_simple.php</a></p>
	
	<h2>Forms</h2>

	<h3>Not Pre-Filled</h3>
	<form name="regForm" method="post" action="phpform_simple.php">
		<input name="myText" type="text" size="10" maxlength="15">
		<input name="myRadio" type="radio" value="Male">M
		<input name="myRadio" type="radio" value="Female">F
		<select name="myComboBox[]" size="2" multiple="multiple">
			<option value="spring" selected="selected">Spring</option>
			<option value="summer" selected="selected">Summer</option>
			<option value="winter">Winter</option>
			<option value="fall">Fall</option>
		</select>
		<select name="myPulldown">
			<option value="thu">Thursday</option>
			<option value="fri">Friday</option>
			<option value="sat">Saturday</option>
			<option value="sun">Sunday</option>
		</select>
		<input name="myCheckbox" type="checkbox" value="1">I agree
		<input type="submit" name="mySubmit" value="Submit">
		<input type="reset" name="myReset" value="Reset">
		<input type="hidden" name="myHidden" value="hidden value">
	</form>

	<h3>Prefilled</h3>
	<form name="regForm" method="post" action="phpform_simple.php">
		<?php if(isset($_POST['myText'])) : ?>
			<input name="myText" type="text" size="10" maxlength="15" value="<?php echo $_POST['myText']; ?>">
		<?php else : ?>
			<input name="myText" type="text" size="10" maxlength="15" value="">
		<?php endif; ?>

		<?php if(isset($_POST['myRadio'])) : ?>
			<input name="myRadio" type="radio" value="Male" <?php if ($_POST['myRadio'] == 'Male') {echo 'checked="checked"';} ?>>M
			<input name="myRadio" type="radio" value="Female" <?php if ($_POST['myRadio'] == 'Female') {echo 'checked="checked"';} ?>>F
		<?php else : ?>
			<input name="myRadio" type="radio" value="Male">M
			<input name="myRadio" type="radio" value="Female">F
		<?php endif; ?>

		<select name="myComboBox[]" size="2" multiple="multiple">
			<option value="spring" selected="selected">Spring</option>
			<option value="summer" selected="selected">Summer</option>
			<option value="winter">Winter</option>
			<option value="fall">Fall</option>
		</select>

		<?php if(isset($_POST['myPulldown'])) : ?>
			<select name="myPulldown">
				<option value="thu" <?php if ($_POST['myPulldown'] == 'thu') {echo 'selected="selected"';} ?>>Thursday</option>
				<option value="fri" <?php if ($_POST['myPulldown'] == 'fri') {echo 'selected="selected"';} ?>>Friday</option>
				<option value="sat" <?php if ($_POST['myPulldown'] == 'sat') {echo 'selected="selected"';} ?>>Saturday</option>
				<option value="sun" <?php if ($_POST['myPulldown'] == 'sun') {echo 'selected="selected"';} ?>>Sunday</option>
			</select>
		<?php else : ?>
			<select name="myPulldown">
				<option value="thu">Thursday</option>
				<option value="fri" selected="selected">Friday</option>
				<option value="sat">Saturday</option>
				<option value="sun">Sunday</option>
			</select>
		<?php endif; ?>

		<?php if(isset($_POST['myCheckbox'])) : ?>
			<input name="myCheckbox" type="checkbox" value="1" checked="checked">
		<?php else : ?>
			<input name="myCheckbox" type="checkbox" value="1">
		<?php endif; ?>
		I agree

		<input type="submit" name="mySubmit" value="Submit">

		<input type="reset" name="myReset" value="Reset">

		<input type="hidden" name="myHidden" value="hidden value">
	</form>


	<h3>Results</h3>
	<table border="1">
		<tr>
		<td>myVar</td>
		<td>$_POST['myVar']&nbsp;</td>
		<td>isset($_POST['myVar'])</td>
		<td>empty($_POST['myVar'])</td>
		</tr>

		<tr>
		<td>myText</td>
		<td><?php echo $_POST['myText'] ?>&nbsp;</td>
		<td><?php if(isset($_POST['myText'])) {echo 'TRUE';} else {echo 'FALSE';}; ?></td>
		<td><?php if(empty($_POST['myText'])) {echo 'TRUE';} else {echo 'FALSE';}; ?></td>
		</tr>

		<tr>
		<td>myRadio</td>
		<td><?php echo $_POST['myRadio'] ?>&nbsp;</td>
		<td><?php if(isset($_POST['myRadio'])) {echo 'TRUE';} else {echo 'FALSE';}; ?></td>
		<td><?php if(empty($_POST['myRadio'])) {echo 'TRUE';} else {echo 'FALSE';}; ?></td>
		</tr>

		<tr>
		<td>myComboBox</td>
		<td><?php echo $_POST['myComboBox'] ?>&nbsp;</td>
		<td><?php if(isset($_POST['myComboBox'])) {echo 'TRUE';} else {echo 'FALSE';}; ?></td>
		<td><?php if(empty($_POST['myComboBox'])) {echo 'TRUE';} else {echo 'FALSE';}; ?></td>
		</tr>

		<tr>
		<td>myPulldown</td>
		<td><?php echo $_POST['myPulldown'] ?>&nbsp;</td>
		<td><?php if(isset($_POST['myPulldown'])) {echo 'TRUE';} else {echo 'FALSE';}; ?></td>
		<td><?php if(empty($_POST['myPulldown'])) {echo 'TRUE';} else {echo 'FALSE';}; ?></td>
		</tr>

		<tr>
		<td>myCheckbox</td>
		<td><?php echo $_POST['myCheckbox'] ?>&nbsp;</td>
		<td><?php if(isset($_POST['myCheckbox'])) {echo 'TRUE';} else {echo 'FALSE';}; ?></td>
		<td><?php if(empty($_POST['myCheckbox'])) {echo 'TRUE';} else {echo 'FALSE';}; ?></td>
		</tr>

		<tr>
		<td>mySubmit</td>
		<td><?php echo $_POST['mySubmit'] ?>&nbsp;</td>
		<td><?php if(isset($_POST['mySubmit'])) {echo 'TRUE';} else {echo 'FALSE';}; ?></td>
		<td><?php if(empty($_POST['mySubmit'])) {echo 'TRUE';} else {echo 'FALSE';}; ?></td>
		</tr>

		<tr>
		<td>myHidden</td>
		<td><?php echo $_POST['myHidden'] ?>&nbsp;</td>
		<td><?php if(isset($_POST['myHidden'])) {echo 'TRUE';} else {echo 'FALSE';}; ?></td>
		<td><?php if(empty($_POST['myHidden'])) {echo 'TRUE';} else {echo 'FALSE';}; ?></td>
		</tr>
	</table>

	<h3>myText</h3>
	<?php
		$data=$_POST['myText']; 
		echo "'" . $data . "', trim='";
		$data = trim($data);
		echo $data . "', stripslashes='";
		$data = stripslashes($data);
		echo $data . "', htmlspecialchars='";
		$data = htmlspecialchars($data);
		echo $data . "'";
	?>

	<h3>myComboBox</h3>
	<?php
		if (isset($_POST['myComboBox']))
		{
			$combobox = $_POST['myComboBox'];
			foreach ($combobox as $s) {
				echo "$s, ";
			} 
		} 
	?>

	<h3>$_POST array</h3>
	<?php
		foreach ($_POST as $p => $v)
		{
			echo "The value at '$p' is '$v'<br />";
		}
	?>
</div>
</body>
</html>
