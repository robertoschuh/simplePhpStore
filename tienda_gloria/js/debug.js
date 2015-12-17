
var rootEle = document.querySelector("body");
var ele = angular.element(rootEle);

// We can fetch the $scope from the element (or its parent) by using the 
// scope() method on the element:
var scope = ele.scope();
console.log('current scope ' +scope);
// inspect current controller

 var ctrl = ele.controller();

 //OR var ctrl = ele.controller('ngModel');
 console.log('current controller ' +ctrl);

// inspect injectoy 
var injector = ele.injector();
console.log('current injector ' +injector);

//We can fetch the data associated with an element’s 
//$scope simply by using the inheritedData() method on the element:
var inherited_data = ele.inheritedData();
console.log('current inheritedData ' +inherited_data);