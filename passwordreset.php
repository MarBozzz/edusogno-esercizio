<?php
// Connessione al database
define("DB_SERVERNAME","localhost");
define("DB_USERNAME","root");
define("DB_PASSWORD","root");
define("DB_NAME","edusogno");

$conn = new mysqli(DB_SERVERNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check Connessione
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check se il form è stato submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // input
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm_password'];

  // Check se password e conferma password coincidono
  if ($password !== $confirm_password) {
    $error_message = "Passwords do not match";
  } else {
    // Hash la nuova password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Update della password nel database
    $sql = "UPDATE utenti SET password='$hashed_password' WHERE email='$email'";

    if (mysqli_query($conn, $sql)) {
        $success_message = "Password updated successfully";
        header('Location: ./login.php');
    } else {
        $error_message = "Error updating password: " . mysqli_error($conn);
    }
  }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/styles/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;700&display=swap" rel="stylesheet">
    <title>Edusogno</title>
</head>

<body>

  <img src="assets/img/Vector 5.png" alt="vector5" id="vector-5">
  <img src="assets/img/Vector 4.png" alt="vector4" id="vector-4">
  <img src="assets/img/Vector 1.png" alt="vector1" id="vector-1">
  
  <img src="assets/img/rocket.svg" alt="rocket" id="rocket">
  <div id="circle-1" class="circle"></div>
  <div id="circle-2" class="circle"></div>

  <header>
      <nav>
          <img src="assets/img/Logo-edusogno.png" alt="logo">
      </nav>
  </header>

  <main>

      <h2 class="register">Modifica la tua password</h2>

<?php
  // Display success o error message
  if (isset($success_message)) {
    echo "<p>$success_message</p>";
  } elseif (isset($error_message)) {
    echo "<p>$error_message</p>";
  }
?>
      <div class="form-container">
        <form class="form-box" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
          <div class="email">
            <label for="email">Inserisci l'email</label>
            <input type="email" name="email" id="email" placeholder="name@example.com" required>
          </div>

          <div class="password">
            <label for="password">Inserisci la nuova password</label>
            <input type="password" name="password" id="password" placeholder="Scrivila qui" required>
          </div>

          <div class="password">
            <label for="confirm_password">Conferma la nuova password</label>
            <input type="password" name="confirm_password" id="confirm_password" placeholder="Conferma qui" required>
          </div>

          <button type="submit" value="Reset Password">Reset Password</button>

        </form>
      </div>
  </main>
</body>
</html>
