	// Custom directives.
	// Inyected by storeAngular module
	angular.module('store-products', [ ]).

	directive('productThumb',function(){
		//debugger;
		return {
			restrict: 'E', // Type of Directive (in this case HTML)
			templateUrl: 'partials/product-thumb.html' // Template URL
		};
	}).

	directive('productDetail',function(){
		return {
			restrict: 'E', // Type of Directive (in this case HTML)
			templateUrl: 'partials/product-detail.html' // Template URL
		};
	}).

	directive('rightSidebar',function(){
		return {
			restrict: 'E', // Type of Directive (in this case HTML)
			templateUrl: 'partials/right-sidebar.html' // Template URL
		};
	});