<!DOCTYPE html>
<html class="full" lang="nl">
<head>
	<meta charset="UTF-8">
	<title>Bezoekers login</title>
	
	<!--facebook login-->
	<script>
	  function statusChangeCallback(response) {
	    console.log('statusChangeCallback');
	    console.log(response);
	    if (response.status === 'connected') {
	      testAPI();
	    } else if (response.status === 'not_authorized') {
	      document.getElementById('status').innerHTML = 'Please log ' +
	        'into this app.';
	    } else {
	      document.getElementById('status').innerHTML = 'Please log ' +
	        'into Facebook.';
	    }
	  }

	  function checkLoginState() {
	    FB.getLoginStatus(function(response) {
	      statusChangeCallback(response);
	    });
	  }

	  window.fbAsyncInit = function() {
	  FB.init({
	    appId      : '966844250000929',
	    cookie     : true,  // enable cookies to allow the server to access 
	                        // the session
	    xfbml      : true,  // parse social plugins on this page
	    version    : 'v2.2' // use version 2.2
	  });

	  FB.getLoginStatus(function(response) {
	    statusChangeCallback(response);
	  });

	  };

	  (function(d, s, id) {
	    var js, fjs = d.getElementsByTagName(s)[0];
	    if (d.getElementById(id)) return;
	    js = d.createElement(s); js.id = id;
	    js.src = "//connect.facebook.net/en_US/sdk.js";
	    fjs.parentNode.insertBefore(js, fjs);
	  }(document, 'script', 'facebook-jssdk'));

	  function testAPI() {
	    console.log('Welcome!  Fetching your information.... ');
	    FB.api('/me', function(response) {
	      console.log('Successful login for: ' + response.name);
	      document.getElementById('status').innerHTML =
	        'Thanks for logging in, ' + response.name + '!';
	    });
	  }
	</script>
</head>

<body>
	  <fb:login-button scope="public_profile,email" onlogin="checkLoginState();"></fb:login-button>
	  <h4>error is normaal omdat de login is ingesteld voor de Vincent zijne localhost <br /> die kan verder doen aan zijn deel dus, normaal gezien</h4>
</body>
</html> 