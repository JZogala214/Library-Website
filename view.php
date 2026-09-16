<?php
require_once "header.php";
require_once "database.php";

if (!isset($_SESSION['account'])) {
    header("Location: index.php");
    exit;
}

$isbn = $conn -> real_escape_string($_GET['id']);
$sql = "SELECT b.ISBN, b.BookTitle, b.Author, b.Edition, b.Year, 
               b.Reserved, c.CategoryDescription
        FROM books b
        JOIN categories c ON b.CategoryID = c.CategoryID
        WHERE b.ISBN = '$isbn'";
        $result = $conn->query($sql);
//$row = $result->fetch_assoc();

if ($result->num_rows === 0) {
        echo "0 results";

} else {
        // output data in a table
    echo "<table border='1'>";
    echo "<tr>
            <th>ISBN</th>
            <th>Book Title</th>
            <th>Author</th>
            <th>Edition</th>
            <th>Release Year</th>
            <th>Reserved</th>
            <th>Category</th>
        </tr>";
    $row = $result->fetch_assoc();
        echo "<tr><td>";
        echo (htmlentities($row["ISBN"]));
        echo ("</td><td>");
        echo (htmlentities($row["BookTitle"]));
        echo ("</td><td>");
        echo (htmlentities($row["Author"]));
        echo ("</td><td>");
        echo (htmlentities($row["Edition"]));
        echo ("</td><td>");
        echo (htmlentities($row["Year"]));
        echo ("</td><td>");
        echo (htmlentities($row["Reserved"]));
        echo ("</td><td>");
        echo (htmlentities($row["CategoryDescription"]));
        echo ("</td></tr>\n");
    echo "</table>";
}
?>
<input type="button" value="Home" onclick="location.href='index.php'; return false;">

<?php
require_once "footer.php";
?>

