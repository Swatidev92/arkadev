			<!-- /.container-fluid -->
			<footer class="footer text-center hidden-print"> <?=date("Y")?> &copy; BLUE DIGITAL MEDIA </footer>
		</div>
		<!-- /#page-wrapper -->
	</div>
	<!-- /#wrapper -->
	
	<!-- Bootstrap Core JavaScript -->
		<script src="<?=SITE_PATH_ADM?>bootstrap/dist/js/bootstrap.min.js"></script>
		<!-- Menu Plugin JavaScript -->
		<script src="<?=SITE_PATH_ADM?>js/sidebar-nav.min.js"></script>
		<!--slimscroll JavaScript -->
		<script src="<?=SITE_PATH_ADM?>js/jquery.slimscroll.js"></script>
		<!--Wave Effects -->
		<script src="<?=SITE_PATH_ADM?>js/waves.js"></script>
		<!-- Form Wizard JavaScript -->
		<script src="<?=SITE_PATH_ADM?>js/jquery-wizard.min.js"></script>
		<!-- Custom Theme JavaScript -->
		<script src="<?=SITE_PATH_ADM?>js/custom.js"></script>
		<!--<script src="<?=SITE_PATH_ADM?>js/validator.js"></script>-->
		<script src="<?=SITE_PATH_ADM?>js/dashboard2.js"></script>
		<script src="<?=SITE_PATH_ADM?>js/jasny-bootstrap.js"></script>
		<script src="<?=SITE_PATH_ADM?>js/dropify.min.js"></script>
		<!-- switchery -->
		<script src="<?=SITE_PATH_ADM?>js/switchery.min.js"></script>
		<script src="<?=SITE_PATH_ADM?>js/custom-select.min.js" type="text/javascript"></script>		
		<!-- Clock Plugin JavaScript -->
		<script src="<?=SITE_PATH_ADM?>js/jquery-clockpicker.min.js"></script>
		<!-- Date Picker Plugin JavaScript -->
		<script src="<?=SITE_PATH_ADM?>js/bootstrap-datepicker.min.js"></script>
		<!-- Date range Plugin JavaScript -->
		<script src="<?=SITE_PATH?>lib/ckeditor2/ckeditor.js" ></script>
<script>
	setTimeout(function(){$(".alert").fadeOut()},2000)
