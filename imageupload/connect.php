<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'imageupload';

$conn = new mysqli($servername, $username, $password, $dbname);

if($conn->connect_error){
    die("Connect rror" . $conn->connect_error);
}/* else {
    echo 'Connected';
} */


?>