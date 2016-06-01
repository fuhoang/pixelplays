app.config(['$stateProvider', function($stateProvider, $authProvider){

    //$authProvider.loginUrl = '/api/authenticate';

    //$urlRouterProvider.otherwise('/login');

    $stateProvider
        .state('/',
        {
            url: '/',
            templateUrl: 'templates/videos.html',
            controller: 'VideoController',
            controlerAs: 'VideoCtrl'

        })
        .state('login',
        {
            url: '/login',
            templateUrl: 'templates/login.html',
            controller: 'AuthController',
            controlerAs: 'AuthCtrl'
        })
        .state('categories',
        {
            url: '/categories',
            templateUrl: 'templates/category.html',
            controller: 'CategoryController',
            controllerAs: 'categoriesCtrl'
        });
}]);