</script>
<script>

	$(document).ready(function(){
		// Basic
		$('.dropify-area-img').dropify();
		var drEvent = $('.dropify-area-img').dropify();

		drEvent.on('dropify.beforeClear', function(event, element){
			var drop_id = $(this).attr('id').replace(/\D/g,'');
			//alert(drop_id);
			$.ajax({
				type: "POST",
				url: '<?=SITE_PATH_ADM.CPAGE?>/remove-area-image.php',
				data:"drop_id="+drop_id,
				success: function(data){
					alert('Image removed successfully');
				}
			});
		});
	});
	
	$(document).ready(function(){
		// Basic
		$('.dropify-charger').dropify();
		var drEvent = $('.dropify-charger').dropify();

		drEvent.on('dropify.beforeClear', function(event, element){
			var drop_id = $(this).attr('id').replace(/\D/g,'');
			$.ajax({
				type: "POST",
				url: '<?=SITE_PATH_ADM.CPAGE?>/remove-charger-image.php',
				data:"drop_id="+drop_id,
				success: function(data){
					alert('Image removed successfully');
				}
			});
		});
	});
	
	$(document).ready(function(){
		// Basic
		$('.dropify-panel').dropify();
		var drEvent = $('.dropify-panel').dropify();

		drEvent.on('dropify.beforeClear', function(event, element){
			var drop_id = $(this).attr('id').replace(/\D/g,'');
			$.ajax({
				type: "POST",
				url: '<?=SITE_PATH_ADM.CPAGE?>/remove-panel-image.php',
				data:"drop_id="+drop_id,
				success: function(data){
					alert('Image removed successfully');
				}
			});
		});
	});
	
	$(document).ready(function(){
		// Basic
		$('.dropify-battery').dropify();
		var drEvent = $('.dropify-battery').dropify();

		drEvent.on('dropify.beforeClear', function(event, element){
			var drop_id = $(this).attr('id').replace(/\D/g,'');
			$.ajax({
				type: "POST",
				url: '<?=SITE_PATH_ADM.CPAGE?>/remove-battery-image.php',
				data:"drop_id="+drop_id,
				success: function(data){
					alert('Image removed successfully');
				}
			});
		});
	});
	
	$(document).ready(function(){
		// Basic
		$('.dropify-inverter').dropify();
		var drEvent = $('.dropify-inverter').dropify();

		drEvent.on('dropify.beforeClear', function(event, element){
			var drop_id = $(this).attr('id').replace(/\D/g,'');
			$.ajax({
				type: "POST",
				url: '<?=SITE_PATH_ADM.CPAGE?>/remove-inverter-image.php',
				data:"drop_id="+drop_id,
				success: function(data){
					alert('Image removed successfully');
				}
			});
		});
	});
	
	
	$(document).ready(function(){
		// Translated
		$('.dropify-fr').dropify({
			messages: {
				default: 'Glissez-déposez un fichier ici ou cliquez',
				replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
				remove:  'Supprimer',
				error:   'Désolé, le fichier trop volumineux'
			}
		});
		// Used events
		var drEvent = $('#input-file-events').dropify();

		drEvent.on('dropify.beforeClear', function(event, element){
			return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
		});

		drEvent.on('dropify.afterClear', function(event, element){
			alert('File deleted');
		});

		drEvent.on('dropify.errors', function(event, element){
			console.log('Has Errors');
		});

		var drDestroy = $('#input-file-to-destroy').dropify();
		drDestroy = drDestroy.data('dropify')
		$('#toggleDropify').on('click', function(e){
			e.preventDefault();
			if (drDestroy.isDropified()) {
				drDestroy.destroy();
			} else {
				drDestroy.init();
			}
		})
	});
</script>
<script>
	$(".checkbox").change(function(){
		var checked_count=$('.checkbox:checked').length;
		if(checked_count>0){
			$(".enable_trash").show();
			$(".disable_trash").hide();
		}else{
			$(".enable_trash").hide();
			$(".disable_trash").show();
		}
	});
</script>

<script>
// Clock pickers
	$('#single-input').clockpicker({
		placement: 'bottom',
		align: 'left',
		autoclose: true,
		'default': 'now'
	});

	$('.clockpicker').clockpicker({
		donetext: 'Done',    
	})
	.find('input').change(function(){
		console.log(this.value);
	});

	$('#check-minutes').click(function(e){
		// Have to stop propagation here
		e.stopPropagation();
		input.clockpicker('show')
		.clockpicker('toggleView', 'minutes');
	});
	
	if (/mobile/i.test(navigator.userAgent)) {
		//$('input').prop('readOnly', true);
	} 
	// Date Picker
    jQuery('#datepicker-autoclose').datepicker({
		autoclose: true,
		todayHighlight: true,
		gotoCurrent:true, 
		setDate: new Date(), //format: 'MM/DD/YYYY'
		format: 'yyyy-mm-dd',
		startDate: '-0d',
	});
	
	jQuery('#valid_from').datepicker({
        autoclose: true,
        todayHighlight: true,
		gotoCurrent:true, 
		setDate: new Date(), //format: 'MM/DD/YYYY'
		format: 'yyyy-mm-dd',
		startDate: '-0d',
	});
      
	jQuery('#valid_to').datepicker({
		autoclose: true,
        todayHighlight: true,
		gotoCurrent:true, 
		setDate: new Date(), //format: 'MM/DD/YYYY'
		format: 'yyyy-mm-dd',
		startDate: '-0d',
	}); 
	jQuery('#start_date').datepicker({
        autoclose: true,
        todayHighlight: true,
		//gotoCurrent:true, 
		setDate: new Date(), //format: 'MM/DD/YYYY'
		format: 'yyyy-mm-dd',
		//startDate: '-0d',
	});
      
	jQuery('#end_date').datepicker({
		autoclose: true,
        todayHighlight: true,
		//gotoCurrent:true, 
		setDate: new Date(), //format: 'MM/DD/YYYY'
		format: 'yyyy-mm-dd',
		//startDate: '-0d',
	}); 
	jQuery('#quotation_date').datepicker({
		autoclose: true,
		todayHighlight: true,
		gotoCurrent:true, 
		setDate: new Date(), //format: 'MM/DD/YYYY'
		format: 'yyyy-mm-dd',
		startDate: '-0d',
	});
	jQuery('#quotation_valid_till').datepicker({
		autoclose: true,
		todayHighlight: true,
		gotoCurrent:true, 
		setDate: new Date(), //format: 'MM/DD/YYYY'
		format: 'yyyy-mm-dd',
		startDate: '-0d',
	});
	jQuery('#due_date').datepicker({
		autoclose: true,
		todayHighlight: true,
		gotoCurrent:true, 
		setDate: new Date(), //format: 'MM/DD/YYYY'
		format: 'yyyy-mm-dd',
		startDate: '-0d',
	});  
	jQuery('#to_date').datepicker({
		autoclose: true,
		todayHighlight: true,
		gotoCurrent:true, 
		setDate: new Date(), //format: 'MM/DD/YYYY'
		format: 'yyyy-mm-dd',
	});
	jQuery('#from_date').datepicker({
		autoclose: true,
		todayHighlight: true,
		gotoCurrent:true, 
		setDate: new Date(), //format: 'MM/DD/YYYY'
		format: 'yyyy-mm-dd',
	});
