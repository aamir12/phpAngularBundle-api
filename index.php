<!DOCTYPE html>
<html>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
<body>

<div ng-app="myApp" ng-controller="myCtrl"> 

<p>Today's welcome message is:</p>

  <button ng-click="sendData()">Send Request</button>

</div>

<script>
var app = angular.module('myApp', []);
app.controller('myCtrl', function($scope, $http) {
  
	$scope.sendData = function(){
		$http({
			method: 'GET',
			url: 'api.php',
			data:{name:'test',action:'sample'}
		}).then(function (response) {
		   console.log(response);
		}, function (error) {
		    console.log(error);
		});
	}


});
</script>

</body>
</html>