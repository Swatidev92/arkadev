<?php include("../lib/opin.inc.website.php"); 
include("inc/header.inc.php"); 
$hedtitle = " Change Password";  
defined('_JEXEC') or die('Restricted access');  

if($cms->is_post_back()){
	$oldpassword = md5(trim($_POST['oldpassword']));
	$password = md5($_POST['password']);
	$newpassword = md5($_POST['cpassword']);
	
	$check = $cms->getSingleresult("SELECT password FROM #_users WHERE password='".$oldpassword."' AND id='".$_SESSION['ses_adm_id'] ."'"); 
	if($check){
		if($password == $newpassword){
			$cms->db_query("UPDATE #_users SET password='".$password."' , plain_password='".$_POST['password']."'  WHERE id='".$_SESSION['ses_adm_id'] ."'"); 
			$adm->sessset('Password change successfuly', 's');
			$cms->redir(SITE_PATH_ADM."change-password.php", true);
		}else {
			$adm->sessset('Password do not Match', 'e');
			$cms->redir(SITE_PATH_ADM."change-password.php", true);
		}
	} else {
		$adm->sessset('Wrong Password', 'e');
		$cms->redir(SITE_PATH_ADM."change-password.php", true);
	}
}
?>
<div class="row bg-title">
	<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
		<h4 class="page-title"><i class="linea-icon linea-basic fa-fw" data-icon="v"></i> Change Password</h4>
	</div>
	<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
		<ol class="breadcrumb">
			<li><a href="<?=SITE_PATH_ADM?>">Dashboard</a></li>
			<li class="active">Change Password</li>
		</ol>
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- .row -->
<div class="row">
	<div class="col-sm-12">
		<div class="white-box">
			<div class="form-group  col-sm-6">
				<label>Old Password</label>
				<input  class="form-control"  type="password" name="oldpassword" id="oldpassword" required title="Old Password" value="<?=$oldpassword?>"  placeholder="Old Password" /> 
				<div class="help-block with-errors"></div>
			</div>
			<div class="clearfix"></div>
			<div class="form-group col-sm-6">
				<label>New Password</label>
				<input type="password"  name="password" data-toggle="validator" data-minlength="6" class="form-control" id="inputPassword" placeholder="New Password" value="<?=$password?>" required>
                <span class="help-block">Minimum of 6 characters</span> 
				<div class="help-block with-errors"></div>
			</div>
			<div class="clearfix"></div>
			<div class="form-group col-sm-6">
				<label>Confirm Password</label>
				<input type="password" class="form-control" name="cpassword" id="inputPasswordConfirm" data-match="#inputPassword" data-match-error="Whoops, Password don't match" placeholder="Confirm Password" value="<?=$cpassword?>" required>
                <div class="help-block with-errors"></div>
			</div> 
			<div class="clearfix"></div>
			<button type="submit" class="btn  btn-primary">Update</button>
			<button type="reset" class="btn btn-primary">Reset</button>
		</div>
	</div>
</div>
<!-- /.row -->	
<?php include("inc/footer.inc.php");?>
<?php include("inc/footer.php");?>