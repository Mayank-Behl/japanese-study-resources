<html>
<head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
</head>
</html>
<?php
include_once 'dbh.php';
if(isset($_POST['submit-button'])) {	 
	$emailUsers = $_POST['email-form'];

//to chech if the message field is empty or not
	if (empty($emailUsers)) {
		$message = 'Email cannot be blank';
		echo "<script>
        alert('$message')
        window.location.replace('http://japanesestudyresources.epizy.com/test/test.php?#news-letter');
    	</script>";
		//echo '<script>alert("Email cannot be blank")</script>'; 
		//header("Location: ../index.php?");
		exit(); //exit prevents the null entry into the table
	}

//to check if the email address is valid or not
	else if(!filter_var($emailUsers, FILTER_VALIDATE_EMAIL)) {
		$message = 'Please enter a valid Email address ';
		echo "<script>
        alert('$message')
        window.location.replace('http://japanesestudyresources.epizy.com/test/test.php?#news-letter');
    	</script>";
		exit();	
	}


    else {
        $sql = "SELECT emailUsers FROM users WHERE emailUsers=?";
        $stmt = mysqli_stmt_init($conn);
		
		
        if(!mysqli_stmt_prepare($stmt, $sql)) {

            header("Location: ../index.php?error=sqlerror");
            exit();
   
        }

        else {
            mysqli_stmt_bind_param($stmt, "s", $emailUsers);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_Result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
		}
		



        if($resultCheck > 0) {
			$message = 'You are already subscribed to the Newsletter ';

            echo "
            <script>
			window.alert('$message')
			window.location.replace('http://japanesestudyresources.epizy.com/test/test.php?');
			</script>";
            exit();
        }
        else {
            $sql = "INSERT INTO users (emailUsers) VALUES(?)";
			$stmt = mysqli_stmt_init($conn);
			

            
            if(!mysqli_stmt_prepare($stmt, $sql)) {

                header("Location: ../index.php?error=sqlerror");
                exit();
       
            }  
            else {
                mysqli_stmt_bind_param($stmt, "s", $emailUsers);
                mysqli_stmt_execute($stmt);
                $message = 'You are now subscribed to the Newsletter';
                echo "<script>
                alert('$message')
                window.location.replace('http://japanesestudyresources.epizy.com/test/test.php?');
                </script>";
                exit();
            }         
			
		}
        
    }
// to enter the data into the database
/*	else{
	$sql = "INSERT INTO users (emailUsers)
	VALUES ('$emailUsers')";
	if (mysqli_query($conn, $sql)) {
		echo "New record created successfully !";
	} else {
		echo "Error: " . $sql . "
" . mysqli_error($conn);
	 }
	 mysqli_close($conn);

}
*/

} //if end

else{
	header("Location: ../index.php");
    exit();
}
?>

