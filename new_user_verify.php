#!/usr/local/bin/php
<?
// collect data from ajax call
$user = $_POST['username'];
$pass = $_POST['password'];

// Connect with credential database
try{
	$database = new SQLite3('credential.db');		
} catch(Exception $e){ // exception object $e
	echo "Error in connecting to database. Message below: </br>";
	echo $e->getMessage();
	die("Script has terminated."); // terminate the script
}

$cmd = "select count(*) from userAndPass where username = '$user'";
$res = $database->query($cmd);
			

$count = $res->fetchArray()[0];

if($count === 0){ // username unique
	// insert the new username - password combination to database.
	$cmd = "insert into userAndPass(username, password) values ('$user', '$pass')";
	$database->query($cmd);
	
	echo "success"; 
} else{ // find same username on database.
	echo "failure"; 
}
$database->close();
?>