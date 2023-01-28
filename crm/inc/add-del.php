<div class="col-lg-6 col-sm-5 col-md-5 col-xs-12">
	  <ol class="breadcrumb" style="background:#fff;">
		<li class="active">
		<?php
		if(isset($_GET['mode'])){ ?>
			<a href="javascript:void(0)" onclick="javascript:formback();" class="ub">
			<img src="<?=SITE_PATH_ADM?>images/back.png" alt=""></a>
		<?php } else{
		?>
		<?php if(!$_GET['mode'] or $_GET['dis']!='hide'){ ?>
			<a href="<?=SITE_PATH_ADM.CPAGE.'/?mode=add'?>" class="ub">
			<img  src="<?=SITE_PATH_ADM?>images/add-new.png" alt=""></a>  <?php } ?>
		<?php if(isset($_GET['dis']) !='hide'){ ?>
			<a href="javascript:void(0)" class="ub" onclick="javascript:submitions('delete');">
			<img src="<?=SITE_PATH_ADM?>images/delete.png" alt=""></a> <?php  }
			} ?>
		
		</li>
	  </ol>
	</div>