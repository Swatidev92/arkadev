<?php 
$_SERVER['argv'][0] = '';
if($reccnt>$pagesize){
	$num_pages=$reccnt/$pagesize;
	$qry_str=$_SERVER['argv'][0];
	
	$m=$_GET;
	unset($m['start']);
	
	$qry_str = $cms->qry_str($m);
	
	$j=$start/$pagesize-5;

	if($j<0) {
		$j=0;
	}
	$k=$j+10;
	if($k>$num_pages){
		$k=$num_pages;
	}
	$j=intval($j);
?>
<div class="row   hidden-print">
	<div class="col-sm-6">
		<div >
			Showing <?=(($start)?$start:'1')?> to <?=$start+10?> of <?=$reccnt?> entries
		</div>
	</div>
	<div class="col-sm-6 text-right">
	 		<ul class="pagination pagination-split">
				<?php if($start!=0){ ?>
					<li >
						<a href="<?=$PHP_SELF?><?=$qry_str?>&start=<?=$start-$pagesize?>"><i class="fa fa-angle-left"></i></a>
					</li>
				<?php  } for($i=$j;$i<$k;$i++) {if(($pagesize*($i))!=$start){?>
					<li>
						<a href="<?=$PHP_SELF?><?=$qry_str?>&start=<?=$pagesize*($i)?>"><?=$i+1;?></a>
					</li>
				 <?php  }  else {  ?>
					<li class="active">
						<a href="javascript:void(0);" class="active"><?=$i+1;?></a>
					</li>
				<?php   } }?>
				<?php if($start+$pagesize < $reccnt){ ?>
					<li >
						<a href="<?=$PHP_SELF?><?=$qry_str?>&start=<?=$start+$pagesize?>"><i class="fa fa-angle-right"></i></a>
					</li>
				 <?php } ?>
			</ul>
		 
	</div>
</div>
<?php }?>
