

<?php require_once('C:/xampp/htdocs/BilLmE/php/connection.php');?>
<?php 
if(isset($_POST['submit'])){
    $Name=$_POST['name'];
    $Email=$_POST['email'];
    $billtype=$_POST['b_type'];



//checking required fields

$req_fields = array('email','b_type');
foreach ($req_fields as $field){
    if (empty(trim($_POST[$field]))){
        $errors[] = $field.' is required';
            }
        }


//checking the max length set correctly
$max_len_fields = array('name'=> 50,'email'=>200,'b_type'=>100);

foreach ($max_len_fields as $field=>$max_len){
    if (strlen(trim($_POST[$field]))>$max_len){
        $errors[] = $field.'must be less than'.$max_len.'characters';
    }
}
if(empty($errors)){
    //add the new input
    $Name=mysqli_real_escape_string($connection,$_POST['name']);
    $Email=mysqli_real_escape_string($connection,$_POST['email']);
    $billtype=mysqli_real_escape_string($connection,$_POST['b_type']);
  

   
    $query="INSERT INTO usr(Ful_Name,Email,Bill_Type)";
    $query.= "VALUES ('{$Name}', '{$Email}' ,'{$billtype}')";

    $result=mysqli_query($connection,$query);
    
    if($result){
        //successful 
        header('Location:usr.php?user_added=true');
    
    }else{
        $errors[]= 'failed to add new record';
    }
}

}

?> 
<!DOCTYPE html>
<html>
  <head><title>BiLlmE</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/1st.css">
    <link rel="stylesheet" href="../css/billdetails.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
        <script src="https://kit.fontawesome.com/72c3a6627b.js" crossorigin="anonymous"></script>
        <script src="../js/popup.js"></script>
    <title>BiLlmE</title>
     

<meta charset="UTF-8 "/>

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
<body>
   
<form action="popup.html" method="Post">
	<div class="container">
		<div class="left">
			
			<form action="popup.html" method="Post">

              
		<div class="center">
			<h3>PAYMENT</h3>
			
				<br>Accepted Card: <br>
				<img src="../images/master.jpeg" width="100">
				<img src="../images/visa.png" width="50">
				<br><br>

				Credit card number:
			<input type="text" name="cardno" placeholder="Enter card number" maxlength="19" >
           
<script>//javascript alert box
    alert("please input right password!!");
    </script>
				<br><br>
				Exp month:
				<input type="text"  placeholder="Enter Month">
				<div id="zip">
					<label>
						<br><br>Exp year:
						<select>
							<option>Choose Year..</option>
							<option>2022</option>
							<option>2023</option>
							<option>2024</option>
							<option>2025</option>
						</select>
					</label>
						<label>
						<br><br>CVV:
						<input type="text"  placeholder="CVV">
                      <br><br>   Amount Rs:
                        <input type="text" placeholder="Amount">
     
				</div>
               <br><br> <input type="submit" name="submit" value="Proceed to checkout" >
             
		</div> 
        </div>
			</form>
           
    
   
<div class="footerDesign">

<div class="custom-shape-divider-bottom-1684689648">
  <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
      <path
          d="M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V120H1200V95.8C1132.19,118.92,1055.71,111.31,985.66,92.83Z"
          class="shape-fill"></path>
  </svg>
</div>
</div>
</div>
</form>

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