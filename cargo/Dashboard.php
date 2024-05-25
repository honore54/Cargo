<?php 
session_start();
$conn = mysqli_connect('localhost','root','','Cargo');

if(isset($_SESSION['user_id'])){
    $userId = $_SESSION['user_id'];
    $query = "SELECT * FROM cargouser WHERE id = '$userId'";
    $result = mysqli_query($conn, $query);
    $userData = mysqli_fetch_assoc($result);
    $userName = $userData['username'];

    $furnitureQuery = "SELECT COUNT(*) as furniture_count FROM furniture";
    $furnitureResult = mysqli_query($conn, $furnitureQuery);
    $furnitureData = mysqli_fetch_assoc($furnitureResult);
    $furnitureCount = $furnitureData['furniture_count'];

$ImportQuery = "SELECT SUM(quantity) as quantity FROM import";
$ImportResult = mysqli_query($conn,$ImportQuery);
$ImportData = mysqli_fetch_assoc($ImportResult);
$ImportCount = $ImportData['quantity'];

$ExportQuery = "SELECT SUM(quantity) as quantity FROM export";
$ExportResult = mysqli_query($conn,$ExportQuery);
$ExportData = mysqli_fetch_assoc($ExportResult);
$ExportCount = $ExportData['quantity'];


}
if(isset($_POST['logout'])){
    session_destroy();
    header('location:index.php');
    exit;
}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cargo Dashnoard</title>
    <link rel="shortcut icon" href="ship-removebg-preview.png" type="image/x-icon">
    <link rel="stylesheet" href="/cargo/dashboard.css">
</head>
<style>
.logOut{
    display: flex;
    margin-top: 350px;
    margin-left: 70px;
}
.logOut button{
    background:none;
    border: none;
    font-family: 'Poppins',sans-serif;
    color: black;
    font-size: 20px;
    cursor: pointer;
}
.logOut ion-icon{
    font-size: 32px;
}
.side-bar nav ul li {
  display: flex;
  flex-direction: column;
  gap: 50px;
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
                    <a href="#" class="active">Dashboard</a>
                    <a href="furniture.php">Furniture🪑</a>
                    <a href="import.php">Import🚚</a>
                    <a href="export.php">Export✈️</a>
                    <a href="report.php">Report📒</a>
                </li>
            </ul>
        </nav>
       
    </section>
 
    <section class="cards">
        <div class="first">
<ion-icon name="cart"></ion-icon>
<div class="number-furniture">
    <span><?php echo  $furnitureCount; ?></span>
</div>
<div class="name">
    <span>Furniture</span>
</div>
        </div>
         <div class="second">
            <ion-icon name="cloud-download"></ion-icon>
            <div class="number-furniture">
    <span><?php echo  $ImportCount; ?></</span>
</div>
<div class="name">
    <span>Import</span>
</div>
        </div>
          <div class="third">
            <ion-icon name="cloud-upload"></ion-icon>
            <div class="number-furniture">
    <span><?php echo $ExportCount; ?></span>
</div>
<div class="name">
    <span>Export</span>
</div>
        </div>
    </section>
       <div class="logOut">
        <ion-icon name="exit"></ion-icon>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>"; method="post">
            <button type="submit" name="logout">LogOut</button>
        </form>
    </div>
   

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>


<script>
window.embeddedChatbotConfig = {
chatbotId: "YFXR9kTzdQ6eu_weSZ3Bf",
domain: "www.chatbase.co"
}
</script>
<script
src="https://www.chatbase.co/embed.min.js"
chatbotId="YFXR9kTzdQ6eu_weSZ3Bf"
domain="www.chatbase.co"
defer>
</script>
</body>
</html>