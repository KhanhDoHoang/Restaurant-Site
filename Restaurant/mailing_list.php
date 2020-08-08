<?php

$host = "localhost";
$username = "docom_eatery";
$password = "cst@823870";
$database = "docom_eatery";

		$dbConnection = mysqli_connect($host, $username, $password);	
		
		// Check connection
		if ($dbConnection->connect_error) {
            //echo "<br><br> -".mysqli_error($dbConnection). "- <br><br>";
			die("Connection failed: " . $dbConnection->connect_error);
		}
		//echo "Connected successfully" . "<br>";		
                
        mysqli_select_db($dbConnection, $database);
            //echo "<br><br> -".mysqli_error($dbConnection). "- <br><br>";
        $sqlQuery = "SELECT * FROM mailingList";
        $result = mysqli_query($dbConnection,$sqlQuery);
        $rowCount = mysqli_num_rows($result);      
		mysqli_close($dbConnection);
	

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
                    <h1>Mailing List</h1>
                    <form name="frmNewsletter" id="frmNewsletter" method="post">
                    <table>
                    <?php                        
                    if($rowCount == 0){
                        echo "*** There are no rows to display from the Employee table ***";
                        echo "Please log in first!";
                    }
                    else
                    {
                        echo "<tr>";					                         
                                echo "<th>Full Name<th>";	                               
                                echo "<th>Telephone Number<th>";	
                                echo "<th>Email Address<th>";	                                				
                            echo "</tr>";
                        for($i=0; $i<$rowCount; ++$i)
                        {
                            $row = mysqli_fetch_row($result);
                            echo "<tr>";					
                                echo "<td>$row[1] $row[2]<td>";	
                                echo "<td>$row[3]<td>";	
                                echo "<td>$row[4]<td>";				
                            echo "</tr>";
                                
                        }
                    }
                    mysqli_close($dbConnection);
                ?>
                </table>
                    </form>
                    
                </div><!-- End Main -->
            </div><!-- End Content -->
            
    <?php include("footer.php"); ?>
