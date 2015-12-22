angular.module('storeProductService', []).

 factory('Product', ['$http', function ProductFactory($http){
 	return {
 		all: function(){
 			return $http({method:'GET', url: '/products-list.json'});	
		}
 	}
 }]);