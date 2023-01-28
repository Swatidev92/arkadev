<?php include("../../lib/opin.inc.php");?>
<?php $hedtitle = '<i class="fa fa-group" aria-hidden="true"></i> Contract Report'; ?>
<?php include_once "../inc/header.inc.php"; ?>
<?php include "../inc/header-without-add-del.php"; ?>
<div class="clearfix"></div>
<?php if($mode=="add"){include("add.php");}else if($mode=="view"){include("view.php");}else{include("manage.php");}?>
<?php include("../inc/footer.inc.php");?>
<?php include("../inc/footer.php");?>
