	// Custom directives.
	// Inyected by storeAngular module
	angular.module('storeCategories', [])


	.directive('categoriesHomeMenu',function(){
		return {
			restrict: 'E', // Type of Directive (in this case HTML)
			templateUrl: 'partials/categories-home-menu.html' // Template URL
		};
	});