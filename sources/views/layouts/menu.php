
<nav class="navbar navbar-expand-sm navbar-light bg-light">
    <!-- <a class="navbar-brand" href="#">Navr</a> -->
    <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavId">
        
        <form class="form-inline my-2 my-lg-0 mr-auto">
            <input class="form-control mr-sm-2" type="text" placeholder="Tìm kiếm">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Tìm</button>
        </form>


        <div class="btn-group float-right">
            <a class="dropdown-toggle" type="button" id="infor" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <?php echo user()['name']; ?>
                    <img src="<?php echo URL; ?>sources/static/images/<?php echo user()['image']; ?>"
                        class="rounded-circle img-thumbnail" width="40px" height="40px">
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="infor">
                <!-- Button trigger modal -->
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modalImage">
                    <img src="<?php echo URL; ?>sources/static/images/<?php echo user()['image']; ?>"
                            class="rounded-circle img-thumbnail" width="50px" height="50px">
                    Sửa ảnh  
                </a>
                <h6 class="dropdown-header"><?php echo user()['name']; ?></h6>
                <a class="dropdown-item disabled" href="#"><?php echo user()['email']; ?></a>
                <a class="dropdown-item" href="#">Quản lý tài khoản</a>
                <div class="dropdown-divider"></div>
                <!-- Button trigger modal -->
                <a href="#" class="dropdown-item" data-toggle="modal" data-target="#modeLogout">
                    Đăng xuất
                </a>
            </div>
        </div>
                    <!-- Modal Avatar -->
                    <div class="modal fade" id="modalImage" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Thay đổi ảnh đại diện</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <input type="file" name="file" class="">
                                        <img src="<?php echo URL; ?>sources/static/images/<?php echo user()['image']; ?>"
                                            class="rounded-circle img-thumbnail">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" name="edit_image" value="<?php echo user()['uid']; ?>" class="btn btn-primary">Lưu thay đổi</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


        
        <!-- Modal Logout-->
        <div class="modal fade" id="modeLogout" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Bạn chắn chắn muốn đăng xuất</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-dismiss="modal">Không</button>
                        <button type="button" class="btn btn-secondary"><a id="confirm" href="?logout" class="text-light">Chắc chắn</a></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>




