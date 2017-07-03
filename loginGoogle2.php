<?php

    echo '<h2>$_POST</h2><br />';
    foreach ($_POST as $p => $v)
    {
        echo $p . "=" . $v . "<br />";
    }

    echo '<h2>$_GET</h2><br />';
    foreach ($_GET as $p => $v)
    {
        echo $p . "=" . $v . "<br />";
    }     
?>