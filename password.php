<?php
    if ($_GET['showsource'])
    {
	show_source("password.php");
	die();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Password</title>


<script type='text/javascript' src='https://www.google.com/jsapi'></script>
<script type='text/javascript'>

function createRequest()
{
	try
	{
		request = new XMLHttpRequest();	// Non-IE
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
console.log("***** createRequest *****");
console.log("***** " + request + " *****");


    
// The sendRequest callback requires that the document has been loaded
// to get references to buttons.  Therefore, only set the callback
// once the DOM has been setup.
google.load('visualization', '1', {packages:['table']});
//google.setOnLoadCallback(sendRequest('getdb'));
google.setOnLoadCallback(drawTable(null));

var data = null;
var table = null;

function drawTable(passwords) {

console.log("***** 1 *****");
    data  = new google.visualization.DataTable(passwords);
console.log("***** 2 *****");
    table = new google.visualization.Table(document.getElementById('password_table'));
console.log("***** 3 *****");
//alert('x');
//alert("data:" + data + " table" + table);

/*
    // Respond to a user selection.  DO NOT DELETE!!!  This is an example.
    google.visualization.events.addListener(table, 'select',
	function(event) {
	    alert(table.getSelection().length + " rows selected.");

	    var row = table.getSelection()[0].row;
	    alert('You selected ' + data.getValue(row, 0));
	}
    );
*/

    // DOESNT WORK: data.setColumnProperties(2, {'style': 'color: red;'});
    // Apparently, can't set an entire column at a time so do a loop and set each cell.
    for (var row=0; row<data.getNumberOfRows(); row++)
    {
	data.setProperty(row, 0, 'style','width: 12%');
	data.setProperty(row, 1, 'style','width: 12%');
	data.setProperty(row, 2, 'style','width: 38%; font-family: courier');
	data.setProperty(row, 3, 'style','width: 38%; font-family: courier');
    }

    table.draw(data, {showRowNumber: false, sort: 'disable', allowHtml: true, page: 'enable', pageSize: 15});
}

function receiveResult()
{
    console.log("***** receiveResult *****");

    // Data from the server are only valid when readyState is 4.
    if (request.readyState == 4)
	if (request.status == 200)
	{
//	    document.getElementById("json").innerHTML = request.responseText;

	    // Transfer from JSON DOM to the HTML DOM by turning the JSON "into" Javascript
	    var data = eval('('+request.responseText+')');

	    document.getElementById("action").innerHTML = "<p>Action: " + data.action + "</p>";
	    document.getElementById("status").innerHTML = "<p>Status: " + data.status + "</p>";
	    document.getElementById("query").innerHTML = "<p>Query: " + data.query + "</p>";
	    document.getElementById("message").innerHTML = "<p>Message: " + data.message + "</p>";

	    if (data.status == 'success')
	    {
		if (data.action == 'getdb')
		{
		    // The data that Google Charts needs is JSON data, which are returned
		    // as an object (rather than a string) names 'passwords' inside the
		    // JSON from the server.  The JSON string must be obtained from the object.
		    drawTable(JSON.stringify(data.passwords));
		}

		// new, delete, login - nothing to do
	    }
	}
}

function sendRequest(action)
{
    var url="passwordserver.php?action=" + action;

    console.log("***** sendRequest ***** " + url);
    console.log(request);


    // Use POST instead of GET to send larger amounts of information in the .send function below.
    request.open("POST", url, true);
    request.onreadystatechange = receiveResult;

    console.log("***** 2 ***** ");

    // Must send the content type (except for Safari)
    // x-www-form-urlencoded means name value pairs, via text
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    console.log("***** 3 ***** ");

    switch (action)
    {
    case 'new':
    case 'login':
	var userid=document.getElementById("userid").value;
	var password=document.getElementById("password").value;
	request.send("userid=" + userid + "&password=" + password);
	break;

    case 'getdb':
	console.log("***** sendRequest: Sending *****");
        request.send();
	break;

    case 'delete':
	if (table != null && data != null)
	{
	    if (table.getSelection().length > 0)
	    {
		if (confirm("Delete " + table.getSelection().length + " rows?") == true)
		{
		    var deleteme = "";
		    for (var i=0; i<table.getSelection().length; i++)
			deleteme += i + "=" + data.getValue(table.getSelection()[i].row, 0) + "&";
		    deleteme += "count=" + table.getSelection().length;

		    request.send(deleteme);
		}
	    }
	}
	break;
    }
}

function done()
{
    console.log("***** done *****");
    sendRequest('getdb');
}
</script>

<link rel="stylesheet" type="text/css" href="style.css">

</head>
<body onload="done()">

    <div id="page">

	<p><a href="./index.html">Home</a>&nbsp;Show source:&nbsp;
	<a href="./password.php?showsource=1">password.php</a>
	<a href="./passwordserver.php?showsource=1">passwordserver.php</a>
	</p>

	<h1>Password</h1>
	<p>This page demonstrates how to store passwords as described in <a href="http://crackstation.net/hashing-security.htm">CrackStation.net</a>.
	There is no attempt to prevent SQL injection here, but the concepts of how to hash are demonstrated.</p>

	<form>
	    <input type="text" id="userid" width="20"> Userid<br />
	    <input type="text" id="password" width="20"> Password<br />
	    <input type="button" id="newButton"   value="New Account" onclick="sendRequest('new')">
	    <input type="button" id="loginButton" value="Login"       onclick="sendRequest('login')">
	</form> 

	<div class="entry">
	    <h3>AJAX Response</h3>
	    <p id="action">Action: </p>
	    <p id="status">Status: </p>
	    <p id="query">Query: </p>
	    <p id="message">Message: </p>
	    <p id="json"></p>
	</div>

	<div class="entry">
	    <h3>Password Database Contents</h3>
	    <div id="password_table"></div>
	    <form>
		<input type="button" id="getdbButton"  value="Refresh"         onclick="sendRequest('getdb')">
		<input type="button" id="deleteButton" value="Delete Selected" onclick="sendRequest('delete')">
	    </form>
	</div>

    </div>

</body>
</html>
