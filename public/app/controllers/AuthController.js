app.controller('AuthController', function($auth, dataFactory, $scope, $http){

    var vm = this;

    vm.loginError = false;
    vm.loginErrorText;

    vm.login = function(){
        var credentials ={
            email: vm.email,
            password: vm.password
        }

        console.login(credentials);
    }
});
