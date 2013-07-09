<?php

/* Author: Masande
 * Title: Page Controller
 * Description: All the pages are being dispatch in this page
 * 
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Page extends CI_Controller {
    
    public function __construct(){
          parent::__construct();      

        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('traffic_model');
        $this->load->library('pagination');
        
                
         //config
       $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'mail.gmims.co.za',
            'smtp_port' => 25,
            'smtp_user' => 'admin@gmims.co.za',
            'smtp_pass' => '*******',
             'mailtype' => 'html',
            'charset' => 'utf-8',
            'wordwrap' => TRUE
        );

        $this->load->library('email', $config);
        
        
    }

    function login($page = 'login_form') {

        $data['title'] = ucfirst($page); // Capitalize the first letter

        


        $this->load->view('include/header.inc');
        $this->load->view('pages/' . $page, $data);
        $this->load->view('include/footer.inc');
    }

    public function index($page = 'home') {
        //$this->load->view('welcome_message');

        $data['query'] = $this->traffic_model->recent();
        $data['title'] = ucfirst($page); // Capitalize the first letter

        $this->load->view('include/header.inc');
        $this->load->view('pages/' . $page, $data);
        $this->load->view('include/footer.inc');
    }

    public function about($page = 'about') {
        //$this->load->view('welcome_message');

        $this->load->model('traffic_model');
        $data['query'] = $this->traffic_model->recent();

        $data['title'] = ucfirst($page); // Capitalize the first letter

        $this->load->view('include/header.inc');
        $this->load->view('pages/' . $page, $data);
        $this->load->view('include/footer.inc');
    }

    public function contact($page = 'contact') {
        //$this->load->view('welcome_message');
        $this->load->model('traffic_model');
        $data['query'] = $this->traffic_model->recent();

        $data['title'] = ucfirst($page); // Capitalize the first letter

        $this->load->view('include/header.inc');
        $this->load->view('pages/' . $page, $data);
        $this->load->view('include/footer.inc');
    }

    public function view_report($page = 'view_report') {
        if (!$this->session->userdata('username')) {
            $this->login();
            //redirect();
        } else {


            $config['base_url'] = base_url('index.php/view_report');
            $config['first_link'] = 'First';
            $config['use_page_numbers'] = TRUE;
            $config['total_rows'] = $this->db->get('reports')->num_rows();
            $config['per_page'] = 5;
            $config['uri_segment'] = 3;
            $config['num_links'] = 2;

            $this->uri->segment(3, 0);
            $this->pagination->initialize($config);
            $data['query'] = $this->traffic_model->get_reports(5, 0);

            $data['title'] = ucfirst($page); // Capitalize the first letter

            $this->load->view('include/header.inc');
            $this->load->view('pages/' . $page, $data);
            $this->load->view('include/footer.inc');
        }
    }

    public function report($page = 'report') {

        if (!$this->session->userdata('username')) {
            $this->login();
            //redirect();
        } else {

        



            $data['title'] = ucfirst($page); // Capitalize the first letter
            $data['query'] = $this->traffic_model->recent();
            $this->form_validation->set_rules('subject', 'Subject', 'required');
            $this->form_validation->set_rules('details', 'Details', 'required');

            if ($this->form_validation->run() === FALSE) {
                $this->load->view('include/header.inc');
                $this->load->view('pages/' . $page, $data);
                $this->load->view('include/footer.inc');
            } else {

                $this->traffic_model->set_news();
                $this->load->view('include/header.inc');
                $this->load->view('pages/success');
                $this->load->view('include/footer.inc');
            }
        }
    }

    function validate_credentials() {
      
        $query = $this->traffic_model->validate();
        
        $this->form_validation->set_error_delimiters('<div id="error">', '</div>');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($query) { // if the user's credentials validated...
            $data = array(
                'username' => $this->input->post('username'),
                'is_logged_in' => true
            );
            $this->session->set_userdata($data);
            redirect('view_report');
        } else { // incorrect username or password
             $this->session->set_flashdata('message', 'Error!  incorrect username/password');
            $this->login();
        }
    }

    public function search($page = 's') {
        //$this->load->view('welcome_message');

     
        $config['base_url'] = 'http://localhost/ci_traffic/index.php/page/search';
        $config['first_link'] = 'First';
        $config['total_rows'] = $this->db->get('reports')->num_rows();
        $config['per_page'] = 2;
        $config['uri_segment'] = 3;
        $config['num_links'] = 2;
        //  $this->uri->segment(4);
        $this->pagination->initialize($config);

        $data['query'] = $this->traffic_model->get_search();
        $data['title'] = ucfirst($page); // Capitalize the first letter

        $this->load->view('include/header.inc');
        $this->load->view('pages/search', $data);
        $this->load->view('include/footer.inc');
    }

    function register($page = "signup_form") {
  

        $this->form_validation->set_error_delimiters('<div id="error">', '</div>');
        $data['title'] = ucfirst($page); // Capitalize the first letter
        $this->load->view('include/header.inc');
        $this->load->view('pages/' . $page, $data);
        $this->load->view('include/footer.inc');
    }

    function reset($page = "reset_form") {
      


        $data['title'] = ucfirst($page); // Capitalize the first letter
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|unique[users.email]|callback_email_check');
        $this->load->view('include/header.inc');
        $this->load->view('pages/' . $page, $data);
        $this->load->view('include/footer.inc');
    }

    function submit_register($page = "submit_register") {


        $data['title'] = ucfirst($page);

        $this->form_validation->set_error_delimiters('<div id="error">', '</div>');
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('surname', 'Surname', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|unique[users.email]');
        $this->form_validation->set_rules('cell_no', 'cell_no', 'trim|required|matches_pattern[###########]');
        $this->form_validation->set_rules('username', 'Username', 'required|min_length[4]');
        $this->form_validation->set_rules('password', 'Password', 'trim|equired|min_length[6]|matches[c_password]');
        $this->form_validation->set_rules('c_password', 'Password Confirmation', 'trim|required|min_length[6]');



        if (!$this->form_validation->run()) {
            $this->register();
        } else {

            if ($this->traffic_model->signup()) {
                
                $this->load->view('include/header.inc');
                $this->load->view('pages/thank-you.php');
                $this->load->view('include/footer.inc');
            }
        }
    }

    function GetEmail($email) {


        $result = @mysql_query("Select email from reg where email='$email'");

        if (!$result || mysql_num_rows($result) <= 0) {

            return false;
        }
        return true;
    }

    function GetUsername($username) {


        $result = @mysql_query("Select username from reg where username='$username'");

        if (!$result || mysql_num_rows($result) <= 0) {

            return false;
        }
        return true;
    }

  

    public function username_check($str) {
      

        $data = $this->traffic_model->get_name();

        if ($str == $data) {
            $this->form_validation->set_message('username_check', 'The %s field can not be the word "' . $data . '"');
            return FALSE;
        } else {
            return TRUE;
        }
    }

   

    public function email_check() {
     
       
        if(!$this->traffic_model->get_email()){
             $this->form_validation->set_message('email_check', 'The %s field can not be the found');
             return FALSE;
        }

    }

    function register_complete(){
     
        //$data['title'] = ucfirst($page); // Capitalize the first letter
        $this->load->view('include/header.inc');
        $this->load->view('pages/register_complete.php' );
        $this->load->view('include/footer.inc');
     
    }
    //Confirm Register
    function confirm_register($page='confirm_register'){
      
        
       if($this->traffic_model->confirm_verify()==TRUE)
       {
           //Update the comfirmation code and redirect to register complete page
           $this->new_user_email($this->uri);
           $this->traffic_model->update_confirmcode();
           $this->register_complete();
       }  else {//Redirect to to confirmation page
                    echo'Confirmsation code does not match ';
                    
                    
              }
     
    }
    
    function new_user_email(){
        
        
        
        
        $this->email->from('info@satrafficupdates.co.za');

        $this->email->to('mmbondwana@gmail.com');
        $this->email->set_mailtype("html");
        $this->email->subject('Registration Completed:');
        $message = "A new user registered at www.satrafficupdates.co.za<br/>" .
        $this->traffic_model->get_new_user($this->uri->segment(3)).
       
          "<br/>" .
          "Regards,<br/>" .
          "Webmaster <br/>
          www.satrafficupdates.co.za
          ";
        $this->email->message($message);
       if ($this->email->send()) {
              
            return TRUE;
        } else {
           echo $this->email->print_debugger();
           return FALSE;
        }



        
    }


    //Confirm page plus error message
    function confirm_page(){
         $this->load->view('include/header.inc');
        $this->load->view('pages/register_complete.php' );
        $this->load->view('include/footer.inc');
    }
    //Send confirm registration email
   
    function confirm_email() {
     

        $confirm_url = $this->traffic_model->GetAbsoluteURLFolder().'/confirm_register/' . $this->traffic_model->MakeConfirmationMd5();
      

        $this->email->from('info@satrafficupdates.co.za');

        $this->email->to($this->input->post('email'));
        $this->email->set_mailtype("html");
        $this->email->subject('Confirm registration');
        $message = "Hello " . $this->input->post('username'). "<br/>" .
          "Thanks for your registration with www.satrafficupdates.co.za <br/>" .
          "Please click the link below to confirm your registration.<br/>" .
          "$confirm_url<br/>" .
          "<br/>" .
          "Regards,<br/>" .
          "Webmaster <br/>
          www.satrafficupdates.co.za
          ";
        $this->email->message($message);
       if ($this->email->send()) {
              echo 'Message was sent';
            //return TRUE;
        } else {
           echo $this->email->print_debugger();
           //return FALSE;
        }




    }
    
    function reset_message()
    {
        $this->load->view('include/header.inc');
        $this->load->view('pages/reset_message.php' );
        $this->load->view('include/footer.inc');
    }
    //Reset password
    
    function reset_password()
    {
        $this->form_validation->set_error_delimiters('<div id="error">', '</div>');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|unique[users.email]|callback_email_check');
        
        if( $this->traffic_model->update_password())
        {
            
            $this->reset_complete();
        }else{
            
           $this->reset();
        }
        
        
    }
    
    /*/Email New Password
    
    function email_new_password()
    {  
          $config = Array(
            'protocol' => 'sendmail',
             'mailtype' => 'html',
            'charset' => 'utf-8',
            'wordwrap' => TRUE
        );
        $this->load->library('email', $config);

        $this->email->from('info@satrafficupdates.co.za');

        $this->email->to($this->input->post('email'));
        $this->email->set_mailtype("html");
        $this->email->subject('This is an email test');
        
        $message = "Hello <br/><br/>" .
            "Your password is reset successfully. <br/>" .
            "Here is your updated login:<br/>" .
            "username:<br/>" .
            "password:".$this->traffic_model->new_password(). "<br/>" .
            "<br/>" .
            "Login here: " . $this->traffic_model->GetAbsoluteURLFolder() . "/login<br/>" .
            "<br/>" .
            "Regards,<br/>" .
            "Webmaster<br/>" .
            'www.satrafficupdates.co.za';
        $this->email->message($message);
        if ($this->email->send()) {

            return TRUE;
        } else {

           return FALSE;
        }


        
    }*/
    
    function reset_complete(){
        
        $this->load->view('include/header.inc');
        $this->load->view('pages/reset_complete.php' );
        $this->load->view('include/footer.inc');
    }




    function change_password(){
        
        
       if (!$this->session->userdata('username')) {
            $this->login();
            //redirect();
        }
        $this->load->view('include/header.inc');
        $this->load->view('pages/change_password_form.php' );
        $this->load->view('include/footer.inc');
        
        if(isset($_POST['Submit'])){
            
        $this->form_validation->set_error_delimiters('<div id="error">', '</div>');
        $this->form_validation->set_rules('old_password', 'Old_password', 'required|min_length[6]');
        $this->form_validation->set_rules('new_password', 'New_password', 'trim|equired|min_length[6]|matches[c_new_password]');
        $this->form_validation->set_rules('c_new_password', 'c_new_password', 'Password Confirmation', 'trim|required|min_length[6]');
        
        if (!$this->form_validation->run()) {
            $this->traffic_model->change_password($this->session->userdata('username'));
            echo 'password has been change'.$this->session->userdata('username');
            
        } 
        else{
            
               $this->traffic_model->change_password($this->session->userdata('username'));
             //  echo 'Password not changed';
        //       echo $this->input->post('old_password').$this->input->post('new_password').$this->input->post('c_new_password');
          $this->session->set_flashdata('message', 'Error Please make sure you fill in all field');
            /*if ($this->traffic_model->signup()) {
                
                $this->load->view('include/header.inc');
                $this->load->view('pages/thank-you.php');
                $this->load->view('include/footer.inc');
            }*/
    }
   // echo $this->traffic_model->get_password($this->session->userdata('username'));
 //      $this->traffic_model->change_password($this->session->userdata('username'));
        }
    }


    function is_logged_in() {
        $is_logged_in = $this->session->userdata('is_logged_in');
        if (!isset($is_logged_in) || $is_logged_in != true) {
            echo 'You don\'t have permission to access this page. <a href="../login">Login</a>';
            die();
            //$this->load->view('login_form');
        }
    }

    function logout() {
        $this->session->sess_destroy();
        redirect('page/login', 'refresh');
    }
    
    function live_traffic() {
                
               
                $this->load->view('pages/live_traffic.php');
               
            }

}
