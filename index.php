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
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 </head>
<body>


<p>Today's welcome message is:</p>
<div id="my-signin2"></div>
<button onclick="verify()">Verify Request</button>
<script>
let data = {}
function onSuccess(googleUser) {
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

function onFailure(error) {
  console.log(error);
}

function renderButton() {
  gapi.signin2.render('my-signin2', {
    'scope': 'profile email',
    'width': 240,
    'height': 50,
    'longtitle': true,
    'theme': 'dark',
    'onsuccess': onSuccess,
    'onfailure': onFailure
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
</script>
<script src="https://apis.google.com/js/platform.js?onload=renderButton" async defer></script>
</body>
</html>