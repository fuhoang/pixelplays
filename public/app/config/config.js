app.config(['$routeProvider', function($routeProvider, $authProvider){

    //$authProvider.loginUrl = '/api/authenticate';

    //$urlRouterProvider.otherwise('/login');

    $routeProvider
        .when('/',
        {
            templateUrl: 'templates/videos.html',
            controller: 'VideoController'

        })
        .when('/login', 
        {
            templateUrl: 'templates/login.html',
            controller: 'AuthController'
        })
        .when('/categories', 
        {
            templateUrl: 'templates/category.html',
            controller: 'CategoryController'
        })
        .otherwise(
        {
            template: "<h2><strong>THERE IS NO PAGE HERE!</strong></h2>"
        });
}]);
