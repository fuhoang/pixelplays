app.controller('VideoController', function(dataFactory, $scope, $http){
    $scope.data = [];
    $scope.video = {}
    $scope.libraryTemp = {};
    $scope.totalItemsTemp = {};
    $scope.totalItems = 0;

    $scope.pageChanged = function(newPage) {
        getResultsPage(newPage);
    };

    getResultsPage(1);

    dataFactory.httpRequest('category').then(function(data) {
        $scope.typeOptions = data;
        $scope.cat_id = $scope.typeOptions[0];
        console.log($scope.cat_id);
    });

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

    $scope.saveAdd = function(){

        $scope.video.category_id = $scope.cat_id.id;
        dataFactory.httpRequest('videos','POST',{},$scope.video).then(function(data) {
            console.log(data);
            $scope.data.push(data);
            $(".modal").modal("hide");
        });
    }

    $scope.edit = function(id){
        dataFactory.httpRequest('videos/'+id+'/edit').then(function(data) {
            console.log(data);
            console.log(data.category);
            $scope.cat_id = data.category;
            $scope.editForm = data;
        });
    }

    $scope.saveEdit = function(){

        delete $scope.editForm.category;
        $scope.editForm.category_id = $scope.cat_id.id;
        dataFactory.httpRequest('videos/'+$scope.editForm.id,'PUT',{},$scope.editForm).then(function(data) {
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
