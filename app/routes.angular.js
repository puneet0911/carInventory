app.config(['$routeProvider', '$locationProvider', function($routeProvider,$locationProvider) {
$routeProvider
    .when('/manufacturer', {
        templateUrl: 'public/views/manufacturer.html',
        controller : "carInventoryController"
    })
    .when('/otherDetails', {
        templateUrl: 'public/views/otherDetails.html',
        controller : "otherDetailsController",
        resolve: {
                carInventoryService : "carInventoryService",
                "check" : function(carInventoryService,$location) {
                    console.log("route carInventoryService",Object.keys(carInventoryService).length);
                    if(Object.keys(carInventoryService).length == 0){
                        $location.path('/manufacturer'); 
                    }
                }
            }
    })
    .when('/uploadImage', {
        templateUrl: 'public/views/upload_image.html',
        controller : "uploadImageController",
        resolve: {
                carInventoryService : "carInventoryService",
                "check" : function(carInventoryService,$location) {
                    console.log("route carInventoryService",Object.keys(carInventoryService).length);
                    if(Object.keys(carInventoryService).length == 0){
                        $location.path('/manufacturer'); 
                    }
                }
            }
    })
    .when('/home', {
        templateUrl: 'public/views/home.html',
        controller : "carInventoryController"
    })
    .when('/car/:id/:name', {
        templateUrl: 'public/views/carDetails.html',
        controller : "carInventoryController"
    })

 }]);