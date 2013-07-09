
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
                    <style>
                        .form-1 {
                            /* Size & position 
                            width: 400px;
                            margin: 30px auto 30px;
                            padding: 10px;
                            position: relative; /* For the submit button positioning */

                            /* Styles 
                            box-shadow:
                                0 0 1px rgba(0, 0, 0, 0.3),
                                0 3px 7px rgba(0, 0, 0, 0.3),
                                inset 0 1px rgba(255,255,255,1),
                                inset 0 -3px 2px rgba(0,0,0,0.25);
                            border-radius: 5px;
                            background: linear-gradient(#eeefef, #ffffff 10%);
                        }

                        .form-1 .field {
                            position: relative; /* For the icon positioning 
                        }
                        .form-1 .field i {
                            /* Size and position 
                            left: 0px;
                            top: 0px;
                            position: absolute;
                            height: 36px;
                            width: 36px;

                            /* Line 
                            border-right: 1px solid rgba(0, 0, 0, 0.1);
                            box-shadow: 1px 0 0 rgba(255, 255, 255, 0.7);

                            /* Styles 
                            color: #777777;
                            text-align: center;
                            line-height: 42px;
                            transition: all 0.3s ease-out;
                            pointer-events: none;
                        }
                        .form-1 a{
                            font-size: small;
                        }*/
                    </style>
                  <div id="register" class="animate form"> 
     
               <?php echo $this->session->flashdata('message');
                  echo validation_errors(); 
                echo form_open('page/change_password')?>

                <fieldset>
                    <legend>Change password</legend>

                    <input type='hidden' name='submitted' id='submitted' value='1'/>

                    <label for='username' ><b>Old password*:</b></label>
                    <div></div>

                    <input type='password' name='old_password'  id='username'  maxlength="50" />
                    <span id='login_username_errorloc' class='error'></span><p></p>
                    <label for='password' ><b>New password*:</b></label><br/>
                    <input type='password' name='new_password' id='password' maxlength="50" />
                    <span id='login_password_errorloc' class='error'></span><br/><p></p>
                    <label for='password' ><b>Confirm new password*:</b></label><br/>
                    <input type='password' name='c_new_password' id='password' maxlength="50" />
                    <span id='login_password_errorloc' class='error'></span><br/>
                    <input type='submit' name='Submit' value=' Change password ' /><br/>

                    </form>



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
