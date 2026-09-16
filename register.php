<?php
require_once "header.php";
require_once "database.php";

if($_SERVER["REQUEST_METHOD"] === "POST") {
    if ( isset($_POST['uname']) && isset($_POST['pword']) && isset($_POST['pword2']) && isset($_POST['fname']) && isset($_POST['lname']) &&
    isset($_POST['a1']) && isset($_POST['a2']) && isset($_POST['city']) && isset($_POST['tp']) &&
    isset($_POST['mp'])) {

        if($_POST['pword'] !== $_POST['pword2']) {
            $_SESSION["error"] = "passwords do not match";
            header("Location: register.php");
            exit;
        }

        if (strlen($_POST['pword']) != 6) {
            $_SESSION["error"] = "Password must be 6 characters long";
            header("Location: register.php");
            exit;
        }

        $test = $_POST['uname'];
        $sql = "SELECT Username FROM users WHERE Username = '$test'";
        $result = $conn->query($sql);

        if($result->num_rows > 0){
            $_SESSION["error"] = "Username already exists";
            header("Location: register.php");
            exit;
        } else {
        $un = $conn -> real_escape_string($_POST['uname']);
        $pw = $conn -> real_escape_string($_POST['pword']);
        $fn = $conn -> real_escape_string($_POST['fname']);
        $ln = $conn -> real_escape_string($_POST['lname']);
        $a1 = $conn -> real_escape_string($_POST['a1']);
        $a2 = $conn -> real_escape_string($_POST['a2']);
        $c = $conn -> real_escape_string($_POST['city']);
        $tp = $conn -> real_escape_string($_POST['tp']);
        $mp = $conn -> real_escape_string($_POST['mp']);

        $hashed_pw = password_hash($pw, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (Username, Password, FirstName, Surname, AddressLine1, AddressLine2, City, Telephone, Mobile)
        VALUES ('$un', '$hashed_pw', '$fn', '$ln', '$a1', '$a2', '$c', '$tp', '$mp')";
        $conn->query($sql);
        echo 'Account successfully registered - <a href="login.php">continue to login</a>';
        }
        return;
    } else {
        $_SESSION["error"] = "All fields required";
        header("Location: register.php");
        exit;
    }
} 

?>

<p>Create your account</p>
<form method="post">
<p>Username:
<input type="text" name="uname"></p>
<p>Password:
<input type="password" name="pword"></p>
<p>Confirm Password:
<input type="password" name="pword2"></p>
<p>First Name:
<input type ="text" name="fname"></p>
<p>Surname:
<input type="text" name="lname"></p>
<p>Address Line 1:
<input type="text" name="a1"></p>
<p>Address Line 2:
<input type="text" name="a2"></p>
<p>City:
<input type="text" name="city"></p>
<p>Telephone:
<input type="number" name="tp"></p>
<p>Mobile Phone:
<input type="number" name="mp"></p>
<p><input type="submit" value="Add New"/>
<a href="login.php">Cancel</a></p>
</form>

<?php
if ( isset($_SESSION["error"]) ) {
    echo('<p style="color:red">Error: '. $_SESSION["error"]."</p>\n");
    unset($_SESSION["error"]);
}
require_once "footer.php";
?>


