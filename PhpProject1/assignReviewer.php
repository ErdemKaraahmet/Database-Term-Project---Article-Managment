<?php

session_start();
include "connection.php";

// Check if connection is established
if (!$conn) {
    die('Error: Failed to connect to database.');
}

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $article_id = $_POST['article_id'];
    $reviewer_email = $_POST['reviewer_email'];

    if (empty($article_id) || empty($reviewer_email)) {
        die('Error: Article ID and Reviewer Email are required.');
    }
    
    $sql = "INSERT INTO articleReviews (id, email) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die('Error: ' . htmlspecialchars($conn->error));
    }
    $stmt->bind_param("is", $article_id, $reviewer_email);
    if ($stmt->execute()) {
        echo "Reviewer assigned successfully.";
    } else {
        echo "Error: " . htmlspecialchars($stmt->error);
    }

    // Close the statement and the database connection
    $stmt->close();
    mysqli_close($conn);

    // Redirect back to the volume articles page
    header("Location: volume_articles.php?volname=" . urlencode($_POST['volname']) . "&volid=" . urlencode($_POST['volid']));
    exit();
}
?>
