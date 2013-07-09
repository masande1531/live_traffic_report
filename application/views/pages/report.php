
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
                <h2>Report a problem</h2>
                <br/>

               <div id="register" class="animate form"> 

               <?php echo '<div id="error">'. validation_errors(); ?></div>

                <?php echo form_open('page/report') ?>
                <label for="subject">Subject</label> 
                <input type="input" name="subject" /><br />
                <label for="location">location</label> 
                <input type="input" name="location" /><br />
                <label for="details">details</label> &nbsp;
                <textarea name="details" rows="5" cols="30"></textarea><br />

             &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;
                <input type="submit" name="submit" value=" Send " /> 

                </form>
            </div>
        </div>
        </div>

    </div>
    <!-- end content -->
    <br style="clear: both;" />
</div>
<!-- end page -->
<!-- start footer -->
