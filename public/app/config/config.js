app.config(['$routeProvider', function($routeProvider){
    $routeProvider
        .when('/',
        {
            templateUrl: 'templates/videos.html',
            controller: 'VideoController'

        })
        .otherwise(
        {
            template: "<h2><strong>THERE IS NO PAGE HERE!</strong></h2>"
        });

}]);
