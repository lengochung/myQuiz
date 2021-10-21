<?php if($isvalgroup): ?>
	<div id="message" style="position: fixed; bottom: 0; right: 5px;">
		<?php if(recieved_message()) echo message(); ?>
	</div>
	<div class="col-lg-11 col-md-11 col-sm-10 col-xs-12 m-0">
	<div class="row">

		<!--  -->
		<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 mr-0">
			<!-- List group -->
			<div class="list-group" id="myList" role="tablist">
				<!-- Button trigger modal -->
				<a href="" type="button" class="list-group-item list-group-item-action" data-toggle="modal" data-target="#createclassmodal">
				  	+ Tạo lớp học
				</a>
				
				<!-- Modal -->
				<div class="modal fade" id="createclassmodal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
								<div class="modal-header">
										<h5 class="modal-title">Tạo lớp học</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
									</div>
							<div class="modal-body">
								<div class="container-fluid">
									<form action="" method="post">
										<fieldset>
											<div class="form-group">
											<label for="">Tên lớp</label>
											<input type="text" name="createclass" class="form-control" required
												aria-describedby="helpId" value="<?php echo request_post('createclass'); ?>">
											
											</div>
										</fieldset>
										<button type="submit" name="createclasssubmit" class="btn btn-outline-success">Tiến hành</button>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php foreach ($class->get_column_value_fetchAll('tid', user()['uid']) as $key => $value): ?>
					<a class="<?php if(current_group()['cname']==$value['cname']) echo 'active'; ?> list-group-item list-group-item-action" 
									 href="?group=<?php echo $value['cname']; ?>">
						<h6>
							<?php echo cut($value['cname'], 16); ?>
						</h6>
					</a>
				<?php endforeach; ?>
			</div>
			
		</div>






		<!--  -->
		<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 border">
			<div class="border-bottom pb-2">
				<div class="float-left text-right pt-2">
					<h5 class="pt-2"><?php echo current_group()['cname']; ?></h5>
				</div>
				<div class="text-right text-secondary">
					<?php $day_create = getdate(date_timestamp_get(new DateTime(current_group()['day_create']))); ?>
					<small>
						<i>
						Được tạo lúc <?php if($day_create['hours']<10) {echo '0'.$day_create['hours'];} else {echo $day_create['hours'];} ?>:<?php if($day_create['minutes']<10) {echo '0'.$day_create['minutes'];} else {echo $day_create['minutes'];} ?>
						ngày <?php if($day_create['mday']<10) {echo '0'.$day_create['mday'];} else {echo $day_create['mday'];} ?>/<?php if($day_create['mon']<10) {echo '0'.$day_create['mon'];} else {echo $day_create['mon'];} ?>
						</i>
					</small> <br>
					<small><i>Sĩ số: <?php echo current_group()['total']; ?></i></small>
				</div>
				
			</div>





			<!--  -->
			<div class="pb-3">
				<ul class="nav nav-tabs nav-justified">
					<li class="nav-item">
						<a href="#manage_group" class="nav-link active" data-toggle="tab">Quản lý lớp học</a>
					</li>
					<li class="nav-item">
						<a href="#assign" class="nav-link" data-toggle="tab">Bài thi/Trắc nghiệm</a>
					</li>
					<li class="nav-item disabled">
						<a href="#notification" class="nav-link" data-toggle="tab">Thông báo</a>
					</li>
				</ul>
				<!--  -->
				<div class="tab-content pt-3 pb-3 pr-3">
				<div id="notification" class="tab-pane fade">
					<div id="notifications" class="pl-3" style="overflow-y: scroll; height: 350px;"></div>
					<div class="ml-3">
						<div class="pb-2"><b>Nhắn tin thông báo</b></div>
						<div class="row">
							<div class="col-lg-7 col-md-8 col-sm-12 col-xs-12 mr-0 pb-2">
								<input type="text" name="notifications"  id="content_nof" class="form-control" required>
							</div>
							<div class="col-lg-4 col-md-3 col-sm-12 col-xs-12 pb-2">
								<button type="button" id="btn_nof" class="btn btn-success">Gửi</button>
							</div>
						</div>
					</div>
					<?php require Path_pro . '/sources/views/call_requests_server/notifications.php'; ?>
				</div>
				<!--  -->
				
				<!--  -->
				<div id="manage_group" class="tab-pane  active">
					<div class="row">
						<div class="col-lg-9 col-md-9 col-sm-8 col-xs-12 border-right">
							<div id="applyaddmessage">
								<?php if(recieved_message()) echo message(); ?>
							</div>
							<div>
								<small><b>Thêm sinh viên</b></small>
								<div class="dropdown form-inline my-2 my-lg-0 mr-auto mb-2">
									<!--  -->
									<input list="showforadd" id="searchforadd" class=" mr-sm-2 form-control col-6">

									<datalist id="showforadd">
										<option value=""></option>
									</datalist>
									
									<button onclick="applyadd()" class="btn btn-outline-success my-2 my-sm-0" type="submit">Thêm ngay</button>
									
								</div>
			
							</div>
							<?php require Path_pro . '/sources/views/call_requests_server/searchforadd.php'; ?>
							<!--  -->
							<div class="pt-3">
								<div class="border-top  pt-2 pb-3" id="inforstudent" >
									<?php $student = $users->get_ref_table_fkey_where_fetch('class_detail', 'uid', 'name', $namestudent); ?>
									<?php if($student): ?>
									<table class="mb-5" style="width: 100%;">
										<tr>
											<td><small><b>Thông tin sinh viên</b></small></td>
											<td colspan="3" style="text-align: right;" ><!-- Button trigger modal -->
												<a href="" class="btn-outline-danger btn" data-toggle="modal" data-target="#deletestudent">
													Xóa khỏi lớp
												</a>
											</td>
										</tr>
										<tr><td>Họ tên</td><td class="pr-3 pl-3">:</td><td><?php echo $student['name']; ?></td><td></td></tr>
										<tr><td>Email</td><td class="pl-3">:</td><td><small class="text-secondary"><b><i><?php echo $student['email']; ?></i></b></small></td></tr>
										<tr><td>Được thêm</td><td class="pl-3">:</td><td><?php echo $student['time_in']; ?></td></tr>
										<?php $detail_assigns = $users_assigns->get_detail_assign_student( current_group()['cid'] , $student['uid']); ?>
										<tr><td><small><b>Bài thi/Trắc nghiệm</b></small></td></td></tr>
										<?php foreach( $detail_assigns as $key => $value): ?>
											<tr>
												<td><a class="" href="../assignments/?assignments=<?php echo $value['aname']; ?>"><?php echo $value['aname']; ?></a></td>
												<td class="pl-3 pr-3"><small><i><?php if($value['turn_in']) {echo 'đã nộp';} else {echo 'chưa nộp';} ?></i></small></td>
												<td><?php echo $value['result']; ?> điểm</td>
												<td><?php if($value['mode']){echo "<small class='text-success'>đã diễn ra</small>";} else {echo "<small class='text-secondary'>chưa diễn ra</small>";} ?></td>
											</tr>
										<?php endforeach; ?>
									</table>
									
									<!-- Modal -->
									<div class="modal fade" id="deletestudent" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title">Xác nhận xóa sinh viên ra khỏi lớp</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body"><div class="container-fluid">Dữ liệu của sinh viên trong lớp sẽ bị xóa</div></div>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
													<form action="" method="post">
														<button type="button" onclick="deletestudentfromgroup(<?php echo $student['uid']; ?>)" value="<?php echo $student['uid']; ?>" class="btn btn-danger">Xác nhận</button>
													</form>
												</div>
											</div>
										</div>
									</div>
									<?php require Path_pro . '/sources/views/call_requests_server/deletestudentfromgroup.php'; ?>
									<script>
										$('#exampleModal').on('show.bs.modal', event => {
											var button = $(event.relatedTarget);
											var modal = $(this);
											// Use above variables to manipulate the DOM
											
										});
									</script>
									<?php endif; ?>
									
								</div>
								<small class=""><b>Nhập nhanh danh sách sinh viên</b></small>
								<form action="" method="post" enctype="multipart/form-data">
									<div class="dropdown form-inline my-2 my-lg-0 mr-auto">
										<input class="btn-outline mr-sm-0" type="file" name="file" required>
												</input>
										<button name="importfile" class="btn-outline-success my-2 my-sm-0" type="submit">Nhập</button>
									</div>
								</form>
								<!-- Button trigger modal -->
								<button type="button" class="btn btn-outline-danger mt-3" data-toggle="modal" data-target="#deleteclass">
									Xóa lớp học
								</button>
								
								<!-- Modal -->
								<div class="modal fade" id="deleteclass" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
												<div class="modal-header">
														<h5 class="modal-title">Xác nhận xóa lớp học <?php echo current_group()['cname']; ?></h5>
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																<span aria-hidden="true">&times;</span>
															</button>
													</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Không</button>
												<form class="" method="post">
													<button value="<?php echo current_group()['cid']; ?>" type="submit" name="deleteclass" class="btn btn-danger">
														Xác nhận
													</button>
												</form>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
							<div class="border-bottom"><b>Danh sách sinh viên</b></div>
							<div id="manage_group_list" class="pt-2">
								
							</div>
						</div>
					</div>
					<?php require Path_pro . '/sources/views/call_requests_server/manage_group_list.php'; ?>
				</div>
				<!--  -->
				<div id="assign" class="tab-pane fade">
					<div id="message_create_assign"></div>
					<!-- Button trigger modal -->
					<button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#createassign">
						Tạo nhiệm vụ
					</button>
					
					<!-- Modal -->
					<div class="modal fade" id="createassign" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
									<div class="modal-header">
											<h5 class="modal-title">Tạo nhiệm vụ</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
										</div>
								<div class="modal-body">
									<div class="container-fluid">
										<form action="" name="form">
											<fieldset>
												<div class="form-group">
												  <label for="">Tên nhiệm vụ</label>
												  <input type="text" name="aname" class="form-control" aria-describedby="helpId">
												  <small class="text-danger"><i id="aname_alert"></i></small>
												</div>
												<div class="form-group">
												  <label for="">Ngày làm bài</label>
												  <input type="date" name="date" class="form-control" aria-describedby="helpId">
												  <small class="text-danger"><i id="date_alert"></i></small>
												</div>
												<div class="form-group">
													<label for="">Bắt đầu lúc </label>
														<select name="hours" id="">
															<?php for ($i = 7; $i <= 21; $i++) : ?>
																<option value="<?php echo $i; ?>"><?php if($i<10) {echo '0'.$i;} else{echo $i;} ?></option>
															<?php endfor; ?>
														</select> giờ
														<select name="minutes" id="">
															<?php for ($i= 0; $i <= 3; $i++) : ?>
																<option value="<?php echo $i*15; ?>"><?php echo $i*15; ?></option>
															<?php endfor; ?>
														</select> phút
													
												</div>
												<div class="form-group">
												  <label for="">Thời gian làm bài (phút)</label>
												  		<select name="duration" id="" class="form-control">
															<?php for ($i= 1; $i <= 6; $i++) : ?>
																<option value="<?php echo $i*15; ?>"><?php echo $i*15; ?></option>
															<?php endfor; ?>
														</select>		
												</div>
											</fieldset>
										</form>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Quay lại</button>
									<button onclick="create_assign(document.forms.form)" type="button" class="btn btn-primary">Thêm ngay</button>
								</div>
							</div>
						</div>
					</div>
					<div id="show_assigns" class="pt-3">
						
					</div>
				</div>
				<?php require Path_pro . '/sources/views/call_requests_server/create_show_assign.php'; ?>
				</div>
			</div>

		</div>

		<!-- end row -->
	</div>
</div>

<?php else: ?>
	<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12 m-0">
		<div class="row mb-2">
			
			<div class="col-lg-5 col-md-8 col-sm-12 col-xs-12">
				<div class="border-bottom pb-2 mb-2">
					Chưa có lớp học, vui lòng tạo lớp học
				</div>
				<h5>Tạo nhóm/lớp học</h5>
				<form action="" method="post">
					<fieldset>
						<div class="form-group">
						<label for="">Tên lớp</label>
						<input type="text" name="createclass" class="form-control" required aria-describedby="helpId">
						
						</div>
					</fieldset>
					<button type="submit" name="createclasssubmit" class="btn btn-outline-success">Tiến hành</button>
				</form>
			</div>
		</div>
	</div>

<?php endif; ?>