app.controller('characteresController', function characteresController($scope, $filter, $http, API_URL) {


    var characteres = $scope.characteres = [];
    var charactere = $scope.charactere = null;
    $scope.sexeOption = null;
    $scope.saison = [];
    $scope.myDate = new Date();

    $scope.minDate = new Date(
        $scope.myDate.getFullYear(),
        $scope.myDate.getMonth() - 2,
        $scope.myDate.getDate());

    $scope.maxDate = new Date(
        $scope.myDate.getFullYear(),
        $scope.myDate.getMonth() + 2,
        $scope.myDate.getDate());

    $scope.age = function age(input){
        return moment().diff(moment(input, 'YYYY-MM-DD'), 'years');
    };



    //retrieve characteres listing from API

    $http.get(API_URL + "characteres")
        .then(function(response) {
            $scope.characteres = response.data;
        });
    //show modal form
    /*console.log($scope.characteres);*/

    $('.modal').modal();

    $scope.toggle = function (modalstate, id) {
        $scope.modalstate = modalstate;

        switch (modalstate) {
            case 'add':
                $scope.form_title = "Add New Employee";
                $scope.charactere = null;
                break;
            case 'edit':
                $scope.form_title = "Charactere Detail";
                $scope.id = id;
                $http.get(API_URL + 'characteres/' + id)
                    .then(function (response) {
                        console.log(response.data);
                        $scope.charactere = response.data;
                    });
                break;
            default:
                break;
        }
        console.log($('#myModal'));
        $('#myModal').modal('open');
    };


    angular.forEach($scope.checkSaison, function(value, key){
        if(value){
            key=parseInt(key.replace(/saison/g,""));
            $scope.saison.push(key);
        }
        if($scope.saison.length===0){
            $scope.saison = [null];
        }
    });


    //save new record / update existing record
    $scope.save = function (modalstate, id) {
        var url = API_URL + "characteres";

        //append employee id to the URL if the form is in edit mode
        if (modalstate === 'edit') {
            url += "/" + id;
        }

        $http({
            method: 'POST',
            url: url,
            data: $.param($scope.charactere),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function successCallback(response) {
            console.log(response);
            location.reload();
        }, function errorCallback(response) {
            console.log(response);
            alert('This is embarassing. An error has occured. Please check the log for details');
        });
        $('#myModal').modal('close');
    };

    //delete record
    $scope.confirmDelete = function (id) {
        var isConfirmDelete = confirm('Are you sure you want this record?');
        if (isConfirmDelete) {
            $http({
                method: 'DELETE',
                url: API_URL + 'characteres/' + id
            }).then(function successCallback(data) {
                console.log(data);
                location.reload();
            }, function errorCallback(data) {
                console.log(data);
                alert('Unable to delete');
            });
        } else {
            return false;
        }
    };
});