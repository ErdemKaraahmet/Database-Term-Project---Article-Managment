<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>All Journals</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                margin: 0;
                padding: 0;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
            }

            .container {
                background-color: #fff;
                border-radius: 8px;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                padding: 20px;
                text-align: center;
            }

            h4 {
                margin-bottom: 20px;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 20px;
            }

            table, th, td {
                border: 1px solid #ddd;
            }

            th, td {
                padding: 10px;
                text-align: left;
            }

            th {
                background-color: #007bff;
                color: #fff;
            }

            a {
                color: #007bff;
                text-decoration: none;
            }

            a:hover {
                text-decoration: underline;
            }

            p {
                margin-top: 20px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <?php
            error_reporting(E_ALL);
            ini_set('display_errors', 1);

            include "connection.php";

            // Query to journal data
            $sql = "SELECT name, frequency FROM journal ORDER BY name";
            $result = mysqli_query($conn, $sql);

            if (!$result) {
                die("Query failed: " . mysqli_error($conn));
            }
            ?>

            <h4>Journals</h4>
            <table border="2" cellspacing="2" cellpadding="2">
                <tr>
                    <th>Journal Name</th>
                    <th>Publication Frequency</th>
                </tr>

<?php
while ($row = mysqli_fetch_assoc($result)) {
    $name = htmlspecialchars($row["name"]);
    $frequency = htmlspecialchars($row["frequency"]);
    ?>
                    <tr>
                        <td><?php echo $name; ?></td>
                        <td><?php echo $frequency; ?></td>
                        <td>
                            <a href="journalVolumes.php?name=<?php echo urlencode($name); ?>">View Volumes</a>
                        </td>
                    </tr>
    <?php
}
mysqli_close($conn);
?>
            </table>

            <p>
                <a href="./">Return to main page</a>
            </p>

    </body>
</html>
