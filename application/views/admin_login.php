<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>Login |  PKDB</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="<?PHP echo base_url(""); ?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="<?PHP echo base_url(""); ?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
<link href="<?PHP echo base_url(""); ?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?PHP echo base_url(""); ?>assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link href="<?PHP echo base_url(""); ?>assets/admin/pages/css/login2.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME STYLES -->
<link href="<?PHP echo base_url(""); ?>assets/global/css/components-rounded.css" id="style_components" rel="stylesheet" type="text/css"/>
<link href="<?PHP echo base_url(""); ?>assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="<?PHP echo base_url(""); ?>assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
<link href="<?PHP echo base_url(""); ?>assets/admin/layout/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
<link href="<?PHP echo base_url(""); ?>assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.ico"/>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="login">
<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
<div class="menu-toggler sidebar-toggler">
</div>
<!-- END SIDEBAR TOGGLER BUTTON -->
<!-- BEGIN LOGO -->
<div class="logo">
	<!--<h2>Viral Webbs PKDB</h2>-->
    <h2> <?PHP echo $title; ?> </h2>
</div>
<!-- END LOGO -->
<!-- BEGIN LOGIN -->
<div class="col-md-offset-2 col-md-4">
    <div class="content">
        <!-- BEGIN LOGIN FORM -->
        <form class="login-form" action="" method="post" novalidate="false">
       		 <input type="hidden" name="admin" value="admin" />
            <div class="form-title">
                <span class="form-title">Welcome User.</span>
                <span class="form-subtitle">Please login.</span>
            </div>
            <?PHP echo $this->common->msg(); ?>
            <div class="form-group">
                <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                <label class="control-label visible-ie8 visible-ie9">Username</label>
                <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="username" value="<?PHP echo set_value("username"); ?>" required/>
                <?PHP echo form_error("username"); ?>
            </div>
            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">Password</label>
                <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" required/>
                <?PHP echo form_error("password"); ?>
            </div>
            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">Type</label>
                <select class="form-control" name="type">
                    <option value="employee">Employee</option>
                    <option value="department">Department</option>
                    <option value="Pk Admin">Pk Admin</option>
                </select>
                <?PHP echo form_error("type"); ?>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary btn-block uppercase" >Login</button>
            </div>
    
        </form>
        <!-- END LOGIN FORM -->
        
    
    </div>
</div>
<div class="col-md-4">
    <div class="content">
        <!-- BEGIN LOGIN FORM -->
        <form class="login-form" action="" method="post">
        	<input type="hidden" name="client" value="client" />
            <div class="form-title">
                <span class="form-title">Welcome Client.</span>
                <span class="form-subtitle">Please login.</span>
            </div>
            <?PHP echo $this->common->msg(); ?>
            <div class="form-group">
                <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                <label class="control-label visible-ie8 visible-ie9">Username</label>
                <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="username" value="<?PHP echo set_value("username"); ?>"/>
                <?PHP echo form_error("username"); ?>
            </div>
            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">Password</label>
                <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password"/>
                <?PHP echo form_error("password"); ?>
            </div>
            
            <div class="form-actions">
           		
                <button type="submit" class="btn btn-primary btn-block uppercase">Client Login</button>
            </div>
    
        </form>
        <!-- END LOGIN FORM -->
         
    
    </div>	
</div>
<div class="copyright hide">
	 2016 © viralwebbs.com.
</div>
<!-- END LOGIN -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="<?PHP echo base_url(""); ?>assets/global/plugins/respond.min.js"></script>
<script src="<?PHP echo base_url(""); ?>assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
<script src="<?PHP echo base_url(""); ?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="<?PHP echo base_url(""); ?>assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<script src="<?PHP echo base_url(""); ?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?PHP echo base_url(""); ?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?PHP echo base_url(""); ?>assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="<?PHP echo base_url(""); ?>assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?PHP echo base_url(""); ?>assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?PHP echo base_url(""); ?>assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="<?PHP echo base_url(""); ?>assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="<?PHP echo base_url(""); ?>assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script src="<?PHP echo base_url(""); ?>assets/admin/pages/scripts/login.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
jQuery(document).ready(function() {     
Metronic.init(); // init metronic core components
Layout.init(); // init current layout
Login.init();
Demo.init();
});
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>