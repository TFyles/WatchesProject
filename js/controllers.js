/* This application uses the Angular.js framework all code is wrote based on and in accordance with the angular framework, 
    All code is wrote firsthand (unless stated ) based on best practices and methods outlined in the AngularDevelopers Guide available from https://docs.angularjs.org/guide
 (TF)*/

 /* Declare new angular module which will contain controllers */
var WatchControllers = angular.module('WatchControllers', []);

/* Declare controller and its dependencies
# $scope (Allows for 2 way data binding with HTML pages which use this controller , produced by angular ) 
# $location (Allows for changes to the URL, produced by angular)
# userLoggedInService (Used to find if the user is logged in, produced by me)
# yearSerive (used to populate year select field, produced by me)
# $http (Allows for http calls(similar to ajax), produced by angular)
# $cookies (Allows for get and set of cookies, produced by angular)
# $rootscope(Allows for two way data biding with any html page)
(TF)
*/

/* All Swal() functions are instances of sweetalert, in each case i have changed the text and determined if it was a click button or a time based exit (TF)*/

/* All Name, Input, Output other blocks are created by me, i missed out my initials (TF) */
WatchControllers.controller('auctionCtrl', ['$scope', '$location', 'userLoggedinService', 'yearService', '$http', '$cookies', '$rootScope',
    function($scope, $location, userLoggedinService, yearService, $http, $cookies, $rootScope) {

        /* Check if user is logged in, if not redirect to login page */
        if (!userLoggedinService.isLoggedIn()) {
            $location.path('/login');
        }


        /*
        Name: addAuction
        Input: Data binded from form (Brand, Model, year, movement, strap, price, description, end_date) From Rootscope (Logged in user)
        Output: ID of created object, Redirect to editPage for new auction
        Other: new auction create in auctions table
        */

        $scope.addAuction = function() {
            var brand = $scope.brand;
            var model = $scope.model;
            var year = $scope.year;
            var movement = $scope.movement;
            var strap = $scope.strap;
            var price = $scope.price;
            var desc = $scope.description;
            var end = $scope.end_date;
            var user = $rootScope.loggedInUserID;
            if ($scope.sellForm.$valid == true) {
                $http({
                    url: "../ajax/addAuction.php",
                    method: "POST",
                    data: { "brand": brand, "model": model, "year": year, "movement": movement, "strap": strap, "price": price, "description": desc, "end_date": end, "user": user }
                }).success(function(data, status, headers, config) {
                    if (data > 0) {
                        data = data.trim();
                        swal({ title: "Success!", text: "Auction Created", type: "success", timer: 1000, showConfirmButton: false });
                        var path = '/auction/edit/' + data;
                        $location.path(path);
                    }
                }).error(function(data, status, headers, config) {
                    $scope.status = status;
                });
            } else {
                $scope.errorText = "Please fill in all fields"
            }

        }

        /*
        Name: getAllAuctions
        Input: None
        Output: Array of Auctions
        Other: Binded to auctions variable
        */
        $scope.getAllAuctions = function() {
            $http({
                url: "../ajax/getAllAuctions.php",
                method: "POST",
                data: { "get": "Auctions" }
            }).success(function(data, status, headers, config) {
                $scope.auctions = data;
            }).error(function(data, status, headers, config) {
                $scope.status = status;
            });
        }

        /*
        Name: getAuctionByYear
        Input: Data Binded from form(year)
        Output: Array of Auctions
        Other: Binded to auctions variable
        */
        $scope.getAuctionByYear = function() {
            var tempYear = $scope.searchYear
            $http({
                url: "../ajax/searchAuctions.php",
                method: "POST",
                data: { "type": "Year", "year": tempYear }
            }).success(function(data, status, headers, config) {
                if (typeof(data) == "string") {
                    data = data.trim();
                }
                if (data == 'nothing') {
                    $scope.auctions = [];
                } else {
                    $scope.auctions = data;
                    for (var i = $scope.auctions.length - 1; i >= 0; i--) {
                        if (($scope.auctions[i]['status']) != null) {
                            $scope.auctions.splice(i, 1);
                        }
                    }
                }
            }).error(function(data, status, headers, config) {
                $scope.status = status;
            });
        }

        /*
        Name: getAuctionByMovement
        Input: Data Binded from form (searchMovement)
        Output: Array of auctions
        Other: Binded to auctions variable
        */
        $scope.getAuctionByMovement = function() {
            var tempMovement = $scope.searchMovement
            $http({
                url: "../ajax/searchAuctions.php",
                method: "POST",
                data: { "type": "Movement", "movement": tempMovement }
            }).success(function(data, status, headers, config) {
                console.log(data);
                if (typeof(data) == "string") {
                    data = data.trim();
                }
                if (data == 'nothing') {
                    $scope.auctions = [];
                } else {
                    console.log("working");
                    $scope.auctions = data;
                    for (var i = $scope.auctions.length - 1; i >= 0; i--) {
                        if (($scope.auctions[i]['status']) != null) {
                            $scope.auctions.splice(i, 1);
                        }
                    }
                }

            }).error(function(data, status, headers, config) {
                $scope.status = status;
            });
        }

        /*
        Name: getAuctionByStrap
        Input: Data binded from form(searchStrap)
        Output: Array of auctions
        Other: Binded to auctions variable.
        */
        $scope.getAuctionByStrap = function() {
            var tempStrap = $scope.searchStrap
            $http({
                url: "../ajax/searchAuctions.php",
                method: "POST",
                data: { "type": "Strap", "strap": tempStrap }
            }).success(function(data, status, headers, config) {
                console.log(data);
                if (typeof(data) == "string") {
                    data = data.trim();
                }
                if (data == 'nothing') {
                    $scope.auctions = [];
                } else {
                    $scope.auctions = data;
                    for (var i = $scope.auctions.length - 1; i >= 0; i--) {
                        if (($scope.auctions[i]['status']) != null) {
                            $scope.auctions.splice(i, 1);
                        }
                    }
                }

            }).error(function(data, status, headers, config) {
                $scope.status = status;
            });
        }

        /*
        Name: getAuctionByBrand
        Input: data binded from form (searchBrand)
        Output: Array of Auctions
        Other: binded to auctions variable
        */
        $scope.getAuctionByBrand = function() {
            var tempBrand = $scope.searchBrand
            $http({
                url: "../ajax/searchAuctions.php",
                method: "POST",
                data: { "type": "Brand", "brand": tempBrand }
            }).success(function(data, status, headers, config) {
                console.log(data);
                if (typeof(data) == "string") {
                    data = data.trim();
                }
                if (data == 'nothing') {
                    $scope.auctions = [];
                } else {
                    $scope.auctions = data;
                    for (var i = $scope.auctions.length - 1; i >= 0; i--) {
                        if (($scope.auctions[i]['status']) != null) {
                            $scope.auctions.splice(i, 1);
                        }
                    }
                }
            }).error(function(data, status, headers, config) {
                $scope.status = status;
            });
        }

        /*Run on page load (TF) */
        $rootScope.loggedIn = userLoggedinService.isLoggedIn();
        if ($rootScope.loggedIn == true) {
            $scope.user = $cookies.get('user');
            $scope.user = JSON.parse($scope.user);
            $scope.loggedinusername = $scope.user.username.trim();
            $rootScope.loggedInUserID = $scope.user.ID.trim();
        }
        $scope.auctions = [];
        $scope.getAllAuctions();
        $scope.years = yearService.getYears();


    }

]);


