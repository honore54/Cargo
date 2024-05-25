<?php
if(isset($_POST['signup'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
$password = $_POST['password'];
$sql = "INSERT INTO bbb(username,email,password) VALUES('$username','$email','$password')";
$result = mysqli_query($conn,$sql);
}
if(isset($_POST['signin'])){
 $username = $_POST['username'];
 $password = $_POST['password'];
 $result = "SELECT * FROM nnn";
 $name = mysqli_query($conn,$result);
while($row = $name->fetch_assoc()){
    $name = $row['username'];
    $pass = $row['password'];
    if($username == $name  && $password == $pass){
        echo "logged in";
    }else{
        echo "not logg in";
    }
}
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="philo.php" method="post">
        <input type="text" name="username">
         <input type="password" name="password">
          <input type="email" name="email">
          <input type="button" name='signup'value="signup">
    </form>
    <form action="philo.php" method="post">
        <input type="text" name="username">
         <input type="password" name="password">
          <input type="button" name='signin'value="signin">
    </form>
</body>
</html>