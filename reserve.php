<?php 
require_once "header.php";
require_once "database.php";

if (!isset($_SESSION['account'])) {
    header("Location: index.php");
    exit;
}

// Check if the ISBN is provided
if (!isset($_GET['isbn'])) {
    echo "Invalid request!";
    exit;
}

$isbn = $_GET['isbn'];
$username = $_SESSION['account'];

// First, check if the book is already reserved
$sql = "SELECT Reserved, BookTitle FROM books WHERE ISBN = '$isbn'";
$result = $conn->query($sql);
if ($result->num_rows === 0) {
    echo "Book not found!";
    exit;
}

$book = $result->fetch_assoc();

if ($book['Reserved'] === 'Y') {
    echo "Sorry, '{$book['BookTitle']}' is already reserved!";
    exit;
}

// Reserve the book
$conn->begin_transaction();

try {

$sql = "UPDATE books SET Reserved = 'Y' WHERE ISBN = '$isbn'";
$conn->query($sql);

$sql = "INSERT INTO reservations (ISBN, Username, ReservedDate) VALUES ('$isbn', '$username', CURDATE())";
$conn->query($sql);

$conn->commit();

echo "You have successfully reserved '{$book['BookTitle']}'!";
echo "<br><a href='index.php'>Home</a>";

} catch (Exception $e) {
    $conn->rollback();
    echo "Failed to reserve book please try again";
}

require_once "footer.php";
?>