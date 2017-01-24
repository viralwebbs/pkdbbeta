<?PHP //$this->load->view("common/admin_head"); ?>

	<?PHP //$this->load->view("common/admin_header"); ?>

<!-- BEGIN CONTAINER 
<div class="page-container"> -->
	<?PHP //$this->load->view("common/admin_sidebar"); ?>
	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
		
			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<!-- BEGIN PAGE HEADER-->
			<!-- BEGIN PAGE HEAD -->
			<div class="page-head">
				<!-- BEGIN PAGE TITLE -->
				<div class="page-title">
					<h1><?PHP echo $title; ?></h1>
				</div>
				<!-- END PAGE TITLE -->
				
			</div>
			<!-- END PAGE HEAD -->
			<!-- BEGIN PAGE BREADCRUMB -->
			
			<!-- END PAGE BREADCRUMB -->
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			<?PHP $this->load->view($filename); ?>
			<!-- END PAGE CONTENT-->
		</div>
	</div>
	<!-- END CONTENT -->
<!--
</div>
 END CONTAINER -->
<?PHP //$this->load->view("common/admin_footer"); ?>