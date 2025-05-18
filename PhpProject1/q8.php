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
        <title>Reviewers with Minimum Reviews</title>
    </head>
        
    
    <body>
        <h2>List of Reviewers with Minimum Number of Articles Reviewed</h2>
        <?php
        include "connection.php";
        $sql = "
            SELECT email
            FROM (
                SELECT email, COUNT(id) AS num_reviews
                FROM articlereviews
                GROUP BY email
            ) AS review_counts
            WHERE num_reviews = (
                SELECT MIN(num_reviews) FROM (
                    SELECT COUNT(id) AS num_reviews
                    FROM articlereviews
                    GROUP BY email
                ) AS min_reviews
            )
        ";

        // Prepare statement
        if ($stmt = $conn->prepare($sql)) {
            $stmt->execute();
            $result = $stmt->get_result();

            // Check if any results were returned
            if ($result->num_rows > 0) {
                echo "<table border='1'>
                        <tr>
                            <th>Email</th>
                        </tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . htmlspecialchars($row['email']) . "</td>
                          </tr>";
                }
                echo "</table>";
            } else {
                echo "<p>No reviewers found.</p>";
            }

            $stmt->close();
        } else {
            // Print error if prepare() fails
            echo "Error preparing statement: " . $conn->error;
        }

        $conn->close();
        ?>
    </body>
</html>
