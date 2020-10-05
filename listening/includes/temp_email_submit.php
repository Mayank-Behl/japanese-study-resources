<?php
if (isset($_POST['submit-button'])) {
    require 'dbh.php';
    
    $email = $_POST['email-form'];

    if (empty($email)) {
        header("Location: ../index.php?error=empltyfield");
        exit();
    }

    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../index.php?error=invalidmail");
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
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_Result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
        }
        if($resultCheck > 0) {
            header("Location: ../index.html?error=alreadyregistered");
            exit();           

        }
        else {
            $sql = "INSERT INTO users (emailUsers) VALUES(?)";
            $stmt = mysqli_stmt_init($conn);
            
            if(!mysqli_stmt_prepare($stmt, $sql)) {

                header("Location: ../index.html?error=sqlerror");
                exit();
       
            }  
            else {
                mysqli_stmt_bind_param($stmt, "s", $email);
                mysqli_stmt_execute($stmt);
                header("Location: ../index.html?submit=success");
                exit();
            }         
        }
        
    }
mysqli_stmt_close($stmt);
mysqli_close($conn);

}
else {
    
    header("Location: ../index.php");
    exit();
}

?>


