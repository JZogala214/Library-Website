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

if ($book['Reserved'] === 'N') {
    echo "Sorry, '{$book['BookTitle']}' is not on loan currently!";
    exit;
}

// Reserve the book
$conn->begin_transaction();

try {
$sql = "DELETE FROM reservations WHERE ISBN = '$isbn' AND Username = '$username'";
$conn->query($sql);

$sql = "UPDATE books SET Reserved = 'N' WHERE ISBN = '$isbn'";
$conn->query($sql);

$conn->commit();

echo "You have successfully removed '{$book['BookTitle']}'!";
echo "<br><a href='resbooks.php'>Back</a>";

} catch (Exception $e) {
    $conn->rollback();
    echo "Failed to cancel reservation please try again";
}

require_once "footer.php";
?>