let app = angular.module('app', []);

app.controller('ctrl', ($scope, $http) => {
     
    $http.get('./data2.php') // Đọc file data2.php hoặc file data.json ở đây
        .then(
            result => $scope.info = result.data,

            err => alert('Failed to load data from php file')

        )

    $scope.money = 0;
    $scope.sort_col = 'name';

    $scope.calTotal = (node) => {$scope.money = 0;

        for (const i of $scope.info) {
            if(i.check) {
                if(i.total < 1) {
                    i.total = 1
                }
                $scope.money += i.total*i.price
            }
        }

    }

    $scope.sort = (attr) => {
        
        if($scope.sort_col.startsWith('-')) {
            $scope.sort_col = attr
        } else {
            $scope.sort_col = '-' + attr;
        }

    }

    $scope.set_log = (log) => {
        
        switch (log) {
            case 0:
                $scope.index = 0;
                break;
            case 1:
                $scope.index = Math.floor($scope.info.length/4)*4;
                break;
            case 2:
                if($scope.index >= 4)
                    $scope.index -= 4;
                break;
            case 3:
                if($scope.index <= Math.floor($scope.info.length/4)*4 - 1)
                    $scope.index += 4;
                break;
        }

    }
});


function set_log (node) {

    let list = document.getElementsByClassName("set_log")
    for (const i of list) {
        i.setAttribute('class', "set_log btn border");
    }

    node.setAttribute('class', "set_log btn border bg-primary");
}
 function calTotal (node) {
    if(node.value <= 0) {
        node.value = 0;
    }

 }
 function demo (node) {
    console.log(node);

 }
