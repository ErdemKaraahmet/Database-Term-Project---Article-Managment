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
        <title>Submitted Articles</title>
    </head>
        
    
    <body>
        <form method="post" action="">
            <label for="volId">Enter Volume ID:</label>
            <input type="text" id="volId" name="volId" required>
            <br>
            <label for="volName">Enter Volume Name:</label>
            <input type="text" id="volName" name="volName" required>
            <br>
            <input type="submit" value="Get Articles">
        </form>
        <?php
        include "connection.php"; // Make sure this file contains your database connection details

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $volId = $_POST['volId'];
            $volName = $_POST['volName'];

            // Prepare and execute the SQL query
            $sql = "SELECT a.title, w.email as author, ar.email as reviewer 
                    FROM article a
                    JOIN articlereviews ar ON a.id = ar.id
                    JOIN writtenby w ON a.id = w.id
                    WHERE a.volId = ? AND a.volName = ?";

            // Prepare statement
            if ($stmt = $conn->prepare($sql)) {
                $stmt->bind_param("ss", $volId, $volName);
                $stmt->execute();
                $result = $stmt->get_result();

                // Check if any results were returned
                if ($result->num_rows > 0) {
                    echo "<table border='1'>
                            <tr>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Reviewer</th>
                            </tr>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . htmlspecialchars($row['title']) . "</td>
                                <td>" . htmlspecialchars($row['author']) . "</td>
                                <td>" . htmlspecialchars($row['reviewer']) . "</td>
                              </tr>";
                    }
                    echo "</table>";
                } else {
                    echo "<p>No articles found for Volume ID: $volId and Volume Name: $volName</p>";
                }

                $stmt->close();
            } else {
                // Print error if prepare() fails
                echo "Error preparing statement: " . $conn->error;
            }

            $conn->close();
        }
        ?>
    </body>
</html>