WatchControllers.controller('loginCtrl', ['$scope', 'userLoggedinService', '$cookies', '$http', '$location', '$rootScope',
    function($scope, userLoggedinService, $cookies, $http, $location, $rootScope) {

        /* set header for http to include PHP session ID cookie */
        $http.defaults.headers.post = { 'session-id': $cookies.get('PHPSESSID') }


        /*
        Name: Register
        Input: data binded from form (regUsername, regPassword, redEmail)
        Output: String describing result
        Other: N/A
        */
        $scope.Register = function() {
            var tempUsername = $scope.regUsername;
            var tempPass = $scope.regPassword;
            var tempEmail = $scope.regEmail;
            if ($scope.registerForm.$valid == true) {
                $http({
                    url: "../ajax/register.php",
                    method: "POST",
                    data: { "username": tempUsername, "pass": tempPass, "email": tempEmail, "role": "user" }
                }).success(function(data, status, headers, config) {
                    data = data.trim()
                    if (data == "Success") {
                        $location.path('/login');
                        swal({ title: "Success!", text: "Thank You For Signing up", type: "success", confirmButtonText: "To Login" });
                    } else if (data == "exists") {
                        swal({ title: "Register Failed!", text: "Username already in use", type: "error", timer: 1000, showConfirmButton: false });
                    } else {
                        swal({ title: "Register Failed!", text: "Please ensure all field are correct", type: "error", timer: 1000, showConfirmButton: false });
                    }
                }).error(function(data, status, headers, config) {
                    $scope.status = status;
                });
            } else {
                $scope.errorText = "Please fill in all fields"
            }
        }

        /*
        Name: Login
        Input: data binded from form (loginUsername, loginPassword)
        Output: user Object
        Other: Creates user cookies
        */
        $scope.login = function() {
            var LtempUsername = $scope.loginUsername;
            var LtempPass = $scope.loginPassword;
            if ($scope.LoginForm.$valid == true) {
                $http({
                    url: "../ajax/login.php",
                    method: "POST",
                    data: { "username": LtempUsername, "pass": LtempPass }
                }).success(function(data, status, headers, config) {
                    if (data.length == 8) {
                        data = data.trim();
                    }
                    if (data == 'Invalid') {
                        swal({ title: "Error!", text: "Incorrect Username or Password", type: "error", confirmButtonText: "Try Again" });
                    } else {
                        var res = data;
                        res = JSON.stringify(res);
                        $cookies.put('user', res);
                        userLoggedinService.setUser(res.ID);
                        $location.path('/');
                        swal({ title: "Success!", text: "Successfully logged", type: "success", timer: 1000, showConfirmButton: false });
                    }

                }).error(function(data, status, headers, config) {
                    $scope.status = status;
                });
            } else {
                $scope.errorText = "Please fill in all fields"
            }
        }

        /*
        Name: Logout
        Input: None
        Output: String describing outcome
        Other: Destroy user cookie
        */
        $scope.logout = function() {

            $http({
                url: "../ajax/logout.php",
                method: "POST",
                data: { "state": 'Logout' }
            }).success(function(data, status, headers, config) {
                data = data.trim();
                if (data == 'sessionOver') {
                    $cookies.remove('user');
                    userLoggedinService.setUser(null);
                    $rootScope.loggedInUserID = null;
                    $location.path('/login');
                    swal({ title: "Success!", text: "Successfully logged out", type: "success", timer: 1000, showConfirmButton: false });

                }

            }).error(function(data, status, headers, config) {
                $scope.status = status;
            });
        }

        /*Run on page load (TF) */
        $rootScope.loggedIn = userLoggedinService.isLoggedIn();
        if ($rootScope.loggedIn == true) {
            $scope.user = $cookies.get('user');
            $scope.user = JSON.parse($scope.user);
            $scope.loggedinusername = $scope.user.username.trim();
            $rootScope.loggedInUserID = $scope.user.ID.trim();
        }
    }

]);

