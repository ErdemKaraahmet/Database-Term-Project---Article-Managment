<?php
include "connection.php";

//initialize variables for input and result
$vid = isset($_POST['vid']) ? $_POST['vid'] : '';
$vname = isset($_POST['vname']) ? $_POST['vname'] : '';
$result = null;

//execute query if inputs are provided
if (!empty($vid) && !empty($vname)) {
    $stmt = $conn->prepare("SELECT * FROM person WHERE vid = ? AND vname = ? AND isAuthor = false AND isReviewer = false AND isEditor = false");
    $stmt->bind_param("ss", $vid, $vname);
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

        <form method="post">
            Vid: <input type="text" name="vid" value="<?php echo htmlspecialchars($vid); ?>"><br>
            Vname: <input type="text" name="vname" value="<?php echo htmlspecialchars($vname); ?>"><br>
            <input type="submit" value="Submit">
        </form>

        <?php if ($result && $result->num_rows > 0): ?>
            <table border="1">
                <tr>
                    <th>Email</th>
                    <th>Name</th>
                    <th>Vid</th>
                    <th>Vname</th>
                    <th>isAuthor</th>
                    <th>isReviewer</th>
                    <th>isEditor</th>
                </tr>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row["email"]); ?></td>
                        <td><?php echo htmlspecialchars($row["name"]); ?></td>
                        <td><?php echo htmlspecialchars($row["vid"]); ?></td>
                        <td><?php echo htmlspecialchars($row["vname"]); ?></td>
                        <td><?php echo htmlspecialchars($row["isAuthor"]); ?></td>
                        <td><?php echo htmlspecialchars($row["isReviewer"]); ?></td>
                        <td><?php echo htmlspecialchars($row["isEditor"]); ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php elseif ($_SERVER['REQUEST_METHOD'] == 'POST'): ?>
            <p>No results found.</p>
        <?php endif; ?>

    </body>
</html>
