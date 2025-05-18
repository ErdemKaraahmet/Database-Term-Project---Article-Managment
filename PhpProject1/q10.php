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
        <title>Articles with Status</title>
    </head>
        
    
    <body>
        <h2>Articles with Status</h2>
        <?php
        include "connection.php"; 
        $sql = "
            SELECT a.title, a.result
            FROM article a
            JOIN writtenby w ON a.id = w.articleId
        ";

        //execute the SQL query
        $result = $conn->query($sql);

        echo "<table border='1'>
                    <tr>
                        <th>Title</th>
                        <th>Status</th>
                    </tr>";
            //Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . htmlspecialchars($row["title"]) . "</td>
                        <td>" . htmlspecialchars($row["result"]) . "</td>
                      </tr>";
            }
            echo "</table>";
        

        $conn->close();
        ?>
    </body>
</html>
