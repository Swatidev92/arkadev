<?php include("../lib/opin.inc.php");?>
<?php include("inc/header.inc.php");?>
<!-- Page Content -->

		<div class="row bg-title">
			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
				<h4 class="page-title">Dashboard</h4>
			</div>
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">	 
			</div>
		</div>		
		
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
	<?php if(($_SESSION["ses_adm_role"]!=1 && $_SESSION["ses_adm_role"]==3 && $_SESSION["ses_adm_usr"]!='') || $_SESSION["ses_adm_role"]==1){ ?> 
		<?php if($_SESSION["ses_adm_role"]!=1){ 
			$admQry = " AND assigned_to=".$_SESSION["ses_adm_id"]."";
		}else{
			$admQry = "";
		}?>
		<div class="row">
			<div class="col-md-12 col-lg-12 col-sm-12">
				<div class="white-box">
					<h4 class="mbot15">Lead Summary</h4>
					<div class="row">
						<?php $leadsStatusArr = getAllStatus();
						foreach($leadsStatusArr as $status_key=>$status_val){ ?>						
						<div class="col-md-2 col-xs-6">
							<div class="box-border">
								<h3 class="bold no-mtop">
								<?php if($status_key==9){ //dimensioning requested
									echo $cms->getSingleResult("SELECT count(id) FROM #_leads where lead_id=0 AND is_deleted=0 AND status=$status_key AND dimensioning_user=".$_SESSION["ses_adm_id"]." ");
								}
								else if($status_key==8){ //dimensioning completed
									echo $cms->getSingleResult("SELECT count(id) FROM #_leads where lead_id=0 AND is_deleted=0 AND status=$status_key AND dimensioning_user=".$_SESSION["ses_adm_id"]." ");
								}else{
									echo $cms->getSingleResult("SELECT count(id) FROM #_leads where lead_id=0 AND is_deleted=0 AND status=$status_key $admQry ");
								}?></h3>
								<p style="color:#989898" class="font-medium no-mbot"><a style="color:#989898" class="text-white" href="<?=SITE_PATH_ADM?>lead-manager/?search_status=<?=$status_key?>"><?=$status_val?></a></p>
								<!--<p class="font-medium-xs no-mbot text-muted">Lead</p>-->
							</div>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
		<?php if($_SESSION["ses_adm_role"]!=1){ 
			$admVQry = " AND activity_for=".$_SESSION["ses_adm_id"]."";
		}else{
			$admVQry = "";
		}?>
		<div class="row">
			<div class="col-md-6 col-lg-6 col-sm-12">
				<div class="white-box">
					<?php $leadActivityQry = $cms->db_query("SELECT activity_message, action_by, lead_id, activity_for, due_date, dimensioning_priority FROM #_lead_tracker where due_date='".date('Y-m-d')."' $admVQry ORDER BY dimensioning_priority LIMIT 4");
					if($leadActivityQry->num_rows>0){ ?>
					<h3 class="label label-rounded label-info pull-right"><a class="text-white" href="<?=SITE_PATH_ADM?>activities/?start_date=<?=date('Y-m-d')?>">View All</a></h3>
					<?php } ?>
					<h4 class="mbot15">Today's Activity (<?=date('d-m-Y')?>)</h4>
					<div class="comment-center" style="margin:0px;">						
						<?php if($leadActivityQry->num_rows>0){
						while($leadActivityRes = $leadActivityQry->fetch_array()){ ?>
						<div class="comment-body" style="display:block">
							<div class="user-img">
								<span class="fa-stack fa-2x">
									<i class="fa fa-circle fa-stack-2x"></i>
									<i class="fa fa-bell fa-stack-1x fa-inverse"></i>
								</span></div>
							<div class="mail-contnet">
								<h5 class="label label-rounded label-success pull-right"><?=$leadActivityRes['due_date']?></h5>
								<h5>For - <?=$cms->getSingleResult("SELECT customer_name FROM #_users where id=".$leadActivityRes['activity_for']." ")?></h5>
								<h6><b>Priority - <?=($leadActivityRes['dimensioning_priority']<9999 && $leadActivityRes['dimensioning_priority']!='')?$leadActivityRes['dimensioning_priority']:'NA'?></b></h6>
								<span class="mail-desc"><?=$leadActivityRes["activity_message"]?></span>
								<h5 class="">By - <?=$cms->getSingleResult("SELECT customer_name FROM #_users where id=".$leadActivityRes['action_by']." ")?></h5>
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
	<?php }else{ ?>
	<div class="row">
		<div class="col-md-12 col-lg-12 col-sm-12">
			<div class="text-center">
				<div class="row">
					<div class="col-lg-12 col-sm-12">
						<h1>Welcome to <b>Arka</b> Dashboard</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php } ?>
		<!-- /.container-fluid -->
		
<?php //include("inc/footer.inc.php");?>
<?php include("inc/footer.php");?>