<?php require_once('C:\xampp\htdocs\BilLmE\php\connection.php'); ?>

<?php
$php_errormsg=array();
$b_type='';
$name='';
$email='';
$Bill_no='';


if (isset($_SESSION['Bill_no'])) {
     header('Location: login.php');
    
 }
 if(isset($_GET['Bills_no'])){
$Billno=mysqli_real_escape_string($connection,$_GET['Bills_no']);
$query="DELETE FROM mobilepayment WHERE Bill_no ='$Billno'";

$result_set=mysqli_query($connection,$query);

if (!$result_set) {
    echo "Error: " . mysqli_error($connection);
   
} else {
    header('Location: Bills.php?err=user_not_found');

}


}


 


 ?>
