<?php include("../lib/opin.inc.website.php"); 
include("inc/header.inc.php"); 
$hedtitle = "Admin Settings";  
defined('_JEXEC') or die('Restricted access');  

$pid = $_GET['id']; 

if($cms->is_post_back()){  
	//$_POST["bundle_product"] = implode(",", );
	if($_POST["act_type"]==1){         
			// update PERMISSIONS START
		for($i=0;$i<count($_POST["module_id"]);$i++){

			$arr["module_id"] = $_POST["module_id"][$i];
			
			// if module exists then update else insert
			$sqlPer = "SELECT id FROM #_permissions WHERE module_id = '".$arr["module_id"]."' AND user_id='".$uid."'";
			
			$resultPerm = $cms->db_query($sqlPer);
			$PernumRows = $resultPerm->num_rows;
			
			$module_sub_id = implode(",",$_POST["module_sub_id"][$_POST["module_id"][$i]]);
			$sub_module_action = implode(",",$_POST["sub_module_action"][$_POST["module_id"][$i]]);
			$arr["user_id"] = $_POST["username"];
			if($sub_module_action=='')
				{
				$arr["sub_module_action"] = '';
				$arr["module_sub_id"]=$module_sub_id;
				}
			else{ 
				$arr["sub_module_action"] = $sub_module_action;
				$arr["module_sub_id"]=$module_sub_id;}
						
			if($PernumRows==0){
					// insert module,submodule,action,user,status
					$cms->sqlquery("rs","permissions",$arr);
			}
			else{
					// update module,submodule,action,user, status
					$perm_id = $resultPerm->fetch_array();
					
					//die;
					if($arr["module_sub_id"]=='' && $arr["sub_module_action"]==''){
						$arr["status"] = 0;
						$arr["module_id"] = '';
					}
					else{$arr["status"] = 1;}
					$cms->sqlquery("rs","permissions",$arr, 'id', $perm_id["id"]);
			}

		}
			// update PERMISSIONS END
			// delete all other records of this user except selected module_id
		if($_POST["module_id"])
		$all_module_id=implode(",",$_POST["module_id"]);
		else
		$all_module_id=0;		
		$return=$cms->db_query("delete from #_permissions where module_id not in ($all_module_id) and user_id='$uid'");
		$adm->sessset('Record has been updated', 's');
	} else {  
			// SAVE PERMISSIONS START
		for($i=0;$i<count($_POST["module_id"]);$i++){
//print_r($_POST);
			$arr["module_id"] = $_POST["module_id"][$i];
			$module_sub_id = implode(",",$_POST["module_sub_id"][$_POST["module_id"][$i]]);
			$sub_module_action = implode(",",$_POST["sub_module_action"][$_POST["module_id"][$i]]);
			$arr["user_id"] = $_POST["username"];
			if($sub_module_action=='')
				{
				$arr["sub_module_action"] = '';
				$arr["module_sub_id"]=$module_sub_id;
				}
			else{ 
				$arr["sub_module_action"] = $sub_module_action;
				$arr["module_sub_id"]=$module_sub_id;}
			
			$cms->sqlquery("rs","permissions",$arr);
		}
			// SAVE PERMISSIONS END
				// delete all other records of this user except selected module_id
		if($_POST["module_id"])
		$all_module_id=implode(",",$_POST["module_id"]);
		else
		$all_module_id=0;		
		$return=$cms->db_query("delete from #_permissions where module_id not in ($all_module_id) and user_id='$uid'");
		$adm->sessset('Record has been added', 's');
	}
		$path = SITE_PATH_ADM."permisions.php?uid=$uid";
		$cms->redir($path, true);	
	
}  
	
?>


<style>
.checkbox input[type="checkbox"]{opacity:9;}

