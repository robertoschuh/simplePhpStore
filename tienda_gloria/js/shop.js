( function () {
    //"use strict";
	var app = angular.module('storeAngular', 
		[
		'store-products', 
		'nav-menus',
		]
	);

	app.controller('StoreController', ['$http', function($http) {
		// this is StoreController (in html alias store).
		//this.products = stock;
		var store = this;
		this.categories = categories;
		//this.products = stock;
		this.products = [];

		$http.get('/products-list.json').success(function(data){
			store.products = data;
			console.log(store);
		});

	}]);

	var categories = [
			{
				name: 'category1',
				description: 'bla bla bla bla'

			},
			{
				name: 'category2',
				description: 'bla bla bla bla'

			},
			{
				name: 'category3',
				description: 'bla bla bla bla'

			}

	];
	
	
})();