
<?php if($pid){?>
<link rel="stylesheet" href="<?=SITE_PATH_ADM?>tabs/tabs.css" type="text/css" media="screen, projection"/>

<script type="text/javascript" src="<?=SITE_PATH_ADM?>tabs/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="<?=SITE_PATH_ADM?>tabs/jquery-ui-1.7.custom.min.js"></script>
<div id="page-wrap">		
	<div id="tabs">						
		<ul style="display:none">
			<?php $projectStepQry = $cms->db_query("select step_num, step_title from #_users_project_steps where status=1 AND is_deleted=0 order by step_num ");
			$i=1;
			while($projectStepArr = $projectStepQry->fetch_array()){ ?>
			<li><a href="#fragment-<?=$projectStepArr['step_num']?>">1</a></li>
			<?php } ?>
		</ul>
		
		
		<?php $projectStepsQry = $cms->db_query("select *, id as fid from #_users_project_steps where is_deleted=0 AND project_id=$pid ");
		$j=1;
		if($projectStepsQry->num_rows>0){
		?>
		<?php while($projectStepsArr = $projectStepsQry->fetch_array()){ ?>
		<div id="fragment-<?=$projectStepsArr['step_num']?>" class="ui-tabs-panel <?=$j!=1?'ui-tabs-hide':''?>">
			<h3 class="step-title">Step <?=$projectStepsArr['step_num']?> <!--<span class="pull-right"><a href="<?=SITE_PATH_ADM.CPAGE?>?mode=edit-step&t=project_steps&id=<?=$pid?>&stepId=<?=$projectStepsArr['step_num']?>" style="font-size:16px; color:#fff">Customize</a></span>--></h3>
			<?php echo '<h3>'.$projectStepsArr['field_label'].'</h3>';
			if($projectStepsArr['field_type']=='radio-group'){?>
				<div class="form-group col-sm-2">
					<div class="radio-list">
						<?php $field_values_obj = json_decode($projectStepsArr['field_values']);
						$val=1;
						foreach($field_values_obj as $fval){ ?>
						<label class="radio-inline p-0">
							<div class="radio radio-info">
								<input type="radio" name="field_required" id="field_required<?=$val?>" value="<?=$fval->value?>" <?=$fval->value==1?'checked':''?>>
								<label for="field_required<?=$val?>"><?=$fval->label?></label>
							</div>
						</label>
						<?php $val++; } ?>
					</div>
					<div class="help-block with-errors"></div>
				</div>
				<div class="clearfix"></div>
			<?php }
			else if($projectStepsArr['field_type']=='text'){
				$typeShow = '<span class="field-icon"><i class="fa fa-folder"></i></span> Text Field';
			}
			else{
				$typeShow = '';
			} 
			echo '<div class="">'.$typeShow.'</div>'; ?>
		</div>
		<?php $j++; } } ?>	
								
	</div>		
</div>
<div class="clearfix"></div>
<?php } ?>



		<script type="text/javascript">
		$(function() {
			var $tabs = $('#tabs').tabs();
			$(".ui-tabs-panel").each(function(i){
				var totalSize = $(".ui-tabs-panel").size() - 1;
				if (i != totalSize) {
					next = i + 2;
					$(this).append("<a href='#' class='next-tab mover' rel='" + next + "'>Next Step &#187;</a>");
				}
				if (i != 0) {
					prev = i;
					$(this).append("<a href='#' class='prev-tab mover' rel='" + prev + "'>&#171; Prev Step</a>");
				}
			});

			$('.next-tab, .prev-tab').click(function() { 
				$tabs.tabs('select', $(this).attr("rel"));
				return false;
			});
		});
		</script>	