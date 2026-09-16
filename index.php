<?php
require_once "header.php";
require_once "database.php";
if ( isset($_SESSION["error"]) ) {
    echo('<p style="color:red">Error:'.$_SESSION["error"]."</p>\n");
    unset($_SESSION["error"]);
}
if ( isset($_SESSION["success"]) ) {
    echo('<p style="color:green">'.$_SESSION["success"]."</p>\n");
    unset($_SESSION["success"]);
}

?>

<?php
if ( !isset($_SESSION["account"]) ) { 
    ?>
    Please <a href="login.php">Log In</a> to start.
    Or <a href = "register.php">Register</a> if you are a new user.
    <?php 
} else { 
    ?>
    <p>Welcome to the library:</p>
    <a href = "search.php">Search</a>
    <p>Your Profile</p>
    <a href = "resbooks.php">Your reserved books</a>
    <a href = "logout.php">Log out</a>
    <?php 

}
?>
<?php
require_once "footer.php";
?>