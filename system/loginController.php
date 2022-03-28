<?php
@session_start();
require_once('dbController.php');
if(isset($_POST['submit'])) //if submit button is pressed and request sent to login controller we proceed
{
	if(isset($_POST['email'],$_POST['password']) && !empty($_POST['email']) && !empty($_POST['password'])) //checking if required inputs are filled
	{
		$email = trim($_POST['email']); //we trim email and password for security reasons
		$password = trim($_POST['password']);

		if(filter_var($email, FILTER_VALIDATE_EMAIL)) //filter_var is a built-in function in php to validate email(using regex)
		{
			$sql = "select * from users where email = :email ";
			$handle = $pdo->prepare($sql);
			$params = ['email'=>$email];
			$handle->execute($params);
			if($handle->rowCount() > 0) //if user count which has email corresponding to email filled to input, we proceed
			{
				$getRow = $handle->fetch(PDO::FETCH_ASSOC);
				if(password_verify($password, $getRow['password'])) //in next step, we verify that entered password is same with login password
				{
					unset($getRow['password']); //if so, we delete post request variable(for security reasons) and redirect user to dashboard
					$_SESSION = $getRow;
					header('location:dashboard');
					exit();
				}
				else
				{
					$errors[] = "Yanlış email və ya parol";
				}
			}
			else
			{
				$errors[] = "Yanlış email və ya parol";
			}
			
		}
		else
		{
			$errors[] = "Yanlış email və ya parol";	
		}

	}
	else
	{
		$errors[] = "Yanlış email və ya parol";	
	}

}
?>