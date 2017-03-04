<?php 
include("dbconn.php");
$rqstid="";
?>
<?php 
$username = "anish";
$username =mysql_real_escape_string($username);
$password="password";
$password=mysql_real_escape_string($password);

$options = [
    'cost' => 11,
    'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
];
$hashedPassword = password_hash($password, PASSWORD_BCRYPT, $options);
//echo password_hash($password, PASSWORD_BCRYPT, $options)."\n";

$sqlinsert = mysql_query("INSERT INTO users(username,password)values('".$username."','".$hashedPassword."')");
if($sqlinsert){

echo("success");
}
?>