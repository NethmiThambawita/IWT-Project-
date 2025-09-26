
<?php session_start(); ?>
<?php require_once('C:\xampp\htdocs\BilLmE\php\connection.php'); ?>

<?php




$bill_list = '';
$query = "SELECT * FROM  usr ";
$usr = mysqli_query($connection, $query);

 if ($usr) {
    while ($bill = mysqli_fetch_assoc($usr)) {
        $usr_list .= "<tr>";
         $usr_list .= "<td>{$usr['Bill_no']}</td>";         
         $usr_list .= "<td>{$usr['Bill_Type']}</td>";         
         $usr_list .= "<td>{$usr['Ful_Name']}</td>"; 
         $usr_list .= "<td> <a href=\"usr_modify.php?Bills_no={$usr['Bill_no']}\">Edit</a></td>";
        
         $usr_list .= "</tr>";

         $_SESSION['bilNo']=$usr['Bill_no'];
     }
 } else {
     echo "Database query failed.";
 }
?>
<!DOCTYPE html>
<html>
  <head>
        
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/1st.css">
     <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
        <link rel ="stylesheet" href="../css/Bills.css">
        <script src="https://kit.fontawesome.com/72c3a6627b.js" crossorigin="anonymous"></script> 
    
    <title>BiLlmE</title>
     
</head>
<meta charset="UTF-8 "/>
<body>
  <header>
      <h2 class="logo">BilLmE</h2>
<nav class="main">
            
                   
                    <a href="../html/billdashboard.html">Dashboard</a>
                    <a href="#">Events</a>
                    <a href="#">Billing</a>
                    <a href="#">Budget Planner</a>
                    <a href="#">Tickets</a>
                    <a href="../html/profileTabshow.html"><img class="navi_img" src="../images/navi.jpg" > </a>
                
            
            </nav>

    
  
            </header>

  </header>
  <body class= ums>
    <title>User Dashboard</title>
    

        <div class=usr_ums>
            <div class="appname">User Management System</div>
            
        </div>
        <main>
       
        <table class="masterlist">
            <tr>
                <th>Bill_no</th>
                <th>Bill_type</th>
                <th>Email</th>
                <th>Amount</th>
                <th>Edit</th>
               
            </tr>
            <?php echo $usr_list; ?>

        </table>
        </main>  
    </body>
</html>
    


























    
<!-- footer -->
<footer class="footer">
  <div class="container">
      <div class="row">
          <div class="footer-col">
              <h4>BilLmE</h4>
              <ul>
                  <li><a href="#">about us</a></li>
                  <li><a href="#">our services</a></li>
                  <li><a href="#">privacy policy</a></li>
                  
              </ul>
          </div>
        
         
          <div class="footer-col">
              <h4>follow us</h4>
              <div class="social-links">
                  <a href="#"><i class="fab fa-facebook-f"></i></a>
                  <a href="#"><i class="fab fa-twitter"></i></a>
                  <a href="#"><i class="fab fa-instagram"></i></a>
                  <a href="#"><i class="fab fa-linkedin-in"></i></a>
              </div>
          </div>

          <div class="footer-col">
            <h4>Contact us</h4>
            <div class="call-links">
                <div class="call">
                <p>email: support@billme.com</p>
                <p>Tel:0332255950</p>
                <p>Mobile:0701260526</p>
                </div>
            </div>
        </div>
         
      </div>

  
  </div>
</footer>

</body>



</html>