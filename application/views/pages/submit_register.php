<!-- start page -->
<div id="page">
<!-- start sidebar -->
  <div id="sidebar">
		
				<? $this->load->view('pages/side_bar.php'); ?>
			
	</div>
	<!-- end sidebar -->
    <div id="content">
        <div class="post">
            <div class="title">

                <br/><small><a href="http://localhost/ci_traffic/index.php/view_report">View Reports</a> | <a href="http://localhost/ci_traffic/index.php/report">Report</a> | <a href="http://localhost/ci_traffic/">Live Traffic</a></small><br/><br/>
            </div>
            <div class="entry">
                <br style="clear: both;" /><br style="clear: both;" />
                 <div id="register" class="animate form"> 

<form name='register' id='submitted' action='http://localhost/ci_traffic/index.php/page/submit_register' method='post' accept-charset='UTF-8'>
<fieldset >
<legend>Registration Form</legend>
<div class='short_explanation'>* required fields</div>


 <div id="error"><?php echo validation_errors(); ?></div>
<input type='hidden' name='submitted' id='submitted' value='1'/>
<label for='name' ><b>Full Name*</b></label>
<input type='text' name='name' id='name'  maxlength="50" />
<span id='register_name_errorloc' class='error'></span><br/>
<label for='name' ><b>Surname*</b></label>
<input type='text' name='surname' id='name'  maxlength="50" />
<span id='register_name_errorloc' class='error'></span><br/>
<label for='email' ><b>Email Address*</b></label>
<input type='text' name='email' id='email'  maxlength="50" />
<span id='register_email_errorloc' class='error'></span><br/>
 <label for='email' ><b>Cell No*</b></label>
<input type='text' name='cell_no' id='cell_no' maxlength="50" /><br/>
 
<label for='username' ><b>UserName*</b></label>
<input type='text' name='username' id='username' maxlength="50" /><br/>
 
<label for='password' ><b>Password*</b></label>
<input type='password' name='password' id='password' maxlength="50" /><br/>
<label for='password' ><b>Confirm Password*</b></label>
<input type='password' name='c_password' id='c_password' maxlength="50" /><br/>
<input type='submit' name='Submit' value='Submit' />
 
</fieldset>
</form>
                 </div>
</div>
<script type='text/javascript'>
// <![CDATA[
    var pwdwidget = new PasswordWidget('thepwddiv','password');
    pwdwidget.MakePWDWidget();
    
    var frmvalidator  = new Validator("register");
    frmvalidator.EnableOnPageErrorDisplay();
    frmvalidator.EnableMsgsTogether();
    frmvalidator.addValidation("name","req","Please provide your name");

    frmvalidator.addValidation("email","req","Please provide your email address");

    frmvalidator.addValidation("email","email","Please provide a valid email address");

    frmvalidator.addValidation("username","req","Please provide a username");
    
    frmvalidator.addValidation("password","req","Please provide a password");

// ]]>
</script>
        </div>
         </div>
     </div>

