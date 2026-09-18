
<?php

$host="127.0.0.1";
$port=3306;
$socket="";
$user="root";
$password="";
$dbname="canteen_admin_db";

$link = new mysqli($host, $user, $password, $dbname, $port, $socket);

if ($link->connect_error) {
    die("Database connection failed: " . $link->connect_error);
}


if (!isset($_GET["id"])) {
    die("Complaint ID is missing.");
}

$item_id = intval($_GET["id"]);

$sql = "SELECT * FROM user_complaint WHERE complaint_id = $item_id";

$result = $link->query($sql);

if (!$result) {
    die("Query failed: " . $link->error);
}

if ($result->num_rows == 0) {
    die("Complaint not found.");
}

$row = $result->fetch_assoc();

?>

<!DOCTYPE html>

<html>

<head>

    <title>View User Complaint</title>

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
            max-width: 600px;
            margin: 0 auto;
            background-color: #1d2026;
            border: 1px solid #2b303b;
            border-radius: 10px;
            padding: 30px;
        }

        h2 {
            color: #ffffff;
            margin-bottom: 25px;
        }

        label {
            display: block;
            color: #9ca3af;
            margin-bottom: 7px;
            font-size: 13px;
        }

        input,
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 18px;
            background-color: #121418;
            color: #ffffff;
            border: 1px solid #2b303b;
            border-radius: 6px;
        }

        input:focus,
        select:focus {
            outline: none;
            border-color: #6b7280;
        }

        .buttons {
            margin-top: 10px;
        }

        .btn {
            display: inline-block;
            padding: 9px 18px;
            border-radius: 18px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-size: 13px;
            margin-right: 8px;
        }

        .btn-save {
            background-color: #ffffff;
            color: #121418;
        }

    </style>

</head>

<body>

<div class="container">

    <h2>View User Complaint</h2>

    <form >

        <label>Complaint ID</label>

        <input type="text"
               value="<?php echo htmlspecialchars($row["complaint_id"]); ?>"
               disabled>


        <label>Customer</label>

        <input type="text"
               name="user_name"
               value="<?php echo htmlspecialchars($row["user_name"]); ?>"
               disabled>


        <label>Complaint</label>

        <input type="text"
               name="complaint"
               value="<?php echo htmlspecialchars($row["complaint"]); ?>"
               disabled>

        <label>Date</label>

        <input type="text"
               name="complaint_date"
               value="<?php echo htmlspecialchars($row["complaint_date"]); ?>" disabled>


        <div class="buttons">


            <a href="dashboard.php" class="btn btn-save">
                Go to dashboard
            </a>

        </div>

    </form>

</div>

</body>

</html>