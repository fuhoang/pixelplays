app.controller('CategoryController', function(dataFactory, $scope, $http){
    $scope.data = [];
    $scope.libraryTemp = {};
    $scope.totalItemsTemp = {};
    $scope.totalItems = 0;

    dataFactory.httpRequest('/category').then(function(data) {
        $scope.data = data;

        console.log($scope.data);
        //$scope.totalItems = data.total;
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
            console.log(data);
            $scope.data.push(data);
            //console.log($scope.data);
            $(".modal").modal("hide");
        });
    }

    $scope.edit = function(id){
        dataFactory.httpRequest('category/'+id+'/edit').then(function(data) {
            console.log(data);
            $scope.form = data;
        });
    }

    $scope.saveEdit = function(){
        dataFactory.httpRequest('videos/'+$scope.form.id,'PUT',{},$scope.form).then(function(data) {
            angular.forEach($scope.data, function(video, key) {
                console.log(key);
                if(video.id == data.id){
                    $scope.data[key] = data;
                }
            });
            $(".modal").modal("hide");
        });
    }

    $scope.remove = function(item,index){
        console.log(item);
        console.log(index);
        var result = confirm("Are you sure delete this item?");
        if (result) {
            dataFactory.httpRequest('videos/'+item.id,'DELETE').then(function(data) {
                $scope.data.splice(index,1);
            });
        }
    }
});
