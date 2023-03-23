<?php
// Connessione al database
define("DB_SERVERNAME","localhost");
define("DB_USERNAME","root");
define("DB_PASSWORD","root");
define("DB_NAME","edusogno");

$conn = new mysqli(DB_SERVERNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);

$stmt = $conn->prepare("INSERT INTO utenti (nome, cognome, email, password) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $nome, $cognome, $email, $password);

if(!empty($_POST)) {
    $nome = $_POST['nome'];
    $cognome = $_POST['cognome'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = $stmt->execute();

    header('Location: ./login.php');
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

        <h2 class="register">Crea il tuo account</h2>

        <div class="form-container">

            <form class="form-box" method="POST">

                <div class="name">
                    <label for="nome">Inserisci il nome</label>
                    <input type="text" name="nome" id="nome" placeholder="Mario">
                </div>

                <div class="surname">
                    <label for="cognome">Inserisci il cognome</label>
                    <input type="text" name="cognome" id="cognome" placeholder="Rossi">
                </div>

                <div class="email">
                    <label for="email">Inserisci l'email</label>
                    <input type="email" name="email" id="email" placeholder="name@example.com">
                </div>

                <div class="password">
                    <label for="password">Inserisci la password</label>
                    <input type="password" name="password" id="password" placeholder="Scrivila qui">
                </div>
                
                <button type="submit">REGISTRATI</button>

                <p>Hai già un account? <a href="./login.php">Accedi</a></p>
                
            </form>
        <div>
    </main>
</body>

</html>