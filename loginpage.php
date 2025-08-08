<?php
if (isset($_SESSION['user'])) {
    header("Location: welcome.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="login-container">
  <a href="javascript:history.back()" class="card-back-arrow" title="Back">&#60;</a>
  <h2>Login</h2>

   <?php if (isset($_GET['error'])): ?>
    <p style="color: red;">Username atau password salah!</p>
  <?php endif; ?>

  <form action="auth.php" method="post">
    <div class="form-group">
      <label for="username">Username:</label>
      <input type="text" id="username" name="username" required>
    </div>
    <div class="form-group">
      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required>
    </div>
    <button type="submit" class="login-button">Login</button>
  </form>
</div>

</body>
</html>