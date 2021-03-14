<html>
<head>
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">
  <script src="https://apis.google.com/js/api:client.js"></script>
  <script>
  var googleUser = {};
  var startApp = function() {
    gapi.load('auth2', function(){
      // Retrieve the singleton for the GoogleAuth library and set up the client.
      auth2 = gapi.auth2.init({
        client_id: '43829369774-pbtautnm3t9b05s5d2bi6ilel0uq8rsv.apps.googleusercontent.com',
        cookiepolicy: 'single_host_origin',
        // Request scopes in addition to 'profile' and 'email'
        //scope: 'additional_scope'
      });
      attachSignin(document.getElementById('customBtn'));
    });
  };

  function attachSignin(element) {
    console.log(element.id);
    auth2.attachClickHandler(element, {},
        function(googleUser) {

         var profile = googleUser.getBasicProfile();
         var id_token = googleUser.getAuthResponse().id_token;
          data = {
            id:profile.getId(),
            name: profile.getName(),
            photo: profile.getImageUrl(),
            email : profile.getEmail(),
            action:'request',
            id_token:id_token
          }
          
          console.log(JSON.stringify(data, undefined, 2));
        }, function(error) {
          alert(JSON.stringify(error, undefined, 2));
        });
  }
  </script>
  <style type="text/css">
    #customBtn {
    display: flex;
    justify-content: center;
    max-width: 150px;
    align-items: center;
    border: solid 1px #d1caca;
    }
    #customBtn:hover {
      cursor: pointer;
    }
  
    span.icon {
      background: url(https://developers-dot-devsite-v2-prod.appspot.com/identity/sign-in/g-normal.png) transparent 5px 50% no-repeat;
    width: 35px;
    height: 35px;
    margin-right: 8px;
    }
    span.buttonText {
      font-size: 16px;
    font-weight: bold;
    font-family: 'Roboto', sans-serif;
    }
  </style>
  </head>
  <body>
  <!-- In the callback, you would hide the gSignInWrapper element on a
  successful sign in -->
  <div id="gSignInWrapper">
    <div id="customBtn" class="customGPlusSignIn">
      <span class="icon"></span>
      <span class="buttonText">Google</span>
    </div>
  </div>
  
  <script>startApp();</script>
</body>
</html>