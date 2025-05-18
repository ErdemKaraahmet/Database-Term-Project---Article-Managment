<!DOCTYPE html>
  <?php
session_start(); 

if (isset($_POST['buttonForEditor'])) {
    $_SESSION['role'] = "editor"; 
    header("Location: allJournals.php"); 
    exit();
} elseif (isset($_POST['buttonForAuthor'])) {
    $_SESSION['role'] = "author"; 
    header("Location: author.php"); 
    exit();
} elseif (isset($_POST['buttonForReviewer'])) {
    $_SESSION['role'] = "reviewer"; 
    header("Location: reviewer.php"); 
    exit();
} elseif (isset($_POST['buttonForReader'])) {
    $_SESSION['role'] = "reader"; 
    header("Location: ReaderHome.php"); 
    exit();
}

$role = isset($_SESSION['role']) ? $_SESSION['role'] : null; 
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Browse</title>
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

        h1 {
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin: 10px;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Select Your Role</h1>
        <form method="post">
            <input type="submit" name="buttonForEditor" value="Editor"/>
            <input type="submit" name="buttonForAuthor" value="Author"/>
            <input type="submit" name="buttonForReviewer" value="Reviewer"/>
            <input type="submit" name="buttonForReader" value="Reader"/>
        </form>
    </div>
</body>
</html>
