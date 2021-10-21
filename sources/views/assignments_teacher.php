<div class="col-lg-11 col-md-11 col-sm-12 col-xs-12 m-0">
	<div class="row">

		<?php if($exists_assign): ?>

		<!--  -->
		<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 mr-0">
			<!-- List group -->
			<div class="list-group" id="myList" role="tablist">
				<?php foreach ($group->get_ref_table_fkey_where('assignments', 'cid', 'tid', user()['uid']) as $key => $value): ?>
					<a class="<?php if(c_assign()['aname']==$value['aname']) echo 'active'; ?> list-group-item list-group-item-action" 
									 href="?assignments=<?php echo $value['aname']; ?>">
						<h6>
							<?php echo cut($value['aname'], 16); ?>
						</h6>
					</a>
				<?php endforeach; ?>
			</div>
			
		</div>





	<!--  -->
		<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 mr-0">
			<div class="row">
				<?php 
					$day_create = getdate(date_timestamp_get(new DateTime(c_assign()['create_at'])));
						
					require Path_pro . '/sources/views/childviews/assignments_teacher_mode' . c_assign()['mode'] . '.php';
				?>

			</div>
		</div>
	<?php else: ?>
		
		<div class="p-3">
			<h3>Quay lại lớp học để tạo nhiệm vụ</h3>
		</div>

	<?php endif; ?>
        <!--  -->
    </div>
</div>