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
        <title>Article Review Result</title>
    </head>
    <body>
        <form method="post" action="">
            <label for="articleId">Enter Article ID:</label>
            <input type="text" id="articleId" name="articleId" required>
            <input type="submit" value="Get Result">
        </form>
        <?php
        include "connection.php";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $articleId = $_POST['articleId'];

            $sql = "SELECT a.id, 
                    IF(AVG(scoreOfTheReviewer) = 1 , 'Accept', 
                    IF(AVG(scoreOfTheReviewer) = 0 , 'Reject', 
                       'Revision')) AS result 
                    FROM Article a, articlereviews ar 
                    WHERE a.id = ar.id AND a.id = ?
                    GROUP BY a.id";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $articleId);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                echo "<table>
                        <tr>
                            <th>Article ID</th>
                            <th>Result</th>
                        </tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row['id'] . "</td>
                            <td>" . $row['result'] . "</td>
                          </tr>";
                }
                echo "</table>";
            } else {
                echo "<p>No article found with ID: $articleId</p>";
            }

            $stmt->close();
            $conn->close();
        } else {
            echo "<p>Please enter a valid numeric Article ID.</p>";
        }
        ?>
    </body>
</html>
