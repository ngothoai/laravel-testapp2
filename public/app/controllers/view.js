(function() {
var app = angular.module('app-User', ['ngFileUpload'])
.constant('API_URL', 'http://localhost/laravel-testapp2/public/');
       
        app.directive('fileUpload', function() {
            return {
                templateUrl: './views/master.html',
                link: function(scope, element) {
                    scope.fileName = 'Choose a file...';

                    element.bind('change', function() {
                        scope.$apply(function() {
                            scope.fileName = document.getElementById('uploadFileInput').files[0].name;
                        });
                    });

                    
                }
            };
        });
})();


app.controller('mainController', ['$scope', 'Upload', '$timeout', '$http' ,'API_URL' , function ($scope, Upload, $timeout,$http,API_URL) {

  $scope.save = function(id){
 formDataedit.append('file', document.getElementById('uploadFileInput').files[0]);
    var urls = API_URL + "api/users/" + id ;
     var nameed =  $scope.user.name;
     var ageed = $scope.user.age ;
     var addressed =  $scope.user.address;
      formDataedit.append("name", nameed);
    formDataedit.append("age", ageed);
    formDataedit.append("address", addressed);
    console.log(addressed);
    $http({
      method: 'post',
      url : urls,
      data : formDataedit,
      transformRequest: angular.identity,
      headers: {'Content-Type' : undefined}
    }).then(function successCallback(response) {
       angular.element("input[type='file']").val(null);
          $scope.users = response.data;
          $scope.userphoto = null;
          $scope.setTheFilesEdit=null;
       $("#myModal").modal("hide");
          $scope.errorsedit = response.data.error;
        }, function errorCallback(err) {
           $scope.errorsedit = err.data;
           console.log(err.data);
        });
  

  }
   



  }]);