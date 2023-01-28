<?php include("../../lib/opin.inc.website.php");?>
<?php $hedtitle = '<i class="ti-support fa-fw"></i> FAQ Category Manager'; ?>
<?php include_once "../inc/header.inc.php"; ?>
<?php include "../inc/header.php"; ?>
<div class="clearfix"></div>
<?=$cms->sform((($mode)?'onsubmit="return formvalid(this)"':'onsubmit="return formvalid(this)"'));?>
<?php if($mode=="add"){include("add.php");}else if($mode=="view"){include("view.php");}else{include("manage.php");}?>
<?php include("../inc/footer.inc.php");?>
<?=$cms->eform();?>
<?php include("../inc/footer.php");?>
