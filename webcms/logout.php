<?php include("../lib/opin.inc.website.php");
session_destroy();
session_unset();
$cms->redir(SITE_PATH_ADM."login/");
exit;
?>