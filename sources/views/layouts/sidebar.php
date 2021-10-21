

        <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12 m-0 pr-0" >
            <!-- List group -->
            <div class="list-group" role="tablist" id="sidebar">
                <a class="list-group-item list-group-item-action pl-3 <?php if($active==1) echo "active"; ?>"
                    href="../dashboard" role="tab">
                    <span>Bảng tin</span>
                </a>
                <a class="list-group-item list-group-item-action pl-3 <?php if($active==2) echo "active"; ?>" 
                    href="../groups" role="tab">
                    <span>Lớp học</span>
                </a>
                <a class="list-group-item list-group-item-action pl-3 <?php if($active==3) echo "active"; ?>" 
                    href="../assignments" role="tab">
                    <span>Bài tập</span>
                </a>
                <a class="list-group-item list-group-item-action pl-3 <?php if($active==4) echo "active"; ?>" 
                    href="../settings" role="tab">
                    <span>Settings</span>
                </a>
            </div>
        </div>
