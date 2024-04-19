<?php

session_start();

if (isset($_SESSION["user_id"])) {
    
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = "SELECT * FROM user
            WHERE id = {$_SESSION["user_id"]}";
            
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home Page</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <header>
    <h1><img src="img/logo.png" alt="Logo">집하자</h1>
  </header>
  <main>
    <h2>Welcome to 집하자!</h2>
    <a href="login.html" class="btn">Login</a>
    <a href="signup.html" class="btn">Sign Up</a>
  </main>
</body>
</html>
<style>
body, h1, h2  {
  margin: 0;
  padding: 0;
}

body {
  font-family: 'Montserrat', sans-serif;
  background: #dfe8ff;
}

header {
  background-color: #182978;
  color: #fff;
  padding: 20px 0;
  text-align: center;
}

h1 {
  color: white;
  font-size: 40px;
  margin: 20px 0;
}

img {
  width: 60px;
  margin-right: 10px;
}

main {
  text-align: center;
  margin-top: 50px;
}

h2 {
  font-size: 24px;
  margin-bottom: 20px;

}



.btn {
  display: inline-block;
  padding: 10px 20px;
  background-color: #182978;
  color: white;
  text-decoration: none;
  border-radius: 5px;
  margin-right: 10px;
  transition: background-color 0.3s ease;
}

.btn:hover {
  background-color: #0f1f38;
}

</style>