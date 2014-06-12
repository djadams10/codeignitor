<?php
//don't forget to setup that config/database.php file.

class Admin_model extends CI_Model {
    function __construct(){
        
    }
    
    public function verify_user($email, $password){
        // echo sha1('mypassword'); die(); //use this to generate sha1 encrypted password in no registration setup
        
        $q = $this
            ->db
            ->where('email_address', $email)
            ->where('password', sha1($password))
            ->limit(1)
            ->get('users');
            
        if ( $q->num_rows > 0 ) {
            //return $q->result(); //if you had multiple results, you would do this, but since we only have 1, no
            
            //echo '<pre>'; // use this for debugging - test that you are getting the correct output back.
            //print_r($q->row()); 
            //echo '</pre>';
            
            return $q->row();

        }
        return false;
    }
}