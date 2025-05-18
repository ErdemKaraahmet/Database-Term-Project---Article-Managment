<?php
session_start();
include "connection.php";

if (!$conn) {
    die('Error: Failed to connect to database.');
}

// Get the reviewer's email address from POST request
if (!isset($_POST['email']) && !isset($_SESSION['reviewer_email'])) {
    die('Error: Email address not provided.');
}

if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $_SESSION['reviewer_email'] = $email;
} else {
    $email = $_SESSION['reviewer_email'];
}

//articles assigned to the reviewer
$sql = "SELECT a.id, a.title, a.bodytext, a.correspAut, a.submissionDate, a.result, p.vname, p.vid, v.secondSubDeadline
        FROM article a
        JOIN writtenby wr ON a.id = wr.id
        JOIN person p ON wr.email=p.email
        JOIN volume v ON p.vname = v.name AND p.vid=v.id
        WHERE wr.email = ?";
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die('Error: ' . htmlspecialchars($conn->error));
}
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

$articles = [];
while ($row = mysqli_fetch_assoc($result)) {
    $articles[] = $row;
}

$stmt->close();
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Author Home</title>
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
                max-width: 1000px;
                width: 100%;
            }

            h2, h3 {
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

            <h2>Welcome, <?php echo htmlspecialchars($email); ?></h2>

            <h3>Articles Assigned to You:</h3>
            <table border="2" cellspacing="2" cellpadding="2">
                <tr>
                    <th>Article ID</th>
                    <th>Title</th>
                    <th>Corresponding Author</th>
                    <th>Submission Date</th>
                    <th>Result</th>
                    <th>Body Text</th>
                    <th>Volume Name</th>
                    <th>Volume ID</th>
                    <th>Second Sub Deadline</th>
                </tr>

                <?php
                foreach ($articles as $article) {
                    $id = htmlspecialchars($article['id']);
                    $title = htmlspecialchars($article['title']);
                    $correspAut = htmlspecialchars($article['correspAut']);
                    $submissionDate = htmlspecialchars($article['submissionDate']);
                    $result = htmlspecialchars($article['result']);
                    $bodytext = htmlspecialchars($article['bodytext']);
                    $volname = htmlspecialchars($article['vname']);
                    $volid = htmlspecialchars($article['vid']);
                    $secondSubDeadline = htmlspecialchars($article['secondSubDeadline']);
                    if ($result != "revision") {
                        $secondSubDeadline = htmlspecialchars("Article is not revised");
                    }
                    ?>
                    <tr>
                        <td><?php echo $id; ?></td>
                        <td><?php echo $title; ?></td>
                        <td><?php echo $correspAut; ?></td>
                        <td><?php echo $submissionDate; ?></td>
                        <td><?php echo $result; ?></td>
                        <td><?php echo nl2br($bodytext); ?></td>
                        <td><?php echo $volname; ?></td>
                        <td><?php echo $volid; ?></td>
                        <td><?php echo $secondSubDeadline; ?></td>
                    </tr>
                    <?php
                }
                ?>
            </table>

            <p>
                <a href="author.php">Logout</a>
            </p>

    </body>
</html>
