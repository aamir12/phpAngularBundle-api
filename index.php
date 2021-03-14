<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <meta
      name="google-signin-client_id"
      content="43829369774-pbtautnm3t9b05s5d2bi6ilel0uq8rsv.apps.googleusercontent.com"
    />

	<script
	src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
	<script src="https://apis.google.com/js/platform.js" async defer></script>
 </head>



<body>

<div > 

<p>Today's welcome message is:</p>

  <div class="g-signin2" data-onsuccess="onSignIn"></div>
 

  <button onclick="verify()">Verify Request</button>

</div>

<script>
$(document).ready(function(){
    let data = {}
    function onSignIn(googleUser) {
	  var profile = googleUser.getBasicProfile();
	  data = {
	  	id:profile.getId(),
	  	name: profile.getName(),
	  	photo: profile.getImageUrl(),
	  	email : profile.getEmail()
	  }
	  console.log(data);
	  //call ajax;
		  $.ajax({
	        url: 'googleLogin.php?action=request',
	        data: data,
	        type: "POST",
	        success: function (res, status) {
	          console.log(`Success`);
	          console.log(res);
	        },
	        error: function (xhr, status, error) {
	          console.log(error);
	        },
	      });
    }

    function verify(){
        $.ajax({
	        url: 'googleLogin.php?action=verify',
	        data: data,
	        type: "POST",
	        success: function (res, status) {
	          console.log(`Success`);
	          console.log(res);
	        },
	        error: function (xhr, status, error) {
	          console.log(error);
	        },
	    });
    }

});



</script>

</body>
</html>