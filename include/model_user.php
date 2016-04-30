<?php
require_once 'db_config.php';

class User {
	
	private $conn;

	public function __construct() {
		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
	}

	public function runQuery($sql) {
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}

	public function lastId() {
		$stmt = $this->conn->lastInsertId();
		return $stmt;
	}

	public function register($firstname, $lastname, $email, $password, $code) {
		try {
			$password = md5($password);
			$stmt = $this->conn->prepare("INSERT INTO users(firstname, lastname, email, password, code, activated) 
				VALUES (:user_first, :user_last, :user_email, :user_pass, :active_code, 0)");

			$stmt->bindparam(":user_first", $firstname);
			$stmt->bindparam(":user_last", $lastname);
			$stmt->bindparam(":user_email", $email);
			$stmt->bindparam(":user_pass", $password);
			$stmt->bindparam(":active_code", $code);
			$stmt->execute();
			return $stmt;
		} catch (PDOException $ex) {
			echo $ex->getMessage();
		}
	}

	public function login($email, $password) {
		try {
			$stmt = $this->conn->prepare("SELECT * FROM users WHERE email=:email_id AND activated=1");
			$stmt->execute(array(":email_id"=>$email));
			$userRow = $stmt->fetch(PDO::FETCH_ASSOC);

			if($stmt->rowCount() == 1) {
				if(strcmp($userRow['password'], md5($password)) === 0) {
					$_SESSION['userSession'] = $userRow['id'];
					return true;
				} else {
					header("Location: index.php?errorPass");
					exit;
				}
			} else {
				header("Location: index.php?errorNope");
				exit;
			}
		} catch (PDOException $ex) {
			echo $ex->getMessage();
		}
	}

	public function is_logged_in() {
		if(isset($_SESSION['userSession'])) {
			return true;
		}
	}

	public function redirect($url){
		header("Location: $url");
	}

	public function logout() {
		session_destroy();
		$_SESSION['userSession'] = false;
	}

	function send_mail($email, $message, $subject) {
		require_once('mailer/class.phpmailer.php');

		$mail = new PHPMailer();
		$mail->isSMTP();
		$mail->SMTPDebug = 0;                    
        $mail->SMTPSecure = "tls"; 
 		$mail->SMTPAuth = true;                                   
  		$mail->Host = "smtp.gmail.com";      
  		$mail->Port = 587;            
  		$mail->AddAddress($email);
  		$mail->Username ="justanothermailtester@gmail.com";  
  		$mail->Password ="bettercallsoul"; 
  		$mail->SetFrom('justanothermailtester@gmail.com','Tester');
  		$mail->AddReplyTo("justanothermailtester@gmail.com","Tester");
  		$mail->Subject = $subject;
  		$mail->MsgHTML($message);
  		$mail->Send();
 		}
}
?>