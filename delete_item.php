<?php

$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "canteen_admin_db";

$link = new mysqli($servername, $username, $password, $dbname);

if ($link->connect_error) {
    die("Database connection failed: " . $link->connect_error);
}



if (!isset($_GET["id"])) {
    die("Item ID is missing.");
}

$item_id = intval($_GET["id"]);



$sql = "SELECT * FROM items WHERE item_id = $item_id";

$result = $link->query($sql);

if (!$result) {
    die("Query failed: " . $link->error);
}

if ($result->num_rows == 0) {
    die("Item not found.");
}

$row = $result->fetch_assoc();



if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $sql = "DELETE FROM items WHERE item_id = $item_id";

    if ($link->query($sql)) {

        header("Location: dashboard.php");
        exit();

    } else {

        echo "Delete failed: " . $link->error;
    }
}

?>

<!DOCTYPE html>

<html>

<head>

    <title>Delete Menu Item</title>

    <style>

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #121418;
            color: #d1d5db;
            padding: 40px;
        }

        .container {
            max-width: 500px;
            margin: 0 auto;
            background-color: #1d2026;
            border: 1px solid #2b303b;
            border-radius: 10px;
            padding: 30px;
            text-align: center;
        }

        h2 {
            color: #ffffff;
            margin-bottom: 15px;
        }

        p {
            color: #9ca3af;
            margin-bottom: 25px;
            line-height: 1.6;
        }

        .item-name {
            color: #ffffff;
            font-weight: bold;
        }

        .btn {
            display: inline-block;
            padding: 9px 18px;
            border-radius: 18px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-size: 13px;
            margin: 5px;
        }

        .btn-delete {
            background-color: #dc2626;
            color: #ffffff;
        }

        .btn-cancel {
            background-color: #2b303b;
            color: #d1d5db;
        }

    </style>

</head>

<body>

<div class="container">

    <h2>Delete Menu Item?</h2>

    <p>
        Are you sure you want to delete
        <span class="item-name">
            <?php echo htmlspecialchars($row["item_name"]); ?>
        </span>
        ?
        <br>
        This action cannot be undone.
    </p>


    <form method="POST"
          action="delete_item.php?id=<?php echo $item_id; ?>"
          style="display:inline;">

        <button type="submit" class="btn btn-delete">
            Yes, Delete
        </button>

    </form>


    <a href="dashboard.php" class="btn btn-cancel">
        Cancel
    </a>

</div>

</body>

</html>