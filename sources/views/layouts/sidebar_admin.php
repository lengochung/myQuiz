<div class="m-3">
    <div class="row">

        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 m-0 pr-0" id="sidebar">
            <!-- List group -->
            <div class="list-group" role="tablist" >
                <a class="list-group-item list-group-item-action pl-3 <?php if($active==1) echo "active"; ?>"
                    href="?page=dashboard" role="tab">
                    <h6>Bảng tin</h6>
                </a>
                <a class="list-group-item list-group-item-action pl-3 <?php if($active==2) echo "active"; ?>" 
                    href="?page=students" role="tab">
                    <h6>Sinh Viên</h6>
                </a>
                <a class="list-group-item list-group-item-action pl-3 <?php if($active==3) echo "active"; ?>" 
                    href="?page=teachers" role="tab">
                    <h6>Giáo viên</h6>
                </a>
                <a class="list-group-item list-group-item-action pl-3 <?php if($active==4) echo "active"; ?>" 
                    href="?page=groups" role="tab">
                    <h6>Lớp học</h6>
                </a>
            </div>
        </div>