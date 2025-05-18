<?php
session_start();
include "connection.php";

// Check if connection is established
if (!$conn) {
    die('Error: Failed to connect to database.');
}

// Get the volume name and ID from the URL
if (!isset($_GET['volname']) || !isset($_GET['volid'])) {
    die('Error: Volume name or ID not specified.');
}
$volname = urldecode($_GET['volname']);
$volid = urldecode($_GET['volid']);

// Handle form submission to assign a reviewer
if (isset($_POST['assignReviewer'])) {
    $article_id = $_POST['article_id'];
    $reviewer_email = $_POST['reviewer_email'];

    $sql2 = "INSERT INTO articlereviews (id, email, scoreOfTheReviewer) VALUES (?, ?, NULL)";
    $stmt2 = $conn->prepare($sql2);

    // Check if the statement was prepared successfully
    if ($stmt2 === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }

    $stmt2->bind_param("ss", $article_id, $reviewer_email);

    if ($stmt2->execute()) {
        echo "Reviewer assigned successfully.";
    } else {
        echo "Error: " . $stmt2->error;
    }

    $stmt2->close();
}

// Query to fetch article and reviewer data
$sql = "SELECT a.id, a.title, a.bodytext, a.correspAut, a.submissionDate, a.result, ar.email 
        FROM article a
        LEFT JOIN articleReviews ar ON a.id = ar.id
        WHERE a.volname = ? AND a.volid = ?";
        
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $volname, $volid);
$stmt->execute();
$result = $stmt->get_result();

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

// Fetch reviewers from person table
$reviewerQuery = "SELECT email FROM person WHERE isReviewer = 1";
$reviewerResult = mysqli_query($conn, $reviewerQuery);

if (!$reviewerResult) {
    die("Failed to fetch reviewers: " . mysqli_error($conn));
}

$reviewers = [];
while ($reviewerRow = mysqli_fetch_assoc($reviewerResult)) {
    $reviewers[] = $reviewerRow['email'];
}

$role = isset($_SESSION['role']) ? $_SESSION['role'] : null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Volume Articles</title>
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

        select, input[type="submit"] {
            padding: 5px;
            margin: 5px 0;
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
<h4>Articles for Volume: <?php echo htmlspecialchars($volname); ?>, Volume ID: <?php echo htmlspecialchars($volid); ?></h4>
<table border="2" cellspacing="2" cellpadding="2">
    <tr>
        <th>Article ID</th>
        <th>Title</th>
        <th>Body Text</th>
        <th>Corresponding Author</th>
        <th>Submission Date</th>
        <th>Result</th>
        <th>Reviewer Email</th>
        <th>Assign Reviewer</th>
    </tr>

    <?php
    //display article data
    while ($row = mysqli_fetch_assoc($result)) {
        $id = htmlspecialchars($row["id"]);
        $title = htmlspecialchars($row["title"]);
        $bodytext = htmlspecialchars($row["bodytext"]);
        $correspAut = htmlspecialchars($row["correspAut"]);
        $submissionDate = htmlspecialchars($row["submissionDate"]);
        $result = htmlspecialchars($row["result"]);
        $reviewerEmail = htmlspecialchars($row["email"]);
        ?>
        <tr>
            <td><?php echo $id; ?></td>
            <td><?php echo $title; ?></td>
            <td><?php echo $bodytext; ?></td>
            <td><?php echo $correspAut; ?></td>
            <td><?php echo $submissionDate; ?></td>
            <td><?php echo $result; ?></td>
            <td><?php echo $reviewerEmail; ?></td>
            <td>
                <?php if ($role == "editor" && $reviewerEmail == null): ?>
                    <form method="post" action="">
                        <input type="hidden" name="article_id" value="<?php echo $id; ?>">
                        <select name="reviewer_email">
                            <?php foreach ($reviewers as $email): ?>
                                 <option value="<?php echo htmlspecialchars($email); ?>"><?php echo htmlspecialchars($email); ?></option>
                            <?php endforeach; ?>
                        </select>
                        <input type="submit" name="assignReviewer" value="Assign">
                    </form>
                <?php endif; ?>
            </td>
        </tr>
        <?php
    }

    // Close the database connection
    $stmt->close();
    mysqli_close($conn);
    ?>
</table>

<p>
    <a href="journalVolumes.php?name=<?php echo urlencode($volname); ?>">Return to Volumes List</a>
</p>

</body>
</html>
