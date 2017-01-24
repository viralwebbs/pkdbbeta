 <!-- BEGIN CONTAINER -->
<div class="page-container">
<!-- BEGIN SIDEBAR -->
	<div class="page-sidebar-wrapper">
		<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
		<!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
		<div class="page-sidebar navbar-collapse collapse">
			<!-- BEGIN SIDEBAR MENU -->
			<!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
			<!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
			<!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
			<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
			<!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
			<!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
			<ul class="page-sidebar-menu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
				<li class="start ">
					<a href="<?PHP  echo base_url("admin/dashboard"); ?>">
					<i class="icon-home"></i>
					<span class="title">Dashboard</span>
					</a>
				</li>
                <li class="<?PHP $this->common->checkModel($module,'jobs');?>">
					<a href="javascript:;">
					<i class="icon-briefcase"></i>
					<span class="title">Jobs</span>
					<span class="arrow"></span>
					</a>
					<ul class="sub-menu" style="display: none;">
						<li <?PHP  $this->common->checkchild($child,'job List');?>>
							<a href="<?PHP echo base_url("admin/jobs/"); ?>">
							<i class="icon-briefcase"></i> Jobs List</a>
						</li>
						<!--<li <?PHP $this->common->checkchild($child,'jobs_add');?>>
							<a href="<?PHP echo base_url("admin/jobs/add/"); ?>">
							<i class="icon-briefcase"></i> Add Job</a>
						</li>-->
					</ul>
				</li>
                 <li class="<?PHP $this->common->checkModel($module,'departments');?>">
					<a href="javascript:;">
					<i class="icon-briefcase"></i>
					<span class="title">Departments</span>
					<span class="arrow"></span>
					</a>
					<ul class="sub-menu" style="display: none;">
						<li <?PHP $this->common->checkchild($child,'viral_departments');?>>
							<a href="<?PHP echo base_url("admin/departments/viral_departments"); ?>">
							<i class="icon-briefcase"></i>Viral Departments</a>
						</li>
						<li <?PHP $this->common->checkchild($child,'client_departments');?>>
							<a href="<?PHP echo base_url("admin/departments/client_departments"); ?>">
							<i class="icon-briefcase"></i>Client Departments</a>
						</li>
					</ul>
				</li>
				
				
			</ul>
			<!-- END SIDEBAR MENU -->
		</div>
	</div>
	<!-- END SIDEBAR -->
    
   