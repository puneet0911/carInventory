app.controller('uploadImageController', ['$scope', 'Upload', '$location','carInventoryService', function ($scope, Upload, $location,carInventoryService) {
    $scope.uploadPic = function(file) {
      var formData  = {
        carInventoryService: carInventoryService, file: file
      }
    file.upload = Upload.upload({
      url: 'http://localhost/CarInventory/BACKEND_API/api_data.php?type=add_manufacturer',
      data: formData,
    });

    file.upload.then(function (response) {
      console.log("success response",response)
      if(response.status == 200){
           $location.url('/manufacturer'); 
      }else{
        
      }
      // $timeout(function () {
      //   file.result = response.data;
      // });
    }, function (response) {
      console.log("Error response",response)
      if (response.status > 0)
          $scope.errorMsg = response.status + ': ' + response.data.data;
    }, function (evt) {
      // Math.min is to fix IE which reports 200% sometimes
      file.progress = Math.min(100, parseInt(100.0 * evt.loaded / evt.total));
    });
    }
}]);