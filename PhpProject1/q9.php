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
        <title>Most Productive Author</title>
    </head>
    
    <body>
        <h2>Most Productive Author (Maximum Number of Accepted Articles)</h2>
        <?php
        include "connection.php"; 
        $sql = "
            SELECT correspAut AS author, COUNT(id) AS num_accepted_articles
            FROM Article
            WHERE result = 'accepted'
            GROUP BY correspAut
            ORDER BY num_accepted_articles DESC
            LIMIT 1
        ";

        // Prepare and execute the SQL query
        $result = $conn->query($sql);

        // Check if any results were returned
        if ($result->num_rows > 0) {
            echo "<table border='1'>
                    <tr>
                        <th>Author</th>
                        <th>Number of Accepted Articles</th>
                    </tr>";
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . htmlspecialchars($row["author"]) . "</td>
                        <td>" . htmlspecialchars($row["num_accepted_articles"]) . "</td>
                      </tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No productive author found.</p>";
        }

        $conn->close();
        ?>
    </body>
</html>
