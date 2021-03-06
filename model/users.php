<?php
/**
 *
 */
class User extends postgis {
	public $user;
	function __construct($userId) {
		parent::__construct();
		$this->userId=$userId;
		$this->postgisdb="mygeocloud";
	
	}

	public function getData() {
		global $domain;
		$query = "SELECT screenname as userid, zone, '{$domain}' as host FROM users WHERE screenname = :sUserID";
		$res = $this -> prepare($query);
		$res -> execute(array(":sUserID" => $this->userId));
		$row = $this -> fetchRow($res);
		if (!$this -> PDOerror) {
			$response['success'] = true;
			$response['data'] = $row;
		} else {
			$response['success'] = false;
			$response['message'] = $this -> PDOerror;
		}
		return $response;
	}
}
