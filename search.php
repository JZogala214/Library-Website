<?php 
require_once "header.php";
require_once "database.php";

if (!isset($_SESSION['account'])) {
    header("Location: index.php");
    exit;
}

$limit = 5; // books per page
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$offset = ($page - 1) * $limit;

$where = "WHERE  1";

if(!empty($_POST['book'])) {
    $title = $_POST['book'];
    $where .= " AND BookTitle LIKE '$title%'";
}

if(!empty($_POST['author'])) {
    $author = $_POST['author'];
    $where .= " AND Author LIKE '$author%'";
}

if(isset($_POST['cat']) && $_POST['cat'] != "")
{
    $category = $_POST['cat'];
    $where .= " AND CategoryDescription = '$category'";
}
$pgSql = "SELECT COUNT(*) AS total FROM books b
        JOIN categories c ON b.CategoryID = c.CategoryID
        $where";

$count = $conn->query($pgSql);
$total_rows = $count->fetch_assoc()['total'];
$total_pages = ceil($total_rows/$limit);

$sql = "SELECT ISBN, BookTitle, Author, Edition, Reserved, CategoryDescription FROM books b
        JOIN categories c ON b.CategoryID = c.CategoryID
        $where
        LIMIT $limit OFFSET $offset";

$result = $conn->query($sql);
?>

<form method = "post">
    <p>Book Title:
    <input type="text" name="book">
    Author:
    <input type="text" name="author">
    <select name = "cat">
        <option value = "">Category</option>
        <option value = "">Any</option>
        <?php
        $cat = "SELECT * FROM categories";
        $resultM = $conn->query($cat);
        while ($row = $resultM->fetch_assoc()) {
            echo "<option value='" . htmlentities($row["CategoryDescription"]) . "'>";
            echo htmlentities($row["CategoryDescription"]);
            echo "</option>";
        } 
        ?>
    </select>
    <input type="submit" value="Search">
    <input type="button" value="Home" onclick="location.href='index.php'; return false;">
    </p>
</form>

<?php
if ($result->num_rows > 0) {
    // output data in a table
    echo "<p><strong>Showing page $page of $total_pages ($total_rows results)</strong></p>";

    echo "<table border='1'>";
        echo "<tr>
            <th>ISBN</th>
            <th>Book Title</th>
            <th>Author</th>
            <th>Edition</th>
            <th>Category</th>
            <th>Reserved</th>
            <th>View</th>
        </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>";
        echo (htmlentities($row["ISBN"]));
        echo ("</td><td>");
        echo (htmlentities($row["BookTitle"]));
        echo ("</td><td>");
        echo (htmlentities($row["Author"]));
        echo ("</td><td>");
        echo (htmlentities($row["Edition"]));
        echo ("</td><td>");
        echo (htmlentities($row["CategoryDescription"]));
        echo ("</td><td>");
        if ($row["Reserved"] == 'N')
            {
                echo ("Available"); 
                echo '<a href="reserve.php?isbn='.htmlentities($row["ISBN"]).'">Reserve this book</a>';
              //  echo ("Click here to reserve!!!"); //implement button dont be a bum
            }
            else
            {
                echo ("Reserved");
                echo ("Unavailable for reservation");
            }
        echo ("</td><td>");
        echo ('<a href ="view.php?id='.htmlentities($row["ISBN"]).'">View Book</a>');
        echo ("</td></tr>\n");
    }
    echo "</table>";
} else {
    echo "0 results";
}

echo "<p>Pages: ";
for ($i = 1; $i <= $total_pages; $i++) {
    echo "<a href='search.php?page=$i'>$i</a> ";
}
echo "</p>";

require_once "footer.php";
?>
