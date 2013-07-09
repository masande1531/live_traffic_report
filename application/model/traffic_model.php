<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Traffic_model extends CI_Model {

    //public $new_password = 'substr(md5(uniqid()), 0, 10)';

    public function __construct() {
        $this->load->database();
        $this->load->library('session');
    }

    public function get_reports($limit, $offset) {

        $this->db->limit($limit, $offset);
        $query = $this->db->get('reports');
        return $query->result();
    }

    public function recent() {

        $this->db->limit(7, 0);
        $this->db->order_by("r_id", "desc");
        $query = $this->db->get('reports');

        return $query->result();
    }

    public function set_news() {
        $this->load->helper('url');

        $slug = url_title($this->input->post('subject'), 'dash', TRUE);

        $data = array(
            'r_id' => 0,
            'r_date' => date('Y-m-d H:i:s'),
            'r_subject' => $this->input->post('subject'),
            'r_location' => $this->input->post('location'),
            'r_details' => $this->input->post('details'),
            'r_status' => 0
        );

        return $this->db->insert('reports', $data);
    }

    function get_search() {
        // Execute our SQL statement and return the result
        $match = $this->input->post('q');

        $this->db->like('r_subject', $match);
        $this->db->or_like('r_location', $match);
        $this->db->limit(5, 0);
        $query = $this->db->get('reports');
        return $query->result();
    }

    function validate() {
        $this->db->where('username', $this->input->post('username'));
        $this->db->where('password', md5($this->input->post('password')));
        $this->db->where('confirmcode', 'y');
        $query = $this->db->get('reg');

        if ($query->num_rows == 1) {
            return true;
        }
    }

    function signup() {
        $code = $this->MakeConfirmationMd5();
        $data = array(
            'id_user' => 0,
            'name' => $this->input->post('name'),
            'surname' => $this->input->post('surname'),
            'email' => $this->input->post('email'),
            'phone_number' => $this->input->post('cell_no'),
            'username' => $this->input->post('username'),
            'password' => md5($this->input->post('password')),
            'confirmcode' => $code
        );

        //Send email

        $confirm_url = $this->traffic_model->GetAbsoluteURLFolder() . '/confirm_register/' . $code;


        $this->email->from('info@satrafficupdates.co.za');

        $this->email->to($this->input->post('email'));
        $this->email->set_mailtype("html");
        $this->email->subject('Confirm registration');
        $message = "Hello " . ucfirst($this->input->post('username')) . "<br/>" .
                "Thanks for your registration with www.satrafficupdates.co.za <br/>" .
                "Please click the link below to confirm your registration.<br/>" .
                "$confirm_url<br/>" .
                "<br/>" .
                "Regards,<br/>" .
                "Webmaster <br/>
          www.satrafficupdates.co.za
          ";
        $this->email->message($message);

        if ($this->db->insert('reg', $data) && $this->email->send()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function get_name() {

        $this->db->where('username', $this->input->post('username'));
        $query = $this->db->get('reg');

        if ($query->num_rows > 1) {
            $row = $query->row();
            $row->username;
        }
    }

    function get_email() {

        $this->db->where('email', $this->input->post('email'));
        $query = $this->db->get('reg');

        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    //Create confirmation code
    function MakeConfirmationMd5() {
        $randno1 = rand();
        $randno2 = rand();
        return md5($this->input->post('email') . $randno1 . '' . $randno2);
    }

    function confirm_verify() {
        $match = $this->uri->segment(3);

        $this->db->select('confirmcode');
        $this->db->where('confirmcode', $match);
        $query = $this->db->get('reg');
        $query->result();


        if ($query->num_rows > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function update_confirmcode() {
        $match = $this->uri->segment(3);

        if ($match != NULL || $match != "") {

            $this->db->set('confirmcode', 'y');
            $this->db->where('confirmcode', $match);

            $query = $this->db->update('reg');

            if ($query) {
                return TRUE;
            } else {
                return FAlSE;
            }
        }
    }

    function update_password() {

        $new_password = substr(md5(uniqid()), 0, 10);
        if ($this->get_email()) {
            $this->db->set('password', md5($new_password));
            $this->db->where('email', $this->input->post('email'));
            $this->db->where('confirmcode', 'y');
            $query = $this->db->update('reg');


            //send email after updating the password
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
            $this->email->subject('Your new password');

            $message = "Hello " . ucfirst($this->get_name_by_email()) . "<br/><br/>" .
                    "Your password is reset successfully. <br/><br/>" .
                    "Here is your updated login:<br/>" .
                    "username:" . ucfirst($this->get_username_by_email()) .
                    "<br/>password:" . $new_password . "<br/>" .
                    "<br/>" .
                    "Login here: " . $this->GetAbsoluteURLFolder() . "/login<br/>" .
                    "<br/>" .
                    "Regards,<br/>" .
                    "Webmaster<br/>" .
                    'www.satrafficupdates.co.za';
            $this->email->message($message);

            if ($query && $this->email->send()) {
                return TRUE;
            } else {
                return FAlSE;
            }
        }
    }

    public function getuser_id($user_email) {
        $this->db->select('id_user')->from('reg')->where('email', $user_email);
        $query = $this->db->get()->row();

        return $query; // Don't forget to return your results!
    }

    function get_username_by_email() {

        $this->db->where('email', $this->input->post('email'));
        $query = $this->db->get('reg');

        if ($query->num_rows > 0) {
            $row = $query->row();
            return $row->username;
        }
    }

    function get_name_by_email() {

        $this->db->where('email', $this->input->post('email'));
        $query = $this->db->get('reg');

        if ($query->num_rows > 0) {
            $row = $query->row();
            return $row->name;
        }
    }

    function get_new_user($uri) {

        $this->db->where('confirmcode', $uri);
        $query = $this->db->get('reg');

        if ($query->num_rows > 0) {
            $row = $query->row();
            $results = 'Name: ' . ucfirst($row->name) . '<br/>';
            $results .= 'Email: ' . ucfirst($row->email) . '<br/>';
            return $results;
        } else {
            return 'User data not returned ' . $uri;
        }
    }

    function change_password($username) {
        
      
            
            $this->db->set('password', md5($this->input->post('new_password')));
            $this->db->where('username', $username);

            $query = $this->db->update('reg');
        if( $query){
            echo 'password changed';
        }else{
            return FALSE;
        }
       
        
    }

    function get_password($username) {
        $this->load->library('session');
        
        $this->db->where('username', $username);
        $query = $this->db->get('reg');

        if ($query->num_rows > 0) {
            $row = $query->row();
            $results = $row->password;

            return $results;
        } else {
            return FALSE;
        }
    }

    function GetAbsoluteURLFolder() {
        $scriptFolder = (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on')) ? 'https://' : 'http://';
        $scriptFolder .= $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI']);
        return $scriptFolder;
    }

}

?>
