( function () {
    //"use strict";
	angular.module('storeAngular', 
		[
		'store-products', 
		'nav-menus'
		]
	).

	controller('StoreController', ['$scope','Product','Category', 
		function($scope, Product, Category) {

		// Isolate scope.
		$scope.products = {};
		$scope.categories = {};

		// Call factory method from Products.
		Products.all().success(function(data){
			
			$scope.products = data;
			console.log('Products '+$scope.products);
		
		}); 
		// Call factory method from Category.
		Category.all().success(function(data){
			$scope.categories = data;
			console.log('Categories '+$scope.categories);
		
		}); 

	}]);

})();