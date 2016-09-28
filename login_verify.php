#!/usr/local/bin/php
<?
// collect data from ajax call
$user = $_POST['username'];
$pass = $_POST['password'];

// Connect with credential database to verify user's login
try{
	$database = new SQLite3('credential.db');		
} catch(Exception $e){ // exception object $e
	echo "Error in connecting to database. Message below: </br>";
	echo $e->getMessage();
	die("Script has terminated."); // terminate the script
}

$cmd = "select count(*) from userAndPass where username = '$user' AND password = '$pass'";
$res = $database->query($cmd);
			

$count = $res->fetchArray()[0];

if($count === 0){ // no match
	echo "failure"; // tell the login_page.html that login attempt failed
} else{ // find record on database. Success!
	echo "success"; // tell the login_page.html that login attempt succeed
}
$database->close();
?>