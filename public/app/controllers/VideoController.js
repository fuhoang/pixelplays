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

    dataFactory.httpRequest('api/v1/category').then(function(data) {
        $scope.typeOptions = data;
        $scope.cat_id = $scope.typeOptions[0];
        console.log($scope.cat_id);
    });

    function getResultsPage(pageNumber) {

        if(! $.isEmptyObject($scope.libraryTemp)){

            dataFactory.httpRequest('api/v1/videos?search='+$scope.searchText+'&page='+pageNumber).then(function(data) {
                $scope.data = data.videos;
                $scope.totalItems = data.total;
            });

        }else{

            dataFactory.httpRequest('api/v1/videos?page='+pageNumber).then(function(data) {
                $scope.data = data.videos;
                $scope.totalItems = data.total;
            });
        }
    }

    $scope.saveAdd = function(valid){

        if(valid){
            $scope.video.category_id = $scope.cat_id.id;
            dataFactory.httpRequest('api/v1/videos','POST',{},$scope.video).then(function(data) {
                console.log(data.videos);
                $scope.data.push(data.videos);
                $(".modal").modal("hide");
            });
        }else{
            console.log("Invalid Form");
        }
    }

    $scope.edit = function(id){

        dataFactory.httpRequest('api/v1/videos/'+id+'/edit').then(function(data) {
            $scope.cat_id = data.video.category;
            $scope.editForm = data.video;
        });
    }

    $scope.saveEdit = function(valid){

        if(valid){
            delete $scope.editForm.category
            delete $scope.editForm.user;
            $scope.editForm.category_id = $scope.cat_id.id;

            dataFactory.httpRequest('api/v1/videos/'+$scope.editForm.id,'PUT',{},$scope.editForm).then(function(data) {
                angular.forEach($scope.data, function(video, key) {
                    if(video.id == data.video.id){
                        $scope.data[key] = data.video;
                    }
                });
                $(".modal").modal("hide");
            });
        }else{
            console.log("Invalid Form")
        }
    }

    $scope.remove = function(item,index){
        console.log(item);
        console.log(index);
        var result = confirm("Are you sure delete this item?");
        if (result) {
            dataFactory.httpRequest('api/v1/videos/'+item.id,'DELETE').then(function(data) {
                $scope.data.splice(index,1);
            });
        }
    }
});
