<?php
include "connection.php";
//Initialize variables for input and result
$volid = isset($_POST['volid']) ? $_POST['volid'] : '';
$volName = isset($_POST['volName']) ? $_POST['volName'] : '';
$result = null;

//execute query if inputs are provided
if (!empty($volid) && !empty($volName)) {
    $stmt = $conn->prepare("SELECT * FROM article WHERE volid = ? AND volName = ?");
    $stmt->bind_param("ss", $volid, $volName);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
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

        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            VolID: <input type="text" name="volid" value="<?php echo htmlspecialchars($volid); ?>"><br>
            VolName: <input type="text" name="volName" value="<?php echo htmlspecialchars($volName); ?>"><br>
            <input type="submit" value="Submit">
        </form>

        <?php if ($result && $result->num_rows > 0): ?>
            <table border="1">
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>VolID</th>
                    <th>VolName</th>
                </tr>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row["id"]); ?></td>
                        <td><?php echo htmlspecialchars($row["title"]); ?></td>
                        <td><?php echo htmlspecialchars($row["volid"]); ?></td>
                        <td><?php echo htmlspecialchars($row["volname"]); ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php elseif ($_SERVER['REQUEST_METHOD'] == 'POST'): ?>
            <p>No results found.</p>
        <?php endif; ?>

    </body>
</html>