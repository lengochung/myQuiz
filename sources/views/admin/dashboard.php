<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12 m-0">
    <div id="message">
      <?php if(recieved_message()) echo message(); ?>
    </div>

    <!--  -->
    <div class="">
        <div>
            <div class="card-columns">
              <div class="card">
                <!-- <img class="card-img-top" src="holder.js/100x180/" alt=""> -->
                <div class="card-body">
                <h6 class="card-title">
                    <a href="?page=teachers" class="text-secondary">Tổng số Giáo viên (<?php echo $num_tea; ?>)</a>
                  </h6>
                  <p class="card-text"><small><a href="?page=teachers">Quản lý</a></small></p>
                </div>
              </div>
              <!--  -->
              <div class="card">
                <!-- <img class="card-img-top" src="holder.js/100x180/" alt=""> -->
                <div class="card-body">
                  <h6 class="card-title">
                    <a href="?page=students" class="text-secondary">Tổng số Sinh viên (<?php echo $num_stu; ?>)</a>
                  </h6>
                  <p class="card-text"><small><a href="?page=students">Quản lý</a></small></p>                </div>
              </div>
              <!--  -->
              <div class="card">
                <!-- <img class="card-img-top" src="holder.js/100x180/" alt=""> -->
                <div class="card-body">
                <h6 class="card-title">
                    <a href="?page=groups" class="text-secondary">Tổng số Lớp học (<?php echo $num_class; ?>)</a>
                  </h6>
                  <p class="card-text"><small><a href="?page=groups">Quản lý</a></small></p>                </div>
              </div>
            </div>
        </div>
    </div>
    <!--  -->
    <div class="border p-3" style="height: 500px;">
      <legend class="border-bottom">Google Chart</legend>
      <div id="chart">
          df;kg
      </div>
    </div>

<!-- Google Chart -->
<script type="text/javascript">
    // Google Chart load
    google.load("visualization", "1.0", {"packages":["corechart"]})
    google.setOnLoadCallback(putData)

    function putData () { // Đẩy dữ liệu qua google chart

      let rows = new Array() // Lấy dữ liệu
      
      <?php $groups = $conn->load("classs")->get_all(); ?>
      <?php foreach ($groups as $key => $group) : ?>
        rows.push(["<?php echo $group['cname']; ?>", <?php echo $group['total']; ?>])
      <?php endforeach; ?>

      let data = new google.visualization.DataTable()
          data.addColumn("string", "Lớp")
          data.addColumn("number", "Sĩ số")
          data.addRows(rows)           

      let chart = document.getElementById("chart")
      
      new google.visualization.LineChart(chart).draw( data, {
        title: "Thống kê sĩ số lớp",
        width: 600, height: 600, backgroundcolor: "#ffffff"
      })
    }
</script>

  