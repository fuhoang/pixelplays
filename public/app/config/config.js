app.config(['$routeProvider', function($routeProvider){
    $routeProvider
        .when('/',
        {
            templateUrl: 'templates/videos.html',
            controller: 'VideoController'

        })
        .when('/categories', {
            templateUrl: 'templates/category.html'
            //controller: 'ShowOrdersController'
          })
        .otherwise(
        {
            template: "<h2><strong>THERE IS NO PAGE HERE!</strong></h2>"
        });

}]);
