
<?php



// Declaring variable to prevent errors
$fname = ""; // First Name
$lname = ""; // Last Name
$em = ""; // Email 1
$em1 = ""; // Confirm Email
$password = ""; // Password
$password2 = ""; // Confirm Password
$date = ""; // Sign up date
$error_array = array(); // Holds error messages

if(isset($_POST['register_button'])) {
    // Registration form values

    // First name
    $fname = strip_tags($_POST['reg_fname']); // Remove html tags
    $fname = str_replace(' ', '', $fname); // Remove spaces
    $fname = ucfirst(strtolower($fname)); // Uppercase first letter
    $_SESSION['reg_fname'] = $fname; // Store first name into session variable

    // Last name
    $lname = strip_tags($_POST['reg_lname']); // Remove html tags
    $lname = str_replace(' ', '', $lname); // Remove spaces
    $lname = ucfirst(strtolower($lname)); // Uppercase first letter
    $_SESSION['reg_lname'] = $lname; // Store last name into session variable
    // Email
    $em = strip_tags($_POST['reg_email']); // Remove html tags
    $em = str_replace(' ', '', $em); // Remove spaces
    $em = ucfirst(strtolower($em)); // Uppercase first letter
    $_SESSION['reg_email'] = $em; // Store email session variable

    // Confirm email
    $em2 = strip_tags($_POST['reg_email2']); // Remove html tags
    $em2 = str_replace(' ', '', $em2); // Remove spaces
    $em2 = ucfirst(strtolower($em2)); // Uppercase first letter
    $_SESSION['reg_email2'] = $em2; // Store email2 session variable

    // Password
    $password = strip_tags($_POST['reg_password']); // Remove html tags

    // Confirm password
    $password2 = strip_tags($_POST['reg_password2']); // Remove html tags

    $date = date("Y-m-d");

    if($em == $em2) {
        // Check if email is in valid format
        if(filter_var($em, FILTER_VALIDATE_EMAIL)) {
            $em = filter_var($em, FILTER_VALIDATE_EMAIL);

            // Check if email already exists
            $e_check = mysqli_query($con, "SELECT email from users WHERE email='$em'");

            // Count number of rows returned
            $num_rows = mysqli_num_rows($e_check);

            if($num_rows > 0) {
                array_push($error_array, "Email already in use<br>");
            }
        }
        else {
            array_push($error_array, "Invalid email format<br>");
        }
    }
    else {
        array_push($error_array,"Emails don't match!!!<br>");
    }
    if(strlen($fname > 25) || strlen($fname) < 2) {
        array_push($error_array,"Your first name must be between 2 and 25 characters<br>");
    }
    if(strlen($lname > 25) || strlen($lname) < 2) {
        array_push($error_array,"Your last name must be between 2 and 25 characters<br>");
    }
    if($password != $password2) {
        array_push($error_array, "Passwords do not match<br>");
    }
    else {
        if(preg_match('/[^A-Za-z0-9]/', $password)) {   // Check if password only contains letters or numbers
            array_push($error_array,"Your password can only contain english characters of numbers<br>");
        }
    }
    if(strlen($password) > 30 || strlen($password) < 5) {
        array_push($error_array,"Your password must be between 5 and 30 characters<br>");
    }
    if(empty($error_array)) {

        $password = md5($password); // Encrypt password before sending to database

        // Generate username by concatenating first and last name
        $username = strtolower($fname . "_" . $lname);
        $check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");

        $i = 0;
        // If username exists add number to username
        while(mysqli_num_rows($check_username_query) != 0) {
            $i++;
            $username = $username . "_" . $i;
            $check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");
        }

        // Assign default profile picture
        $rand = rand(1, 16);
        if($rand == 1) $profile_pic = "assets/images/profile_pics/defaults/head_deep_blue.png";
        else if($rand == 2) $profile_pic = "assets/images/profile_pics/defaults/head_alizarin.png";
        else if($rand == 3) $profile_pic = "assets/images/profile_pics/defaults/head_amethyst.png";
        else if($rand == 4) $profile_pic = "assets/images/profile_pics/defaults/head_belize_hole.png";
        else if($rand == 5) $profile_pic = "assets/images/profile_pics/defaults/head_carrot.png";
        else if($rand == 6) $profile_pic = "assets/images/profile_pics/defaults/head_emerald.png";
        else if($rand == 7) $profile_pic = "assets/images/profile_pics/defaults/head_green_sea.png";
        else if($rand == 8) $profile_pic = "assets/images/profile_pics/defaults/head_nephrittis.png";
        else if($rand == 9) $profile_pic = "assets/images/profile_pics/defaults/head_pete_river.png";
        else if($rand == 10) $profile_pic = "assets/images/profile_pics/defaults/head_pomegranate.png";
        else if($rand == 11) $profile_pic = "assets/images/profile_pics/defaults/head_pumpkin.png";
        else if($rand == 12) $profile_pic = "assets/images/profile_pics/defaults/head_red.png";
        else if($rand == 13) $profile_pic = "assets/images/profile_pics/defaults/head_sun_flower.png";
        else if($rand == 14) $profile_pic = "assets/images/profile_pics/defaults/head_turqoise.png";
        else if($rand == 15) $profile_pic = "assets/images/profile_pics/defaults/head_wet_asphalt.png";
        else if($rand == 16) $profile_pic = "assets/images/profile_pics/defaults/head_wisteria.png";

        // Insert values into database

        $query = mysqli_query($con, "INSERT INTO users VALUES (NULL, '$fname', '$lname', '$username', '$em', '$password', '$date', '$profile_pic', '0', '0', 'no', ',')");

        array_push($error_array, "<span style='color: #14C800;'>You're all set! Go ahead and login!</span><br>");

        // Clear session variables
        $_SESSION['reg_fname'] = "";
        $_SESSION['reg_lname'] = "";
        $_SESSION['reg_email'] = "";
        $_SESSION['reg_email2'] = "";
    }
}
?>