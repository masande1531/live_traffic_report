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
                <h2>Recent  Reports</h2>

                <?
                
                foreach ($query as $row) {

                    print '<a href=#>' . $row->r_subject . '</a> ';
                    print '<br/>';
                    print $row->r_location;
                    print '<br/>';
                    print $row->r_details;
                    print '<br/><br/><br/>';
                }
                ?>
                <?php echo $this->pagination->create_links(); ?>
            </div>
<p>Page rendered in <strong>{elapsed_time}</strong> seconds</p>
        </div>

    </div>
    <!-- end content -->
    <br style="clear: both;" />
</div>
<!-- end page -->
<!-- start footer -->
