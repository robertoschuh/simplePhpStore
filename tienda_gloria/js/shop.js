( function () {
    //"use strict";
	var app = angular.module('storeAngular', 
		[
		'store-products', 
		'nav-menus',
		]
	);

	app.controller('StoreController', ['$http', function($http) {
		/*
		this.selectedCategory = '';
		this.setGroup = function(catid) {
			this.selectedCategory = catid;
		}
	*/
		var store = this;
		//this.products = stock;
		this.products = [];
		this.categories = [];

		$http.get('/products-list.json').success(function(data){
			store.products = data;
			console.log(store);
		
		});

		$http.get('/categories-list.json').success(function(data){
			store.categories = data;
			console.log(store);
		
		});

	}]);

})();