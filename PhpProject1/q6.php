<?php
include "connection.php";
$x = '';
$y = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $x = $_POST['volid'];
    $y = $_POST['volname'];

    $sql = "SELECT ar.email, a.title
            FROM article a, articlereviews ar
            WHERE a.id = ar.id
            AND a.volid = ?
            AND a.volname = ?
            AND a.result = 'accepted'";

    // Prepare and bind
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $x, $y); // Assuming volid is integer and volname is string
    // Execute the query
    $stmt->execute();
    $result = $stmt->get_result();
}
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
        <title>Fetch Articles</title>
    </head>
   

    <body>

        <h2>Fetch Accepted Articles</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            Volume ID: <input type="text" name="volid">
            Volume Name: <input type="text" name="volname">
            <input type="submit" name="submit" value="Submit">
        </form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($result->num_rows > 0) {
        echo "<table border='1'>
                <tr>
                    <th>Email</th>
                    <th>Title</th>
                </tr>";
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . htmlspecialchars($row["email"]) . "</td>
                    <td>" . htmlspecialchars($row["title"]) . "</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }
    // Close the statement
    $stmt->close();
}
// Close the connection
$conn->close();
?>

    </body>
</html>