<?php
    setcookie("mycookie", "Hi there!", time() + 24*60*60);
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<title>HTML5 Demonstration</title>
<link rel="stylesheet" type="text/css" href="style.css"/>

<script type="text/javascript">
function showPosition() {
    var gps = navigator.geolocation;
    if (gps)
    {
        document.getElementById("whereami").innerHTML = "Searching...";
        gps.getCurrentPosition(
            function(position) {
                document.getElementById("whereami").innerHTML =
                    "Latitude: " + position.coords.latitude + "  Longitude: " + position.coords.longitude;
            },
            function(error) {
                document.getElementById("whereami").innerHTML =
                    "Geolocation error: " + error.message;
            }
        );
    }
    else
    {
        document.getElementById("whereami").innerHTML =
            "Geolocation not supported.";
    }
}

// Drag and Drop
// =============

// localStorage
// ============

// Given a key/value pair typed by the user, store the key/value pair
function localStorageSetItem() {
    var key=document.getElementById("mylocalkey").value;
    var val=document.getElementById("mylocalval").value;
    
    if (localStorage) {
        localStorage.setItem(key, val);
    }
    
    showLocalStorage();
}

// Given a key typed by the user, remove the key/value pair
function localStorageRemoveItem() {
    var key=document.getElementById("mylocalkey").value;
    
    if (localStorage) {
        localStorage.removeItem(key);
    }
    
    showLocalStorage();
}

// Remove all key/value pairs
function localStorageClear() {
    if (localStorage) {
        localStorage.clear();
    }
    
    showLocalStorage();
}

// Retrieve and show all key/value pairs.
function showLocalStorage() {

    var result="";

    if (localStorage) {
        result += "localStorage IS supported.<br />";
        
        var len = localStorage.length;
        if (len) {
            for (var i=0; i<len; i++) {
                result += localStorage.key(i) + " > " + localStorage.getItem(localStorage.key(i)) + "<br />";
            }
        }
        else {
            result += "localStorage is empty.<br />";
        }
    }
    else {
        result += "localStorage is NOT supported.<br />";
    }

    document.getElementById("localStoragePairs").innerHTML = result;
}


// sessionStorage
// ============

// Given a key/value pair typed by the user, store the key/value pair
function sessionStorageSetItem() {
    var key=document.getElementById("mysessionkey").value;
    var val=document.getElementById("mysessionval").value;
    
    if (sessionStorage) {
        sessionStorage.setItem(key, val);
    }

    showSessionStorage();
}

// Given a key typed by the user, remove the key/value pair
function sessionStorageRemoveItem() {
    var key=document.getElementById("mysessionkey").value;
    
    if (sessionStorage) {
        sessionStorage.removeItem(key);
    }
    
    showSessionStorage();
}

// Remove all key/value pairs
function sessionStorageClear() {
    if (sessionStorage) {
        sessionStorage.clear();
    }
    
    showSessionStorage();
}

// Retrieve and show all key/value pairs.
function showSessionStorage() {

    var result="";

    if (sessionStorage) {
        result += "sessionStorage IS supported.<br />";
        
        var len = sessionStorage.length;
        if (len) {
            for (var i=0; i<len; i++) {
                result += sessionStorage.key(i) + " > " + sessionStorage.getItem(sessionStorage.key(i)) + "<br />";
            }
        }
        else {
            result += "sessionStorage is empty.<br />";
        }
    }
    else {
        result += "sessionStorage is NOT supported.<br />";
    }

    document.getElementById("sessionStoragePairs").innerHTML = result;
}
</script>
    
</head>
<body onload="showLocalStorage(), showSessionStorage()">
    
<div id="page">

    <div class="entry">
        <h1>Browser navigator Object</h1>
        <script>
            document.writeln("<a href='http://www.w3schools.com/jsref/obj_navigator.asp'>W3Schools Navigator</a><br />");
            document.writeln("navigator.appCodeName = " + navigator.appCodeName + "<br />");
            document.writeln("navigator.appName = " + navigator.appName + "<br />");
            document.writeln("navigator.appVersion = " + navigator.appVersion + "<br />");
            document.writeln("navigator.cookieEnabled = " + navigator.cookieEnabled + "<br />");
            document.writeln("navigator.onLine = " + navigator.onLine + "<br />");
            document.writeln("navigator.platform = " + navigator.platform + "<br />");
            document.writeln("navigator.userAgent = " + navigator.userAgent + "<br />");

            // getUserMedia depends on the browser.
            if (navigator.getUserMedia)
                document.writeln("getUserMedia<br />");
            else if (navigator.webkitGetUserMedia)
                document.writeln("webkitGetUserMedia<br />");
            else if (navigator.mozGetUserMedia)
                document.writeln("mozGetUserMedia<br />");
            else if (navigator.msGetUserMedia)
                document.writeln("msGetUserMedia<br />");
            else
                document.writeln("sorry, no camera support<br />");
        </script>
    </div>

    <div class="entry">
        <h1>Drag and Drop - INCOMPLETE</h1>
        <a href="http://www.html5rocks.com/en/tutorials/dnd/basics/">example...</a>
        <div style="float: left; margin-right: 20px; height: 100px; width: 100px; border: solid 1px black; background-color: red"
             draggable="true"
             ondragstart="document.getElementById('status').innerHTML='ondragstart';"
             ondrag="document.getElementById('status').innerHTML='ondrag';"
             ondragenter="document.getElementById('status').innerHTML='ondragenter';"
             ondragleave="document.getElementById('status').innerHTML='ondragleave';"
             ondragover="document.getElementById('status').innerHTML='ondragover';"
             ondragdrop="document.getElementById('status').innerHTML='ondragdrop';"
             ondragdragend="document.getElementById('status').innerHTML='ondragend';"
             >Move Me</div>

