<?php
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "canteen_admin_db"; 

$link = new mysqli($servername, $username, $password, $dbname);

if ($link->connect_error) {
    die("<p style='color: #ff6b6b;'>Database connection failed: " . htmlspecialchars($link->connect_error) . "</p>");
}
?>
<html>
<head>
 <title>Administrator Dashboard - Online Canteen Management System</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        }

        body {
            background-color: #121418;
            color: #d1d5db;
            padding: 24px;
            font-size: 14px;
        }
 .dashboard{
	display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        max-width: 1400px;
        margin: 0 auto;
}

.card{
	background-color: #1d2026;
        border: 1px solid #2b303b;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 20px;
}
.logo-box {
            border: 1px dashed #4b5563;
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 12px;
            color: #9ca3af;
	    width:50px;
	    height:30px;
        }
.card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 12px;
        }

 .card-title {
            font-size: 16px;
            font-weight: 600;
            color: #ffffff;
	   
        }
.card-subtitle {
            color: #9ca3af;
            font-size: 12px;
            margin-top: 4px;
	    
        }
.logout-link{
	 color: #9ca3af;
         text-decoration: none;
         font-size: 13px;
}
.logout-link:hover {
            color: #ffffff;
        }
.header-left {
            display: flex;
            align-items: center;
            gap: 15px;
        }
 table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th {
            text-align: left;
            color: #9ca3af;
            font-weight: 500;
            padding: 10px 8px;
            font-size: 12px;
        }

        td {
            padding: 12px 8px;
            color: #ffffff;
            border-top: 1px solid #2b303b;
            font-size: 13px;
            vertical-align: middle;
        }
.btn-action {
            background-color: #2b303b;
            color: #d1d5db;
            padding: 4px 10px;
            border-radius: 12px;
            font-weight: normal;
            font-size: 12px;
            margin-right: 4px;
        }
 .btn-white {
            background-color: #ffffff;
            color: #121418;
        }

        .btn-white:hover {
            background-color: #e5e7eb;
        }
 .btn {
            border: none;
            padding: 7px 16px;
            border-radius: 18px;
            cursor: pointer;
            font-size: 12px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
        }
.btn-action:hover {
            background-color: #374151;
            color: #ffffff;
        }
.note-text {
            font-size: 11px;
            color: #6b7280;
            margin-top: 12px;
        }

  input[type="date"] {
            background: #121418;
            color: white;
            border: 1px solid #3b4657;
            border-radius: 6px;
            padding: 10px;
            font-size: 15px;
        }
     .form-group {
            display: flex;
            flex-direction: column;
        }

.filter-row {
            display: flex;
            align-items: flex-end;
            gap: 15px;
            margin-top: 15px;
            margin-bottom: 10px;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .filter-group label {
            font-size: 12px;
            color: #9ca3af;
        }

        .date-input {
            background-color: #121418;
            border: 1px solid #374151;
            color: #ffffff;
            padding: 6px 10px;
            border-radius: 6px;
            font-size: 12px;
            outline: none;
        }


</style>
</head>
<body >
<div class="dashboard">
<div class="leftcol">
<div class="card card-header">
<div class="header-left">
	<div class="logo-box"><img  src="img.png" alt="Logo"/></div>
	<div>
		<div class="card-title">Administrator Dashboard</div>
		<div class="card-subtitle">Online Canteen Management System</div>
	</div>
	</div>
	<a href="logout.php" class="logout-link">Logout</a>
	</div>
<div class="card">
            <div class="card-header">
                <div>
                    <div class="card-title">Menu items and prices</div>
                    <div class="card-subtitle">Add new meals or change existing meal details.</div>
		</div>
		<a href="additem.php"><button class="btn btn-white">Add Menu Item</button></a>
	</div>
<?php

$sql = "SELECT * FROM items";
$result = $link->query($sql);

if (!$result) {
    die("Query failed: " . $link->error);
}
echo "<table >";
echo "<thead>";
echo "<tr>";
echo "<th>Image</th>";
echo "<th>Item ID</th>";
echo "<th>Item name</th>";
echo "<th>Price</th>";
echo "<th>Availability</th>";
echo "<th>Actions</th>";
echo "</tr>";
echo "</thead>";
echo "<tbody>";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
	
        echo "<tr>";
	echo "<td>".$row["image_url"]."</td>";
	echo "<td>".$row["item_id"]."</td>";
	echo "<td>".$row["item_name"]."</td>";
	echo "<td>".$row["price"]."</td>";
	echo "<td>".$row["availability"]."</td>";
	echo "<td><a href='edit_item_form.php?id=".$row["item_id"]."' class='btn btn-action'>Edit</a> <a href='delete_item.php?id=".$row["item_id"]."' class='btn btn-action'>delete</a></td>"; 
        echo "</tr>";
    }
} else {
    echo "No records found.";
}
echo "</tbody>";

echo "</table>";

?>
<p class="note-text">The administrator manages names, prices, and images. Staff normally changes daily availability.</p>
</div>
 <div class="card">
            <div class="card-header">
                <div>
                    <div class="card-title">User and staff accounts</div>
                    <div class="card-subtitle">Customers register themselves. Only the administrator creates staff accounts.</div>
                </div>
               <a href=addstaff.php> <button class="btn btn-white">Add Staff Account</button></a>
            </div>
