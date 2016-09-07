/* This application uses the Angular.js framework all code is wrote based on and in accordance with the angular framework, 
    All code is wrote firsthand (unless stated ) based on best practices and methods outlined in the AngularDevelopers Guide available from https://docs.angularjs.org/guide
 (TF)*/
var WatchServices = angular.module('WatchServices', []);

WatchServices.factory('userLoggedinService', ['$cookies', function($cookies) {
	var user;
  var userObj;
  return {
      setUser : function(uID){

        user = uID;
    },
    isLoggedIn : function(){
        userObj = $cookies.get('user');
        if(((userObj)? true : false) == true)
        {
          return true;
        } else {
          return false;
        }
    },
    getUser : function(){
    	return user;
    }
  };
}]);

/* Service to creat list of year to populate dropdown instead of writing them manually (TF)*/
WatchServices.factory('yearService', [ function() {
  var user;
  return {
      getYears : function(){
        /*Set first year (TF)*/
        var d = new Date("1900");
        first = d.getFullYear();
        /* Get todays date then get year (TF)*/
        var s = new Date();
        second = s.getFullYear();
        arr = Array();
        /* Create list of arrays between the two dates (TF)*/
        for(i = first; i <= second; i++) {
          arr.push(i);
        }
        /*Prints current year first by reversing (TF) */
        arr.reverse();
       return arr;
    }
  };
}]);

