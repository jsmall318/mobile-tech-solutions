function SearchController($scope, $http) 
{
	$http.get("http://localhost/mobile-tech-solutions/json/browse.txt").success(function(response) {$scope.products = response;});
	$scope.tab = 1;
}