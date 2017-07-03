<!DOCTYPE html>

<html>
<head>
    <title>Javascript vs. PHP</title>
</head>

<body>

<script>
    // Date is a Javascript object that defaults to today.
    
    // Make an "instance" of date.  We could have multiple Date
    // variables that represent different dates.
    var today = new Date();
    
    switch (today.getDay())
    {
        case 0:
            document.writeln("Happy Sunday, from Javascript!<br />");
            break;
        case 1:
            document.writeln("Happy Monday, from Javascript!<br />");
            break;
        case 2:
            document.writeln("Happy Tuesday, from Javascript!<br />");
            break;
        case 3:
            document.writeln("Happy Wednesday, from Javascript!<br />");
            break;
        case 4:
            document.writeln("Happy Thursday, from Javascript!<br />");
            break;
        case 5:
            document.writeln("Happy Friday, from Javascript!<br />");
            break;
        case 6:
            document.writeln("Happy Saturday, from Javascript!<br />");
            break;
    }
</script>

<?php
    // PHP variables start with '$'
    $dayofweek = date("N");

    switch ($dayofweek)
    {
        case 0:
            echo "Happy Sunday, from PHP!";
            break;
        case 1:
            echo "Happy Monday, from PHP!";
            break;
        case 2:
            echo "Happy Tuesday, from PHP!";
            break;
        case 3:
            echo "Happy Wednesday, from PHP!";
            break;
        case 4:
            echo "Happy Thursday, from PHP!";
            break;
        case 5:
            echo "Happy Friday, from PHP!";
            break;
        case 6:
            echo "Happy Saturday, from PHP!";
            break;
    }
?>

</body>
</html>