WatchControllers.controller('auctionDetailsCtrl', ['$scope', '$location', 'userLoggedinService', 'yearService', '$http', '$cookies', '$routeParams', '$rootScope',
    function($scope, $location, userLoggedinService, yearService, $http, $cookies, $routeParams, $rootScope) {

         /* Check if user is logged in, if not redirect to login page */
        if (!userLoggedinService.isLoggedIn()) {
            $location.path('/login');
        }

        /*
        Name: getWatchFromID
        Input: ID value from routeParamters
        Output: Auction Object
        Other: binded to watch variable
        */
        $scope.getWatchFromID = function() {
            $http({
                url: "../ajax/getWatchFromID.php",
                method: "POST",
                data: { "ID": $scope.WatchID }
            }).success(function(data, status, headers, config) {
                if (data.length == 9) {
                    data = data.trim();
                }
                if (data == 'nothing') {
                    $location.path('/404');
                } else {
                    $scope.watch = data;
                }
            }).error(function(data, status, headers, config) {
                $scope.status = status;
            });
        }

        /*
        Name: getWatchBidsFromID
        Input: ID value from routeParamters
        Output: Array of Bid Objects
        Other: binded to watchBids variable
        */
        $scope.getWatchBidsFromID = function() {
            $http({
                url: "../ajax/getWatchBidsFromID.php",
                method: "POST",
                data: { "ID": $scope.WatchID }
            }).success(function(data, status, headers, config) {
                if (typeof(data) == "string") {
                    data = data.trim();
                }
                if (data == 'nothing') {
                    $scope.watchBids = [];
                } else {
                    $scope.watchBids = data;
                }
            }).error(function(data, status, headers, config) {
                $scope.status = status;
            });
        }

         /*
        Name: getImagesFromID
        Input: ID value from routeParamters
        Output: Array of image Object
        Other: binded to watchImgs variable
        */
        $scope.getImagesFromID = function() {
            $http({
                url: "../ajax/getImagesFromID.php",
                method: "POST",
                data: { "ID": $scope.WatchID }
            }).success(function(data, status, headers, config) {
                if (typeof(data) == "string") {
                    data = data.trim();
                }
                if (data == 'nothing') {
                    $scope.watchImgs = [];
                } else {
                    $scope.watchImgs = data;
                }


            }).error(function(data, status, headers, config) {
                $scope.status = status;
            });
        }

        
         /*
        Name: deleteAuction
        Input: ID value from routeParamters
        Output: String describing outcome
        Other: N/A
        */
        $scope.deleteAuction = function() {
            $http({
                url: "../ajax/deleteAuction.php",
                method: "POST",
                data: { "watchID": $scope.WatchID }
            }).success(function(data, status, headers, config) {
                if (typeof(data) == "string") {
                    data = data.trim();
                }
                if (data == "Success") {
                    $location.path('/profile/' + $scope.userID);
                    swal({ title: "Success!", text: "Auction Deleted", type: "info", timer: 1000, showConfirmButton: false });
                }

            }).error(function(data, status, headers, config) {
                $scope.status = status;
            });
        }

         /*
        Name: editAuction
        Input: Data binded from from (editbrand, editModel, edityear, editmovement, edotstrap, editprice, editdescription, edit_end_date)
        Output: String describing outcome
        Other: N/A
        */
        $scope.editAuction = function() {
            var brand = $scope.editbrand;
            var model = $scope.editmodel;
            var year = $scope.edityear;
            var movement = $scope.editmovement;
            var strap = $scope.editstrap;
            var price = $scope.editprice;
            var desc = $scope.editdescription;
            var end = $scope.edit_end_date;
            if ($scope.updateForm.$valid == true) {
                $http({
                    url: "../ajax/editAuction.php",
                    method: "POST",
                    data: { "ID": $scope.WatchID, "end_date": end, "brand": brand, "model": model, "year": year, "movement": movement, "strap": strap, "price": price, "description": desc }
                }).success(function(data, status, headers, config) {
                    if (typeof(data) == "string") {
                        data = data.trim();
                    }
                    if (data == "Success") {
                        //Why havent i wrote anything here
                    }

                }).error(function(data, status, headers, config) {
                    $scope.status = status;
                });
            } else {
                $scope.errorText = "Please fill in all fields"
            }
        }

        /*
        Name: Bid
        Input: Data binded from from (bidAmount), Price attribute from watch object
        Output: String describing outcome
        Other: N/A
        */
        $scope.Bid = function() {
            var bidAmount = parseInt($scope.bidAmount);


            if (bidAmount >= parseInt($scope.watch.price)) {
                $http({
                    url: "../ajax/bid.php",
                    method: "POST",
                    data: { "watchID": $scope.WatchID, "userID": $scope.userID, "bidAmount": bidAmount }
                }).success(function(data, status, headers, config) {
                    data = data.trim();
                    if (data == "Success") {
                        $scope.getWatchBidsFromID();
                        swal({ title: "Success!", text: "Bid Made", type: "success", timer: 1000, showConfirmButton: false });
                    }
                }).error(function(data, status, headers, config) {
                    $scope.status = status;
                });
            } else {
                swal({ title: "Bid Failed!", text: "Please check that the bid value is higher than the minimum bid", type: "error", timer: 1000, showConfirmButton: false });
            }


        }

        /*
        Name: acceptBid
        Input: ID from routeParamter
        Output: None
        Other: Calls FinishAuction function
        */
        $scope.acceptBid = function(bidID, buyerID, auctionID) {

            $http({
                url: "../ajax/bidStatus.php",
                method: "POST",
                data: { "ID": bidID, "type": "accept", "auctionID": auctionID }
            }).success(function(data, status, headers, config) {
                $scope.getWatchBidsFromID();
                $scope.FinishAuction(buyerID);

            }).error(function(data, status, headers, config) {
                $scope.status = status;
            });


        }

        /*
        Name: FinishAuction
        Input: ID from watch Object, buyerID from parameter
        Output: None
        Other: Auction ends
        */
        $scope.FinishAuction = function(buyerID) {
            watch = $scope.watch;
            $http({
                url: "../ajax/FinishAuction.php",
                method: "POST",
                data: { "ID": watch.ID, "buyerID": buyerID }
            }).success(function(data, status, headers, config) {


            }).error(function(data, status, headers, config) {
                $scope.status = status;
            });

        }

        
        /*
        Name: declineBid
        Input: bidID from parameter
        Output: None
        Other: status of bid changes to declines
        */
        $scope.declineBid = function(bidID) {
            $http({
                url: "../ajax/bidStatus.php",
                method: "POST",
                data: { "ID": bidID, "type": "decline" }
            }).success(function(data, status, headers, config) {
                $scope.getWatchBidsFromID();

            }).error(function(data, status, headers, config) {
                $scope.status = status;
            });
        }

        /*
        Name: cancelBid
        Input: bidID from parameter
        Output: None
        Other: status of bid changes to cancelled
        */
        $scope.cancelBid = function(bidID) {
            $http({
                url: "../ajax/bidStatus.php",
                method: "POST",
                data: { "ID": bidID, "type": "cancel" }
            }).success(function(data, status, headers, config) {
                $scope.getWatchBidsFromID();

            }).error(function(data, status, headers, config) {
                $scope.status = status;
            });
        }

        /*
        Name: deletePhoto
        Input: photoID from parameter
        Output: String describing outcome
        Other: deletes photo row from photos table
        */
        $scope.deletePhoto = function(photoID) {
            $http({
                url: "../ajax/deletePhoto.php",
                method: "POST",
                data: { "ID": photoID }
            }).success(function(data, status, headers, config) {
                if (typeof(data) == "string") {
                    data = data.trim();
                }
                if (data == "Success") {
                    $scope.getImagesFromID();
                    swal({ title: "Success!", text: "Photo Deleted", type: "success", timer: 1000, showConfirmButton: false });
                }
            }).error(function(data, status, headers, config) {
                $scope.status = status;
            });
        }

        /*
        Name: deleteThumbnal
        Input: auctionID from parameter
        Output: String describing outcome
        Other: sets thumbnail attribute on selection auction to Null.
        */
        $scope.deleteThumbnail = function(auctionID) {
            $http({
                url: "../ajax/deleteThumbnail.php",
                method: "POST",
                data: { "ID": auctionID }
            }).success(function(data, status, headers, config) {
                if (typeof(data) == "string") {
                    data = data.trim();
                }
                if (data == "Success") {
                    $scope.getWatchFromID();
                    swal({ title: "Success!", text: "Thumbnail Deleted", type: "success", timer: 1000, showConfirmButton: false });
                }

            }).error(function(data, status, headers, config) {
                $scope.status = status;
            });
        }


        /*Run on page load (TF) */
        $rootScope.loggedIn = userLoggedinService.isLoggedIn();
        if ($rootScope.loggedIn == true) {
            $scope.user = $cookies.get('user');
            $scope.user = JSON.parse($scope.user);
            $scope.userID = $scope.user.ID.trim();
            $scope.WatchID = $routeParams.auctionID;
            $rootScope.loggedInUserID = $scope.user.ID.trim();
        }
        $scope.watch;
        $scope.getWatchFromID();
        $scope.watchImgs;
        $scope.getImagesFromID();
        $scope.watchBids;
        $scope.getWatchBidsFromID();
        $scope.years = yearService.getYears();
    }

]);

