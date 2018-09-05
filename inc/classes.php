<?php
class User {
	public $loggedin  = false;
	private $user     = '';
	private $name     = '';
	private $perm     = 0;
	public $timeout   = '';
	public $now       = '';
	public $ip        = '';
	public $useragent = '';
	public $sid       = '';

	public function __construct() {
		$this->ip        = preg_replace('/\W/', '_',
			preg_replace('/:/', 'd',
				preg_replace('/\./', 'p', $_SERVER['REMOTE_ADDR'])
			)
		);
		$this->useragent = preg_replace('/[`\'\r\n]/', '’', $_SERVER['HTTP_USER_AGENT']);
		$this->sid       = (isset($_COOKIE['sid']) && preg_match('/^[0-9a-fA-F]{40}$/', $_COOKIE['sid'])) ?
			$_COOKIE['sid'] : '';
	}
	public function setUser($userp) {
		global $db;
		$userp = preg_replace("/['`]/", '’', $userp);
		// TODO E-mail ellenőrzés
		// Adatbázis!
		$sql = "SELECT * FROM users WHERE email = '$userp';";
		$rs = $db->Execute($sql);
		if(($this->user === '') && ($rs && ($row = $rs->FetchRow()))) {
			$this->user = $userp;
			$this->name = $row['nev'];
			$this->perm = $row['user_perm'];
			return true;
		};
		if($rs && ($row = $rs->FetchRow()) && ($row['email'] === $userp)) {
			return false;
		};
		$sql = "UPDATE users SET email = '$userp' WHERE email = '{$this->user}';";
		$db->Execute($sql);
		$sql = "SELECT * FROM users WHERE email = '$userp';";
		$rs = $db->Execute($sql);
		if($rs && ($row = $rs->FetchRow()) && ($row['email'] === $userp)) {
			$this->user = $userp;
			$this->name = $row['nev'];
			$this->perm = $row['user_perm'];
			return true;
		};
		return false;
	}
	public function setName($namep) {
		global $db;
		$namep = preg_replace("/['`]/", '’', $namep);
		// Adatbázis!
		$sql = "UPDATE users SET nev = '$namep' WHERE email = '{$this->user}';";
		$db->Execute($sql);
		$sql = "SELECT nev FROM users WHERE email = '{$this->user}';";
		$rs = $db->Execute($sql);
		if($rs && ($row = $rs->FetchRow()) && ($row['nev'] === $namep)) {
			$this->name = $namep;
			return true;
		};
		return false;
	}
	public function setPerm($permp) {
		global $db;
		$permp = (int) $permp;
		// Adatbázis!
		$sql = "UPDATE users SET user_perm = $permp WHERE email = '{$this->user}';";
		$db->Execute($sql);
		$sql = "SELECT user_perm FROM users WHERE email = '{$this->user}';";
		$rs = $db->Execute($sql);
		if($rs && ($row = $rs->FetchRow()) && ((int) $row['user_perm'] === $permp)) {
			$this->perm = $permp;
			return true;
		};
		return false;
	}
	public function getUser() {
		return $this->user;
	}
	public function getName() {
		return $this->name;
	}
	public function getPerm() {
		return $this->perm;
	}
}
?>