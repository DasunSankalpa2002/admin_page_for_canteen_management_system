<?php

$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "canteen_admin_db";

$link = new mysqli($servername, $username, $password, $dbname);

if ($link->connect_error) {
    die("Database connection failed: " . $link->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $item_name   = $_POST["item_name"];
    $price       = $_POST["price"];
    $availability = $_POST["availability"];
    $image_url   = $_POST["image_url"];

        $sql = "INSERT INTO items
            (item_name, price, availability, image_url)
            VALUES
            ('$item_name', '$price', '$availability', '$image_url')";

    if ($link->query($sql) === TRUE) {

               header("Location: dashboard.php");
        exit();

    } else {

        echo "ADD ITEM FAILED: " . $link->error;
    }
}

?>

<!DOCTYPE html>
<html>
<head>

    <title>Add New Item</title>

    <style>

        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #14171c;
            color: white;
        }

        .container {
            width: 500px;
            margin: 60px auto;
            background-color: #1d2026;
            border: 1px solid #2b303b;
            border-radius: 12px;
            padding: 30px;
        }

        h1 {
            margin-top: 0;
            margin-bottom: 25px;
            font-size: 26px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-size: 15px;
            font-weight: bold;
        }

        input,
        select {
            width: 100%;
            box-sizing: border-box;
            padding: 12px;
            border: 1px solid #3a404c;
            border-radius: 7px;
            background-color: #272b33;
            color: white;
            font-size: 15px;
        }

        input:focus,
        select:focus {
            outline: none;
            border-color: #6c757d;
        }

        .buttons {
            display: flex;
            gap: 10px;
            margin-top: 25px;
        }

        .btn {
            padding: 12px 20px;
            border-radius: 7px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-size: 15px;
        }

        .btn-add {
            background-color: #198754;
            color: white;
            flex: 1;
        }

        .btn-cancel {
            background-color: #343a40;
            color: white;
            text-align: center;
            flex: 1;
        }

        .btn:hover {
            opacity: 0.85;
        }

    </style>

</head>

<body>

<div class="container">

    <h1>Add New Item</h1>

    <form method="POST" action="">

        <div class="form-group">

            <label for="item_name">Item Name</label>

            <input
                type="text"
                id="item_name"
                name="item_name"
                placeholder="Enter item name"
                required
            >

        </div>


        <div class="form-group">

            <label for="price">Price</label>

            <input
                type="number"
                id="price"
                name="price"
                step="0.01"
                min="0"
                placeholder="Enter price"
                required
            >

        </div>


        <div class="form-group">

            <label for="availability">Availability</label>

            <select id="availability" name="availability" required>

                <option value="">Select availability</option>
                <option value="Available">Available</option>
                <option value="Unavailable">Unavailable</option>

            </select>

        </div>


        <div class="form-group">

            <label for="image_url">Image URL</label>

            <input
                type="text"
                id="image_url"
                name="image_url"
                placeholder="Enter image URL"
            >

        </div>


        <div class="buttons">

            <a href="dashboard.php" class="btn btn-cancel">
                Cancel
            </a>

            <button type="submit" class="btn btn-add">
                Add Item
            </button>

        </div>

    </form>

</div>

</body>
</html>