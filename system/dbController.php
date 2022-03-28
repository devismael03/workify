<?php

$cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL")); //in cloud(heroku) we have environment variable which holds configuration for connectinog to database
$cleardb_server = $cleardb_url["host"];
$cleardb_username = $cleardb_url["user"];
$cleardb_password = $cleardb_url["pass"];
$cleardb_db = substr($cleardb_url["path"],1);

$dsn = 'mysql:dbname='.$cleardb_db.';host='.$cleardb_server.';charset=utf8';
$user = 'root';
$password = '';

try
{
	$pdo = new PDO($dsn,$cleardb_username,$cleardb_password); //we connect remotely to our database in heroku cloud(cleardb extension)
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
	echo "PDO error".$e->getMessage();
	die();
}
?>
