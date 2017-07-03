<?php

	if (isset($_GET['showsource']))
	{
		show_source("ajaxserver.php");
		die();
	}
	
	if (!isset($_GET['action']))
	{
		echo "Error - no action.";
		return;
	}

	else if ($_GET['action'] == 'date')
		echo date("l dS \of F Y h:i:s A");

	else if ($_GET['action'] == 'sqrt')
		echo sqrt($_GET['square']);


	else if ($_GET['action'] == 'timer')
	{
		$beg = idate("U");

		// wait 10 sec before returning
		while (idate("U") - $beg < 5)
			;

		// return the number of the timer that is done
		echo $_GET['whichtimer'];
	}

	else if ($_GET['action'] == 'sum')
		echo $_POST['addend1'] + $_POST['addend2'];

	else if ($_GET['action'] == 'address')
	{
		header("Content-Type: text/xml");

		echo '<?xml version="1.0" encoding="utf-8"?>';
		echo '<address>';
		echo '<name>Barak Obama</name>';
		echo '<street>1600 Pennsylvania Ave.</street>';
		echo '<city>Washington</city>';
		echo '<state>DC</state>';
		echo '<zip>20500</zip>';
		echo '</address>';
	}

	else if ($_GET['action'] == 'address2')
	{
		echo '{"address": [{"name": "Joe Biden","street": "3450 Massachusetts Ave.","city": "Washington","state": "DC","zip": "20392"}]}';
	}

	else if ($_GET['action'] == 'states')
	{
		$name = array(
			" 0 Alabama",        " 1 Alaska",      " 2 Arizona",        " 3 Arkansas",      " 4 California",
			" 5 Colorado",       " 6 Connecticut", " 7 Delaware",       " 8 Florida",       " 9 Georgia",
			"10 Hawaii",         "11 Idaho",       "12 Illinois",       "13 Indiana",       "14 Iowa",
			"15 Kansas",         "16 Kentucky",    "17 Louisiana",      "18 Maine",         "19 Maryland",
			"20 Massachussetts", "21 Michigan",    "22 Minnesota",      "23 Mississippi",   "24 Missouri",
			"25 Montana",        "26 Nebraska",    "27 Nevada",         "28 New Hampshire", "29 New Jersey",
			"30 New Mexico",     "31 New York",    "32 North Carolina", "33 North Dakota",  "34 Ohio",
			"35 Oklahoma",       "36 Oregon",      "37 Pennsylvania",   "38 Rhode Island",  "39 South Carolina",
			"40 South Dakota",   "41 Tennessee",   "42 Texas",          "43 Utah",          "44 Vermont",
			"45 Virginia",       "46 Washington",  "47 West Virginia",  "48 Wisconsin",     "49 Wyoming");

		$abbreviation = array(
			"AL", "AK", "AZ", "AR", "CA", "CO", "CT", "DE", "FL", "GA",
			"HI", "ID", "IL", "IN", "IA", "KS", "KY", "LA", "ME", "MD",
			"MA", "MI", "MN", "MS", "MO", "MT", "NE", "NV", "NH", "NJ",
			"NM", "NY", "NC", "ND", "OH", "OK", "OR", "PA", "RI", "SC",
			"SD", "TN", "TX", "UT", "VT", "VA", "WA", "WV", "WI", "WY");

		$capital = array(
			"Montgomery",    "Juneau",    "Phoenix",     "Little Rock",    "Sacramento",
			"Denver",        "Hartford",  "Dover",       "Tallahassee",    "Atlanta",
			"Honolulu",      "Boise",     "Springfield", "Indianapolis",   "Des Moines",
			"Topeka",        "Frankfort", "Baton Rouge", "Augusta",        "Annapolis",
			"Boston",        "Lansing",   "St. Paul",    "Jackson",        "Jefferson City",
			"Helena",        "Lincoln",   "Carson City", "Concord",        "Trenton",
			"Santa Fe",      "Albana",    "Raleigh",     "Bismark",        "Columbus",
			"Oklahoma City", "Salem",     "Harrisburg",  "Providence",     "Columbia",
			"Pierre",        "Nashville", "Austin",      "Salt Lake City", "Montpelier",
			"Richmond",      "Olympia",   "Charleston",  "Madison",        "Cheyenne");

		// Respond with some JSON
		if (isset($_GET['state']))
		{
			$which = (int) $_GET['state'];
			if (0 <= $which && $which < 50)
				echo '{"name":"' . $name[$which] . '","abbreviation":"' . $abbreviation[$which] . '","capital":"' . $capital[$which] . '"}';
		}
		else
		{
			echo '{"states":[';
			for ($i=0; $i<50; $i++)
			{
				echo '{"name":"' . $name[$i] . '","abbreviation":"' . $abbreviation[$i] . '","capital":"' . $capital[$i] . '"}';
				if ($i < 49)
					echo ',';
			}
			echo ']}';
		}
	}

	// See http://www.php.net/manual/en/features.file-upload.post-method.php
	else if ($_GET['action'] == 'upload')
	{
		// userfile shows up as name="userfile" in the calling form.
		// If uploading multiple files, need multiple name= for each.
		// "name" and "size" are provided by PHP.
//		if (basename($_FILES['userfile']['name']) != "uploadme.txt")
//		{
//			echo "File must be named uploadme.txt and under 100 bytes.";
//			die();
//		}
//		if ($_FILES['userfile']['size'] > 100)
//		{
//			echo "File must be named uploadme.txt and under 100 bytes.";
//			die();
//		}

		$uploaddir = './uploads/';
		$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

		if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile))
		{
			echo "File is valid, and was successfully uploaded.\n";
		}
		else
		{
			echo "Possible file upload attack!\n";
		}
	}

	else
		echo "No idea";

	// Show some debug information
	// ===========================

	if (isset($_GET['showget']))
	{
		echo "<br /><br />GET<br />";
		foreach ($_GET as $key=>$val)
		    echo $key. ": ".$val. "<br>";
	}

	if (isset($_GET['showpost']))
	{
		echo "<br /><br />POST<br />";
		foreach ($_POST as $key=>$val)
		    echo $key. ": ".$val. "<br>";
	}

	if (isset($_GET['showserver']))
	{
		echo "<br /><br />SERVER<br />";
		foreach ($_SERVER as $key=>$val)
		    echo $key. ": ".$val. "<br>";
	}

	if (isset($_GET['showfiles']))
	{
		if (isset($_GET['plain']))
		{
			echo "FILES\n";
			foreach ($_FILES as $key=>$val)
			{
				echo $key. ": ".$val. "\n";
				foreach ($val as $key2=>$val2)
					echo "   ".$key2. ": ".$val2. "\n";
				echo "\n";
			}
		}
		else
		{
			// The FILES variable is a 2-D array, with a set of values for each uploaded file.
			echo "<br /><br />FILES<br />";
			foreach ($_FILES as $key=>$val)
			{
				echo $key. ": ".$val. "<br />";
				foreach ($val as $key2=>$val2)
					echo "&nbsp;&nbsp;&nbsp;".$key2. ": ".$val2. "<br />";
				echo "<br />";
			}
		}
	}

	if (isset($_GET['showcookie']))
	{
		echo "<br /><br />SESSION<br />";
		foreach ($_COOKIE as $key=>$val)
		    echo $key. ": ".$val. "<br>";
	}

	if (isset($_GET['showsession']))
	{
		echo "<br /><br />SESSION<br />";
		foreach ($_SESSION as $key=>$val)
		    echo $key. ": ".$val. "<br>";
	}
?>