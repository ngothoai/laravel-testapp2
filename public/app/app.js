var app = angular.module('app-User', [])
.constant('API_URL', 'http://localhost/laravel-testapp2/public/');



// var app = angular.module('app-User', [], ['$httpProvider', function ($httpProvider) {
//     $httpProvider.defaults.headers.post['X-CSRF-TOKEN'] = $('meta[name=csrf-token]').attr('content');
// }]).constant('API_URL', 'http://localhost/laravel-testapp2/public/');


// var app = angular.module('app-User', [ 'ngRoute' ])
// .constant('API_URL', 'http://localhost/laravel-testapp2/public/');
// app.config(function($routeProvider) {
//         $routeProvider
//             .when('/', {
//                 templateUrl : '../resources/views/templates/home.html',
//                 controller  : 'mainController'
//             })
//         .when('/create', {
//             templateUrl : '../resources/views/templates/create.html',
//             controller  : 'createController'
//         })

//         .when('/:id/edit', {
//             templateUrl : '../resources/views/templates/create.html',
//             controller  : 'editController'
//         });
// });