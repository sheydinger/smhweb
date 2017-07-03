<?php
	if ($_GET['showsource'])
	{
		show_source("ajaxsimple.php");
		die();
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<title>Ajax & HTTP Demonstrations</title>


<script type="text/javascript">
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


function updatePageDate()
{
	// Data from the server are only valid when readyState is 4.
	if (request.readyState == 4)
	{
		if (request.status == 200)
			document.getElementById("theDate").innerHTML = "<b>The date is: " + request.responseText + "</b>";
		else
			document.getElementById("theDate").innerHTML = "<b>The date is: ERROR returned from server = " + request.status + "</b>";
	}

	document.getElementById("responses").innerHTML = request.getAllResponseHeaders();
}

function getDate()
{
	var url="ajaxserver.php?action=date";

	// Add a "random" number to fake out IE into thinking the URL changed
	// so that it doesn't just return a cached result.
	url += "&dummy=" + new Date().getTime();

	// The "true" means "asynchronous
	request.open("GET", url, true);

	// This is the function that the browser calls when the server responds.
	request.onreadystatechange = updatePageDate;

	request.send(null);
}




function updatePageSqrt()
{
	// Data from the server are only valid when readyState is 4.
	if (request.readyState == 4)
		document.getElementById("theSqrt").innerHTML = "<b>The square root is: " + request.responseText + "</b>";
}


function getSqrt()
{
	var theSquare=document.getElementById("theSquare").value;
	var url="ajaxserver.php?action=sqrt" + "&square=" + escape(theSquare);
	url += "&dummy=" + new Date().getTime();
	request.open("GET", url, true);
	request.onreadystatechange = updatePageSqrt;
	request.send(null);
}





// Need to create MULTIPLE request objects to differentiate
var requests = new Array();
for (i=0; i<3; i++)
{
	requests[i] = createRequest();
}

function updateTimer()
{
	// Data from the server are only valid when readyState is 4.
	// Search all requests (PLURAL!) objects and process any that are valid
	for (i=0; i<3; i++)
	{
		if (requests[i].readyState == 4)
			if (requests[i].status == 200)
			{
				if (i==0)
					document.getElementById("timer0").disabled = false;
				else if (i==1)
					document.getElementById("timer1").disabled = false;
				else if (i==2)
					document.getElementById("timer2").disabled = false;
			}
	}
}

function getTimer(whichtimer)
{
	if (whichtimer == 0)
		document.getElementById("timer0").disabled = true;
	else if (whichtimer == 1)
		document.getElementById("timer1").disabled = true;
	else if (whichtimer == 2)
		document.getElementById("timer2").disabled = true;

	var url="ajaxserver.php?action=timer&whichtimer=" + whichtimer;
	url += "&dummy=" + new Date().getTime();
	requests[whichtimer].open("GET", url, true);
	requests[whichtimer].onreadystatechange = updateTimer;
	requests[whichtimer].send(null);
}








function updateSum()
{
	// Data from the server are only valid when readyState is 4.
	if (request.readyState == 4)
		document.getElementById("theSum").innerHTML = "<b>The sum is: " + request.responseText + "</b>";
}


function getSum()
{
	var theAddend1=document.getElementById("addend1").value;
	var theAddend2=document.getElementById("addend2").value;

	// Browswers don't cache POSTs, just GETs, so don't add random values to the end
	var url="ajaxserver.php?action=sum" ; // &dummy=" + new Date().getTime();

	// Use POST instead of GET to send larger amounts of information in the .send function below.
	request.open("POST", url, true);
	request.onreadystatechange = updateSum;

	// Must send the content type (except for Safari)
	// x-www-form-urlencoded means name value pairs, via text
	request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

	request.send("addend1=" + escape(theAddend1) + "&addend2=" + escape(theAddend2));
}








function updatePageAddressXML()
{
	// Data from the server are only valid when readyState is 4.
	if (request.readyState == 4)
	{
		if (request.status == 200)
		{
			document.getElementById("theTextAddress").innerHTML = "<b>The text address is: " + request.responseText + "</b>";
			document.getElementById("theXMLAddress").innerHTML = "<b>The XML address is: " + request.responseXML + "</b>";

			// Transfer from the XML DOM to the HTML DOM
			var xmlDoc = request.responseXML;

			document.getElementById("theName").innerHTML   = xmlDoc.getElementsByTagName("name")[0].firstChild.nodeValue;
			document.getElementById("theStreet").innerHTML = xmlDoc.getElementsByTagName("street")[0].firstChild.nodeValue;
			document.getElementById("theCity").innerHTML   = xmlDoc.getElementsByTagName("city")[0].firstChild.nodeValue;
			document.getElementById("theState").innerHTML  = xmlDoc.getElementsByTagName("state")[0].firstChild.nodeValue;
			document.getElementById("theZip").innerHTML    = xmlDoc.getElementsByTagName("zip")[0].firstChild.nodeValue;
		}
		else
		{
			document.getElementById("theTextAddress").innerHTML = "<b>The text address is: ERROR returned from server = " + request.status + "</b>";
			document.getElementById("theXMLAddress").innerHTML = "<b>The XML address is: ERROR returned from server = " + request.status + "</b>";
		}
	}
}

function getAddressXML()
{
	var url="ajaxserver.php?action=address";

	// Add a "random" number to fake out IE into thinking the URL changed
	// so that it doesn't just return a cached result.
	url += "&dummy=" + new Date().getTime();

	// The "true" means "asynchronous
	request.open("GET", url, true);

	// This is the function that the browser calls when the server responds.
	request.onreadystatechange = updatePageAddressXML;

	request.send(null);
}





function updatePageAddressJSON()
{
	// Data from the server are only valid when readyState is 4.
	if (request.readyState == 4)
	{
		if (request.status == 200)
		{
			document.getElementById("theTextAddress2").innerHTML = "<b>The text address is: " + request.responseText + "</b>";
			document.getElementById("theXMLAddress2").innerHTML = "<b>The XML address is: " + request.responseXML + "</b>";

			// Transfer from JSON DOM to the HTML DOM by turning the JSON "into" Javascript

			var data = eval('('+request.responseText+')');;

			document.getElementById("theName2").innerHTML   = data.address[0].name;
			document.getElementById("theStreet2").innerHTML = data.address[0].street;
			document.getElementById("theCity2").innerHTML   = data.address[0].city;
			document.getElementById("theState2").innerHTML  = data.address[0].state;
			document.getElementById("theZip2").innerHTML    = data.address[0].zip;
		}
		else
		{
			document.getElementById("theTextAddress2").innerHTML = "<b>The text address is: ERROR returned from server = " + request.status + "</b>";
			document.getElementById("theXMLAddress2").innerHTML = "<b>The XML address is: ERROR returned from server = " + request.status + "</b>";
		}
	}
}

function getAddressJSON()
{
	var url="ajaxserver.php?action=address2";

	// Add a "random" number to fake out IE into thinking the URL changed
	// so that it doesn't just return a cached result.
	url += "&dummy=" + new Date().getTime();

	// The "true" means "asynchronous
	request.open("GET", url, true);

	// This is the function that the browser calls when the server responds.
	request.onreadystatechange = updatePageAddressJSON;

	request.send(null);
}
</script>


</head>
<body>
<div id="wrapper">

	<div id="page">
		<div id="page-bgtop">
			<div id="content">

				<div id="myhtmldom" class="post">
					<p>
					<a href="ajaxcurl.php">PHP cURL</a>,
					<a target="_blank" href="http://www.w3schools.com/jsref/default.asp">HTML DOM Reference</a>,
					<a href="ajaxserver.php?showsource=1">Server Source</a>,
					<a href="ajaxsimple.php?showsource=1">Client Source</a></p>

					<h2>Simple Ajax Examples</h2>

					<div class="entry">
						<h3>Date</h3>

						<p><a href="ajaxserver.php?action=date">Raw response</a></p>

						<p>This example sends no data to the server.  The server sends back the date 
						using the PHP date() function as follows: &lt;?php echo date("l dS \of F Y h:i:s A"); ?&gt;</p>

						<p id="theDate"><b>The date is:</b></p>

						<input type="button" value="Get Date" onClick="getDate();"/>
					</div>


					<div class="entry">
						<h3>Square Root</h3>
						<p>This example is slightly more complicated than the Date example in that a number is sent
						to the server, and the server returns the square root of the number.  It demonstrates how
						to make the response from the server depend on something sent from the client.</p>

						<p>The processing script is called using onChange.  Once you type a number, you'll need
						to leave the input field for the ajax scripts to execute.  Other options are onFocus()
						and onBlur().</p>

						<p id="theSqrt"><b>The square root is:</b></p>

						<input type="text" size="5" name="square" id="theSquare" onChange="getSqrt();" />
					</div>

					<div class="entry">
						<h3>Timer</h3>
						<p>This example demonstrates the asynchronous nature of ajax, including three
						independent 5 second timers.  Press a button and it will become disabled.
						Then 5 seconds later it will become reenabled.  The timer executes on the host
						which delays the response for 5 seconds.  Note that three different request objects
						are required to keep the three buttons independent.  Try "overlapping" the timers.</p>

						<input type="button" style="xbackground-color: #00ff00" id="timer0" value="Timer 0" onClick="getTimer(0);"/>
						<input type="button" style="xbackground-color: #00ff00" id="timer1" value="Timer 1" onClick="getTimer(1);"/>
						<input type="button" style="xbackground-color: #00ff00" id="timer2" value="Timer 2" onClick="getTimer(2);"/>
					</div>

					<div class="entry">
						<h3>Adder</h3>
						<p>This example uses POST instead of GET to send the two addends.</p>

						<p id="theSum"><b>The sum is:</b></p>

						<input type="text" size="5" name="addend1" id="addend1" onChange="getSum();" />
						<input type="text" size="5" name="addend2" id="addend2" onChange="getSum();" />
					</div>

					<div class="entry">
						<h3>Address (XML)</h3>

						<p><a href="ajaxserver.php?action=address">Raw response</a></p>

						<p>This example retrieves multiple pieces of information from the server: a name,
						street address, city, state and zip for an individual, in XML format.</p>

						<p id="theTextAddress"><b>The text address is:</b></p>

						<p id="theXMLAddress"><b>The XML address is:</b></p>

						<p>
						<span id="theName">name</span><br />
						<span id="theStreet">street</span><br />
						<span id="theCity">city</span>, <span id="theState">state</span>  <span id="theZip">zip</span><br />
						</p>

						<input type="button" value="Get Address XML" onClick="getAddressXML();"/>
					</div>

					<div class="entry">
						<h3>Address (JSON)</h3>

						<p><a href="ajaxserver.php?action=address2">Raw response</a></p>

						<p>This example retrieves multiple pieces of information from the server: a name,
						street address, city, state and zip for an individual, in JSON format.</p>

						<p id="theTextAddress2"><b>The text address is:</b></p>

						<p id="theXMLAddress2"><b>The XML address is:</b></p>

						<p>
						<span id="theName2">name</span><br />
						<span id="theStreet2">street</span><br />
						<span id="theCity2">city</span>, <span id="theState2">state</span>  <span id="theZip2">zip</span><br />
						</p>

						<input type="button" value="Get Address JSON" onClick="getAddressJSON();"/>
					</div>
				</div>


				<div id="myhtmldom" class="post">
					<h2>XMLHttpRequest Notes</h2>

					<div class="entry">
						<h3>getAllResponseHeaders()</h3>
						<p>Note: The "Get Date" function invokes getAllResponseHeaders().  Press the Get Date button above.</p>
						<div id="responses"></div>
					</div>
				</div>

			</div>
			<!-- end div#content -->

			<div style="clear: both; height: 1px"></div>
		</div>
	</div>
	<!-- end div#page -->
</div>

</body>
</html>
