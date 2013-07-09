<!-- start page -->
<div id="page">
  <!-- start sidebar -->
	<div id="sidebar">
		<? $this->load->view('pages/side_bar.php'); ?>
	</div>
	<!-- end sidebar -->
	<!-- start content -->
    <div id="content">
        <div class="post">
            <div class="title">

                <br/><small><a href="http://localhost/ci_traffic/index.php/view_report">View Reports</a> | <a href="http://localhost/ci_traffic/index.php/report">Report</a> | <a href="http://localhost/ci_traffic/">Live Traffic</a></small><br/><br/>
            </div>
            <div class="entry">
               
                <div id="login_form">
                       <?php
                echo form_open('page/validate_credentials')?>
 <div id="register" class="animate form"> 
                <fieldset>
                    <legend>Login</legend>
                    <?php echo validation_errors(); ?>
                    <div id="flash"><?php echo $this->session->flashdata('message');?></div><br/>
                    <input type='hidden' name='submitted' id='submitted' value='1'/>

                    <label for='username' ><b>UserName*:</b></label>
                    <div></div>

                    <input type='text' name='username'  id='username'  maxlength="50" />
                    <span id='login_username_errorloc' class='error'></span><p></p>
                    <label for='password' ><b>Password*:</b></label><br/>
                    <input type='password' name='password' id='password' maxlength="50" />
                    <span id='login_password_errorloc' class='error'></span>

                    <input type='submit' name='Submit' value=' Login ' /><br/>

                    <a href="http://localhost/ci_traffic/index.php/page/register">Create Account</a>

                    </form>


                    <div class='short_explanation'><a href="http://localhost/ci_traffic/index.php/page/reset">Forgot Password?</a></div>

                </fieldset>
            </div>
            </div><!-- end login_form-->
        </div>

    </div>

</div>
<!-- end content -->
<br style="clear: both;" /><br style="clear: both;" /><br style="clear: both;" />
</div>
<!-- end page -->
<!-- start footer -->
