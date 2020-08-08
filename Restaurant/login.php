<?php

    $error = "";

    require_once('WebsiteUser.php');
    session_start();
    if(isset($_SESSION['websiteUser'])){
        if($_SESSION['websiteUser']->isAuthenticated()){
            session_write_close();
            $_SESSION["loggedin"] = true; //Logged in
            header('Location:internal.php');
        } else {
            $error = "Can not log in!";
        }
    }
    $missingFields = false;
    if(isset($_POST['submit'])){
        if(isset($_POST['username']) && isset($_POST['password'])){
            if($_POST['username'] == "" || $_POST['password'] == ""){
                $missingFields = true;
            } else {
                //All fields set, fields have a value
                $websiteUser = new WebsiteUser();
                if(!$websiteUser->hasDbError()){
                    $username = $_POST['username'];
                    $password = $_POST['password'];
                    $websiteUser->authenticate($username, $password);
                    if($websiteUser->isAuthenticated() == true){
                        $host = "localhost";
                        $username = "docom_eatery";
                        $password = "cst@823870";
                        $database = "docom_eatery";
                        $dbConnection = mysqli_connect($host, $username, $password);
                        mysqli_select_db($dbConnection, $database);

                        $sqlQuery1 = "SELECT CURDATE();";
                        //$result1 = mysqli_query($dbConnection,$sqlQuery1);
                        //echo $result1;
                        foreach($dbConnection->query('SELECT CURDATE()') as $row) {
                            //echo "<tr>";
                            $Logindate = $row['CURDATE()'];
                            //echo "</tr>";
                        }
                        $sqlQuery = "UPDATE adminusers
                        SET Lastlogin = '$Logindate'
                        WHERE AdminID = 1;";
                        mysqli_query($dbConnection,$sqlQuery);
                        $sqlQuery2 = "SELECT * FROM adminusers";
                        $result = mysqli_query($dbConnection,$sqlQuery2);
                        //echo "<br><br> -".mysqli_error($dbConnection). "- <br><br>";
                
                        $rowCount = mysqli_num_rows($result);
                        for($i=0; $i<$rowCount; ++$i)
                        {
                            $row = mysqli_fetch_row($result);
                            if(i == ($rowCount - 1)){
                                $_SESSION["adminID"] = $row[0];
                                $_SESSION["adminLevel"] = $row[3];
                                $_SESSION["lastDayLogin"] = $row[4];
                            }
                        }
                        //$_SESSION["userName"] =  $username;
                        $_SESSION['websiteUser'] = $websiteUser;
                        $_SESSION["loggedin"] = true;
                        mysqli_close($dbConnection);
                        header('Location:internal.php');
                    }
                }
                $error = "Can not log in!";
            }
        }
    }
?>
<?php include("header.php"); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Week 12 Lecture</title>
    </head>
    <body>
            <?php
            //Missing username/password
            if($missingFields){
                echo '<h3 style="color:red;">Please enter both a username and a password</h3>';
            }
            
            //Authentication failed
            if(isset($websiteUser)){
                if(!$websiteUser->isAuthenticated()){
                    echo '<h3 style="color:red;">Login failed. Please try again.</h3>';
                }
            }
             ?>
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
                    <form name="login" id="login" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                    <table>
                        <tr>
                            <td>Username:</td>
                            <td><input type="text" name="username" id="username"></td>
                        </tr>
                        <tr>
                            <td>Password:</td>
                            <td><input type="password" name="password" id="password"></td>
                        </tr>
                        <tr>
                            <td><input type="submit" name="submit" id="submit" value="Login"></td>
                            <td><input type="reset" name="reset" id="reset" value="Reset"></td>
                        </tr>
                    </table>
                        <br><br>
                        <?php echo "$error <br><br>"; ?>
                        <?php echo '<p>Session ID: ' . session_id() . '</p><br>';?>
                        
                    </form>
                </div><!-- End Main -->
            </div><!-- End Content -->
        <!-- MESSAGES -->
        
        
        
    </body>
</html>
<?php include("footer.php"); ?>


