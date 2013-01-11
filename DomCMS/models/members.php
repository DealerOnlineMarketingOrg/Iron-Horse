<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Members extends CI_Model {

    public function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->load->helper('pass');
		$this->load->helper('string_parser');
    }
    
	public function validate() {
		$email 		= $this->security->xss_clean($this->input->post('email'));
		$password 	= encrypt_password($this->security->xss_clean($this->input->post('password')));
		
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
		   //Start drop down default insert for session
		   $ClientID 	= $row->CLIENT_ID;
		   $GroupID 	= $row->GROUP_ID;
		   $AgencyID 	= $row->AGENCY_ID;
		   $AccessLevel = $row->ACCESS_Level;
		   
		   //process levels of users for drop down
		   //If the access level is greater than or equel to 600,000 (SuperAdmin)
		   if($AccessLevel >= 600000) : 
				$dropdown_defaults = array(
				   'LevelID' 		=> $AgencyID,
				   'PermType' 		=> 'SuperAdmin',
				   'PermLevel'		=> 600000,
				   'LevelType'      => 1,
				   'SelectedID' 	=> FALSE,
				   'SelectedAgency' => FALSE,
				   'SelectedGroup' => FALSE,
				   'SelectedClient' => FALSE,
				   'SelectedTag'	=> FALSE
				);
			//If the access level is less than 600,000 and greater than or equel to 500,000
			elseif($AccessLevel < 600000 && $AccessLevel >= 500000) : 
				$dropdown_defaults = array(
				   'LevelID' 		=> $AgencyID,
				   'PermType' 		=> 'AgencyAdmin',
				   'PermLevel'		=> 500000,
				   'LevelType'      => 2,
				   'SelectedID' 	=> FALSE,
				   'SelectedAgency' => FALSE,
				   'SelectedGroup' => FALSE,
				   'SelectedClient' => FALSE,
				   'SelectedTag'	=> FALSE
				);
			//If the access level is less than 500,000 and greater than or equel to 400,000
			elseif($AccessLevel < 500000 && $AccessLevel >= 400000) :
				$dropdown_defaults = array(
				   'LevelID' 		=> $GroupID,
				   'PermType' 		=> 'GroupAdmin',
				   'PermLevel'		=> 400000,
				   'LevelType'      => 3,
				   'SelectedID' 	=> FALSE,
				   'SelectedAgency' => FALSE,
				   'SelectedGroup' => FALSE,
				   'SelectedClient' => FALSE,
				   'SelectedTag'	=> 'noshow'
				);
			elseif($AccessLevel < 400000 AND $AccessLevel >= 300000) :
				$dropdown_defaults = array(
				   'LevelID' 		=> $ClientID,
				   'PermType' 		=> 'ClientAdmin',
				   'PermLevel'		=> 300000,
				   'LevelType'      => 4,
				   'SelectedID' 	=> FALSE,
				   'SelectedAgency' => FALSE,
				   'SelectedGroup' => FALSE,
				   'SelectedClient' => FALSE,
				   'SelectedTag'	=> 'noshow'
				);
			elseif($AccessLevel < 300000 AND $AccessLevel >= 200000) :
				$dropdown_defaults = array(
				   'LevelID' 		=> $ClientID,
				   'PermType' 		=> 'Manager',
				   'PermLevel'		=> 200000,
				   'LevelType'      => 5,
				   'SelectedID' 	=> FALSE,
				   'SelectedAgency' => FALSE,
				   'SelectedGroup' => FALSE,
				   'SelectedClient' => FALSE,
				   'SelectedTag'	=> 'noshow'
				);
			else:
				$dropdown_defaults = array(
				   'LevelID' 		=> $ClientID,
				   'PermType' 		=> 'User',
				   'PermLevel'		=> 100000,
				   'LevelType'      => 6,
				   'SelectedID' 	=> FALSE,
				   'SelectedAgency' => FALSE,
				   'SelectedGroup' => FALSE,
				   'SelectedClient' => FALSE,
				   'SelectedTag'	=> 'noshow'
				);
		   endif;

		   $data = array(
			   'Username' 		 => (string)$row->USER_Name,
			   'FirstName' 		 => (string)$row->DIRECTORY_FirstName,
			   'LastName' 		 => (string)$row->DIRECTORY_LastName,
			   'Emails' 		 => (object)mod_parser($row->DIRECTORY_Email),
			   'Gravatar'		 => (string)$row->USER_GravatarEmail,
			   'UserID' 		 => (int)$row->USER_ID,
			   'DirectoryID' 	 => (int)$row->DIRECTORY_ID,
			   'ClientID' 	     => (int)$row->CLIENT_ID,
			   'GroupID' 	     => (int)$row->GROUP_ID,
			   'AgencyID' 	     => (int)$row->AGENCY_ID,
			   'ClientName' 	 => (string)$row->CLIENT_Name,
			   'ClientAddress' 	 => (object)group_parser($row->CLIENT_Address),
			   'ClientPhone' 	 => (object)group_parser($row->CLIENT_Phone),
			   'ClientNotes' 	 => (string)$row->CLIENT_Notes,
			   'ClientCode' 	 => (string)$row->CLIENT_Code,
			   'ClientActive' 	 => (bool)$row->CLIENT_Active,
			   'ClientActiveTS'  => date(FULL_MILITARY_DATETIME, strtotime($row->CLIENT_ActiveTS)),
			   'AccessLevel' 	 => (int)$row->ACCESS_Level,
			   'AccessName' 	 => (string)$row->ACCESS_Name,
			   'UserModules' 	 => $this->UserModules(mod_parser($row->USER_Modules)),
			   'isActive' 		 => (bool)$row->USER_Active,
			   'TimeActive' 	 => date(FULL_MILITARY_DATETIME, strtotime($row->USER_ActiveTS)),
			   'isGenerated' 	 => (int)$row->USER_Generated,
			   'CreatedOn' 		 => date(FULL_MILITARY_DATETIME, strtotime($row->USER_Created)),
			   'validated' 		 => (bool)TRUE,
			   'DropdownDefault' => (object)$dropdown_defaults
		   );
		   		   
		   $this->session->set_userdata('valid_user', $data);
		   return (object)$data;

	   }
   }    
   
   public function UserModules($mods) {
		$modules = array();
		foreach($mods as $key => $value) {
			if($value != 0) {
				$sql = "SELECT * FROM xModules WHERE MODULE_ID = '" . $key . "';";	
				$query = $this->db->query($sql);
				if($query) {
					array_push($modules,$query->row());	
				}
			}
		}
		return $modules;
   }
   
   public function reset_password($email,$new_pass) {
		$this->load->helper('msg_helper');
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
				$msg = email_reset_msg();
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
		$email = $this->security->xss_clean($this->input->post('email'));
		$password = $this->security->xss_clean(encrypt_password($this->input->post('new_pass')));
		//Get the user id
		$user_sql = "SELECT USER_ID from Users WHERE USER_Name = '" . $email . "';";
		$user = $this->db->query($sql);
		if($user->num_rows() == 1) :
			$user_id = $user->row()->USER_ID;
			
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
        if($this->email->send()) {
            return TRUE;
        }else {
            return FALSE;
        }
    }
    
}