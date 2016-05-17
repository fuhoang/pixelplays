app.controller('CategoryController', function(dataFactory, $scope, $http){
    $scope.data = [];
    $scope.libraryTemp = {};
    $scope.totalItemsTemp = {};
    $scope.totalItems = 0;

    dataFactory.httpRequest('/category').then(function(data) {
        $scope.data = data;
    });


    /*
    $scope.pageChanged = function(newPage) {
        getResultsPage(newPage);
    };*/

    //getResultsPage(1);


    /*
    function getResultsPage(pageNumber) {

        if(! $.isEmptyObject($scope.libraryTemp)){

            dataFactory.httpRequest('/videos?search='+$scope.searchText+'&page='+pageNumber).then(function(data) {
                $scope.data = data.data;
                $scope.totalItems = data.total;
            });

        }else{

            dataFactory.httpRequest('/videos?page='+pageNumber).then(function(data) {
                $scope.data = data.data;
                $scope.totalItems = data.total;
            });
        }
    }
    */

    $scope.saveAdd = function(){
        dataFactory.httpRequest('category','POST',{},$scope.form).then(function(data) {
            $scope.data.push(data);
            $(".modal").modal("hide");
        });
    }

    $scope.edit = function(id){
        dataFactory.httpRequest('category/'+id+'/edit').then(function(data) {
            $scope.form = data;
        });
    }

    $scope.saveEdit = function(){
        dataFactory.httpRequest('category/'+$scope.form.id,'PUT',{},$scope.form).then(function(data) {
            angular.forEach($scope.data, function(category, key) {
                if(category.id == data.id){
                    $scope.data[key] = data;
                }
            });
            $(".modal").modal("hide");
        });
    }

    $scope.remove = function(item,index){
        var result = confirm("Are you sure delete this item?");
        if (result) {
            dataFactory.httpRequest('category/'+item.id,'DELETE').then(function(data) {
                $scope.data.splice(index,1);
            });
        }
    }
});
