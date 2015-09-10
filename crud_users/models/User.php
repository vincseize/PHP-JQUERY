<?php


class User {


	private $dbh;
	
	public function __construct($host,$user,$pass,$db)	{		
		$this->dbh = new PDO("mysql:host=".$host.";dbname=".$db,$user,$pass);		
	}

	public function getUsers(){				
		$sth = $this->dbh->prepare("SELECT * FROM users_zemelattitude ORDER by name ASC");
		$sth->execute();
		return json_encode($sth->fetchAll());
	}

	public function add($user){		
		// $sth = $this->dbh->prepare("INSERT INTO users(name, email, mobile, address,score, hdv) VALUES (?, ?, ?, ?, ?, ?)");
		$sth = $this->dbh->prepare("INSERT INTO users_zemelattitude(name,score,hdv,actif) VALUES (?, ?, ?, ?)");
		// $sth->execute(array($user->name, $user->email, $user->mobile, $user->address));		
		$sth->execute(array($user->name, $user->score, $user->hdv,$user->actif));		
		return json_encode($this->dbh->lastInsertId());
	}
	
	public function delete($user){				
		$sth = $this->dbh->prepare("DELETE FROM users_zemelattitude WHERE id=?");
		$sth->execute(array($user->id));
		return json_encode(1);
	}
	
	public function updateValue($user){		
		$sth = $this->dbh->prepare("UPDATE users_zemelattitude SET ". $user->field ."=? WHERE id=?");
		$sth->execute(array($user->newvalue, $user->id));				
		return json_encode(1);	
	}
}
?>