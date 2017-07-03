<?php
if ($_FILES["file"]["error"] > 0)
{
    echo "Error: " . $_FILES["file"]["error"] . "<br>";
}
else
{
    echo "Upload: " . $_FILES["file"]["name"] . "<br>";
    echo "Type: " . $_FILES["file"]["type"] . "<br>";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
    echo "Stored in: " . $_FILES["file"]["tmp_name"];  

/*
    The results shown above look like

    Upload: uploadme.txt
    Type: text/plain
    Size: 0.0205078125 kB
    Stored in: /tmp/phpJDCHVR
    
    The /tmp directory file is removed when the script ends, so move to a new location.
*/
    
    move_uploaded_file($_FILES["file"]["tmp_name"], $_FILES["file"]["name"]);}
?> 