<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'Cargo');

if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    $query = "SELECT * FROM cargouser WHERE id = '$userId'";
    $result = mysqli_query($conn, $query);
    $userData = mysqli_fetch_assoc($result);
    $userName = $userData['username'];
}

$furnitureQuery = "SELECT f.id, f.name, f.quantity, f.date, f.owner, i.quantity as import_quantity, e.quantity as export_quantity 
                   FROM furniture f 
                   LEFT JOIN import i ON f.id = i.id 
                   LEFT JOIN export e ON f.id = e.id";
$furnitureResult = mysqli_query($conn, $furnitureQuery);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report</title>
    <link rel="shortcut icon" href="ship-removebg-preview.png" type="image/x-icon">
    <link rel="stylesheet" href="/cargo/report.css">
</head>
<style>
  .report {
  width: 60%;
  padding: 20px;
  border: 1px solid #ddd;
  margin-left: 310px;
  margin-top: -600px;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}
.report .section ul li {
  margin-bottom: 40px;
}
.report.section ul {
  list-style: none;
  padding: 0;
  margin: 0;
}
.print{
    padding: 10px;
    background-color: black;
    border: none;
    cursor: pointer;
    color: white;
    font-family: 'Poppins',sans-serif;
    font-size: 18px;
    border-radius: 18px;
}
.signature p {
  font-family: "Poppins", sans-serif;
  white-space: pre;
}
.signature .ascii-signature {
  font-family: "Courier New", Courier, monospace;
  font-size: 12px;
  line-height: 1;
  margin-left: -90px;
}
</style>
<body>
 <section class="nav-bar">
        <div class="logo">
            <h2>Cargoltd</h2>
        </div>
        <div class="user">
            <span>Welcome,<?php echo $userName; ?></span>
        </div>
    </section>
    <section class="side-bar">
        <nav>
            <ul>
                <li>
                    <a href="Dashboard.php" >Dashboard</a>
                    <a href="furniture.php">Furniture🪑</a>
                    <a href="import.php">Import🚚</a>
                    <a href="export.php">Export✈️</a>
                    <a href="report.php" class="active">Report📒</a>
                </li>
            </ul>
        </nav>
    </section>

    <section class="report">
        <h2>Hello, <?php echo $userName;?>!</h2>
        <p>This is your report📒 from Cargo Ltd.</p>
        <section class="section">
            <h3>Furniture Report📒</h3>
            <ul>
                <?php while ($furnitureData = mysqli_fetch_assoc($furnitureResult)) {
                    ?>
                <li>
                    <span>ID:</span> <?php echo $furnitureData['id'];?><br>
                    <span>Name:</span> <?php echo $furnitureData['name'];?><br>
                    <span>Quantity:</span> <?php echo $furnitureData['quantity'];?><br>
                    <span>Date:</span> <?php echo $furnitureData['date'];?><br>
                    <span>Owner:</span> <?php echo $furnitureData['owner'];?><br>
                    <span>Import Quantity:</span> <?php echo $furnitureData['import_quantity'];?><br>
                    <span>Export Quantity:</span> <?php echo $furnitureData['export_quantity'];?><br>
                </li>
                <?php }?>
            </ul>
        </section>
       <div class="export-report signature">
            <p>Best Regards🤜🤛,</p>
            <p>Cargoltd team</p>
             <p class="ascii-signature">
            ____                           
           / ___| __ _ _ __ ___   ___  ___ 
          | |    / _` | '_ ` _ \ / _ \/ __|
          | |___| (_| | | | | | |  __/\__ \
           \____|\__,_|_| |_| |_|\___||___/
        </p>
        </div>
        <button onclick="window.print()" class="print">Print Report📒</button>
    </section>
</body>
</html>