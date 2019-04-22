app.controller('otherDetailsController',['$scope','carInventoryService','$location',function ($scope,carInventoryService,$location) {  
        $scope.loader = false;
        $scope.uploadData = function(){
            $scope.loader = true;
            if($scope.manufacturer != 'undefined'){
                carInventoryService.color =$scope.manufacturer.color; 
                carInventoryService.year =$scope.manufacturer.year; 
                carInventoryService.rNumber =$scope.manufacturer.rNumber; 
                carInventoryService.note =$scope.manufacturer.note;
                $location.url('/uploadImage'); 
            }
        }
}]);  