	// Custom menu directives.	
	// Inyected by storeAngular module
	angular.module('navMenus', [ ]).

	directive('navMenu',function(){
		return {
			restrict: 'E', // Type of Directive (in this case HTML)
			templateUrl: 'partials/nav-menu.html' // Template URL
		};
	});