</script>


<!--<script type="text/javascript" src="<?=SITE_PATH_ADM?>js/jquery.multi-select.js"></script>-->
<script>
	jQuery(document).ready(function() {
		// Switchery
		var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
		$('.js-switch').each(function() {
			new Switchery($(this)[0], $(this).data());
		});
		// For select 2
		$(".select2").select2();
		//$('.selectpicker').selectpicker();
		
		/*		   
		// For multiselect
		$('#pre-selected-options').multiSelect();      
		$('#optgroup').multiSelect({ selectableOptgroup: true });

		$('#public-methods').multiSelect();
		$('#select-all').click(function(){
			$('#public-methods').multiSelect('select_all');
			return false;
		});
		$('#deselect-all').click(function(){
			$('#public-methods').multiSelect('deselect_all');
			return false;
		});
		$('#refresh').on('click', function(){
			$('#public-methods').multiSelect('refresh');
			return false;
		});
		$('#add-option').on('click', function(){
			$('#public-methods').multiSelect('addOption', { value: 42, text: 'test 42', index: 0 });
			return false;
		});
		*/
	});
</script>

<script type="text/javascript">
	(function(){
		$('#exampleBasic').wizard({
			onFinish: function(){
				alert('finish');
			}
		});
		$('#exampleBasic2').wizard({
			onFinish: function(){
				alert('finish');
			}
		});
		

		$('#accordion').wizard({
			step: '[data-toggle="collapse"]',
			buttonsAppendTo: '.panel-collapse',

			templates: {
				buttons: function(){
					var options = this.options;
					return '<div class="panel-footer"><ul class="pager">' +
						'<li class="previous">'+
							'<a href="#'+this.id+'" data-wizard="back" role="button">'+options.buttonLabels.back+'</a>' +
						'</li>' +
						'<li class="next">'+
						'<a href="#'+this.id+'" data-wizard="next" role="button">'+options.buttonLabels.next+'</a>' +
						'<a href="#'+this.id+'" data-wizard="finish" role="button">'+options.buttonLabels.finish+'</a>' +
						'</li>'+
					'</ul></div>';
				}
			},

			onBeforeShow: function(step){
				step.$pane.collapse('show');
			},

			onBeforeHide: function(step){
				step.$pane.collapse('hide');
			},

			onFinish: function(){
				alert('finish');
			}
		});
	})();
</script>
</body>
</html>