( function () {
    //"use strict";
	angular.module('storeAngular', 
		['storeProducts',
		'storeCategories', 
		'navMenus',
		'storeCategoryService',
		'storeProductService'
		]
	).

	controller('StoreController', ['$scope','Product','Category', 
		function($scope, Product, Category) {

		// Isolate scope.
		$scope.products = {};
		$scope.categories = {};

		// Call factory method from Products.
		Product.all().success(function(data){		
			$scope.products = data;	
		}); 
		// Call factory method from Category.
		Category.all().success(function(data){
			$scope.categories = data;
			console.log('Categories '+$scope.categories);
		
		}); 

	}]);

})();