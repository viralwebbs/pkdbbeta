<!-- BEGIN FOOTER -->
<div class="page-footer">
	<div class="page-footer-inner">
		 Copyright &copy;<?PHP echo date("Y"); ?>. viralwebbs.com
	</div>
	<div class="scroll-to-top">
		<i class="icon-arrow-up"></i>
	</div>
</div>
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="<?PHP echo base_url(); ?>assets/global/plugins/respond.min.js"></script>
<script src="<?PHP echo base_url(); ?>assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->

<script src="<?PHP echo base_url(); ?>assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="<?PHP echo base_url(); ?>assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="<?PHP echo base_url(); ?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?PHP echo base_url(); ?>assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="<?PHP echo base_url(); ?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?PHP echo base_url(); ?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?PHP echo base_url(); ?>assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="<?PHP echo base_url(); ?>assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="<?PHP echo base_url(); ?>assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<script src="<?PHP echo base_url(); ?>assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="<?PHP echo base_url(); ?>assets/admin/layout4/scripts/layout.js" type="text/javascript"></script>
<script src="<?PHP echo base_url(); ?>assets/admin/layout4/scripts/demo.js" type="text/javascript"></script>
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="<?PHP echo base_url(); ?>assets/global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="<?PHP echo base_url(); ?>assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?PHP echo base_url(); ?>assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<script src="<?PHP echo base_url(); ?>assets/admin/pages/scripts/table-managed.js"></script>

<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>

<script src="<?PHP echo base_url(); ?>assets/global/scripts/custom.js"></script>
 
<script src="<?PHP echo base_url(); ?>assets/global/plugins/dropzone/dropzone.js"></script>
<script src="<?PHP echo base_url(); ?>assets/admin/pages/scripts/form-dropzone.js"></script>

<!--materialize js-
<script src="<?PHP echo base_url(); ?>assets/global/scripts/js/materialize.min.js"></script>->

</div>
<!-- END CONTAINER -->

<script>

      jQuery(document).ready(function() {    
         Metronic.init(); // init metronic core components
		Layout.init(); // init current layout
		Demo.init(); // init demo features
		 TableManaged.init(); // table 
		  FormDropzone.init(); // file dropzone
		   Dropzone.options.myDropzone = false;
      });
	  //// Nice Editot tiny myce
	   tinymce.init({ selector:'textarea' });
	   
	   $(document).ready(function() {
			$(".datepicker" ).datepicker({
			 dateFormat: 'dd-mm-yy'
			});
		});
		
		
   </script>
    
</body>
<!-- END BODY -->
</html>