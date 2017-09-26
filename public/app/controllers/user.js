var link = $('meta[name="website"]').attr('content');
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
var app = angular.module('app-User', ['ngFileUpload'])
.constant('API_URL', 'http://localhost/laravel-testapp2/public/');
app.directive('ngFiles', ['$parse', function ($parse) {
 
    function file_links(scope, element, attrs) {
        var onChange = $parse(attrs.ngFiles);
        element.on('change', function (event) {
            onChange(scope, {$files: event.target.files});
        });
    }
     return {
        link: file_links
    }
}]);
app.directive('ngFilesedit', ['$parsee', function ($parsee) {
 
    function file_linksedit(scope, element, attrs) {
        var onChange = $parsee(attrs.ngFilesedit);
        element.on('change', function (event) {
            onChange(scope, {$filesedit: event.target.files});
        });
    }
 
    return {
        link: file_linksedit
    }
}]);


	

app.controller('mainController', ['$scope', 'Upload', '$timeout', '$http' ,'API_URL' , function ($scope, Upload, $timeout,$http,API_URL) {
	$http({
    	method : "get",
    	url : API_URL + "users"
    	})
	.then(function successCallback(response) {
				$scope.users = response.data;
		  }, function errorCallback(response) {
		   	
		  });

	var formDataedit = new FormData();
 var formData = new FormData();
$scope.toggle = function(id){
		console.log($scope.userphoto);
	
		$scope.userphoto = null;
	$scope.id = id;
	$http.get("users/" + id + "/edit")
	.then(function successCallback(response) {
    	console.log(response.data);
		$scope.user = response.data;
	  }, function errorCallback(response) {
	   	
	  });

	$('#myModal').modal();
};



 

$scope.setTheFilesedit = function ($files) {
        angular.forEach($files, function (value, key) {
            formDataedit.append('photo', value);
            console.log($files);
        });
    };

$scope.save = function(id){

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
	    		$scope.users = response.data;
			 $("#myModal").modal("hide");
	  			$scope.errorsedit = response.data.error;
			  }, function errorCallback(err) {
			   	 $scope.errorsedit = err.data;
			   	 console.log(err.data);
			  });
	

	}
   
   

    //ADd
    $scope.addtoggle = function(file){
    	$scope.add = null;
    	$scope.errors = null;
	$('#myModaladd').modal();
	}
	$scope.setTheFiles = function ($files) {
        angular.forEach($files, function (value, key) {
            formData.append('photo', value);
            console.log($files);
        });
    };
	 $scope.adduser = function() {
    	var name =  $scope.add.name;
	    var age =  $scope.add.age;
	    var address =  $scope.add.address;

	    formData.append("name", name);
	    formData.append("age", age);
	    formData.append("address", address);
	    console.log(formData);
		$http({
			url : "users",
			method: 'post',
			data : formData,
			headers: {'Content-Type' : undefined}
			})
			.then(function successCallback(response) {
			    	console.log(response);
					$scope.users = response.data.data;
					$('#myModaladd').modal('hide');
					$scope.add.name = "";
					$scope.add.age = "";
					$scope.add.address = "";
					$scope.errors = response.data.error;
			  }, function errorCallback(err) {
			   	 $scope.errors = err.data;
			   	 console.log(err.data);
			  });
	    }



$scope.delete = function (id){
	var isConfirmDeleter = confirm("Do you want to delete this user?");
	if(isConfirmDeleter){
		$http({
			method: 'delete',
			url : 'users/' + id,
		})
		.then(function successCallback(response) {
    		$scope.users = response.data;
		  }, function errorCallback(response) {
		   	console.log(response);
				alert("Error");
		  });
	}else{
		return false;
	}
};


}]);