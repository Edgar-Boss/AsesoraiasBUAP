<?php
  require 'database.php';
  $message = '';
  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $stmt->bindParam(':password', $password);
    if ($stmt->execute()) {
      $message = 'Nuevo usuario creado satisfactoriamente';
    } else {
      $message = 'Lo sentimos hemos tenido un problema al crear su cuenta';
    }
  }
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <title>SignUp</title>
         <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="assets/css/style.css">
    </head>
    <body>
        <?php require 'partials/header.php' ?>
        
        <?php if(!empty($message)): ?>
            <p> <?= $message ?></p>
        <?php endif; ?>
        
        <h1 >Registrarse</h1>
        <span>o<a href="login.php"> Ingresar</a></span>
        <form action="signup.php" method="post">
        <input type="text" name="email" placeholder="Ingrese su email">
        <input type="password" name="password" placeholder="Ingrese su contraseña">    
        <input type="password" name="confirm_password" placeholder="Confirme su correo">   
        <input type="submit" value="Enviar">
    </form>
    </body>
</html>