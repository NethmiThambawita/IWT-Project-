
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
  

   
    $query="INSERT INTO mobilepayment(Ful_Name,Email,Bill_Type)";
    $query.= "VALUES ('{$Name}', '{$Email}' ,'{$billtype}')";

    $result=mysqli_query($connection,$query);
    
    if($result){
    
        header('Location: Bills.php?user_added=true');
    
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
    <link rel="stylesheet" href="../css/mobile payement.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
        <script src="https://kit.fontawesome.com/72c3a6627b.js" crossorigin="anonymous"></script>
   
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
   
<div id="error"></div>
	<div class="container">
		<div class="left">
			
			<form action="mobile_payment.php" method="Post">

                <select name="b_type">
                    <option>Mobile</option>
                    <option>Utilities</option>
                    <option>Internet</option>
                    <option>Television</option>
                    <option>Insurance</option>
                    <option>Wallate</option>
                    <option>Other</option>
                </select>
                 <select>
                    <option>SLT-Mobitel</option>
                    <option>Dialog</option>
                    <option>Airtel</option>
                    <option>Ceylon Electricity Board</option>
                    <option>National Water Supply & Drainage Board</option>
                    <option>LECO</option>
                    <option>SLT-PEOTV</option>
                    <option>Dialog-Television</option>
                    <option>AIA</option>
                    <option>Ceylinco</option>
                    <option>Cash App</option>
                    <option>NiKi Event-Planner</option>
                    <option>Glamour Event-Planner</option>
                    </select>
               
				<br> name:
				<input type="text" name="username" placeholder="Enter name" required>
				Email:
				<input type="text" name="email" placeholder="Enter email" spellcheck="false" id="email-field">
                <span id="email-error"> error msg</span>
<script>
    var emailField=document.getElementById("email-field");
    var emailError=document.getElementById("email-error");

    function validateEmail(){
        
    }

				Address:
				<input type="text" name="address" placeholder="Enter address">
				
				City:
				<input type="text" name="city" placeholder="Enter City">
				<div id="zip">
					<label>
						State:
						<select>
							<option>Choose State..</option>
							<option>Galle</option>
							<option>colombo</option>
							<option>Kandy</option>
							<option>Jaffna</option>
                            <option>Anuradhapura</option>
							<option>trincomalee</option>
							<option>Batticoloa</option>
							<option>Kilinochchi</option>
                            <option>Kurunegala</option>
							<option>Mannar</option>
							<option>Matale</option>
							<option>Matara</option>
                            <option>Badulla</option>
							<option>Dehiwala</option>
							<option>Hambantota</option>
							<option>Kalutara</option>
                            
						</select>
					</label>
						<label>
						Zip code:
						<input type="number" placeholder="Zip code">
					</label>
				</div>
                <label></label>
            </div>
           
	
         <input type="submit" name="submit" value="Add Payment Details" > <link rel="../html/billdetails.php">
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
      
