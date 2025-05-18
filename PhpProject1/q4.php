<?php
include "connection.php";
$articleId = isset($_POST['articleId']) ? $_POST['articleId'] : '';
$result = null;

// Prepare and execute query if input is provided
if (!empty($articleId)) {
    $query = "
        SELECT ar.* 
        FROM articlereviews ar
        JOIN article a ON a.id = ar.articleId
        WHERE a.id = ?
    ";

    // Check if prepare() returns false
}

$conn->close();
?>

<!DOCTYPE html>
<html>
    <head>
        <style>
            table {
                width: 50%;
                border-collapse: collapse;
            }
            table, th, td {
                border: 1px solid black;
            }
            th, td {
                padding: 10px;
                text-align: left;
            }
        </style>
    </head>
    <body>

        <form method="post">
            Article ID: <input type="text" name="articleId" value="<?php echo htmlspecialchars($articleId); ?>"><br>
            <input type="submit" value="Submit">
        </form>

        <?php if ($result && $result->num_rows > 0): ?>
            <table border="1">
                <tr>
                    <th>Email</th>
                    <th>Article ID</th>
                    <th>Score</th>
                </tr>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row["email"]); ?></td>
                        <td><?php echo htmlspecialchars($row["id"]); ?></td>
                        <td><?php echo htmlspecialchars($row["score"]); ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php elseif ($_SERVER['REQUEST_METHOD'] == 'POST'): ?>
            <p>No results found.</p>
        <?php endif; ?>

    </body>
</html>
