<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Login_attempts
 *
 * This model serves to watch on all attempts to login on the site
 * (to protect the site from brute-force attack to user database)
 *
 * @package	Tank_auth
 * @author	Ilya Konyukhov (http://konyukhov.com/soft/)
 */
class Login_attempts extends CI_Model
{
	private $table_name = 'LoginFail';

	function __construct()
	{
		parent::__construct();

		$ci =& get_instance();
		$this->table_name = $this->table_name;
	}
	
	/**
	 * Get number of attempts to login occured from given IP-address or login
	 *
	 * @param	string
	 * @param	string
	 * @return	int
	 */
	function get_attempts_count($ip_address, $login)
	{
		$sql = 'SELECT * FROM ' . $this->table_name . ' WHERE LFAIL_IP = "' . $ip_address . '" AND LFAIL_Email = "' . $login . '";';
		$result = $this->db->query($sql);
		return (($result->num_rows() > 0) ? $result->num_rows() : 0);
	}

	/**
	 * Increase number of attempts for given IP-address and login
	 *
	 * @param	string
	 * @param	string
	 * @return	Bool
	 */
	function increase_attempt($ip_address, $login)
	{
		$sql = 'INSERT INTO ' . $this->table_name . ' (LFAIL_IP,LFAIL_Email) VALUES("' . $ip_address . '","' . $login . '");';
		$query = $this->db->query($sql);
		
		if($query)
			return TRUE;
		else
			return FALSE;
	}

	/**
	 * Clear all attempt records for given IP-address and login.
	 * Also purge obsolete login attempts (to keep DB clear).
	 *
	 * @param	string
	 * @param	string
	 * @param	int
	 * @return	void
	 */
	function clear_attempts($ip_address, $login, $expire_period = 86400)
	{
		$this->db->where(array('LFAIL_IP' => $ip_address, 'LFAIL_Email' => $login));

		// Purge obsolete login attempts
		$this->db->or_where('UNIX_TIMESTAMP(LFAIL_TS) <', time() - $expire_period);

		$this->db->delete($this->table_name);
	}

}