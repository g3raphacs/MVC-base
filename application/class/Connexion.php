<?php
namespace App;

class Connexion {
	private $login;
	private $pass;
	private $connec;

    // Modify database login informations here __________________
	public function __construct(){
		$this->login = 'root';
		$this->pass = '';
		$this->db = 'database';
		$this->connect();
	}

	private function connect(){
		try
		{
	         $bdd = new \PDO(
                            'mysql:host=localhost;dbname='.$this->db.';charset=utf8mb4',
                             $this->login,
                             $this->pass
                 );
			$bdd->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_WARNING);
			$bdd->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_OBJ);
			$this->connec = $bdd;
		}
		catch (\PDOException $e)
		{
			$msg = 'ERREUR PDO dans ' . $e->getFile() . ' L.' . $e->getLine() . ' : ' . $e->getMessage();
			die($msg);
		}
	}

	public function query($sql,Array $cond = null, $wantResponse = false){
		$stmt = $this->connec->prepare($sql);

		if($cond){
			foreach ($cond as $v) {
				$stmt->bindParam($v[0],$v[1],$v[2]);
			}
		}
        $stmt->execute();
        if(!$wantResponse){
            $stmt->closeCursor();
		    $stmt=NULL;
        }else{
		    $response = $stmt->fetchAll();
		    $stmt->closeCursor();
		    $stmt=NULL;
            return $response;
        }
	}
}