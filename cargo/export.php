<?php
session_start();
error_reporting(0);
$conn = mysqli_connect('localhost','root','','Cargo');

if(isset($_SESSION['user_id'])){
    $userId = $_SESSION['user_id'];
    $query = "SELECT * FROM cargouser WHERE id = '$userId'";
    $result = mysqli_query($conn, $query);
    $userData = mysqli_fetch_assoc($result);
    $userName = $userData['username'];
}

if(isset($_POST['export'])){
    $product_id = $_POST['product_id'];
    $export_quantity = $_POST['export_quantity'];

    $sql_export = "UPDATE export SET quantity = export.quantity + $export_quantity WHERE id = $product_id";
    $sql_furniture = "UPDATE furniture SET quantity = furniture.quantity - $export_quantity WHERE id = $product_id";

    $query_export = mysqli_query($conn, $sql_export);
    $query_furniture = mysqli_query($conn, $sql_furniture);

    if($query_export && $query_furniture){
        echo "<script>alert('Export successful!')</script>";
    } else {
        echo "Error exporting: ". mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export</title>
    <link rel="shortcut icon" href="ship-removebg-preview.png" type="image/x-icon">
    <link rel="stylesheet" href="/cargo/export.css">
</head>
<style>
    
</style>
<body>
    <section class="nav-bar">
        <div class="logo">
            <h2>Cargoltd</h2>
        </div>
        <div class="user">
            <span>Welcome,<?php echo $userName;?></span>
        </div>
    </section>
    <section class="side-bar">
        <nav>
            <ul>
                <li>
                    <a href="Dashboard.php" >Dashboard</a>
                    <a href="furniture.php">Furniture🪑</a>
                    <a href="import.php">Import🚚</a>
                    <a href="export.php" class="active">Export✈️</a>
                </li>
            </ul>
        </nav>
    </section>
   
    <section class="export-report">
        <h2>Export Report</h2>
        <p>Dear <?php echo $userName;?>,</p>
        <p>Here is the export report for your reference:</p>
        <table>
            <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $exportQuery = "SELECT e.*, f.name AS product_name FROM export e JOIN furniture f ON e.id = f.id";
                $exportResult = mysqli_query($conn,$exportQuery);
                while ($exportRow = mysqli_fetch_assoc($exportResult)) {
                   ?>
                    <tr>
                        <td><?php echo $exportRow['id'];?></td>
                        <td><?php echo $exportRow['product_name'];?></td>
                        <td><?php echo $exportRow['quantity'];?></td>
                        <td><?php echo $exportRow['date'];?></td>
                    </tr>
                    <?php
                }
               ?>
            </tbody>
        </table>
        <p>Thank you for using our services.</p>
        <div class="export-report signature">
            <p>Regards,</p>
            <p>Cargoltd team</p>
             <p class="ascii-signature">
            ____                           
           / ___| __ _ _ __ ___   ___  ___ 
          | |    / _` | '_ ` _ \ / _ \/ __|
          | |___| (_| | | | | | |  __/\__ \
           \____|\__,_|_| |_| |_|\___||___/
        </p>
        </div>
    </section>
</body>
</html>