<?php

$host = "localhost";
$username = "docom_eatery";
$password = "cst@823870";
$database = "docom_eatery";
//echo "<br><br> -".mysqli_error($dbConnection). "- <br><br>";
$error = "";
$message = "";

if(isset($_POST["customerfName"]) == false){
    $error = "Please fill all the empty.";
} else if (isset($_POST["customerlName"]) == false){
    $error = "Please fill all the empty.";
} else if (isset($_POST["phoneNumber"]) == false){
    $error = "Please fill all the empty.";
} else if (isset($_POST["emailAddress"]) == false){
    $error = "Please fill all the empty.";
} else if (isset($_POST["username"]) == false){
    $error = "Please fill all the empty.";
} else if (isset($_POST["referral"]) == false){
    $error = "Please fill all the empty.";
} else {
    if($_POST["customerfName"] != "" && $_POST["customerlName"] != "" && $_POST["phoneNumber"] != "" 
    && $_POST["emailAddress"] != "" && $_POST["username"] != "" && $_POST["referral"] != "") 
	{		

		$dbConnection = mysqli_connect($host, $username, $password);	
		
		// Check connection
		if ($dbConnection->connect_error) {
            //echo "<br><br> -".mysqli_error($dbConnection). "- <br><br>";
			die("Connection failed: " . $dbConnection->connect_error);
		}
		//echo "Connected successfully" . "<br>";		
                
        mysqli_select_db($dbConnection, $database);
        
        $sqlQuery1 = "SELECT * FROM mailingList where emailAddress = '".$_POST["emailAddress"]."'";
        $result = mysqli_query($dbConnection,$sqlQuery1);
        //echo "<br><br> -".mysqli_error($dbConnection). "- <br><br>";

        $rowCount = mysqli_num_rows($result);
        if($rowCount > 0){
            $error = "User already signed up!";	
            //echo "Person Could not be added: " . $sqlQuery . "<br>" . mysqli_error($dbConnection);
        } else {
            $sqlQuery = "INSERT INTO mailingList (_id, firstName, lastName, phoneNumber, emailAddress, userName, referrer) 
            VALUES(NULL,'".$_POST["customerfName"]."','".$_POST["customerlName"]."', '".$_POST["phoneNumber"]."', '".$_POST["emailAddress"]."', '".$_POST["username"]."', '".$_POST["referral"]."')";
            //echo "<br><br> -".mysqli_error($dbConnection). "- <br><br>";
            if (mysqli_query($dbConnection, $sqlQuery)) {
                //echo "Person Successfully Added". "<br>";
                $message = "Person Successfully Added";
            } else {
                //echo "<br><br> -".mysqli_error($dbConnection). "- <br><br>";
                $error = "Person Could not be added";
                //echo "Person Could not be added: " . $sqlQuery . "<br>" . mysqli_error($dbConnection);
            }
        }

		//echo "<br><br> -".mysqli_error($dbConnection). "- <br><br>";
		
		//echo "<br><br> -".mysqli_error($dbConnection). "- <br><br>";
		mysqli_close($dbConnection);
	}
	else	
        $error = "Please fill all the empty.";	
}

// if(!isset($_POST["customerfName"]) || !isset($_POST["customerlName"]) || !isset($_POST["phoneNumber"]) 
// || !isset($_POST["emailAddress"]) || !isset($_POST["username"]) || !isset($_POST["referral"]))
// {
//     //echo "<br><br> -".mysqli_error($dbConnection). "- <br><br>";
// 	$error = "Please fill all the empty.";
// }
// else
// {
//     //echo "<br><br> -".mysqli_error($dbConnection). "- <br><br>";
    
        
    
// }

?>

<?php include("header.php"); ?>

            <div id="content" class="clearfix">
                <aside>
                        <h2>Mailing Address</h2>
                        <h3>1385 Woodroffe Ave<br>
                            Ottawa, ON K4C1A4</h3>
                        <h2>Phone Number</h2>
                        <h3>(613)727-4723</h3>
                        <h2>Fax Number</h2>
                        <h3>(613)555-1212</h3>
                        <h2>Email Address</h2>
                        <h3>info@wpeatery.com</h3>
                </aside>
                <div class="main">
                    <h1>Sign up for our newsletter</h1>
                    <p>Please fill out the following form to be kept up to date with news, specials, and promotions from the WP eatery!</p>
                    <form name="frmNewsletter" id="frmNewsletter" method="post">
                        <table>
                            <tr>
                                <td>First Name:</td>
                                <td><input type="text" name="customerfName" id="customerfName" size='40'required></td>
                            </tr>
                            <tr>
                                <td>Last Name:</td>
                                <td><input type="text" name="customerlName" id="customerlName" size='40'required></td>
                            </tr>
                            <tr>
                                <td>Phone Number:</td>
                                <td><input type="text" name="phoneNumber" id="phoneNumber" size='40'required></td>
                            </tr>
                            <tr>
                                <td>Email Address:</td>
                                <td><input type="text" name="emailAddress" id="emailAddress" size='40'required>
                            </tr>
                             <tr>
                                <td>Username:</td>
                                <td><input type="text" name="username" id="username" size='20'required>
                            </tr>
                            <tr>
                                <td>How did you hear<br> about us?</td>
                                <td>
                                   <select name="referral" size="1" required>
                                      <option>Select referer</option>
                                      <option value="newspaper" required>Newspaper</option>
                                      <option value="radio" required>Radio</option>
                                      <option value="tv" required>Television</option>
                                      <option value="other" required>Other</option>
                                   </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan='2'><input type='submit' name='btnSubmit' id='btnSubmit' value='Sign up!'>&nbsp;&nbsp;<input type='reset' name="btnReset" id="btnReset" value="Reset Form"></td>
                            </tr>
                        </table>
                        <?php 
                        echo "$error";
                        ?>
                    </form>
                    
                </div><!-- End Main -->
            </div><!-- End Content -->
            
    <?php include("footer.php"); ?>
