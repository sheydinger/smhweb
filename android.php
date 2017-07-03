<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
    "http://www.w3.org/TR/html4/strict.dtd"
    >
<html lang="en">
<head>
<title>WebsiteToAndroid</title>

<!-- Do this for Apple so that iOS won't automatically scale to fit. -->
<meta name="viewport" content="width=device-width; initial-scale=1.0">

<style type="text/css">

* {
    margin: 0 auto;
    padding: 0;
}

body {
    text-align: justify;
    line-height: 150%;
    font-family:Arial,Helvetica,sans-serif;
}

#container {
    background-color: white
    width: 100%;
    max-width: 960px;
    margin-top: 30px;
    padding-left: 5px;
    padding-right: 5px;
}

.col1 {
    width: 100%;
}

.col2 {
    width: 50%;
    float: left;
}

.col3 {
    width: 33.333333333333%;
    float: left;
}

.myinfo {
    padding: 5px;
    margin: 5px;
    border-radius: 8px;
    background-color: #eeeeee;
}

/* If the screen is 480px or less, turn
   multiple columns into a stack. */
@media screen and (max-width: 600px) {
    body {
        font-size: 0.9em;
    }

/*
    #container {
        margin: 30px 15px 15px 15px;
        width: auto;
    }
*/
    .col2 {
        margin-top: 25px;
        width: 100%;
        float: none;
    }

    .col3 {
        margin-top: 25px;
        width: 100%;
        float: none;
    }

    .myinfo {
        padding: 2px;
        margin: 2px;
    }
}

@media screen and (min-width: 1000px) {
    .shadow {
      -moz-box-shadow:    7px 7px 5px #ccc;
      -webkit-box-shadow: 7px 7px 5px #ccc;
      box-shadow:         0px 0px 10px #888;
    }
}

.row {
    margin-top: 25px;
}



img {
    max-width: 100%;
    pdading-bottom: 0;
}

h1 {
    padding: 20px 0px 10px 0px;
}

h2 {
    font-size: 1.2em;
}
    /* http://www.bestcssbuttongenerator.com/ */
    .myButton {

        -moz-box-shadow:inset 0px 1px 0px 0px #97c4fe;
        -webkit-box-shadow:inset 0px 1px 0px 0px #97c4fe;
        box-shadow:inset 0px 1px 0px 0px #97c4fe;

        background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #3d94f6), color-stop(1, #1e62d0));
        background:-moz-linear-gradient(top, #3d94f6 5%, #1e62d0 100%);
        background:-webkit-linear-gradient(top, #3d94f6 5%, #1e62d0 100%);
        background:-o-linear-gradient(top, #3d94f6 5%, #1e62d0 100%);
        background:-ms-linear-gradient(top, #3d94f6 5%, #1e62d0 100%);
        background:linear-gradient(to bottom, #3d94f6 5%, #1e62d0 100%);
        filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#3d94f6', endColorstr='#1e62d0',GradientType=0);

        background-color:#3d94f6;

        -moz-border-radius:6px;
        -webkit-border-radius:6px;
        border-radius:6px;

        border:1px solid #337fed;

        display:inline-block;
        color:#ffffff;
        font-family:arial;
        font-size:15px;
        font-weight:bold;
        padding:6px 24px;
        text-decoration:none;

        text-shadow:0px 1px 0px #1570cd;
        
        /* Added by Scott */
        width: 100%;
        margin-top: 15px;
    }

    .myButton:hover {

        background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #1e62d0), color-stop(1, #3d94f6));
        background:-moz-linear-gradient(top, #1e62d0 5%, #3d94f6 100%);
        background:-webkit-linear-gradient(top, #1e62d0 5%, #3d94f6 100%);
        background:-o-linear-gradient(top, #1e62d0 5%, #3d94f6 100%);
        background:-ms-linear-gradient(top, #1e62d0 5%, #3d94f6 100%);
        background:linear-gradient(to bottom, #1e62d0 5%, #3d94f6 100%);
        filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#1e62d0', endColorstr='#3d94f6',GradientType=0);

        background-color:#1e62d0;
    }

    .myButton:active {
        position:relative;
        top:1px;
    }

</style>

</head>
<body>
    <div id="container" class="shadow">

        <div class="row">
            <div class="col1">
                <div class="myinfo" style="background-color: white">
                    <h1>Android/JavaScript</h1>

                    <p>It's easy to communcate between a WebView in a native Android application
                    and the JavaScript/HTML running inside the WebView, without PhoneGap!  Be
                    sure to view this page inside the WebsiteToAndroid Android application to see how.</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col3">
                <div class="myinfo">
                    <h2>Send a Toast</h2>
                    <p>These buttons call an Android method that displays a Toast.  The second
                    one sends a string from HTML to Android.  Type your own message here:</p>
                    <input type="text" id="theMessage" value="Can you hear me now?" width="30"></input>
                    <button class="myButton" onClick="HiAndroid.toastHelloWorld()">Send a Toast!</button>
                    <button class="myButton" onClick="getTheMessage()">Send a custom Toast!</button>
                </div>
            </div>
            <div class="col3">
                <div class="myinfo">
                    <h2>Take a Picture</h2>
                    <p>Press the button below to send an ACTION_IMAGE_CAPTURE intent on the device,
                    then take a picture!</p>
                    <button class="myButton" onClick="HiAndroid.takePicture()">Take a picture</button><br />
                </div>
            </div>
            <div class="col3">
                <div class="myinfo">
                    <h2>Android to JavaScript</h2>
                    <p>Press one of the buttons in the device Options Menu.</p>
                    <p style="margin-top: 10px" id="textFromAndroid">Watch here!</p>
                </div>
            </div>
        </div>
        <div style="clear: both; height: 0px;"></div>

        <script>
            function getTheMessage() {
                var message = document.getElementById("theMessage").value;
                HiAndroid.toast(message);
            }
            function HiFromAndroid(str) {
                document.getElementById("textFromAndroid").innerHTML = str;
            }
        </script>

    </div>
</body>
</html>