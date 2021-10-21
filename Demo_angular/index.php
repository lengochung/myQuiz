<?php 
    $config = require '../config.php';
    define("URL", $config['url']); 
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="<?php echo URL; ?>Demo_angular/angular.js"></script>
    <script src="<?php echo URL; ?>Demo_angular/app.js"></script>
    <!-- Bootstrap CSS -->
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body ng-app='app' ng-controller='ctrl'>
      <form action="view.php" method="post">
          <button type="submit" class="btn btn-primary">Submit</button>
      </form>
      <nav class="navbar navbar-expand-sm navbar-dark bg-primary">
          <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
              aria-expanded="false" aria-label="Toggle navigation"></button>
          <div class="collapse navbar-collapse" id="collapsibleNavId">
              <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                  <li class="nav-item">
                      <a class="nav-link" href="./b1.html">Bài 1 <span class="sr-only">(current)</span></a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="../Lab07/data.php">Bài 2</a>
                  </li>
              </ul>
          </div>
      </nav>
      <!--  -->
      <div class="col-12">
        Page: 
        <a href="" onclick="set_log(this)" class="set_log btn border" ng-click="set_log( 0)"><<</a>  
        <a href="" onclick="set_log(this)" class="set_log btn border" ng-click="set_log( 2)"><</a>  
        <a href="" onclick="set_log(this)" class="set_log btn border" ng-click="set_log( 3)">></a> 
        <a href="" onclick="set_log(this)" class="set_log btn border" ng-click="set_log( 1)">>></a>
        <legend class="bg-secondary p-2">BÁN HÀNG GIẢI KHÁT</legend>
        <div>
            <table style="width: 100%;" id="">
                <thead>
                <tr class="border-bottom">
                    <td><b>CHỌN</b></td>
                    <td ng-click="sort('name')"><b><a href="">
                        TÊN HÀNG <input type="number" style="width: 18px; border: none;">
                    </a></b></td>
                    <td><b>SỐ LƯỢNG</b></td>
                    <td ng-click="sort('price')" class="text-right"><b><a href="">
                        ĐƠN GIÁ <input type="number" style="width: 18px; border: none;">
                    </a></b></td>
                    <td class="text-right"><b>THÀNH TIỀN</b></td>
                </tr>
                </thead>
               <tbody>
               <tr class="border-bottom" ng-repeat="item in info | orderBy: sort_col | limitTo: 4 : index">
                    <td>
                        <input type="checkbox" ng-change='calTotal(this)' ng-model='item.check'>
                    </td>
                    <td>   {{ item.name }}  </td>
                    <td>
                        <input type="number" class="text-right" ng-change='calTotal(this)'
                            ng-disabled='!item.check' value="item.total" ng-model='item.total'>
                    </td>
                    <td class="text-right">{{ item.price | number  }} đ </td>
                    <td class="text-right">{{ item.price*item.total | number }} đ </td>
                </tr>
               </tbody>
            </table>
        </div>
        <legend class="bg-secondary p-2">Tổng tiền: <b>{{ money | number }} đ</b></legend>
    </div>
    <div id="demo"></div>
   
    <script>
          window.addEventListener('DOMContentLoaded', event => {
               
              const table = document.getElementById('table');
              if (table) {
                  new simpleDatatables.DataTable(table);
              }
          });
          console.log(document.getElementById("demo"));
    
    </script>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
