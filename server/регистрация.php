<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("localhost", "id11426384_smilejulia09", "Blablabla9", "id11426384_bukinisticheskij_magazin");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Escape user inputs for security
$fio = mysqli_real_escape_string($link, $_REQUEST['fio']);
$tel_nomer = mysqli_real_escape_string($link, $_REQUEST['tel_nomer']);
$p_mail = mysqli_real_escape_string($link, $_REQUEST['p_mail']);
$login = mysqli_real_escape_string($link, $_REQUEST['login']);
$pass = mysqli_real_escape_string($link, $_REQUEST['pass']);
 
// Attempt insert query execution
$sql = "INSERT INTO polzovateli (fio, tel_nomer, p_mail, login, pass) VALUES ('$fio', '$tel_nomer', '$p_mail', '$login', '$pass')";
if(mysqli_query($link, $sql)){
    echo "Records added successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
// Close connection
mysqli_close($link);
?>