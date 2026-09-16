<?php
require_once "header.php";
require_once "database.php";

if (!isset($_SESSION['account'])) {
    header("Location: index.php");
    exit;
}

$username = $_SESSION['account'];

$sql = "SELECT b.ISBN, BookTitle, Author, ReservedDate, CategoryDescription 
        FROM reservations r
        JOIN books b ON r.ISBN = b.ISBN
        JOIN categories c ON b.CategoryID = c.CategoryID
        WHERE r.Username = '$username'";
$result = $conn->query($sql);
?>
<h2>Your reserved books</h2>
<?php
if ($result->num_rows > 0) {
    // output data in a table
    echo "<table border='1'>";
    echo "<tr>
            <th>ISBN</th>
            <th>Book Title</th>
            <th>Author</th>
            <th>Category</th>
            <th>Date Reserved</th>
            <th>View</th>
            <th>Remove Reservation</th>
        </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>";
        echo (htmlentities($row["ISBN"]));
        echo ("</td><td>");
        echo (htmlentities($row["BookTitle"]));
        echo ("</td><td>");
        echo (htmlentities($row["Author"]));
        echo ("</td><td>");
        echo (htmlentities($row["CategoryDescription"]));
        echo ("</td><td>");
        echo (htmlentities($row["ReservedDate"]));
        echo ("</td><td>");
        echo ('<a href ="view.php?id='.htmlentities($row["ISBN"]).'">View Book</a>');
        echo ("</td><td>");
        echo '<a href="unreserve.php?isbn='.htmlentities($row["ISBN"]).'">Remove this book</a>';
        echo ("</td></tr>\n");
    }
    echo "</table>";
} else {
    echo "0 results";
}
?>
<input type="button" value="Home" onclick="location.href='index.php'; return false;">

<?php
require_once "footer.php";
?>

