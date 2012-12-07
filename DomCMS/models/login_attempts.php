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
class Login_attempts extends CI_Model {

	function __construct() {
		parent::__construct();
	}
	
	/**
	 * Get number of attempts to login occured from given IP-address or login
	 *
	 * @param	string
	 * @param	string
	 * @return	int
	 */
	function get_count($ip_address, $email) {
		$sql = "SELECT * FROM LoginFail WHERE LFAIL_IP = '" . $ip_address . "' AND LFAIL_Email = '" . $email . "';";
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
	function add($ip_address, $email) {
		$sql = "INSERT INTO LoginFail (LFAIL_IP,LFAIL_Email) VALUES('" . $ip_address . "','" . $email . "');";
		$query = $this->db->query($sql);
		return (($query) ? TRUE : FALSE);
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
	function clear($ip_address,$email,$expire_period=86400) {
		$this->db->where(array('LFAIL_IP' => $ip_address, 'LFAIL_Email' => $email));
		// Purge obsolete login attempts
		$this->db->or_where('UNIX_TIMESTAMP(LFAIL_TS) <', time() - $expire_period);
		$this->db->delete('LoginFail');
	}

}