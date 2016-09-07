/* This application uses the Angular.js framework all code is wrote based on and in accordance with the angular framework, 
    All code is wrote firsthand (unless stated ) based on best practices and methods outlined in the AngularDevelopers Guide available from https://docs.angularjs.org/guide
 (TF)*/

/* Declare app and its dependencies (TF)
# ng-Route (For page routing produced by Angular)
# ng-cookies (Best practice for using cookies Produced by angular)
# watchServices (A service produced by me)
# watchControllers (The controllers for my application produced by me)
(TF)*/
var WatchApp = angular.module('WatchApp', ['ngRoute', 'ngCookies', 'WatchServices' ,'WatchControllers',
]);

/* Routing configuration for project, declare route, which page should load, and which controller should handle it (TF) */
WatchApp.config(['$routeProvider',
  function($routeProvider) {

    $routeProvider.
    when('/', {
        templateUrl: 'views/home.html',
        controller: 'auctionCtrl'
      }).
     when('/auction/buy/:auctionID', {
        templateUrl: 'views/watch.html',
        controller: 'auctionDetailsCtrl'
      }).
     when('/auction/edit/:auctionID', {
        templateUrl: 'views/editWatch.html',
        controller: 'auctionDetailsCtrl'
      }).
      when('/auction/sell', {
        templateUrl: 'views/sell.html',
        controller: 'auctionCtrl'
      }).
      when('/auction/buy', {
        templateUrl: 'views/buy.html',
        controller: 'auctionCtrl'
      }).
      when('/login', {
        templateUrl: 'views/users/login.html',
        controller: 'loginCtrl'
      }).
      when('/register', {
        templateUrl: 'views/users/register.html',
        controller: 'loginCtrl'
      }).
      when('/logout', {
        templateUrl: 'views/users/logout.html',
        controller: 'loginCtrl'
      }).
      when('/profile/:profileID', {
        templateUrl: 'views/users/profile.html',
        controller: 'profileCtrl'
      }).
      when('/404', {
        templateUrl: 'views/404.html',
        controller: 'auctionCtrl'
      }).
      otherwise({
        redirectTo: '/'
      });

  }]);