<!--
/*
 One use of cURL is as an analog to AJAX from JavaScript.  In other words,
 a PHP page can call another PHP page for a result.  This page calls the
 methods in ajaxserver.php.  Rather than do a redirect, it calls ajaxserver.php
 and gets the result back in a variable.
 
 Be patient when loading this page!  It includes examples of the Timer calls!
*/
-->
<html>
<head>
    <title>PHP cURL Demonstration</title>
</head>
<body>

<h1>No Idea</h1>
<?php
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "http://www.theunclassroom.org/phpman/ajaxserver.php");

    // Without this, the curl_exec() call automatically echos the JSON results
    // and returns TRUE or FALSE,  With this, it returns the result or FALSE (failure).
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $result = curl_exec($ch);
    curl_close($ch);

    echo '<p>Result: ' . $result . '</p>';
?>


<h1>Date</h1>
<?php
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "http://www.theunclassroom.org/phpman/ajaxserver.php?action=date");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);

    echo '<p>The date is: ' . $result . '</p>';
?>


<h1>Square Root</h1>
<?php
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "http://www.theunclassroom.org/phpman/ajaxserver.php?action=sqrt&square=25");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);

    echo '<p>The square root of 25 is: ' . $result . '</p>';
?>


<h1>Sum</h1>
<?php
    $fields = array(
        'addend1' => '2',
        'addend2' => '3',
    );
    foreach ($fields as $key=>$value) {
        $fields_string .= $key . '=' . $value . '&';
    }
    rtrim($fields_string, '&');

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "http://www.theunclassroom.org/phpman/ajaxserver.php?action=sum");
    curl_setopt($ch, CURLOPT_POST, count($fields));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);

    echo '<p>The sum of 2 + 3 is: ' . $result . '</p>';
?>



<h1>Address (XML)</h1>
<?php
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "http://www.theunclassroom.org/phpman/ajaxserver.php?action=address");

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);

    echo '<p>The address is: ' . $result . '</p>';

    $arr = new SimpleXmlElement($result, LIBXML_NOCDATA);
    
    echo $arr->name . "<br />";
    echo $arr->street . "<br />";
    echo $arr->city . ", " . $arr->state . "  " . $arr->zip . "<br />";
?>



<h1>Address2 (JSON)</h1>
<?php
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "http://www.theunclassroom.org/phpman/ajaxserver.php?action=address2");

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);

    echo '<p>The address is: ' . $result . '</p>';
    
    // The top level object is an array.
    $arr = json_decode($result);
    echo "There is " . sizeof($arr) . " address:<br />";
    echo $arr->address[0]->name . "<br />";
    echo $arr->address[0]->street . "<br />";
    echo $arr->address[0]->city . ", " . $arr->address[0]->state . "  " . $arr->address[0]->zip . "<br />";
?>


<h1>Timer 1</h1>
<?php
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "http://www.theunclassroom.org/phpman/ajaxserver.php?action=timer&whichtimer=1");

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);

    if ($result == FALSE)
        echo '<p>The timer has failed</p>';
    else
        echo '<p>The timer has returned (timer #' . $result . ')</p>';
?>


<h1>Timer 2</h1>
<?php
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "http://www.theunclassroom.org/phpman/ajaxserver.php?action=timer&whichtimer=2");
    
    // Set timeout to 2 sec.  The timer lasts for 5 sec. so no result.
    curl_setopt($ch, CURLOPT_TIMEOUT, 2);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);

    if ($result == FALSE)
        echo '<p>The timer has failed</p>';
    else
        echo '<p>The timer has returned (timer #' . $result . ')</p>';
?>

</body>
</html>
