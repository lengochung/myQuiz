<?php if($exists_assigns): ?>


	<div class="col-lg-11 col-md-11 col-sm-12 col-xs-12 m-0">
		<div class="row">

			<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 mr-0">
				<!--  List group -->
				<div class="list-group" id="myList" role="tablist">
					<?php foreach ($users_assigns->get_ref_table_fkey_where('assignments', 'aid', 'uid', user()['uid']) as $key => $value): ?>
						<a class="<?php if(c_assign()['aname']==$value['aname']) echo 'active'; ?> list-group-item list-group-item-action" 
										href="?assignments=<?php echo $value['aname']; ?>">
							<h6>
								<?php echo cut($value['aname'], 16); ?>
							</h6>
						</a>
					<?php endforeach; ?>
				</div>
				
			</div>






			<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 mr-0">
				<div class="m-0 p-0" id="message_turnin">
					<?php if(recieved_message()) echo message(); ?>
				</div>
				<div class="row">
					<?php 
						$day_create = getdate(date_timestamp_get(new DateTime(c_assign()['create_at'])));
									
						require Path_pro . '/sources/views/childviews/assignments_student_mode' . c_assign()['mode'] . '.php';
					?>

					<!--  -->
					<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 mr-0 border-left border-top">
						<div class="border-bottom pb-2 mb-2 pt-2">Danh sách SV của bài thi</div>
						<?php $listStudent = $users_assigns->get_ref_table_fkey_where_asc('users', 'uid', 'aid', c_assign()['aid'], 'name'); ?>
						<?php foreach($listStudent as $key => $value): ?>
							<small class="text-secondary"><b><?php echo $value['name']; ?></b></small>
							<small class="float-right mt-2 rounded-circle bg-<?php if($value['login']) {echo 'success';} else {echo 'danger';} ?>" style="width: 7px; height: 7px;"></small> <br>
						<?php endforeach; ?>
					</div>
					
				</div>
			</div>
			<script>
				setTimeout( () => {
					document.getElementById('message_turnin').innerHTML = '';
				}, 5000);
			</script>






			<!--  -->
		</div>
	</div>

<?php else: ?>

	<div class="p-4">Vui lòng chờ nhiệm vụ</div>

<?php endif; ?>