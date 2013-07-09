<script type='text/javascript' src='scripts/gen_validatorv31.js'></script>
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

<!-- Form Code Start -->


<form id='confirm' action='p_confirm.php' method='get' accept-charset='UTF-8'>
<fieldset>
<legend>Confirm registration</legend>
<p>
Please enter the confirmation code in the box below
</p>

    <label for='code' ><b>Confirmation Code:*</b> </label><br/>
    <input type='text' name='code' id='code' maxlength="50" /><br/>
    <span id='register_code_errorloc' class='error'></span>


    <input type='submit' name='Submit' value='Submit' />

</fieldset>
</form>
            </div>
        </div>
    </div>
