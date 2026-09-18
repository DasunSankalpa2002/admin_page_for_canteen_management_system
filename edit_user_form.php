
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
    die("Item ID is missing.");
}

$user_id = intval($_GET["id"]);


if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $user_name = $_POST["user_name"];
    $email = $_POST["email"];
    $user_role = $_POST["user_role"];

    $sql = "UPDATE user_details SET
                user_name = '$user_name',
                email = '$email',
                user_role = '$user_role'
            WHERE user_id = $user_id";



   if ($link->query($sql) === TRUE) {
   header("Location: dashboard.php");
   exit();
} else {
    echo "UPDATE FAILED: " . $link->error;
}
}


$sql = "SELECT * FROM user_details WHERE user_id = $user_id";

$result = $link->query($sql);

if (!$result) {
    die("Query failed: " . $link->error);
}

if ($result->num_rows == 0) {
    die("Item not found.");
}

$row = $result->fetch_assoc();

?>

<!DOCTYPE html>

<html>

<head>

    <title>Edit User Details</title>

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

        .btn-cancel {
            background-color: #2b303b;
            color: #d1d5db;
        }

    </style>

</head>

<body>

<div class="container">

    <h2>Edit User Details</h2>

    <form method="POST" action="edit_user_form.php?id=<?php echo $user_id; ?>">

        <label>User ID</label>

        <input type="text"
               value="<?php echo htmlspecialchars($row["user_id"]); ?>"
               disabled>


        <label>User Name</label>

        <input type="text"
               name="user_name"
               value="<?php echo htmlspecialchars($row["user_name"]); ?>"
               required>


        <label>Email</label>

        <input type="email"
	       name="email"
               value="<?php echo htmlspecialchars($row["email"]); ?>"
               required>


        <label>Role</label>

        <select name="user_role">

            <option value="Staff"
                <?php
                if ($row["user_role"] == "Staff") {
                    echo "selected";
                }
                ?>>
                Staff
            </option>

            <option value="Customer"
                <?php
                if ($row["user_role"] == "Customer") {
                    echo "selected";
                }
                ?>>
                Customer
            </option>

        </select>


        <div class="buttons">

            <button type="submit" class="btn btn-save">
                Save Changes
            </button>

            <a href="dashboard.php" class="btn btn-cancel">
                Cancel
            </a>

        </div>

    </form>

</div>

</body>

</html>