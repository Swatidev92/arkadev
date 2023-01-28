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
								<h3 class="bold no-mtop"><?=$cms->getSingleResult("SELECT count(id) FROM #_leads where lead_id=0 AND is_deleted=0 AND status=$status_key $admQry ")?></h3>
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
			$admVQry = " AND action_by=".$_SESSION["ses_adm_id"]."";
		}else{
			$admVQry = "";
		}?>
		<div class="row">
			<div class="col-md-6 col-lg-6 col-sm-12">
				<div class="white-box">
					<?php $leadActivityQry = $cms->db_query("SELECT activity_message, action_by, lead_id FROM #_lead_tracker where due_date='".date('Y-m-d')."' $admVQry ORDER BY id DESC LIMIT 1");
					if($leadActivityQry->num_rows>0){ ?>
					<span class="label label-rounded label-success pull-right"><a class="text-white" href="<?=SITE_PATH_ADM?>activities/?start_date=<?=date('Y-m-d')?>">View All</a></span>
					<?php } ?>
					<h4 class="mbot15">Today's Activity</h4>
					<div class="comment-center" style="margin:0px;">						
						<?php if($leadActivityQry->num_rows>0){
						while($leadActivityRes = $leadActivityQry->fetch_array()){ ?>
						<div class="comment-body" style="display:block">
							<div class="user-img"> <img src="<?=SITE_PATH_ADM?>images/blankuser.png" alt="user" class="img-circle"></div>
							<div class="mail-contnet">
								<h5><?=$cms->getSingleResult("SELECT customer_name FROM #_leads where id=".$leadActivityRes['lead_id']." ")?></h5>
								<span class="mail-desc"><?=$leadActivityRes["activity_message"]?></span>
								<!--<span class="label label-rounded label-success"><a class="text-white" href="<?=SITE_PATH_ADM?>lead-manager/?mode=add&start=&id=<?=$leadActivityRes['lead_id']?>">View</a></span>-->
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
		<!-- /.container-fluid -->
		
<?php //include("inc/footer.inc.php");?>
<?php include("inc/footer.php");?>