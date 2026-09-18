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

    $user_name   = $_POST["user_name"];
    $email       = $_POST["email"];
    $user_role = $_POST["user_role"];

        $sql = "INSERT INTO user_details
            (user_name, email, user_role)
            VALUES
            ('$user_name', '$email', '$user_role')";

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

    <h1>Add New Staff Members</h1>

    <form method="POST" action="">

        <div class="form-group">

            <label for="user_name">User name</label>

            <input
                type="text"
                id="user_name"
                name="user_name"
                placeholder="Enter User name"
                required
            >

        </div>


        <div class="form-group">

            <label for="email">Email</label>

            <input
                type="email"
                id="email"
                name="email"
                placeholder="Enter Email"
                required
            >

        </div>


        <div class="form-group">

            <label for="user_role">Role</label>

            <select id="user_role" name="user_role" required>

                <option value="">Select </option>
                <option value="Staff">Register staff members only</option>
                

            </select>

        </div>

        <div class="buttons">

            <a href="dashboard.php" class="btn btn-cancel">
                Cancel
            </a>

            <button type="submit" class="btn btn-add">
                Add New Member
            </button>

        </div>

    </form>

</div>

</body>
</html>