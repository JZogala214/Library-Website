<?php 
require_once "header.php";
require_once "database.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Validate input
    if (empty($_POST["account"]) || empty($_POST["pw"])) {
        $_SESSION["error"] = "Missing Required Information";
        header("Location: login.php");
        exit;
    }

    $username = $_POST["account"];
    $password = $_POST["pw"];

    $stmt = $conn->prepare("SELECT Username, Password FROM users WHERE Username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    $user = $result->fetch_assoc();

    if ($user === false) {
        $_SESSION["error"] = "Incorrect username or password.";
        header("Location: login.php");
        exit;
    }
    
    if (password_verify($password, $user["Password"])) {
        $_SESSION["account"] = $user["Username"];
        $_SESSION["success"] = "Logged in.";
        header("Location: index.php");
        exit;
    }

    // Wrong password
    $_SESSION["error"] = "Incorrect username or password.";
    header("Location: login.php");
    exit;
}
?>
<h1>Please Log In</h1>

<?php
if ( isset($_SESSION["error"]) ) {
    echo('<p style="color:red">Error: '. $_SESSION["error"]."</p>\n");
    unset($_SESSION["error"]);
}
?>

<form method="post">
<p>Username: <input type="text" name="account" value=""></p>
<p>Password: <input type="password" name="pw" value=""></p>
<p><input type="submit" value="Log In">
<input type="button" value="Home" onclick="location.href='index.php'; return false;">
</p>

</form>
<?php
require_once "footer.php";
?>