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

if(isset($_POST['import'])){
    $product_id = $_POST['product_id'];
    $import_quantity = $_POST['import_quantity'];

    $sql_import = "UPDATE import SET quantity = import.quantity + $import_quantity WHERE id = $product_id";
    $sql_furniture = "UPDATE furniture SET quantity = furniture.quantity + $import_quantity WHERE id = $product_id";

    $query_import = mysqli_query($conn, $sql_import);
    $query_furniture = mysqli_query($conn, $sql_furniture);

    if($query_import && $query_furniture){
        echo "<script>alert('Import successful!')</script>";
    } else {
        echo "Error importing: ". mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Import</title>
    <link rel="shortcut icon" href="ship-removebg-preview.png" type="image/x-icon">
    <link rel="stylesheet" href="/cargo/import.css">
</head>
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
                    <a href="import.php" class="active">Import🚚</a>
                    <a href="export.php">Export✈️</a>
                </li>
            </ul>
        </nav>
    </section>
   
    <section class="import-report">
        <h2>Import Report</h2>
        <p>Dear <?php echo $userName;?>,</p>
        <p>Here is the import report for your reference:</p>
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
                $importQuery = "SELECT i.*, f.name AS product_name FROM import i JOIN furniture f ON i.id = f.id";
                $importResult = mysqli_query($conn,$importQuery);
                while ($importRow = mysqli_fetch_assoc($importResult)) {
                    ?>
                    <tr>
                        <td><?php echo $importRow['id'];?></td>
                        <td><?php echo $importRow['product_name'];?></td>
                        <td><?php echo $importRow['quantity'];?></td>
                        <td><?php echo $importRow['date'];?></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <p>Thank you for using our services.</p>
        <div class="import-report signature">
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