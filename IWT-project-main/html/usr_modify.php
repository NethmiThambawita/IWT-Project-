<?php session_start(); ?>
<?php require_once('C:\xampp\htdocs\BilLmE\php\connection.php');?>

<?php
$php_errormsg = array();
$b_type = '';
$email = '';
$Billno = '';

if(isset($_GET['Bills_no'])){


    $Billno = mysqli_real_escape_string($connection, $_GET['Bills_no']);
   
    $query = "SELECT * FROM usr WHERE Bill_no ='$Billno' LIMIT 1";

    $result_set = mysqli_query($connection, $query);

    if (!$result_set) {
        echo "Error: " . mysqli_error($connection);
        // handle the error
    } else {
        if (mysqli_num_rows($result_set) == 1) {
            $result = mysqli_fetch_assoc($result_set);
            $b_type = $result['Bill_Type'];

            $email = $result['Email'];
           
        } else {
            // user not found
            header('Location: usr.php?err=user_not_found');
            exit();
        }
    }
}


//update form
if (isset($_POST['submit'])) {

    $Billno = $_SESSION['bilNo'];
    $b_type = $_POST['b_type'];
     $email = $_POST['email'];
    



    // checking required fields
    $req_fields = array( 'email', 'b_type');

    foreach ($req_fields as $field) {
        if (empty(trim($_POST[$field]))) {
            $errors[] = $field . ' is required';
        }
    }

    // checking max length
    $max_len_fields = array( 'email' => 200, 'b_type' => 100);

    foreach ($max_len_fields as $field => $max_len) {
        if (strlen(trim($_POST[$field])) > $max_len) {
            $errors[] = $field . ' must be less than ' . $max_len . ' characters';
        }
    }

    

    if (empty($errors)) {

        
        // no errors found... updating the record
        $b_type = mysqli_real_escape_string($connection, $_POST['b_type']);
        $name = mysqli_real_escape_string($connection, $_POST['name']);
        $email = mysqli_real_escape_string($connection, $_POST['email']);
    

        $query = "UPDATE usr
                  SET Bill_Type='$b_type' Email='$email'
                  WHERE Bill_no='$Billno'";
        

        $result = mysqli_query($connection, $query);

        if ($result) {

            echo $result;
            // query successful... redirecting to users page
            // header('Location: Bills.php?user_added=true');
            // exit();
        } else {
            $errors[] = 'Failed to update the record.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="eng">
<head>
    <title>User Dashboard</title>
    <link rel="stylesheet" href="../css/usr.css">
    <link rel="stylesheet" href="../css/mobile payement.css">
</head>
<body class="ums">
<div class="usr_ums">
    <div class="appname"></div>
    <div class="Loggedin">Welcome <a href="logout.php">Log Out</a></div>
</div>
<main>
    
    <table class="masterlist">
        <?php
        if (!empty($errors)) {
            echo '<div class="errmsg">';
            echo '<b>There were error(s) on your form</b>';
            echo '<br>';
            foreach ($errors as $error) {
                echo $error . '<br>';
            }
            echo '</div>';
        }
        ?>

        <form action="usr_modify.php" method="POST">

         <input type="hidden" name="Bill_no" value="<?php echo $Bilno?>">
            <select name="b_type">
                <option <?php if ($b_type == 'Mobile') echo 'selected'; ?>>Mobile</option>
                <option <?php if ($b_type == 'Utilities') echo 'selected'; ?>>Utilities</option>
                <option <?php if ($b_type == 'Internet') echo 'selected'; ?>>Internet</option>
                <option <?php if ($b_type == 'Television') echo 'selected'; ?>>Television</option>
                <option <?php if ($b_type == 'Insurance') echo 'selected'; ?>>Insurance</option>
                <option <?php if ($b_type == 'Wallate') echo 'selected'; ?>>Wallate</option>
                <option <?php if ($b_type == 'Other') echo 'selected'; ?>>Other</option>
            </select>
            <select name="service_provider">
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
            <br>
            
            Email:
            <input type="text" name="email" placeholder="Enter email" value="<?php echo $email; ?>">
           
            
            <label></label>
            <input type="submit" name="submit" value="Save Changes">
        </form>
    </table>
</main>
</body>
</html>
