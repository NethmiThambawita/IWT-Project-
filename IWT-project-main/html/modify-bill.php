
<?php session_start(); ?>
<?php require_once('C:\xampp\htdocs\BilLmE\php\connection.php');?>

<?php
$php_errormsg = array();
$b_type = '';
$name = '';
$email = '';
$Billno = '';

if(isset($_GET['Bills_no'])){


    $Billno = mysqli_real_escape_string($connection, $_GET['Bills_no']);
   
    $query = "SELECT * FROM mobilepayment WHERE Bill_no ='$Billno' LIMIT 1";

    $result_set = mysqli_query($connection, $query);

    if (!$result_set) {
        echo "Error: " . mysqli_error($connection);
        // handle the error
    } else {
        if (mysqli_num_rows($result_set) == 1) {
            $result = mysqli_fetch_assoc($result_set);
            $b_type = $result['Bill_Type'];
            $name = $result['Ful_Name'];
            $email = $result['Email'];
            $address=$result['addresss'];
            $city=$result['city'];
            $state=$result['states'];
        } else {
            // user not found
            header('Location: Bills.php?err=user_not_found');
            exit();
        }
    }
}


//update form
if (isset($_POST['submit'])) {

    $Billno = $_SESSION['bilNo'];
    $b_type = $_POST['b_type'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address=$_POST['address'];
    $city=$_POST['city'];
    $state=$_POST['state'];



    // checking required fields
    $req_fields = array('name', 'email', 'b_type','address','city','state');

    foreach ($req_fields as $field) {
        if (empty(trim($_POST[$field]))) {
            $errors[] = $field . ' is required';
        }
    }

    // checking max length
    $max_len_fields = array('name' => 50, 'email' => 200, 'b_type' => 100);

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
    

        $query = "UPDATE mobilepayment
                  SET Bill_Type='$b_type', Ful_Name='$name', Email='$email',addresss='$address', states='$state',city='$city'
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
    <title>Bill Dashboard</title>
    <link rel="stylesheet" href="../css/Bills.css">
    <link rel="stylesheet" href="../css/mobile payement.css">
</head>
<body class="ums">
<div class="Bill_ums">
    <div class="appname">Bill Management System</div>
    <div class="Loggedin">Welcome <a href="logout.php">Log Out</a></div>
</div>
<main>
    <h1>Bill Management</h1>
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

        <form action="modify-bill.php" method="POST">

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
            Full name:
            <input type="text" name="name" placeholder="Enter name" value="<?php echo $name; ?>">
            Email:
            <input type="text" name="email" placeholder="Enter email" value="<?php echo $email; ?>">
            Address:
            <input type="text" name="address" placeholder="Enter address" value="<?php echo $address; ?>">
            City:
            <input type="text" name="city" placeholder="Enter City" value="<?php echo $city; ?>">
            <div id="zip">
                <label>
                    State:
                    <select name="state">
                        <option>Choose State..</option>
                        <option <?php if ($state == 'Galle') echo 'selected'; ?>>Galle</option>
                        <option <?php if ($state == 'Colombo') echo 'selected'; ?>>Colombo</option>
                        <option <?php if ($state == 'Kandy') echo 'selected'; ?>>Kandy</option>
                        <option <?php if ($state == 'Jaffna') echo 'selected'; ?>>Jaffna</option>
                        <option <?php if ($state == 'Anuradhapura') echo 'selected'; ?>>Anuradhapura</option>
                        <option <?php if ($state == 'Trincomalee') echo 'selected'; ?>>Trincomalee</option>
                        <option <?php if ($state == 'Batticaloa') echo 'selected'; ?>>Batticaloa</option>
                        <option <?php if ($state == 'Kilinochchi') echo 'selected'; ?>>Kilinochchi</option>
                        <option <?php if ($state == 'Kurunegala') echo 'selected'; ?>>Kurunegala</option>
                        <option <?php if ($state == 'Mannar') echo 'selected'; ?>>Mannar</option>
                        <option <?php if ($state == 'Matale') echo 'selected'; ?>>Matale</option>
                        <option <?php if ($state == 'Matara') echo 'selected'; ?>>Matara</option>
                        <option <?php if ($state == 'Badulla') echo 'selected'; ?>>Badulla</option>
                        <option <?php if ($state == 'Dehiwala') echo 'selected'; ?>>Dehiwala</option>
                        <option <?php if ($state == 'Hambantota') echo 'selected'; ?>>Hambantota</option>
                        <option <?php if ($state == 'Kalutara') echo 'selected'; ?>>Kalutara</option>
                    </select>
                </label>
                <label>
                    Zip code:
                    <input type="number" name="zip_code" placeholder="Zip code" value="<?php echo $zip_code; ?>">
                </label>
            </div>
            <label></label>
            <input type="submit" name="submit" value="Save Changes">
        </form>
    </table>
</main>
</body>
</html>