<!--
             ondragstart="document.getElementById('status').innerHtml='x'" >Move Me</div>
             style="float: left; margin-right: 20px; height: 100px; width: 100px; border: solid 1px black; background-color: red"
-->
        <div style="float: left; margin-right: 20px; height: 100px; width: 100px; border: solid 1px black"></div>
        <div style="clear:both" />
        <p id="status">nothing...</p>
    </div>

    <div class="entry">
        <h1>Geolocation</h1>
        <p>Use the web browser navigator object to get location information via navigator.geolocation.</p>
        <p id="whereami">Latitude: ?  Longitude: ?</p>

        <!-- Don't put this in a <form> wrapper.  -->
        <button onclick="showPosition()">Get Location!</button>
    </div>

    <div class="entry">
        <h1>Local Storage</h1>
        <p>Use the localStorage object to store potentally large strings locally.  Use HttpFox
        to watch the HTTP traffic and note that unlike cookies the localStorage data are NOT
        sent to the server.  Data in localStorage persist after the browser is closed and are
        visible per domain (i.e. multiple pages share the same data.)</p>
        <a href="http://en.wikipedia.org/wiki/Web_Storage">Wikipedia Web Storage</a><br />

        <form>
            Key: <input type="text" size="5" id="mylocalkey" />
            Value: <input type="text" size="5" id="mylocalval" />
            <input type="button" onclick="localStorageSetItem();" value="setItem(k, v)" />
            <input type="button" onclick="localStorageRemoveItem();" value="removeItem(k)" />
            <input type="button" onclick="localStorageClear();" value="clear()" />
        </form>

        <p id="localStoragePairs">localStorage key/value pairs should appear here.</p>
    </div>

    <div class="entry">
        <h1>Session Storage</h1>
        <p>Use the sessionStorage object to store potentally large strings locally.  Use HttpFox
        to watch the HTTP traffic and note that unlike cookies the sessionStorage data are NOT
        sent to the server.  Data in sessionStorage are per page per window and disappear when
        the window disappears.</p>
        <a href="http://en.wikipedia.org/wiki/Web_Storage">Wikipedia Web Storage</a><br />

        <form>
            Key: <input type="text" size="5" id="mysessionkey" />
            Value: <input type="text" size="5" id="mysessionval" />
            <input type="button" onclick="sessionStorageSetItem();" value="setItem(k, v)" />
            <input type="button" onclick="sessionStorageRemoveItem();" value="removeItem(k)" />
            <input type="button" onclick="sessionStorageClear();" value="clear()" />
        </form>

        <p id="sessionStoragePairs">sessionStorage key/value pairs should appear here.</p>
    </div>

    <div class="entry">
        <h1>Orientation</h1>
        <p id="orientation">No orientation sensed yet...</p>

        <script>
            if (window.DeviceOrientationEvent) {
                document.writeln("window.DeviceOrientationEvent is supported.");
                window.addEventListener(
                    'deviceorientation',
                    function(eventData) {
                        document.getElementById("orientation").innerHTML =
                            eventData.gamma + "<br />" + eventData.beta + "<br />" + eventData.alpha;
                    },
                    false);
            }
            else if (window.OrientationEvent)
                document.writeln("window.OrientationEvent is supported.");
            else
                document.writeln("Orientaiton is not supported.");
        </script>
    </div>

    <div class="entry">
        <h1>Links</h1>
        <a href="http://en.wikipedia.org/wiki/HTML5_in_mobile_devices">Wikipedia HTML5 in Mobile Devices</a>
    </div>

    <div class="entry">
        <h1>Debug</h1>
        <?php
            echo "<h2>COOKIE</h2>";
            print_r($_COOKIE);
            echo "<h2>GET</h2>";
            print_r($_GET);
        ?>
    </div>
</div>
</body>
</html>
