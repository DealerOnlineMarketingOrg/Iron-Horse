<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Members extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->helper('pass');
        $this->load->helper('string_parser');
    }
    /**
     * 
     * @param string $email
     * @param string $pass
     * @return boolean
     * 
     * This function is used to check if the user is a valid user and thats it.
     */
    public function check_user($email, $pass) {
        
        $email = $this->security->xss_clean($email);
        $pass  = encrypt_password($this->security->xss_clean($pass));
        
        $sql = 'SELECT u.User_Name,ui.USER_Password,u.USER_ID FROM Users u INNER JOIN Users_Info ui ON u.USER_ID = ui.USER_ID WHERE u.USER_Name = "' . $email . '" AND ui.USER_Password = "' . $pass . '";';
        $query = $this->db->query($sql);
        
        if($query->num_rows == 1) {
            return $query;
        }else {
            return FALSE;
        }
        
        return FALSE;
    }
    
<<<<<<< HEAD
	public function validate() {
		$email = $this->security->xss_clean($this->input->post('email'));
		$password = encrypt_password($this->security->xss_clean($this->input->post('password')));
		
		$sql = "SELECT u.*,ui.*,d.*,sa.*,c.*,g.*,a.* FROM Users u
				INNER JOIN Users_Info ui ON u.USER_ID = ui.USER_ID
				INNER JOIN Directories d ON d.DIRECTORY_ID = ui.DIRECTORY_ID
				INNER JOIN xSystemAccess sa ON sa.ACCESS_ID = ui.Access_ID
				INNER JOIN Clients c ON c.CLIENT_ID = ui.CLIENT_ID
				INNER JOIN Groups g ON g.GROUP_ID = c.GROUP_ID
				INNER JOIN Agencies a ON a.AGENCY_ID = g.AGENCY_ID
				WHERE u.USER_Name = '" . $email . "' AND ui.USER_Password = '" . $password . "';"; 
				
		$query = $this->db->query($sql);
			
	   if($query->num_rows() == 1) {
		   $row = $query->row();
		   //This array becomes our session array, any data we want to travel from page to page, needs to be defined here.
		   $data = array(
			   'Username' 		=> (string)$row->USER_Name,
			   'FirstName' 		=> (string)$row->DIRECTORY_FirstName,
			   'LastName' 		=> (string)$row->DIRECTORY_LastName,
			   'Emails' 		=> (object)mod_parser($row->DIRECTORY_Email),
			   'UserID' 		=> (int)$row->USER_ID,
			   'DirectoryID' 	=> (int)$row->DIRECTORY_ID,
			   'ClientID' 	    => (int)$row->CLIENT_ID,
			   'GroupID' 	    => (int)$row->GROUP_ID,
			   'AgencyID' 	    => (int)$row->AGENCY_ID,
			   'ClientName' 	=> (string)$row->CLIENT_Name,
			   'ClientAddress' 	=> (object)group_parser($row->CLIENT_Address),
			   'ClientPhone' 	=> (object)group_parser($row->CLIENT_Phone),
			   'ClientNotes' 	=> (string)$row->CLIENT_Notes,
			   'ClientCode' 	=> (string)$row->CLIENT_Code,
			   'ClientTags' 	=> (string)$row->CLIENT_Tags,
			   'ClientActive' 	=> (bool)$row->CLIENT_Active,
			   'ClientActiveTS' => date(FULL_MILITARY_DATETIME, strtotime($row->CLIENT_ActiveTS)),
			   'AccessLevel' 	=> (int)$row->ACCESS_Level,
			   'AccessName' 	=> (string)$row->ACCESS_Name,
			   'UserPerm' 		=> (object)mod_parser($row->USER_Perm),
			   'isActive' 		=> (bool)$row->USER_Active,
			   'TimeActive' 	=> date(FULL_MILITARY_DATETIME, strtotime($row->USER_ActiveTS)),
			   'isGenerated' 	=> (int)$row->USER_Generated,
			   'CreatedOn' 		=> date(FULL_MILITARY_DATETIME, strtotime($row->USER_Created)),
			   'validated' 		=> (bool)TRUE
		   );
		   
		   $this->session->set_userdata('valid_user',$data);
		   return (object)$data;
		   
		   //Start drop down default insert for session
		   $ClientID = $data['ClientID'];
		   $GroupID = $data['GroupID'];
		   $AgencyID = $data['AgencyID'];
		   $AccessLevel = $data['AccessLevel'];
		   //process levels of users for drop down
		   if ($AccessLevel<200000) :
		    $data1 = array(
			   'LevelID' 		=> $AgencyID,
			   'LevelType' 		=> 'SA'
	   		);
			elseif ($AccessLevel>200000&&$AccessLevel<300000):
			$data1 = array(
			   'LevelID' 		=> $AgencyID,
			   'LevelType' 		=> 'A'
	   		);
			elseif ($AccessLevel>300000&&$AccessLevel<400000):
			$data1 = array(
			   'LevelID' 		=> $GroupID,
			   'LevelType' 		=> 'G'
	   		);
			else:
			$data1 = array(
			   'LevelID' 		=> $ClientID,
			   'LevelType' 		=> 'C'
	   		);
		   endif;
		   //set session to correct level for dropdown
		   $this->session->set_userdata('DropdownDefault',$data1);
		   
	   }
	   return FALSE;
   }    
    public function reset_password($email,$new_pass) {
		
		$email = $this->security->xss_clean($this->input->post('email'));
		$new_pass = createRandomString(8,'ALPHANUM');
=======
    public function validate() {
        $email 		= $this->security->xss_clean($this->input->post('email'));
        $password 	= encrypt_password($this->security->xss_clean($this->input->post('password')));

        $sql 		= "SELECT u.*,ui.*,d.*,sa.*,c.* FROM Users u
                	   INNER JOIN Users_Info ui ON u.USER_ID = ui.USER_ID
                       INNER JOIN Directories d ON d.DIRECTORY_ID = ui.DIRECTORY_ID
                       INNER JOIN xSystemAccess sa ON sa.ACCESS_ID = ui.Access_ID
                	   INNER JOIN Clients c ON c.CLIENT_ID = ui.CLIENT_ID
                	   WHERE u.USER_Name = '" . $email . "' AND ui.USER_Password = '" . $password . "';"; 

        $query 		= $this->db->query($sql);
			
        if($query->num_rows() == 1) {
            $row 	= $query->row();
            //This array becomes our session array, any data we want to travel from page to page, needs to be defined here
            $data   = array(
                'Username' 		=> (string)$row->USER_Name,
                'FirstName' 	=> (string)$row->DIRECTORY_FirstName,
                'LastName' 		=> (string)$row->DIRECTORY_LastName,
                'Emails' 		=> (object)mod_parser($row->DIRECTORY_Email),
                'UserID' 		=> (int)$row->USER_ID,
                'DirectoryID' 	=> (int)$row->DIRECTORY_ID,
                'ClientName' 	=> (string)$row->CLIENT_Name,
                'ClientAddress' => (object)group_parser($row->CLIENT_Address),
                'ClientPhone' 	=> (object)group_parser($row->CLIENT_Phone),
                'ClientNotes' 	=> (string)$row->CLIENT_Notes,
                'ClientCode' 	=> (string)$row->CLIENT_Code,
                'ClientTags' 	=> (string)$row->CLIENT_Tags,
                'ClientActive' 	=> (bool)$row->CLIENT_Active,
                'ClientActiveTS'=> date(FULL_MILITARY_DATETIME, strtotime($row->CLIENT_ActiveTS)),
                'AccessLevel' 	=> (int)$row->ACCESS_Level,
                'AccessName' 	=> (string)$row->ACCESS_Name,
                'UserPerm' 		=> (object)mod_parser($row->USER_Perm),
                'isActive' 		=> (bool)$row->USER_Active,
                'TimeActive' 	=> date(FULL_MILITARY_DATETIME, strtotime($row->USER_ActiveTS)),
                'isGenerated' 	=> (int)$row->USER_Generated,
                'CreatedOn' 	=> date(FULL_MILITARY_DATETIME, strtotime($row->USER_Created)),
                'validated' 	=> (bool)TRUE
            );

            $this->session->set_userdata('valid_user',$data);
            return (object)$data;
        }
        return FALSE;
    }    
	
    public function reset_pass() {
>>>>>>> Changes
		
        $email = $this->security->xss_clean($this->input->post('email'));
        $new_pass = createRandomString(8,'ALPHANUM');
        
	
        $sql = 'SELECT * FROM Users WHERE USER_Name = "' . $email . '";';
        $query = $this->db->query($sql);
        
        if($query->num_rows() == 1) {
            $user_row = $query->row();
            $user_id = $user_row->USER_ID;
            
            $update_sql = "UPDATE Users_Info SET USER_Password = '" . encrypt_password($new_pass) . "', USER_Generated='1' WHERE USER_ID = '" . $user_id . "';";
            
            $update = $this->db->query($update_sql);
            
            if($update) {
                //return TRUE;
                $subject = 'Password Reset';
                $msg = 'Your password at dealeronlinemarketing.com has been reset to ' . $new_pass . ' please login to change it to something you can remember.';
                $emailed = $this->email_results($email, $subject, $msg);
                
                if($emailed) {
                    return TRUE;
                }else {
                    return FALSE;
                }
            }else {
                return FALSE;
            }
        }
        return FALSE;
    }
    
    public function password_change() {
        $email 			= $this->security->xss_clean($this->input->post('email'));
        $password 		= $this->security->xss_clean(encrypt_password($this->input->post('new_pass')));
        //Get the user id
        $user_sql 		= "SELECT USER_ID from Users WHERE USER_Name = '" . $email . "';";
        $user 			= $this->db->query($user_sql);
        if($user->num_rows() == 1) :
            $user_id 	= $user->row()->USER_ID;

            //update the password based on the user id
            $update_sql = "UPDATE Users_Info SET USER_Password = '" . $password . "', USER_Generated='0' WHERE USER_ID = '" . $user_id . "';";
            $update = $this->db->query($update_sql);

            //if the update successfully triggers return true, else false;
            if($update) :
                return TRUE;
            else:
                return FALSE;
            endif;
        else :
            return FALSE;
        endif;
    }
    
    public function email_results($email, $subject, $msg) {
        
        $this->load->library('email');
        $this->email->from('no-reply@dealeronlinemarketing.com','Dealer Online Marketing');
        $this->email->to($email);
        $this->email->subject($subject);
        $this->email->message($msg);
        
        if($this->email->send()) :
            return TRUE;
        else :
            return FALSE;
        endif;        
        
    }
    
}