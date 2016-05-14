<?php 

use TextQuest\Engine\PDOHandler;

	if (isset($_POST['username']) && isset($_POST['password'])) {

		PDOHandler::setDBpath(__DIR__ . '/../storage');

		PDOHandler::setDB('database.sqlite');

		$db = PDOHandler::create();

		$username = $_POST['username'];
		$password = $_POST['password'];

		$query = $db->prepare("SELECT * FROM 'users' WHERE username = :username");

		$query->bindParam(':username', $username);

		$query->execute();
		
		$fields = $query->fetch();


		if (password_verify($password, $fields['password'])) {
			session_start();
			$_SESSION['username'] = $username;
			redirect('/home');
		}else{
			throw new Exception("You cant login in system with this fields");
		}
		
		// print_r($_SESSION);
	}

	
	/**
	* Make the testuser
	*
	**/
	
	// $username = 'testuser123';
	
	// $password = password_hash('pass123', PASSWORD_DEFAULT);

	// $query = $db->prepare("INSERT INTO 'users' (username, password) VALUES(:username, :password)");

	// $query->bindParam(':username', $username);

	// $query->bindParam(':password', $password);

	// $query->execute();

