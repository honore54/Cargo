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

if(isset($_POST['add'])){
    $owner = $_POST['owner'];
    $furniture = $_POST['furniture-name'];
    $quantity = $_POST['quantity'];

    $sql_furniture  = "INSERT INTO furniture(name, owner, quantity) VALUES ('$furniture', '$owner', '$quantity')";
    $query_furniture = mysqli_query($conn, $sql_furniture);

    $product_id = mysqli_insert_id($conn);

    $sql_import_export = "INSERT INTO import (id, quantity) VALUES ('$product_id', $quantity);
                         INSERT INTO export (id, quantity) VALUES ('$product_id', 0)";
    $query_import_export = mysqli_multi_query($conn, $sql_import_export);

    if($query_furniture && $query_import_export){
        echo "<script>alert('Product added successful!')</script>";
    } else {
        echo "Error adding product: " . mysqli_error($conn);
    }
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
        echo "Error importing: " . mysqli_error($conn);
    }
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
        echo "Error exporting: " . mysqli_error($conn);
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Furniture</title>
    <link rel="shortcut icon" href="ship-removebg-preview.png" type="image/x-icon">
    <link rel="stylesheet" href="/cargo/furniture.css">
</head>
<style>
 .DisplayAll{
    display: flex;
    margin-left: 300px;
    margin-top: 60px;
 }
 .DisplayAll table{
    display: block;
    background-color: white;
    width: 75vw;
  border-radius: 12px;
    box-shadow: 0px 3px 3px 3px rgba(0, 0, 0, 0.377);
 }
 .DisplayAll table thead tr th{
    padding: 40px;
 }
 .DisplayAll table tbody tr td{
    padding: 30px;
 }
 .importForm{
    display: none;
 }
 .exportForm{
    display: none;
 }
 .importBtn{
    background-color: black;
    color: white;
    font-family: 'Poppins',sans-serif;
    padding: 8px 10px;
    border-radius: 7px;
    border: 1px solid black;
    cursor: pointer;
 }
 .importBtn:hover{
     background-color: white;
  color: black;
  border: 0.5px solid rgb(17, 17, 17);
  outline: 6px solid gray;
 }
 .exportBtn{
    background-color: black;
    color: white;
    font-family: 'Poppins',sans-serif;
    padding: 8px 10px;
    border-radius: 7px;
    border: 1px solid black;
    cursor: pointer;
 }
 .exportBtn:hover{
     background-color: white;
  color: black;
  border: 0.5px solid rgb(17, 17, 17);
  outline: 6px solid gray;
 }
 .importInput{
    padding: 8px 10px;
    outline: 6px solid gray;
     border: 0.5px solid rgb(17, 17, 17);
     border-radius: 10px;
     font-family: 'Poppins',sans-serif;
     font-size: 16px;
     margin-top: 7px;
 }
 .exportInput{
    padding: 8px 10px;
    outline: 6px solid gray;
     border: 0.5px solid rgb(17, 17, 17);
     border-radius: 10px;
     font-family: 'Poppins',sans-serif;
     font-size: 16px;
     margin-top: 7px;
 }
 .importSubmit{
     background-color: black;
    color: white;
    font-family: 'Poppins',sans-serif;
    padding: 8px 10px;
    border-radius: 7px;
    border: 1px solid black;
    cursor: pointer;
    margin-top: 10px;
 }
 .importSubmit:hover{
     background-color: white;
  color: black;
  border: 0.5px solid rgb(17, 17, 17);
  outline: 6px solid gray;
 }

 .exportSubmit{
     background-color: black;
    color: white;
    font-family: 'Poppins',sans-serif;
    padding: 8px 10px;
    border-radius: 7px;
    border: 1px solid black;
    cursor: pointer;
    margin-top: 10px;
 }
 .exportSubmit:hover{
     background-color: white;
  color: black;
  border: 0.5px solid rgb(17, 17, 17);
  outline: 6px solid gray;
 }
 .btn{
     background-color: black;
    color: white;
    font-family: 'Poppins',sans-serif;
    padding: 8px 10px;
    border-radius: 7px;
    border: 1px solid black;
    cursor: pointer;
    margin-top: 10px;
 }
 .btn:hover{
     background-color: white;
  color: black;
  border: 0.5px solid rgb(17, 17, 17);
  outline: 6px solid gray;
 }
 #owner{
   padding: 8px 10px;
    outline: 6px solid gray;
     border: 0.5px solid rgb(17, 17, 17);
     border-radius: 10px;
     font-family: 'Poppins',sans-serif;
     font-size: 16px;
     margin-top: 7px; 
 }
  #furniture-name{
   padding: 8px 10px;
    outline: 6px solid gray;
     border: 0.5px solid rgb(17, 17, 17);
     border-radius: 10px;
     font-family: 'Poppins',sans-serif;
     font-size: 16px;
     margin-top: 7px; 
 }
  #quantity{
   padding: 8px 10px;
    outline: 6px solid gray;
     border: 0.5px solid rgb(17, 17, 17);
     border-radius: 10px;
     font-family: 'Poppins',sans-serif;
     font-size: 16px;
     margin-top: 7px; 
 }
 #furnitureForm {
  display: none;
  flex-direction: row;
  justify-content: space-between;
  padding: 15px;
  background-color: white;
  box-shadow: 3px 0px 3px 0px rgba(0, 0, 0, 0.377);
  width: 60vw;
  height: 18vh;
  margin-left: 305px;
  margin-top: 20px;
  border-radius: 7px;
}
 #furnitureForm form input{
