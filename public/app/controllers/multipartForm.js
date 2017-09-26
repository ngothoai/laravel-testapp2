app.service('multipartForm', ['$http' ,function ($http) {
	this.post = function (uploadUrl,data){
		var fd = new FormData();
		for (var key in data){
			fd.append(key,data[key]);
			$http.post(uploadUrl,fd , {
				transformRequest: angular.identity,
				headers: {'Content-Type' : undefined }
			})
			.then(function successCallback(response) {
		    	console.log(response);
				$scope.users = response.data.data;
				$('#myModaladd').modal('hide');
				$scope.add.name = "";
				$scope.add.age = "";
				$scope.add.address = "";
		  }, function errorCallback(response) {
		   	
		  });
			}
		}
}]);