WatchControllers.controller('profileCtrl', ['$scope', '$location', 'userLoggedinService', '$http', '$cookies', '$routeParams', '$rootScope',
    function($scope, $location, userLoggedinService, $http, $cookies, $routeParams, $rootScope) {

         /* Check if user is logged in, if not redirect to login page */
        if (!userLoggedinService.isLoggedIn()) {
            $location.path('/login');
        }


        /*
        Name: getProfileFromID
        Input: ID value from routeParamters
        Output: profile object
        Other: binded to profile variable
        */
        $scope.getProfileFromID = function() {
            $http({
                url: "../ajax/getProfileFromID.php",
                method: "POST",
                data: { "ID": $scope.profileID, "get": "user" }
            }).success(function(data, status, headers, config) {
                if (typeof(data) == "string") {
                    data = data.trim();
                }
                if (data == 'nothing') {
                    $location.path('/404');
                } else {
                    $scope.profile = data;
                }

            }).error(function(data, status, headers, config) {
                $scope.status = status;
            });
        }

        /*
        Name: getAuctionFromSellerID
        Input: ID value from routeParamters
        Output: Array of auction objects
        Other: binded to selling variable
        */
        $scope.getAuctionFromSellerID = function() {
            $http({
                url: "../ajax/searchAuctions.php",
                method: "POST",
                data: { "type": "Seller", "ID": $scope.profileID }
            }).success(function(data, status, headers, config) {
                if (typeof(data) == "string") {
                    data = data.trim();
                }
                if (data == 'nothing') {
                    $scope.selling = [];
                } else {
                    $scope.selling = data;
                }

            }).error(function(data, status, headers, config) {
                $scope.status = status;
            });
        }

        /*
        Name: getWatchBidsFromUserID
        Input: ID value from routeParamters
        Output: Array of bid objects
        Other: binded to auctionBids variable
        */
        $scope.getWatchBidsFromUserID = function() {
            $http({
                url: "../ajax/getWatchBidsFromUserID.php",
                method: "POST",
                data: { "ID": $scope.profileID }
            }).success(function(data, status, headers, config) {
                if (typeof(data) == "string") {
                    data = data.trim();
                }
                if (data == 'nothing') {
                    $scope.auctionBids = [];
                } else {
                    $scope.auctionBids = data;
                }
            }).error(function(data, status, headers, config) {
                $scope.status = status;
            });
        }

        /*
        Name: cancelBid
        Input: bidID from parameter
        Output: None
        Other: status of bid changes to cancelled
        */
        $scope.cancelBid = function(bidID) {
            $http({
                url: "../ajax/bidStatus.php",
                method: "POST",
                data: { "ID": bidID, "type": "cancel" }
            }).success(function(data, status, headers, config) {
                $scope.getWatchBidsFromUserID();

            }).error(function(data, status, headers, config) {
                $scope.status = status;
            });
        }


        /*
        Name: getUserPurchased
        Input: ID value from routeParamters
        Output: Array of auction objects
        Other: binded to userPurchased variable
        */
        $scope.getUserPurchased = function() {
            $http({
                url: "../ajax/getUserPurchased.php",
                method: "POST",
                data: { "ID": $scope.profileID }
            }).success(function(data, status, headers, config) {
                if (typeof(data) == "string") {
                    data = data.trim();
                }
                if (data == 'nothing') {
                    $scope.userPurchased = [];
                } else {
                    $scope.userPurchased = data;
                }
            }).error(function(data, status, headers, config) {
                $scope.status = status;
            });
        }


        /*Run on page load (TF) */
        $rootScope.loggedIn = userLoggedinService.isLoggedIn();
        if ($rootScope.loggedIn == true) {
            $scope.user = $cookies.get('user');
            $scope.user = JSON.parse($scope.user);
            $scope.userID = $scope.user.ID.trim();
            $rootScope.loggedInUserID = $scope.user.ID.trim();
        }
        $scope.profileID = $routeParams.profileID;
        $scope.profile;
        $scope.getProfileFromID();
        $scope.selling;
        $scope.getAuctionFromSellerID();
        $scope.auctionBids;
        $scope.getWatchBidsFromUserID();
        $scope.userPurchased;
        $scope.getUserPurchased();



    }

]);
