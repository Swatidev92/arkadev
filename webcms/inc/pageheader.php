<header>
     
      <div class="hrd-right-wrap   hidden-print">
      <nav>
        <div class="brdcm" id="hed-tit"> <?=$hedtitle?></div>
        <div class="unvrl-btn"> 
		  
	    
         <?php if(!$_GET[mode] or $_GET[dis]!='hide'){?>
          <a href="javascript:void(0)"  onclick="javascript:submitions('Active');"class="ub">
        <img src="<?=SITE_PATH_ADM?>images/active.png" alt=""></a>
        <a href="javascript:void(0)" onClick="javascript:submitions('Inactive');" class="ub">
        <img src="<?=SITE_PATH_ADM?>images/inactive.png" alt=""></a>
		 <? }?>
    <?php if($_GET[mode]){?>
        <a href="javascript:void(0)" onclick="javascript:formback();" class="ub">
        <img src="<?=SITE_PATH_ADM?>images/back.png" alt=""></a>
	<?php } ?>
 
        </div> 
      </div>
      <div class="cl"></div>
    </header> 