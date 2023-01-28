<input type="hidden" name="action" id="action"/>
<input type="hidden" name="submitdate" id="submitdate" value="<?=time()?>"/>
<input type="hidden" name="updateid" id="updateid" value="<?=$id?>"/>
<?=$cms->eform();?>
<script type="text/javascript">
 $(document).ready(function(){
 
	 $("#hed-tit").html("<?=$hedtitle?>");
	 <? 
	 if($hedtitle!=""){
	 ?>
	 $("#innertit").html("<?=$hedtitle?>");
	 <? }?>
	});
	 $('.qty').blur(function() {  
	var val = $(this).val();
	if(isNaN(val) || val=='0'){
	 alert("Invalid value!")
	$(this).val(1); 
	$(this).focus(); 
	}
	});
</script>
 
 