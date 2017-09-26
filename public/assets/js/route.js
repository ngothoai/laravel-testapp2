var app =  angular.module('main-App',['ngRoute']);
app.config(['$routeProvider',
    function($routeProvider) {
        $routeProvider.
            
            when('/items', {
                templateUrl: 'templates/items.html',
                controller: 'ItemController'
            });
}]);