<?php



$dbhost='localhost';
$dbuser='root';
$dbpass='';
$dbname='billme';

$connection=mysqli_connect('localhost','root','','billme');
if(mysqli_connect_errno()){

    die('Database connection failed'.mysqli_comment_error());
}

