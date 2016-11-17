	// Custom menu directives.	
	var app = angular.module('nav-menus', [ ]);

	app.directive('navMenu',function(){
		return {
			restrict: 'E', // Type of Directive (in this case HTML)
			templateUrl: 'partials/nav-menu.html' // Template URL
		};
	});

    app.directive('categoriesHomeMenu',function(){
		return {
			restrict: 'E', // Type of Directive (in this case HTML)
			templateUrl: 'partials/categories-home-menu.html' // Template URL
		};
	});