<?php
    if ($_GET['showsource'])
    {
	show_source("loginFacebook.php");
	die();
    }
?>
<html>
<head>

    <title>Scott's Facebook Login Demo</title>    
    <link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>
<div id="fb-root"></div>
<script>
  window.fbAsyncInit = function() {
  FB.init({
    appId      : '607854029248149', // App ID
    channelUrl : '//www.theunclassroom.org/smhweb/channel.html', // Channel File
    status     : true, // check login status
    cookie     : true, // enable cookies to allow the server to access the session
    xfbml      : true  // parse XFBML
  });

  // Here we subscribe to the auth.authResponseChange JavaScript event. This event is fired
  // for any authentication related change, such as login, logout or session refresh. This means that
  // whenever someone who was previously logged out tries to log in again, the correct case below 
  // will be handled. 
  FB.Event.subscribe('auth.authResponseChange', function(response) {
    alert('here');
    // Here we specify what we do with the response anytime this event occurs. 
    if (response.status === 'connected') {
      // The response object is returned with a status field that lets the app know the current
      // login status of the person. In this case, we're handling the situation where they 
      // have logged in to the app.
      alert('connected');
      testAPI();
    } else if (response.status === 'not_authorized') {
      // In this case, the person is logged into Facebook, but not into the app, so we call
      // FB.login() to prompt them to do so. 
      // In real-life usage, you wouldn't want to immediately prompt someone to login 
      // like this, for two reasons:
      // (1) JavaScript created popup windows are blocked by most browsers unless they 
      // result from direct interaction from people using the app (such as a mouse click)
      // (2) it is a bad experience to be continually prompted to login upon page load.
      alert('not authorized');
      FB.login();
    } else {
      // In this case, the person is not logged into Facebook, so we call the login() 
      // function to prompt them to do so. Note that at this stage there is no indication
      // of whether they are logged into the app. If they aren't then they'll see the Login
      // dialog right after they log in to Facebook. 
      alert('else');      
      FB.login();
    }
  });
  };

  // Load the SDK asynchronously
  (function(d){
   var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
   if (d.getElementById(id)) {return;}
   js = d.createElement('script'); js.id = id; js.async = true;
   js.src = "//connect.facebook.net/en_US/all.js";
   ref.parentNode.insertBefore(js, ref);
  }(document));

  // Here we run a very simple test of the Graph API after login is successful. 
  // This testAPI() function is only called in those cases. 
  function testAPI() {
    alert('logged in');
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
      console.log('Good to see you, ' + response.name + '.');
    });
  }
</script>

<!--
  Below we include the Login Button social plugin. This button uses the JavaScript SDK to
  present a graphical Login button that triggers the FB.login() function when clicked.

  Learn more about options for the login button plugin:
  /docs/reference/plugins/login/ -->

    <div id="page">

	<p><a href="http://www.theunclassroom.org/smhweb/index.html">Home</a>&nbsp;Show source:&nbsp;
	<a href="http://www.theunclassroom.org/smhweb/loginFacebook.php?showsource=1">loginFacebook.php</a></p>

        <h1>Facebook Login</h1>
        <p>Style the buttons at <a href="https://developers.facebook.com/docs/reference/plugins/login/">Login Button</a>.  Preferably,
        set show-faces="false".</p>
        
        <p><a href="https://developers.facebook.com/docs/facebook-login/overview/">Facebook Login Overview</a></p>
        <p><a href="https://developers.facebook.com/docs/facebook-login/getting-started-web/">Getting Started with Facebook Login</a></p>

        <h2>small</h2>
        <fb:login-button show-faces="false" width="200" max-rows="1" size="small"></fb:login-button>

        <h2>medium</h2>
        <fb:login-button show-faces="false" width="200" max-rows="1" size="medium"></fb:login-button>

        <h2>large</h2>
        <fb:login-button show-faces="false" width="200" max-rows="1" size="large"></fb:login-button>

        <h2>xlarge</h2>
        <fb:login-button show-faces="false" width="200" max-rows="1" size="xlarge"></fb:login-button>

    </div>

</body>
</html>