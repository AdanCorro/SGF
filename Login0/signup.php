<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrarse</title>
  <link rel="stylesheet" href="css/style1.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="icon" href="../src/img/logo-cetmar.png" type="image/x-icon">
</head>

<body>
  <div class="container">
    <div class="form-box box">

      <header>Registrarse</header>
      <hr>

      <form action="#" method="POST">

        <div class="form-box">

          <?php

          include "connection.php";

          if (isset($_POST['register'])) {

            $name = $_POST['username'];
            $email = $_POST['email'];
            $pass = $_POST['password'];
            $cpass = $_POST['cpass'];

            // Verificar si el correo electrónico ya está registrado
            $check = $conn->prepare("SELECT * FROM users WHERE email = :email");
            $check->execute(['email' => $email]);
            $res = $check->fetch(PDO::FETCH_ASSOC);

            $passwd = password_hash($pass, PASSWORD_DEFAULT);

            if ($res) {
              echo "<div class='message'>
        <p>Este correo electrónico ya está en uso, ¡Intenta con otro, por favor!</p>
        </div><br>";

              echo "<a href='javascript:self.history.back()'><button class='btn'>Regresar</button></a>";
            } else {

              if ($pass === $cpass) {

                $sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
                $stmt = $conn->prepare($sql);
                $result = $stmt->execute(['username' => $name, 'email' => $email, 'password' => $passwd]);

                if ($result) {
                  echo "<div class='message'>
      <p>¡Te has registrado exitosamente!</p>
      </div><br>";
                  
                  echo "<div class='message'>
      <p>¿Quieres iniciar sesión ahora?</p>
      </div><br>";
                  
                  echo "<a href='login.php'><button class='btn'>Iniciar sesión</button></a>";
                  echo "<a href='index.php'><button class='btn'>Volver a la página principal</button></a>";

                } else {
                  echo "<div class='message'>
        <p>Ocurrió un error, por favor intenta de nuevo.</p>
        </div><br>";

                  echo "<a href='javascript:self.history.back()'><button class='btn'>Regresar</button></a>";
                }

              } else {
                echo "<div class='message'>
      <p>Las contraseñas no coinciden.</p>
      </div><br>";

                echo "<a href='signup.php'><button class='btn'>Regresar</button></a>";
              }
            }
          } else {

            ?>

            <div class="input-container">
              <i class="fa fa-user icon"></i>
              <input class="input-field" type="text" placeholder="Nombre de usuario" name="username" required>
            </div>

            <div class="input-container">
              <i class="fa fa-envelope icon"></i>
              <input class="input-field" type="email" placeholder="Correo electrónico" name="email" required>
            </div>

            <div class="input-container">
              <i class="fa fa-lock icon"></i>
              <input class="input-field password" type="password" placeholder="Contraseña" name="password" required>
              <i class="fa fa-eye icon toggle"></i>
            </div>

            <div class="input-container">
              <i class="fa fa-lock icon"></i>
              <input class="input-field" type="password" placeholder="Confirmar contraseña" name="cpass" required>
              <i class="fa fa-eye icon"></i>
            </div>

          </div>

          <center><input type="submit" name="register" id="submit" value="Registrarse" class="btn"></center>

          <div class="links">
            ¿Ya tienes una cuenta? <a href="login.php">Inicia sesión</a>
          </div>

        </form>
      </div>
      <?php
          }
          ?>
  </div>

  <script>
    const toggle = document.querySelector(".toggle"),
      input = document.querySelector(".password");
    toggle.addEventListener("click", () => {
      if (input.type === "password") {
        input.type = "text";
        toggle.classList.replace("fa-eye-slash", "fa-eye");
      } else {
        input.type = "password";
      }
    })
  </script>
</body>

</html>
