(function(angular) {
  'use strict';
	
	// App
	var app = angular.module('forum', ['ngAnimate','ngRoute','ngSanitize']);
	app.controller('navController', ['$scope', function($scope,$http) {
	    // Navigation
	    $scope.links =
	      [{name: 'Blog', url: 'blog'},
	      {name: 'About', url: 'user'},
	      {name: 'Contact', url: '#'}
	      ];
	    // Logo
	    $scope.logo = 'Dcastalia';
	}]);
	
	
	
	// List view Control
	app.controller('archiveController', function($scope,$http) {
	  	$scope.title="All posts";
	  	$scope.posts = [];
	  	var API="apis/post";
	  	
	  	$http.post(API,{sub: 'getPost'})
	  	.success(function (response) {
   			$scope.posts=response;
   		});
	});
	// User Control
	app.controller('userController', function($scope,$http) {
	  	var API="apis/user";
	  	$scope.reg=function(){
		  	$http.post(API,{sub: 'regUser', username: $scope.username, email: $scope.email, password: $scope.password})
		  	.success(function (response) {
	   			$scope.status=response.message;
	   			if(response.success==1) window.self.location.reload();
	   		});
	   	};
	   	$scope.login=function(){
		  	$http.post(API,{sub: 'loginUser', email: $scope.email, password: $scope.password})
		  	.success(function (response) {
	   			if(response.success==1) window.self.location.reload();
	   		});
	   	};
	});
	// Post Control
	app.controller('postController', function($scope,$http) {
	  	$scope.title="Write a post";
	    var API="apis/post";
	    $scope.textareaText='';
	    $scope.left  = function() {return 500 - $scope.textareaText.length;};
	});
	// single post control
	app.controller('singleController', function($scope,$http,$routeParams,$location) {
		$scope.title='';
	  	var API="apis/post";
	  	$scope.comdesc="Post comment:";
	  	
		var pid=$routeParams.postId;
		$http.post(API,{sub: 'singlePost', postid: pid})
	  	.success(function (response) {
   			$scope.title=response[0].posttitle;
   			$scope.uid=response[0].uid;
   			$scope.username=response[0].username;
   			$scope.postdesc=response[0].postdesc;
   			$scope.postimg=response[0].postimg;
   			$scope.url=window.self.location.href;
   			FB.XFBML.parse();
   		});
   		var API="apis/comment";
   		$scope.coms=[];
   		$scope.newComment=function(){
   			$http.post(API,{sub: 'addComment', postid: pid, name: $scope.viewer, comment: $scope.comment})
		  	.success(function (response) {
	   			$scope.comdesc="Comment added!";
	   			$('#comment-form').hide();
	   			$scope.coms.unshift({postid: pid, viewer: $scope.viewer, comment: $scope.comment});
	   		});
   		}
		$http.post(API,{sub: 'getComment', postid: pid})
	  	.success(function (response) {
   			$scope.coms=response;
   		});
	});
	// Profile control
	app.controller('profileController', function($scope,$http,$routeParams) {
	  	var API="apis/user";

		$scope.ujoin=function(id){
			if($routeParams.userId) id=$routeParams.userId;
			$http.post(API,{sub: 'joinUser', uid: id})
		  	.success(function (response) {
	   			$scope.username=response[0].username;
	   			$scope.joindate=response[0].joindate;
	   		});
	   	}
	});
	
	
	// Custom directive
	app.directive('myMaxlength', ['$compile', '$log', function($compile, $log) {
		return {
			restrict: 'A',
			require: 'ngModel',
			link: function (scope, elem, attrs, ctrl) {
				attrs.$set("ngTrim", "false");
                var maxlength = parseInt(attrs.myMaxlength, 10);
                ctrl.$parsers.push(function (value) {
                    if (value.length > maxlength) {
                        value = value.substr(0, maxlength);
                        ctrl.$setViewValue(value);
                        ctrl.$render();
                    }
                    return value;
                });
			}
		};
	}]);
	
	
	
	// Routing
	app.config(function($routeProvider, $locationProvider) {
	  $routeProvider
	  .when('/user', {
	    templateUrl: 'pages/user.php',
	    controller: 'userController'
	  })
	  .when('/user/:userId', {
	    templateUrl: 'pages/user.php',
	    controller: 'userController'
	  })
	  .when('/post/:postId', {
	    templateUrl: 'pages/post.php',
	    controller: 'singleController'
	  })
      .otherwise({
        templateUrl: 'pages/archive.php',
	    controller: 'archiveController'
      });
	
	  $locationProvider.html5Mode(true);
	});
	  
	  
	  // Cool
})(window.angular);