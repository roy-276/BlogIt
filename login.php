<?php
require 'config/constants.php';

// get the data from the form
$username_email = $_SESSION['login-data']['username_email'] ?? null;
$password = $_SESSION['login-data']['password'] ?? null;

// unset the session data
unset($_SESSION['login_data']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>BlogIt</title>

  <!-- Custom CSS -->
  <link rel="stylesheet" href="<?= ROOT_URL ?>css/style.css" />

  <!-- Iconscout CDN -->
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />

  <!-- Google Fonts Montserrat -->
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;900&display=swap" rel="stylesheet" />
</head>

<body>
  <!-- Form starts here -->
  <section class="form_section">
    <div class="container form_section-container">
      <h2>Login</h2>
      <?php if (isset($_SESSION['signup-success'])) : ?>
        <div class="alert_message success">
          <p>
            <?= $_SESSION['signup-success'];
            unset($_SESSION['signup-success']); ?>
          </p>
        </div>
      <?php elseif (isset($_SESSION['login'])) : ?>
        <div class="alert_message error">
          <p>
            <?= $_SESSION['login'];
            unset($_SESSION['login']); ?>
          </p>
        </div>
      <?php endif; ?>
      <form action="<?= ROOT_URL ?>login-logic.php" method="POST">
        <input type="text" name="username_email" value="<?= $username_email ?>" placeholder="Username or Email" />
        <input type="password" name="password" value="<?= $password ?>" placeholder="Password" />
        <button type="submit" name="submit" class="btn">Login</button>
        <small>Create an account? <a href="signup.php">Sign Up</a></small>
      </form>
    </div>
  </section>
  <!-- Form ends here -->
</body>

</html>