</style>
<div class="row bg-title">
	<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
		<h4 class="page-title"><i class="linea-icon linea-basic fa-fw" data-icon="v"></i>  Manage User Permisions</h4>
	</div>
	<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
		<ol class="breadcrumb">
			<li><a href="<?=SITE_PATH_ADM?>">Dashboard</a></li>
			<li class="active"> Manage User Permisions</li>
		</ol>
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- .row -->
<div class="row">
    <div class="col-sm-12">
        <div class="white-box panel-body">
			<?php 
				/*if($cms->is_post_back()){
					//print_r($_POST);die;
					$_POST["module_id"] = implode(",", $module_id); 
					$_POST["module_sub_id"] = implode(",", $module_sub_id); 
					$_POST["user_id"] = $username;
					$cms->sqlquery("rs","permissions",$_POST);
					$adm->sessset('Record has been updated', 's');
					//$cms->redir(SITE_PATH_ADM."settings.php", true);
				}*/
				$adminRs=$cms->db_query("SELECT id, username, email FROM #_administrator WHERE id='".$uid."'");
				$adminArr = $adminRs->fetch_array();
				@extract($adminArr);
				
				// get user module lists start
				if($uid!=''){
					$edit = 0;
					$asign_mod = $cms->db_query("SELECT module_id,module_sub_id,sub_module_action FROM #_permissions WHERE status='1' AND user_id='".$uid."'");
						while($adminResAr = $asign_mod->fetch_array()){
							
								$perm_arr["module_id"][$adminResAr["module_id"]] = $adminResAr["module_id"];
								$perm_arr["module_sub_id"][$adminResAr["module_id"]]  = explode(",",$adminResAr["module_sub_id"]);
								$perm_arr["sub_module_action"][$adminResAr["module_id"]]  = explode(",",$adminResAr["sub_module_action"]);
								$edit=1;
						}
						//print_r($perm_arr);die;
				}
				// get user module lists end
			?> 
			<div class="panel-body">
				<div class="panel-body col-lg-12">
					<div class="form-group col-lg-5">
						<label>Username</label>
						<select  class="form-control select2" id="username" title="Username" lang="R" name="username">
							<?php $adminReq=$cms->db_query("SELECT id, username, email FROM #_administrator WHERE type!='Super Admin' AND status='1'"); ?>
							<option value="" >Select Username</option>
							<?php while($adminRes = $adminReq->fetch_array()){ ?>
								<option value="<?=$adminRes["id"]?>" <?=(($adminArr["id"]==$adminRes["id"])?'selected="selected"':'')?>><?=$adminRes["username"]?></option>
							<?php } ?>
						</select>						
					</div>
					<!--<div class="form-group col-lg-5">
						<label>Email</label>
						<input  class="form-control"  name="email" id="email" title="Email" value="<?=$email?>"  placeholder="Email" /> 
					</div> -->
					 
					 
					 
				</div> 
				<div class="panel-body col-lg-12">
					<?php $moduleReq = $cms->db_query("SELECT * FROM #_admin_module WHERE status='1' AND parent_id='0' order by position asc");?>
					<?php while($moduleRes = $moduleReq->fetch_array()){?>
					<?php if($moduleRes["url"]!="javascript:void(0)"){ ?>
					<div class="">
					<input name="module_id[]" type="checkbox" id="" value="<?=$moduleRes["id"]?>" <?=((in_array($moduleRes["id"],$perm_arr["module_id"]))?'checked="checked"':'')?>>
					
					
					  <label for="<?=$moduleRes["id"]?>"> <?=ucwords($moduleRes["name"])?> </label>
					</div>
						<?php 
							$arr1 = array();
							$moduleRq1 = $cms->db_query("SELECT * FROM #_admin_module WHERE status='1' AND parent_id='".$moduleRes["id"]."'");
							while($moduleRs1 = $moduleRq1->fetch_array()){
								  $arr1[] = $moduleRs1["id"];
							}
							$alids = implode(',',$arr1);
							
							$moduleRq12 = $cms->db_query("SELECT * FROM #_admin_module WHERE status='1' AND parent_id in ($alids)");
							$cnt = $moduleRq12->num_rows;
						$moduleRq = $cms->db_query("SELECT * FROM #_admin_module WHERE status='1' AND parent_id='".$moduleRes["id"]."'");?>
							<?php while($moduleRs = $moduleRq->fetch_array()){?>
							<div class="col-lg-2" style="margin-left:5%">
							
								
								<?php
								if($cnt>0){ ?>
								<input name="module_sub_id[<?php echo $moduleRes["id"] ?>][]" type="checkbox" id="" value="<?=$moduleRs["id"]?>" <?=((in_array($moduleRs["id"],$perm_arr["module_sub_id"][$moduleRes["id"]]))||(in_array($moduleRs["id"],$perm_arr["sub_module_action"][$moduleRes["id"]]))?'checked="checked"':'')?>>
							<?php }else{ ?>
								<input name="sub_module_action[<?php echo $moduleRes["id"] ?>][]" type="checkbox" id="" value="<?=$moduleRs["id"]?>" <?=((in_array($moduleRs["id"],$perm_arr["module_sub_id"][$moduleRes["id"]]))||(in_array($moduleRs["id"],$perm_arr["sub_module_action"][$moduleRes["id"]]))?'checked="checked"':'')?>>
								
							<?php } ?>
								
								<label for="<?=$moduleRs["id"]?>"> <?=ucwords($moduleRs["name"])?> </label><br>
								<?php $moduleRq_2 = $cms->db_query("SELECT * FROM #_admin_module WHERE status='1' AND parent_id='".$moduleRs["id"]."'");
									while($moduleRs_2 = $moduleRq_2->fetch_array()){
								?>
								<br>
															
								<input name="sub_module_action[<?php echo $moduleRes["id"] ?>][]" type="checkbox" id="" value="<?=$moduleRs_2["id"]?>" <?=((in_array($moduleRs_2["id"],$perm_arr["module_sub_id"][$moduleRes["id"]]))||(in_array($moduleRs_2["id"],$perm_arr["sub_module_action"][$moduleRes["id"]]))?'checked="checked"':'')?>><?=ucwords($moduleRs_2["name"])?>
								
									<?php } ?>
							</div>
						<?php } ?>
						<div class="clearfix"></div>
						<?php } ?>
					<?php } ?>
                </div>
				<div class="panel-body col-lg-12">
					<input type="hidden" name="act_type" value="<?php echo $edit; ?>">
					<button type="submit" class="btn btn-primary">Submit</button>
					<a href="<?=SITE_PATH_ADM?>permisions.php"  class="btn btn-primary">Reset</a>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /.row -->	
<?php include("inc/footer.inc.php");?>
<?php include("inc/footer.php");?>
<script>
    $(function(){
      // bind change event to select
      $('#username').on('change', function () {
          var url = $(this).val(); // get selected value
          if (url) { // require a URL
              window.location = "<?=SITE_PATH_ADM?>permisions.php?uid="+url; // redirect
          }
          return false;
      });
    });
</script>