<!DOCTYPE html>
<html>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
<body>

<div ng-app="myApp" ng-controller="myCtrl"> 

<p>Today's welcome message is:</p>

  <button ng-click="sendData()">Send Request</button>

  <button ng-click="verifyRequuest()">Verify Request</button>

</div>

<script>
var app = angular.module('myApp', []);
app.controller('myCtrl', function($scope, $http) {
  
	$scope.sendData = function(){
		$http({
			method: 'POST',
			url: 'googleLogin.php?action=request',
			data:{name:'request'}
		}).then(function (response) {
		   console.log(response.data);
		}, function (error) {
		    console.log(error);
		});
	}

	$scope.verifyRequuest  = function(){
		$http({
			method: 'POST',
			url: 'googleLogin.php?action=verify',
			data:{name:'verify'}
		}).then(function (response) {
		   console.log(response.data);
		}, function (error) {
		    console.log(error);
		});
	}


});
</script>

</body>
</html>