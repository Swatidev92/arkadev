<?php include("../lib/opin.inc.php"); 
	include("inc/header.inc.php"); 
	$hedtitle = "Admin Settings";  
	defined('_JEXEC') or die('Restricted access');  
	
?>
<div class="row bg-title">
	<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
		<h4 class="page-title"><i class="linea-icon linea-basic fa-fw" data-icon="v"></i> Settings</h4>
	</div>
	<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
		<ol class="breadcrumb">
			<li><a href="<?=SITE_PATH_ADM?>">Dashboard</a></li>
			<li class="active">Settings</li>
		</ol>
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- .row -->
<div class="row">
	<div class="col-sm-12">
		<div class="white-box">
			<?php 
				if($cms->is_post_back()){
					$cms->sqlquery("rs","setting",$_POST, 'id',1);
					$adm->sessset('Record has been updated', 's');
					//$cms->redir(SITE_PATH_ADM."settings.php", true);
				}
				$rsAdmin=$cms->db_query("select * from #_setting where id='1'");
				$arrAdmin=$cms->db_fetch_array($rsAdmin);
				@extract($arrAdmin);
			?> 
			<div class="col-lg-12 col-sm-12 col-xs-12">
				<div class="">
					<!-- Nav tabs -->
					<ul class="nav nav-tabs" role="tablist">
						<li role="presentation" class="active">
							<a href="#home" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs"> Basic Settings</span></a>
						</li>						
						<li role="presentation" class="">
							<a href="#profile" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-user"></i></span> <span class="hidden-xs">SMTP Settings</span></a>
						</li>
						<li role="presentation" class="">
							<a href="#payment" aria-controls="payment" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-user"></i></span> <span class="hidden-xs">Social Media Settings</span></a>
						</li>
					</ul>
					<!-- Tab panes -->
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane active" id="home">
							<div class="panel-body">
								<div class="">
									<div class="form-group col-lg-6">
										<label>Company</label>
										<input  class="form-control"   name="company" id="company" title="company" value="<?=$company?>"  placeholder="Company" /> 
										<div class="help-block with-errors"></div>
									</div>
									<div class="form-group col-lg-6">
										<label>Email</label>
										<input  class="form-control"  name="email" id="email" title="Email" value="<?=$email?>"  placeholder="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" /> 
										<div class="help-block with-errors"></div>
									</div> 
									<div class="form-group col-lg-6">
										<label>Phone</label>
										<input  class="form-control"  name="phone" id="phone" title="Phone" value="<?=$phone?>"  placeholder="Phone" /> 
										<div class="help-block with-errors"></div>
									</div>
									<div class="form-group col-lg-12" style="margin-bottom: 15px;">
										<label>Address</label>
										<textarea  class="form-control" rows="7" cols="30"  name="address" id="address" title="New Password" placeholder="Address" /><?=$address?></textarea>
										<div class="help-block with-errors"></div>
									</div>
								</div> 
								<div class="clearfix"></div>
							</div>
							<div class="clearfix"></div>
							<div class="panel-body">
								<div class="col-lg-12">
									<button type="submit" class="btn btn-primary">Submit</button>
								</div>
							</div>
						</div>
						<div role="tabpanel" class="tab-pane" id="profile">
							<div class="panel-body">
								<div class="">
									<div class="form-group col-lg-6">
										<label>SMTP Host</label>
										<input class="form-control" name="smtp_host" required value="<?=$smtp_host?>"  placeholder="SMTP Host"/> 
									</div>
									<div class="form-group col-lg-6">
										<label>SMTP User</label>
										<input class="form-control" name="smtp_user" required value="<?=$smtp_user?>"  placeholder="SMTP User"/> 
									</div>
									<div class="form-group col-lg-6">
										<label>SMTP Password</label>
										<input class="form-control" name="smtp_password" required value="<?=$smtp_password?>"  placeholder="SMTP Password"/> 
									</div> 									
									<div class="form-group col-lg-6">
										<label>Admin Email</label>
										<input class="form-control" name="from_email" required value="<?=$from_email?>"  placeholder="From Email"/> 
									</div> 
									<!--<div class="form-group col-lg-6">
										<label>To Email</label>
										<input class="form-control" name="to_emails" required value="<?=$to_emails?>"  placeholder="To Email"/> 
									</div> -->
								</div> 					
							</div> 
							<div class="clearfix"></div>
							<div class="panel-body">
								<div class="col-lg-12">
									<button type="submit" class="btn btn-primary">Submit</button>
								</div>
							</div>
						</div>
						<div role="tabpanel" class="tab-pane" id="payment">
							<div class="panel-body">
								<div class="col-lg-6">
									<div class="form-group">
										<label>Facebook</label>
										<input  class="form-control"  name="fb" id="fb" title="Facebook" value="<?=$fb?>"  placeholder="Facebook" />
										<div class="help-block with-errors"></div>						
									</div> 
									<div class="form-group">
										<label>Instagram</label>
										<input  class="form-control"  name="instagram" id="instagram" title="Instagram" value="<?=$instagram?>"  placeholder="Instagram" /> 
										<div class="help-block with-errors"></div>
									</div> 
									<div class="form-group">
										<label>Linkedin</label>
										<input  class="form-control"  name="lin" id="lin" title="Linkedin" value="<?=$lin?>"  placeholder="Linkedin" />
										<div class="help-block with-errors"></div>						
									</div>
									<!--<div class="form-group">
										<label>Pinterest</label>
										<input  class="form-control"  name="pinterest" id="pinterest" title="Pinterest" value="<?=$pinterest?>"  placeholder="Pinterest" /> 
										<div class="help-block with-errors"></div>
									</div>
									<div class="form-group">
										<label>Linkedin</label>
										<input  class="form-control"  name="lin" id="lin" title="Linkedin" value="<?=$lin?>"  placeholder="Linkedin" />
										<div class="help-block with-errors"></div>						
									</div>-->
									<!--<div class="form-group">
										<label>Twitter</label>
										<input  class="form-control"  name="tw" id="tw" title="Twitter" value="<?=$tw?>"  placeholder="Twitter" /> 
										<div class="help-block with-errors"></div>
									</div> 
									<div class="form-group">
										<label>Google Plus</label>
										<input  class="form-control"  name="gp" id="gp" title="Google Plus" value="<?=$gp?>"  placeholder="Google Plus" /> 
										<div class="help-block with-errors"></div>
									</div>
									<div class="form-group">
										<label>Youtube</label>
										<input  class="form-control"  name="yt" id="yt" title="Youtube" value="<?=$yt?>"  placeholder="Youtube" /> 
										<div class="help-block with-errors"></div>
									</div>-->
								</div>
							</div> 
							<div class="clearfix"></div>
							<div class="panel-body">
								<div class="col-lg-12">
									<button type="submit" class="btn btn-primary">Submit</button>
								</div>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</div>
<!-- /.row -->	
<?php include("inc/footer.inc.php");?>
<?php include("inc/footer.php");?>