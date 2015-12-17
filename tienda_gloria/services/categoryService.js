 angular.module('storeAngular', 
		[
		'store-products', 
		'nav-menus'
		]
	).

 factory('Category', ['$http', function CategoryFactory($http){
 	return {
		all: function(){
 			return $http.get('/categories-list.json');	
		}	
 	}
 }]);