<?php  

// function of forget password

function forgotPassword($conn, $param)
{
    extract($param);

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);
    


     if($result && $result->num_rows > 0)
    {

        $users = mysqli_fetch_assoc($result);
        $user_id = $users['user_id'];
        $datetime = date("y-m-d H:i:s");
       //generate otp  
       $otp = rand(1111,9999);
       $msg = "please use this otp <b>$otp </b>to reset your password";

       // send otp to email 
       $to = $email;
       $subject = "forgot password request";
      $header = "from : nj@library.com"."\r\n"; //optional
       $res = mail($to , $subject ,$msg, $header );
     if($res){
        $sql = "insert into reset-password(user_id, reset_code , created_at)
        Values ('$user_id', '$otp', '$datetime') ";
           $conn->query($sql);
          return ['status' => true];
     } else {
        return ['status' => false];
    }

    }else {
        return ['status' => false];
    }
}


// function to check login
function login($conn, $param)
{
    extract($param);

    // validation
    if(empty($email)) {
        return ['error' => 'email is required'];
    } else if(empty($password)) {
        return ['error' => 'password is required'];
    }




    // prepared statement (safe way)
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result && $result->num_rows > 0)
    {
        $users = mysqli_fetch_assoc($result);
        $hash = $users['password'];

        if(password_verify($password, $hash))
        {
            return ['status' => true, 'users' => $users];
        } else {
            return ['status' => false];
        }
    }
    else {
        return ['status' => false];
    }
}





// function of forget password

function resetPassword($conn, $param)
{
    extract($param);

    $sql = "SELECT * FROM reset_password WHERE reset_code = '$reset_code'";
    $result = $conn->query($sql);
    

     if($result && $result->num_rows > 0)
    {
         $code = mysqli_fetch_assoc($result);
          if($password == '$conf_password'){

             $hash = password_hash($password,PASSWORD_DEFAULT);
             //update password
             $sql = "update set users password = ' $hash' where id= ".$code['user_id'];
             $conn->query($sql);

             //delete reset password
               $sql = "delete from reset_password where id= ".$code['id'];
             $conn->query($sql);


             return ['status' => true, "msg" => "Password has been reset successfully"];

         }else{
           return ['status' => false , "msg" => "Cofirm password not matched"];
         }

     
     } else {
        return ['status' => false, "msg" => "INVALID RESET CODE"];
    }

}



// Function to change password
function changePassword($conn, $param)
{
    extract($param);
    $hash = $_SESSION['user']['password'];
    if (password_verify($current_pass, $hash)) {
        if ($new_pass == $conf_pass) {
            $hash = password_hash($new_pass, PASSWORD_DEFAULT);

            // Update password
            $sql = "UPDATE users SET password = '$hash' where id = " . $_SESSION['user']['id'];
            $conn->query($sql);
            $result = array('status' => true, "message" => "Password has been changed successfully");
        } else {
            $result = array('status' => false, "message" => "Confirm password doesn't match");
        }
    } else {

        $result = array('status' => false, "message" => "Invalid current password");
    }




    return $result;
}

// Function to update profile
function updateProfile($conn, $param)
{
    extract($param);

    //Upload image start
    $uploadTo = "assets/uploads/";
    $allowedFileTypes = array("jpg", "png", "jpeg", "gif");
    $fileName = $_FILES['profile_pic']['name'];
    $tempPath = $_FILES['profile_pic']['tmp_name'];

    //$basename = basename($fileName);
    $originalPath = $uploadTo . $fileName;
    $fileType = pathinfo($originalPath, PATHINFO_EXTENSION);

    if (!empty($fileName)) {
        if (in_array($fileType, $allowedFileTypes)) {
            $upload = move_uploaded_file($tempPath, $originalPath);
        } else {
            $result = array('status' => false, "message" => "Invalid file formate");
            return $result;
        }
    }
    //Upload image end


    $user_id = $_SESSION['user']['id'];
    $datetime = date("Y-m-d H:i:s");
    $sql = "UPDATE users SET 
        name = '$name', 
        email = '$email', 
        phone_no = '$phone_no',
        updated_at = '$datetime'";

    if (isset($upload)) {
        $sql .= ",profile_pic = '$fileName'";
        $_SESSION['user']['profile_pic'] = $fileName;
    }

    $sql .= " WHERE id = $user_id";
    $conn->query($sql);

    // Update session user data
    $_SESSION['user']['name'] = $name;
    $_SESSION['user']['email'] = $email;
    $_SESSION['user']['phone_no'] = $phone_no;

    $result = array('status' => true, "message" => "Profile has been updated successfully");
    return $result;
}
?>
