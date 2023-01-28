<div class="bg-title hidden-print">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<h4 class="page-title"><?=$hedtitle?></h4>
	</div>
</div>
<div class="row">
	<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
		<ol class="breadcrumb">
			<li class="active">
				<?php if(isset($_GET['mode'])){ ?>
				<a href="javascript:void(0)" onclick="javascript:formback();" class="ub">
					<b><i class="fa fa-angle-double-left fa-lg"></i> Back</b>
				</a>
				<?php } else{ ?>
				<?php if(!$_GET['mode'] or $_GET['dis']!='hide'){ ?>
				<a href="<?=SITE_PATH_ADM.CPAGE.'/?mode=add'?>" class="ub">
					<img  src="<?=SITE_PATH_ADM?>images/add_1.svg" width="25" alt="">
				</a>  
				<?php } } ?>	
			</li>
		</ol>
	</div>
</div>