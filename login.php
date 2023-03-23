<?php
session_start();

// Crea connessione
define("DB_SERVERNAME","localhost");
define("DB_USERNAME","root");
define("DB_PASSWORD","root");
define("DB_NAME","edusogno");

$conn = new mysqli(DB_SERVERNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connessione
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, email, password FROM utenti";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {

    $valid_email = $row["email"];
    $valid_password = $row["password"];

    if (!empty($_POST) && $_POST['email'] === $valid_email && $_POST['password'] === $valid_password)
    {
      $_SESSION['logged_in'] = true;
      $_SESSION['email'] = $_POST['email'];
      $_SESSION['password'] = $_POST['password'];
      header('Location: ./index.php');
    }
  }
} else {
  echo "Nessun risultato";
}

$error = false;
if (!empty($_POST))
{
    if (empty($_POST['email']) || empty($_POST['password']))
    {
        $error = true;
        echo '<h2 class ="error">Per favore, inserisci sia l\'email che la password.</h2>';
    }
    else if ($_POST['email'] !== $valid_email || $_POST['password'] !== $valid_password)
    {
        $error = true;
        echo '<h2 class ="error">Le credenziali non sono corrette. Riprova.</h2>';
    }
}

if (!$error && !empty($_POST) && $_POST['email'] === $valid_email && $_POST['password'] === $valid_password)
{
    $_SESSION['logged_in'] = true;
    header('Location: ./index.php');
}
else
{
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

    <h2 class="login">Hai già un account?</h2>

    <div class="form-container">
      <form class="form-box" method="POST">
          <div class="email">
              <label for="email">Inserisci l'email</label><br>
              <input type="email" name="email" id="email" placeholder="name@example.com">
          </div>
          <div class="password">
              <label for="password">Inserisci la password</label><br>
              <input type="password" name="password" id="password" placeholder="Scrivila qui">
          </div>
          <button type="submit">ACCEDI</button>
      
          <p>Non hai ancora un profilo? <a href="./registration.php">Registrati</a></p>
      </form>
    </div>
  </main>
</body>
</html>

<?php
}
$conn->close();
?>