

<!-- Online -->
<div class="" id="online">
    <div class="dropup">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="triggerOnline" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
            On <span id="total_online">...</span>
        </button>
        <div class="dropdown-menu bg-secondary pt-3" aria-labelledby="triggerOnline" id="content_online">
            <h6 class="dropdown-header">... đang tải lên</h6>
            
        </div>
    </div>
</div>

<!-- Notification assignment -->
<div id="nof_load_assign" class="text-right"></div>

<form method="post" class="p-2 rounded" id="countdown_assigns">
        <!-- Nộp bài -->
        <!-- Button trigger modal -->

</form>
        
        <!-- Modal -->
        <div class="modal fade" id="turn_in" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                        <div class="modal-header">
                                <h5 class="modal-title">Xác nhận nộp bài</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                            </div>
                    
                    <div class="modal-footer">
                        <form action="" method="post" class="">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Xem lại</button>
                       
                            <button type="submit" name="turn_in" value="<?php echo c_assign()['aid']; ?>" class="btn btn-primary">Xác nhận nộp</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>



