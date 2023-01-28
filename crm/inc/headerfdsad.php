<div class="row bg-title hidden-print">
	<div class="col-lg-6 col-md-5 col-sm-5 col-xs-12">
	  <h4 class="page-title"><?=$hedtitle?></h4>
	</div>
	<div class="col-lg-6 col-sm-5 col-md-5 col-xs-12">
	  <ol class="breadcrumb">
		<li class="active">
			 
					<?php if(isset($_GET['dis']) !='hide' AND !$_GET['mode']){ ?>
						<a href="<?=SITE_PATH_ADM.CPAGE.'/?mode=add'?>" class="ub">
						<img  src="<?=SITE_PATH_ADM?>images/add-new.png" alt=""></a>  
					<?php } ?>
					<?php if((isset($_GET['dis'])!='hide') AND !$_GET['mode']){?>
						<a href="javascript:void(0)"  onclick="javascript:submitions('Active');"class="ub">
						<img src="<?=SITE_PATH_ADM?>images/active.png" alt=""></a>
						<a href="javascript:void(0)" onClick="javascript:submitions('Inactive');" class="ub">
						<img src="<?=SITE_PATH_ADM?>images/inactive.png" alt=""></a>
						<a href="javascript:void(0)" class="ub" onclick="javascript:submitions('delete');">
							<img src="<?=SITE_PATH_ADM?>images/delete.png" alt=""></a> 
					<?php }  ?>
					 <?php if($_GET['mode']){?>
						<a href="javascript:void(0)" onclick="javascript:formback();" class="ub">
						<img src="<?=SITE_PATH_ADM?>images/back.png" alt=""></a>
					<?php } ?> 
					 
				 
			 
		
		</li>
	  </ol>
	</div>
	<!-- /.col-lg-12 -->
	
	
</div>
 
 
 