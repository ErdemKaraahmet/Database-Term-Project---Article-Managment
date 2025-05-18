<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Journal Volumes</title>
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
                max-width: 1400px;
                width: 100%;
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

            if (!file_exists('connection.php')) {
                die('Error: connection.php file not found.');
            }

            include "connection.php";

            if (!$conn) {
                die('Error: Failed to connect to database.');
            }

            // Get the journal name from the URL
            if (!isset($_GET['name'])) {
                die('Error: Journal name not specified.');
            }
            $journalName = urldecode($_GET['name']);

            //Query for volume data
            $sql = "SELECT name,id, publicationDate, firstSubOpen, firstSubDeadline, reviewStarts, reviewDeadline, resultsAnnouncement, secondSubOpen, secondSubDeadline 
                FROM volume WHERE name = ?";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $journalName);
            $stmt->execute();
            $result = $stmt->get_result();

            if (!$result) {
                die("Query failed: " . mysqli_error($conn));
            }
            ?>

            <h4>Volumes for Journal: <?php echo htmlspecialchars($journalName); ?></h4>
            <table border="2" cellspacing="2" cellpadding="2">
                <tr>
                    <th>Volume Name</th>
                    <th>Volume ID</th>
                    <th>Publication Date</th>
                    <th>First Submission Open</th>
                    <th>First Submission Deadline</th>
                    <th>Review Starts</th>
                    <th>Review Deadline</th>
                    <th>Results Announcement</th>
                    <th>Second Submission Open</th>
                    <th>Second Submission Deadline</th>
                    <th>View Articles</th>
                </tr>

                <?php
                //display volume data
                while ($row = mysqli_fetch_assoc($result)) {
                    $name = htmlspecialchars($row["name"]);
                    $id = htmlspecialchars($row["id"]);
                    $publicationDate = htmlspecialchars($row["publicationDate"]);
                    $firstSubOpen = htmlspecialchars($row["firstSubOpen"]);
                    $firstSubDeadline = htmlspecialchars($row["firstSubDeadline"]);
                    $reviewStarts = htmlspecialchars($row["reviewStarts"]);
                    $reviewDeadline = htmlspecialchars($row["reviewDeadline"]);
                    $resultsAnnouncement = htmlspecialchars($row["resultsAnnouncement"]);
                    $secondSubOpen = htmlspecialchars($row["secondSubOpen"]);
                    $secondSubDeadline = htmlspecialchars($row["secondSubDeadline"]);
                    ?>
                    <tr>
                        <td><?php echo $name; ?></td>
                        <td><?php echo $id; ?></td>
                        <td><?php echo $publicationDate; ?></td>
                        <td><?php echo $firstSubOpen; ?></td>
                        <td><?php echo $firstSubDeadline; ?></td>
                        <td><?php echo $reviewStarts; ?></td>
                        <td><?php echo $reviewDeadline; ?></td>
                        <td><?php echo $resultsAnnouncement; ?></td>
                        <td><?php echo $secondSubOpen; ?></td>
                        <td><?php echo $secondSubDeadline; ?></td>
                        <td>
                            <a href="volumeArticles.php?volname=<?php echo urlencode($journalName); ?>&volid=<?php echo urlencode($id); ?>">View Articles</a>
                        </td>
                    </tr>
                    <?php
                }

                $stmt->close();
                mysqli_close($conn);
                ?>
            </table>

            <p>
                <a href="allJournals.php">Return to Journals List</a>
            </p>

    </body>
</html>
