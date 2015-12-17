	// Custom menu directives.	
	// Inyected by storeAngular module
	angular.module('nav-menus', [ ]).

	directive('navMenu',function(){
		return {
			restrict: 'E', // Type of Directive (in this case HTML)
			templateUrl: 'partials/nav-menu.html' // Template URL
		};
	}).

    directive('categoriesHomeMenu',function(){
		return {
			restrict: 'E', // Type of Directive (in this case HTML)
			templateUrl: 'partials/categories-home-menu.html' // Template URL
		};
	});