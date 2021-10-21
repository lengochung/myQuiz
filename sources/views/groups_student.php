<?php if($num_class > 0): ?>
	
	<div class="col-lg-11 col-md-11 col-sm-10 col-xs-12 m-0">
	<div class="row">


		<!--  -->
		<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 mr-0">
			<!-- List group -->
			<div class="list-group" id="myList" role="tablist">
				
				<?php foreach ($class_detail->get_ref_table_fkey_where('class', 'cid', 'uid', user()['uid']) as $key => $value): ?>
					<a class="<?php if(current_group()['cname']==$value['cname']) echo 'active'; ?> list-group-item list-group-item-action" 
									 href="?group=<?php echo $value['cname']; ?>">
						<h6>
							<?php echo cut($value['cname'], 15); ?>
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
					<small><i>Sĩ số: <?php echo $class_detail->count_column_value('cid', current_group()['cid']); ?></i></small>
				</div>
				
			</div>





			<!--  -->
			<div class="pb-3">
				<ul class="nav nav-tabs nav-justified">
					<li class="nav-item">
						<a href="#group" class="nav-link active" data-toggle="tab">Thông báo/Nhắn tin</a>
					</li>
					<li class="nav-item">
						<a href="#assign_student" class="nav-link" data-toggle="tab">Bài thi/Trắc nghiệm</a>
					</li>
				</ul>
				<!--  -->
			<div class="tab-content pt-3 pr-3">
				<!--  -->
				<div id="group" class="tab-pane active">
					<div class="row">
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 border-right">
                            <div id="notifications" class="pl-3" style="overflow-y: scroll; height: 350px;"></div>
                            <div class="ml-3">
                                <div class="pb-2"><b>Nhắn tin</b></div>
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
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="border-bottom"><b>Bạn trong lớp</b></div>
							<div id="manage_group_list" class="pt-2">
								
							</div>
						</div>
					</div>
					<?php require Path_pro . '/sources/views/call_requests_server/manage_group_list.php'; ?>
				</div>






				<!--  -->
				<div id="assign_student" class="tab-pane fade">
                    <?php $num_assign = $assigns->count_column_value('cid', current_group()['cid']); ?>
                    <?php if($num_assign > 0): ?>
                    
                        <?php $list_assigns = $assigns->get_ref_table_fkey_where('class', 'cid', 'cid', current_group()['cid']); ?>
                        <?php foreach($list_assigns as $key => $value): ?>
                            <div class="border p-2 pb-2 mb-1">
                                <div>
									<a class="float-left btn btn-outline-<?php if($value['mode']==0){echo "success";} else {echo 'secondary';} ?>"
										href="../assignments?assignments=<?php echo $value['aname']; ?>"    ><?php echo $value['aname']; ?>
									</a>    
									
                                    <div class="text-right text-secondary">
                                        <?php $day_create = getdate(date_timestamp_get(new DateTime($value['create_at']))); ?>
                                        <?php $num_ques = $questions->count_column_value('aid', $value['aid']); ?>
                                        <small>
                                            <i>
                                            tạo lúc <?php if($day_create['hours']<10) {echo '0'.$day_create['hours'];} else {echo $day_create['hours'];} ?>:<?php if($day_create['minutes']<10) {echo '0'.$day_create['minutes'];} else {echo $day_create['minutes'];} ?>
                                            ngày <?php if($day_create['mday']<10) {echo '0'.$day_create['mday'];} else {echo $day_create['mday'];} ?>/<?php if($day_create['mon']<10) {echo '0'.$day_create['mon'];} else {echo $day_create['mon'];} ?>
                                            </i>
                                        </small>
                                    </div> <br>
									<div class="mb-3">
										<?php
											switch ($value['mode']) :
												case '0':	
										?>
												<small>
													<b>Trạng thái: </b><i class="text-danger">chưa hoàn thành</i>
													<span class="float-right">
													<?php $start = getdate(date_timestamp_get(new DateTime($value['start']))); ?>
														<i>
														diễn ra lúc <?php if($start['hours']<10) {echo '0'.$start['hours'];} else {echo $start['hours'];} ?>:<?php if($start['minutes']<10) {echo '0'.$start['minutes'];} else {echo $start['minutes'];} ?>
														ngày <?php if($start['mday']<10) {echo '0'.$start['mday'];} else {echo $start['mday'];} ?>/<?php if($start['mon']<10) {echo '0'.$start['mon'];} else {echo $start['mon'];} ?>
														</i>
													</span> <br>
												</small>
												<small class="float-right"><i>thời gian làm bài: <?php echo $value['duration']; ?> phút</i></small>
												<span>Số lượng câu hỏi: <b><?php echo $num_ques; ?></b></span> <br>
												<span><i>Điểm số sẽ được cập nhật sau khi bài thi diễn ra</i></span>
												
										<?php
												break; case '1':
										?>
												<small><b>Trạng thái: </b><i class="text-success">đang diễn ra</i></small>
												<div>Vui lòng nhấn vào nhiệm vụ để làm bài</div>
										<?php
												break; case '2':
										?>
										<?php $result = $users_assigns->get_column_value_fetch('uid', user()['uid']); ?>
										<?php
											$result_ques = $questions->get_ref_table_dl_where('users_questions_assigns', 'qid', 'aid', $value['aid'], 'uid', user()['uid']);
											$numR = $numF = $numN = 0;
											foreach ($result_ques as $key => $rs_q) {
												if($rs_q['choose']==$rs_q['answer']) { $numR++; } 
												if($rs_q['choose']=='none') { $numN++; }
											}
										?>
												<small>
													<b>Trạng thái: </b><i class="text-secondary">đã hoàn thành</i>
													<span class="float-right">
													<?php $end = getdate(date_timestamp_get(new DateTime($value['start'])) + $value['duration']*60); ?>
														<i>
														kết thúc lúc <?php if($end['hours']<10) {echo '0'.$end['hours'];} else {echo $end['hours'];} ?>:<?php if($end['minutes']<10) {echo '0'.$end['minutes'];} else {echo $end['minutes'];} ?>
														ngày <?php if($end['mday']<10) {echo '0'.$end['mday'];} else {echo $end['mday'];} ?>/<?php if($end['mon']<10) {echo '0'.$end['mon'];} else {echo $end['mon'];} ?>
														</i>
													</span> <br>
												</small>
												<small class="float-right"><i>thời gian làm bài: <?php echo $value['duration']; ?> phút</i></small>
												<?php if($result['turn_in']): ?>
													<small class="text-success">Đã nộp</small> <br>
												<?php else: ?>
													<small class="text-danger">Chưa nộp</small> <br>
												<?php endif; ?>
												<span>Số lượng câu hỏi: <b><?php echo $num_ques; ?></b></span> <br>
												
												<span>Điểm : <b><?php echo $result['result']; ?></b> đ</span> <br>
												<small>Đúng: <?php echo $numR; ?> Sai: <?php echo $num_ques - $numR - $numN; ?> Chưa chọn: <?php echo $numN; ?></small>

												<div class="dropdown float-right">
													<button class="btn btn-secondary dropdown-toggle" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
															aria-expanded="false">
																Xem chi tiết bài thi
															</button>
													<div class="dropdown-menu" aria-labelledby="triggerId">
														<?php $i = 1; ?>
														<?php foreach($result_ques as $key => $detail): ?>
															<a class="dropdown-item" href="#">
																<small><b>Câu <?php echo $i++; ?>:</b> <?php echo $detail['content']; ?></small> <br>
																<small class="pl-2 <?php if($detail['answer']=='A') echo 'text-success'; ?>">A. <?php echo $detail['a']; ?></small> 
																<small class="pl-2 <?php if($detail['answer']=='B') echo 'text-success'; ?>">B. <?php echo $detail['b']; ?></small> 
																<small class="pl-2 <?php if($detail['answer']=='C') echo 'text-success'; ?>">C. <?php echo $detail['c']; ?></small> 
																<small class="pl-2 <?php if($detail['answer']=='D') echo 'text-success'; ?>">D. <?php echo $detail['d']; ?></small> <br>
																<small>
																	Đã chọn: <b><?php echo $detail['choose']; ?></b>
																	<?php if($detail['choose']==$detail['answer']) {echo "<i class='text-success'>Đúng</i>";} else { echo "<i class='text-danger'>Sai</i>";} ?>
																</small>
																
															</a>
														<?php endforeach; ?>
													</div>
												</div>
												

										<?php
												break;
											endswitch;
										?>
									</div>
                                </div>
                                
                            </div>
                        <?php endforeach; ?>





						<!--  -->
                    <?php else: ?>
                        <small class="mt-3 ml-3"><b>Lớp chưa có bài tập, vui lòng chờ!</b></small>
                    <?php endif; ?>
				</div>
			</div>

		</div>

		<!-- end row -->
	</div>
</div>


<?php else: ?>
	<h5 class="p-3">Bạn không có tên trong lớp học nào, vui lòng chờ giáo viên thêm bạn vào lớp</h5>
<?php endif; ?>