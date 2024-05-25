<?php
session_start();
$conn = mysqli_connect('localhost','root','','Cargo');

if(isset($_POST['signup'])) {
    $name = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $normal = "SELECT * FROM cargouser WHERE username = '$name'";
    $normal_user = mysqli_query($conn,$normal);
   $check = mysqli_num_rows($normal_user);

    if($check > 0){
        echo "<script>alert('user already exist')</script>";
    } else{
        $sql = "INSERT INTO cargouser(username,email,password)VALUES('$name','$email','$password')";
        $insert = mysqli_query($conn,$sql);
        echo "<script>alert('User Registered')</script>";
        
    }


}

if(isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $select = "SELECT * FROM cargouser";
    $result = mysqli_query($conn,$select);

    while($row = $result->fetch_assoc()){
        $_SESSION['user_id'] = $row['id'];
        $em = $row['email'];
        $pass = $row['password'];

        if($email == $em && $password == $pass) {
            header("location:Dashboard.php");
        } else{
            echo "<script>alert('You are not member of Cargoltd Register to Cargo Ltd')</script>";
            
        }
    }
   


}

?>














<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cargo ltd</title>
    <link rel="stylesheet" href="/cargo/index.css">
    <link rel="shortcut icon" href="ship-removebg-preview.png" type="image/x-icon">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script>
</head>
<style>
  .about .second-text .inner-text {
  display: flex;
  margin-top: 85px;
  margin-left: -420px;
  color: rgba(0, 0, 0, 0.733);
}

    .login-form {
  display: none;
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background-color: rgba(255, 255, 255, 0.884);
  padding: 20px;
  width: 30vw;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}

.login-form h2 {
  display: flex;
  justify-content: center;
  align-items: center;
  text-align: center;
  color: black;
  font-family: "Poppins", sans-serif;
  margin-top: 0;
}

.login-form label {
  display: block;
  font-family: "Poppins", sans-serif;
  margin-bottom: 10px;
}

.login-form input[type="email"],
.login-form input[type="password"] {
  width: 100%;
  padding: 10px;
  margin-bottom: 20px;
  border-top: none;
  border-left: none;
  border-right: none;
  border-bottom: 2px solid black;
  background: none;
  border-radius: 2px;
  outline: none;
  font-family: "Poppins", sans-serif;
  font-size: 20px;
}

.login-form input[type="submit"] {
  display: flex;
  justify-content: center;
  align-items: center;
  text-align: center;
  align-self: center;
  background-color: #000000;
  color: #fff;
  font-family: "Poppins", sans-serif;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.login-form input[type="submit"]:hover {
  background-color: white;
  color: black;
  border: 0.5px solid rgb(17, 17, 17);
  outline: 6px solid gray;
}

.login-form input[type="submit"]:active {
  background: rgb(17, 17, 17);
  transition: 0.1s ease-in-out;
  color: white;
}
.login {
  display: flex;
  justify-content: center;
  align-items: center;
  text-align: center;
  align-self: center;
  background-color: #000000;
  color: #fff;
  height: 5vh;
  width: 7vw;
  margin-left: 190px;
  margin-top: 25px;
  font-family: "Poppins", sans-serif;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.login:hover {
  background-color: white;
  color: black;
  border: 0.5px solid rgb(17, 17, 17);
  outline: 6px solid gray;
}
.login:active {
  background: rgb(17, 17, 17);
  transition: 0.1s ease-in-out;
  color: white;
}

</style>
<body>
    <section class="nav-bar">
        <div class="logo">
            <a href="#home"><h1>Cargo.ltd</h1></a>
        </div>
        <nav>
            <ul>
                <li>
                    <a href="#about">About</a>
                    <a href="#">Furniture</a>
                    <a href="#">Contact Us</a>
                </li>
            </ul>
        </nav>
        <button class="login">Login</button>
    </section>
    <section class="home" id="home">
        <div class="text">
            <span>
                Delivering Any Possibilities✈️✈️ <br /> With One Cargo at a Time.
            </span>
            <button class="get-started">Get Started</button>
        </div>
        <div class="image">
            <img src="ship-removebg-preview.png" alt="ship" srcset="">
        </div>
       <div class="signup-form">
    <h2>Sign Up</h2>
    <form action="index.php" method="post">
      <label for="username">Username:</label>
      <input type="text" id="user" name="username"><br><br>
      <label for="email">Email:</label>
      <input type="email" id="em" name="email"><br><br>
      <label for="password">Password:</label>
      <input type="password" id="pass" name="password"><br><br>
      <input type="submit" name="signup" value="Sign Up">
    </form>
  </div>
   <div class="login-form">
    <h2>Login</h2>
    <form action="index.php" method="post">
      <label for="email">Email:</label>
      <input type="email" id="email" name="email"><br><br>
      <label for="password">Password:</label>
      <input type="password" id="password" name="password"><br><br>
      <input type="submit" name="login" value="Login">
    </form>
  </div>
  
</section>
<section class="about" id="about">
    <div class="about-text">
        <span>Seamless Shipping<br />Services for a<br /> Connected World🌍</span>
    </div>
    <div class="images">
        <img src="container.jpg" alt="cargo" class="one">
        <img src="containers.jpg" alt="cargos" class="two">
        <img src="ship-removebg-preview.png" alt="" class="three">
    </div>
    <div class="second-text">
        <div class="icon">
            <ion-icon name="flash-outline"></ion-icon>
            <span class="descr" >About Our Cargo ltd Company</span>
        </div>
        <div class="inner-text">
            <span>Our mission is to revolutionize the way goods travel<br />around the world by providing efficient,secure, and timely<br /> cargo shipment services.</span>
        </div>
    </div>
</section>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<script>
          gsap.from(".text", 1, {
        opacity: 0,
        duration: 1,
        x: -50,
        delay: 0.5,
      });
       gsap.from(".image", 1, {
        opacity: 0,
        duration: 0.5,
        x: -190,
        delay: 0.5,
      });

      function animateAbout() {
        gsap.from("#about", 1, {
          opacity: 0,
          duration: 1,
          y: -50,
          delay: 0.5,
        });
      }
      
      document
        .querySelector("a[href='#about']")
        .addEventListener("click", animateAbout);

const getStartedBtn = document.querySelector('.get-started');
const signupForm = document.querySelector('.signup-form');
const loginForm = document.querySelector('.login-form');
const body = document.querySelector('body');
const nav = document.querySelector('.nav-bar');

getStartedBtn.addEventListener('click', () => {
  body.style.backgroundColor = 'rgba(0, 0, 0, 0.5)';
   nav.style.backgroundColor = 'rgba(0, 0, 0, 0.2)';
  signupForm.style.display = 'block';
});

signupForm.addEventListener('submit', (e) => {
  body.style.backgroundColor = 'white';
  nav.style.backgroundColor = 'white';
  signupForm.style.display = 'none';
});
document.querySelector('.login').addEventListener('click', () => {
  body.style.backgroundColor = 'rgba(0, 0, 0, 0.5)';
   nav.style.backgroundColor = 'rgba(0, 0, 0, 0.2)';
  loginForm.style.display = 'block';
});
loginForm.addEventListener('submit', (e) => {
  body.style.backgroundColor = 'white';
  nav.style.backgroundColor = 'white';
  signupForm.style.display = 'none';
});
</script>
</body>
</html>