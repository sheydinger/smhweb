<?php


    // This is BASIC Authenticaion.  Use it local on WAMP.  GoDaddy doesn't work.
    // To clear it in FireFox add this extension
    //    https://addons.mozilla.org/en-US/firefox/addon/web-developer/developers
    // and pick Tools->Web Developer Extension->Miscellaneous->Clear Private Data->Clear HTTP Authentication
    
    if (!isset($_SERVER['PHP_AUTH_USER']))
    {
        header('WWW-Authenticate: Basic realm="My Realm"');
        header('HTTP/1.0 401 Unauthorized');
        echo "You hit cancel.  Can't get in!";
        exit;
    }
    else
    {
        echo "<p>Hello {$_SERVER['PHP_AUTH_USER']}.</p>";
        echo "<p>You entered {$_SERVER['PHP_AUTH_PW']} as your password.</p>";
    }

?>

<!DOCTYPE html>

<html>
<head>
    <title>Rest Demonstration</title>
<script type="text/javascript">
function createRequest()
{
    try
    {
        request = new XMLHttpRequest();    // Non-IE
    }
    catch (trymicrosoft)
    {
        try
        {
            request = new ActiveXObject("Msxm12.XMLHTTP");
        }
        catch (othermicrosoft)
        {
            try
            {
                request = new ActiveXObject("Microsoft.XMLHTP");
            }
            catch (failed)
            {
                request = null;
            }
        }
    }

    return request;
}

// Create the request objects OUTSIDE of a function so they get created on page load
var request = createRequest();


function update()
{
    // Data from the server are only valid when readyState is 4.
    if (request.readyState == 4)
        if (request.status == 200)
        {
            document.getElementById("json").innerHTML = request.responseText;
        }
}

function get(type)
{
    var url="restserver.php";

    // Use POST instead of GET to send larger amounts of information in the .send function below.
    request.open(type, url, true);
    request.onreadystatechange = update;

    // Must send the content type (except for Safari)
    // x-www-form-urlencoded means name value pairs, via text
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    request.send();
}

</script>
</head>

<body>
<p><a href="restserver.php?showsource=1">restserver.php source</a></p>

<input type="button" value="GET"  onclick="get('GET')">
<input type="button" value="POST" onclick="get('POST')">
<input type="button" value="HEAD" onclick="get('HEAD')">
<input type="button" value="PUT"  onclick="get('PUT')">

<p id="json"></p>

</body>
</html>
