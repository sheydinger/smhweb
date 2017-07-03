<?php
	if ($_GET['showsource'])
	{
		show_source("http_post.php");
		die();
	}
?>
<!DOCTYPE html>

<html>
<head>
    <title>HTTP POST</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    
    <div id="page">

        <p><a href="index.html">Home</a>&nbsp;<a href="<?php echo $_SERVER['SCRIPT_URI']; ?>?showsource=1">Show source</a></p>

        <h1>HTTP POST</h1>
        <p>This page shows three ways to send and HTTP POST.  To understand the differences
        between the three forms, do the POSTs while running HttpFox and watch the calls.</p>


        <h2>Url Encoded</h2>
        <p>The following is a simple web form that is used to add two numbers.</p>
        <form method="POST" action="ajaxserver.php?action=sum&showpost=1">
            Addend 1 <input type="text" width="3" name="addend1" /><br />
            Addend 2 <input type="text" width="3" name="addend2" />
            <input type="Submit">
        </form>

        <h2>Multipart Form Data</h2>
        <p>The following is a simple web form that is used to add two numbers.</p>
        <form enctype="multipart/form-data" method="POST"
            action="ajaxserver.php?action=sum&showpost=1">

            Addend 1 <input type="text" width="3" name="addend1" /><br />
            Addend 2 <input type="text" width="3" name="addend2" />
            <input type="Submit">
        </form>


        <h2>File Upload</h2>
        <p>See <a href="http://www.php.net/manual/en/features.file-upload.post-method.php">
            http://www.php.net/manual/en/features.file-upload.post-method.php</a></p>

	<p>To upload a file, put enctype="multipart/form-data" in the &lt;form&gt; tag,</form>
	and have an &lt;input&gt; tag with name="myname" and type="file".  The name will show up in the
	first index of the PHP $_FILES["myname"][] array.  The second dimension of the array has "name",
	"type", "tmp_name", "error" and "size" fields.  Multiple files can be uploaded, thus a 2-D array.
	Each file shows up with the same five meta-data fields in the second index of the FILES[][] array
	and are differentiated by the first index.</p>
	
	<p>Input type="file" provides both a Browse button and the name of the file.  It is difficult to style.</p>

        <!-- The data encoding type, enctype, MUST be specified as below -->
        <form enctype="multipart/form-data" action="ajaxserver.php?action=upload&showpost=1&showfiles=1" method="POST">

            <!-- MAX_FILE_SIZE must precede the file input field -->
            <input type="hidden" name="MAX_FILE_SIZE" value="30000" />

            <!-- Name of input element determines name in $_FILES array -->
            Send this file: <input name="userfile" type="file" />
            <input type="submit" value="Send File" />
        </form>

	<h2>File Upload - AJAX</h2>
	<p><a href="https://developer.tizen.org/help/index.jsp?topic=%2Forg.tizen.web.appprogramming%2Fhtml%2Ftutorials%2Fw3c_tutorial%2Fcomm_tutorial%2Fupload_ajax.htm">Reference</a></p>
	<input type="file" id="uploadfile" name="uploadfile" />
	<input type="button" value="upload" onclick="upload()" />
    </div>
</body>
</html>
