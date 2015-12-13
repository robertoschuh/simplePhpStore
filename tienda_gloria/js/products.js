	// Custom directives.
	
	var app = angular.module('store-products', [ ]);

	app.directive('productThumb',function(){
		return {
			restrict: 'E', // Type of Directive (in this case HTML)
			templateUrl: 'partials/product-thumb.html' // Template URL
		};
	});

	app.directive('productDetail',function(){
		return {
			restrict: 'E', // Type of Directive (in this case HTML)
			templateUrl: 'partials/product-detail.html' // Template URL
		};
	});