margin: 8px;
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
                    <a href="furniture.php"class="active">Furniture🪑</a>
                    <a href="import.php">Import🚚</a>
                    <a href="export.php">Export✈️</a>
                </li>
            </ul>
        </nav>
    </section>
    <div class="add" onclick="toggleForm()">
    <div class="icon">
        <ion-icon name="add-circle"></ion-icon>
    </div>
    <div class="text">
        <span>Add Furniture</span>
    </div>
</div>
<section class="form" id="furnitureForm">
    <form action="furniture.php" method="post">
        <input type="text" name="owner" placeholder="Owner" id="owner"  required>
        <input type="text" name="furniture-name" placeholder="Add Furniture...." id="furniture-name" required>
        <input type="number" name="quantity" placeholder="Quantity...." id="quantity" required>
        <button type="submit" name="add" class="btn">Add</button>
    </form>
</section>

<section class="DisplayAll">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Quantity</th>
                <th>Date</th>
                <th>Owner</th>
                <th>Import</th>
                <th>Export</th>
            </tr>
        </thead>
        <tbody>
         <?php
$select = "SELECT f.id, f.owner, f.quantity, f.date, f.name, i.quantity as import_quantity, e.quantity as export_quantity FROM furniture f LEFT JOIN import i ON f.id = i.id LEFT JOIN export e ON f.id = e.id";
$selectResult = mysqli_query($conn, $select);
while ($selectFetch = mysqli_fetch_assoc($selectResult)) {
    echo "<tr>";
    echo "<td>" . $selectFetch['id'] . "</td>";
    echo "<td>" . $selectFetch['name'] . "</td>";
    echo "<td>" . $selectFetch['quantity'] . "</td>"; 
    echo "<td>" . $selectFetch['date'] . "</td>";
    echo "<td>" . $selectFetch['owner'] . "</td>";
   
    echo "<td>
    <button class='importBtn'>Import</button>
    <div class='importForm'>
    <form action='furniture.php' method='post'>
    <input type='hidden' name='product_id' value='" . $selectFetch['id'] . "'>
    <input type='number' name='import_quantity' placeholder='Import Quantity' class='importInput' required>
    <button type='submit' name='import' class='importSubmit'>Import</button>
    </form>
    </div>
    </td>";
    echo "<td>
    <button class='exportBtn'>Export</button>
    <div class='exportForm'>
    <form action='furniture.php' method='post'>
    <input type='hidden' name='product_id' value='" . $selectFetch['id'] . "'>
    <input type='number' name='export_quantity' placeholder='Export Quantity' class='exportInput' required>
    <button type='submit' name='export' class='exportSubmit'>Export</button>
    </form>
    </div>
    </td>";
    echo "</tr>";
}
?>

        </tbody>
    </table>
</section>
<!--  -->
    
    
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<script>

const importForm = document.querySelector('.importForm');
const importBtn = document.querySelector('.importBtn');

const exportForm = document.querySelector('.exportForm');
const exportBtn = document.querySelector('.exportBtn');
const body = document.querySelector('body');
const nav = document.querySelector('.nav-bar');

importBtn.addEventListener('click',() => {
    // body.style.backgroundColor = 'rgba(0, 0, 0, 0.5)';
    // nav.style.backgroundColor = 'rgba(0, 0, 0, 0.5)';
    importForm.style.display = 'block';
});


importForm.addEventListener('submit', () => {
    body.style.backgroundColor = 'white';
    nav.style.backgroundColor = 'white';
  importForm.style.display = 'none';
})

exportBtn.addEventListener('click',() => {
    // body.style.backgroundColor = 'rgba(0, 0, 0, 0.5)';
    // nav.style.backgroundColor = 'rgba(0, 0, 0, 0.5)';
    exportForm.style.display = 'block';
});

exportForm.addEventListener('submit', () => {
    body.style.backgroundColor = 'white';
    nav.style.backgroundColor = 'white';
  exportForm.style.display = 'none';
})

    function toggleForm() {
  var form = document.getElementById('furnitureForm');
  form.style.display = (form.style.display === 'none' || form.style.display === '') ? 'block' : 'none';
  
}



    
       

</script>
</body>
</html>