<?php
session_start();
include 'connection.php';
// echo $_POST["username"];
// echo $_POST["pass"];
// print_r($_POST);
if (isset($_POST['username']) && isset($_POST['pass'])) {

    function validate($data){

       $data = trim($data);

       $data = stripslashes($data);

       $data = htmlspecialchars($data);

       return $data;

    }

    $uname = validate($_POST['username']);

    $pass = validate($_POST['pass']);

    if (empty($uname) || (empty($pass)))
     {
        
        // header("Location: index.php?error=User Name is required");
        echo '<script>alert("incorrect user name/password ,please try again."); window.history.back();</script>';
        exit();
    }else{

        $sql = "SELECT * FROM employees WHERE username='$uname' AND password='$pass'";
        echo "$sql";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) 
        {

            $row = mysqli_fetch_assoc($result);

            if ($row['username'] === $uname && $row['password'] === $pass) {

                echo "Logged in!";

                $_SESSION['userid'] = $row['employee_id'];

                // $_SESSION['id'] = $row['id'];

                header("Location: index.php");

                exit();

            }else{
                echo '<script>alert("User not found"); window.history.back();</script>';
                // header("Location: index.php?error=Incorect User name or password");

                // exit();

            }

        }else
        {
            echo '<script>alert("User not found"); window.history.back();</script>';
            // header("Location: index.php?error=Incorect User name or password");

            // exit();

        }

    }

}else{
    echo '<script>alert("Username or Password empty"); window.history.back();</script>';
    // header("Location: index.php");

    // exit();

}
// $mobile_no = $_REQUEST['mobile_number'];
// $password = md5($_REQUEST['password']);
// echo md5(123456);
// $admin = $db->select("admin", "*", ["AND" => ['mobile' => $mobile_no, 'password' => $password]]);
// //print_r($admin);
// if (isset($admin)) {
//     $admin = $admin[0];
//     $mess_verified = $db->select("mess_profile", "*", ['mess_id' => $admin['mess_id']])[0];
//     if ($admin['can_login'] == 1 and $admin['deleted'] == 0 and $mess_verified['is_verified'] == '1') {
//         $mess = $db->select("mess_profile", "*", ['mess_id' => $admin['mess_id']])[0];
//         $_SESSION['admin'] = $admin;
//         $_SESSION['mess'] = $mess;
//         header("location:index.php");
//     } else {

//         echo '<script>alert("Invalid User"); window.history.back(); </script>';
//     }
// } else {

//     echo '<script>alert("incorrect user name/password ,please try again."); window.history.back();</script>';
// }