<?php

$sql = "SELECT * FROM user_details";
$result = $link->query($sql);

if (!$result) {
    die("Query failed: " . $link->error);
}
echo "<table >";
echo "<thead>";
echo "<tr>";
echo "<th>User ID</th>";
echo "<th>Name</th>";
echo "<th>Email</th>";
echo "<th>Role</th>";
echo "<th>Actions</th>";
echo "</tr>";
echo "</thead>";
echo "<tbody>";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
	
        echo "<tr>";
	echo "<td>".$row["user_id"]."</td>";
	echo "<td>".$row["user_name"]."</td>";
	echo "<td>".$row["email"]."</td>";
	echo "<td>".$row["user_role"]."</td>";
	echo "<td><a href='edit_user_form.php?id=".$row["user_id"]."' class='btn btn-action'>Edit</a> <a href='delete_user.php?id=".$row["user_id"]."' class='btn btn-action'>delete</a></td>"; 
        echo "</tr>";
             }
} else {
    echo "No records found.";
}
echo "</tbody>";

echo "</table>";

?>

</div>
</div>
<div class="rightcol">
<div class="card">
            <div class="card-header">
                <div>
                    <div class="card-title">Customer complaints</div>
                    <div class="card-subtitle">Read complaints submitted by customers.</div>
                </div>
            </div>
<?php

$sql = "SELECT * FROM user_complaint";
$result = $link->query($sql);

if (!$result) {
    die("Query failed: " . $link->error);
}
echo "<table >";
echo "<thead>";
echo "<tr>";
echo "<th>Complaint ID</th>";
echo "<th>Customer</th>";
echo "<th>Complaint</th>";
echo "<th>Date</th>";
echo "<th>Actions</th>";
echo "</tr>";
echo "</thead>";
echo "<tbody>";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
	
        echo "<tr>";
	echo "<td>".$row["complaint_id"]."</td>";
	echo "<td>".$row["user_name"]."</td>";
	echo "<td>".$row["complaint"]."</td>";
	echo "<td>".$row["complaint_date"]."</td>";
	echo "<td><a href='view_Complaint.php?id=".$row["complaint_id"]."' class='btn btn-action'>View</a> <a href='delete_Complaint.php?id=".$row["complaint_id"]."' class='btn btn-action'>Delete</a></td>"; 
        echo "</tr>";
        
    }
} else {
    echo "No records found.";
}
echo "</tbody>";

echo "</table>";

?>
</div>
<!-- Orders and Revenue -->
<div class="card">
            <div class="card-header">
                <div>
                    <div class="card-title">Orders and revenue</div>
                    <div class="card-subtitle">View completed-order totals for a selected period.</div>
                </div>
            </div>
<?php
$from_date = "2026-07-24";
$to_date   = "2026-07-26";

if (isset($_POST["view_report"])) {

    $from_date = $_POST["from_date"];
    $to_date   = $_POST["to_date"];
}

$sql = "SELECT
            order_date,
            COUNT(order_id) AS completed_orders,
            SUM(total_amount) AS revenue
        FROM orders
        WHERE status = 'Completed'
        AND order_date BETWEEN '$from_date' AND '$to_date'
        GROUP BY order_date
        ORDER BY order_date ASC";

$result = $link->query($sql);

if (!$result) {
    die("Query failed: " . $link->error);
}

$total_orders = 0;
$total_revenue = 0;

?>
  
    <form method="POST" action="">

      <div class="filter-row">

            <div class="filter-group">

                <label>From</label>

                <input
                    type="date"
                    name="from_date"
                    value="<?php echo $from_date; ?>"
                    required
                >

            </div>


            <div class="filter-group">

                <label>To</label>

                <input
                    type="date"
                    name="to_date"
                    value="<?php echo $to_date; ?>"
                    required
                >

            </div>


            

                <button type="submit" name="view_report" class="btn btn-white">
                    View Report
                </button>

            </div>

       
    </form>


  <table>

        <thead>

            <tr>
                <th>Date</th>
                <th>Completed orders</th>
                <th>Revenue</th>
            </tr>

        </thead>

        <tbody>
<?php

        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {

                $date = date(
                    "d F Y",
                    strtotime($row["order_date"])
                );

                $orders = $row["completed_orders"];
                $revenue = $row["revenue"];

                $total_orders += $orders;
                $total_revenue += $revenue;

                echo "<tr>";

                echo "<td>" . $date . "</td>";

                echo "<td>" . $orders . "</td>";

                echo "<td>Rs. " . number_format($revenue, 2) . "</td>";

                echo "</tr>";
            }

        } else {

            echo "<tr>";
            echo "<td colspan='3'>No completed orders found.</td>";
            echo "</tr>";
        }
?>
 </tbody>
 <tfoot>

            <tr class="total-row">

                <td>Total</td>

                <td>
                    <?php echo $total_orders; ?>
                </td>

                <td>
                    Rs. <?php echo number_format($total_revenue, 2); ?>
                </td>

            </tr>

        </tfoot>

    </table>

</div>
</body>
</html>