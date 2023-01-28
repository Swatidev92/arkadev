<?php include("../lib/opin.inc.php");?>
<?php include_once "inc/header.inc.php"; ?>
		<div class="row bg-title">
			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
				<h4 class="page-title">Dashboard</h4>
			</div>
		</div>
		<!-- /.row -->

<style>
.box-border {
    background-clip: initial;
    border-radius: 5px;
    margin-bottom: 1.3rem;
    border: 1px dashed #626f807d;
    padding: 14px;
    text-align: center;
	height:150px;
}
</style>
		
		<div class="row">
			<div class="col-md-12 col-lg-12 col-sm-12">
				<div class="white-box">
					<h4 class="mbot15">Lead Summary</h4>
					<div class="row">
						<?php $leadsStatusArr = getAllStatus();
						foreach($leadsStatusArr as $status_key=>$status_val){?>						
						<div class="col-md-2 col-xs-6">
							<div class="box-border">
								<h3 class="bold no-mtop"><?=$cms->getSingleResult("SELECT count(id) FROM #_leads where status=$status_key ")?></h3>
								<p style="color:#989898" class="font-medium no-mbot"><?=$status_val?></p>
								<!--<p class="font-medium-xs no-mbot text-muted">Lead</p>-->
							</div>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	  
				<div class="row">
					<div class="col-md-6 col-lg-6 col-sm-12">
						<div class="white-box">
							<h4 class="mbot15">Today's action</h4>
							<div class="comment-center" style="margin:0px;">
								<?php 								
								$leadCommentQr = $cms->db_query("SELECT `id`, `lead_comment`, `lead_id`, `post_by`, `post_date`, `lead_status`, `attched_file`, `action_from_date_time`, `action_to_date_time`, `visit_call`, `next_call_date` FROM #_lead_comments WHERE lead_status='1' AND DATE(next_call_date)='".date('Y-m-d')."' ORDER BY id DESC");
								if($leadCommentQr->num_rows>0){
								while($leadCommentRes = $leadCommentQr->fetch_array()){ ?>
								<div class="comment-body" style="display:block">
									<div class="user-img"> <img src="<?=SITE_PATH_ADM?>images/blankuser.png" alt="user" class="img-circle"></div>
									<div class="mail-contnet">
										<h5><?=$cms->getSingleResult("SELECT customer_name FROM #_leads where id=".$leadCommentRes['lead_id']." ")?></h5>
										<span class="mail-desc"><?=$leadCommentRes["lead_comment"]?></span>
										<span class="label label-rounded label-success"><?=$leadCommentRes["next_call_date"]?></span>
									</div>
								</div>
								<?php } }else{
									echo 'No action for today';
								}?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
<!-- /.container-fluid -->
<?php include("inc/footer.inc.php");?>
<?php include("inc/footer.php");?>