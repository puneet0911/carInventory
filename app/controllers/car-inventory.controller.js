app.controller('carInventoryController',['$scope','$location','$http','$routeParams', 'carInventoryService', 'generalService', function ($scope,$location,$http,$routeParams,carInventoryService,generalService) {  
        $scope.loader = false;
        $scope.manufacturerData = [];
        $scope.getName = function(){
        	$scope.loader = true;
        	if($scope.manufacturer.name != 'undefined'){
	        	carInventoryService.name =$scope.manufacturer.name; 
	        	$location.url('/otherDetails');
        	}
        }

        $scope.getData = function(){
        	$scope.loader = true;
        	var promise = $http.get(generalService.domainURL+"api_data.php?type=get_manufacturers");
				promise.success(function(response) {
				   if(response.status == 200){
				   	$scope.manufacturerData = response.data;
				   	console.log($scope.manufacturerData);
				   }
				});
				promise.error(function(response, status) {
				   console.log("The request failed with response " + response + " and status code " + status);
				});	
        }
        $scope.getDetails = function(){
        	console.log("get router params",$routeParams.id);
        	 promise = $http.get(generalService.domainURL+"api_data.php?type=get_manufacturer_details&id="+$routeParams.id);
				promise.success(function(response) {
				   if(response.status == 200){
				   	$scope.manufacturerDetails = response.data;
				   	$scope.manufacturerName = $routeParams.name;
				   	console.log($scope.manufacturerDetails);
				   }
				});
				promise.error(function(response, status) {
				   console.log("The request failed with response " + response + " and status code " + status);
				});	
        }

}]);  