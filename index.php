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

            <div class="nav-right">
                <div class="btn-logout">
                    <a href='./logout.php'>Log out</a>
                </div>
                
                <div class="btn-changepwd">
                    <form action="index.php" method="POST">
                        <input type="submit" name="email" value="Change Password" />
                    </form>
                </div>
                
            </div>
        </nav>
    </header>

<?php
require __DIR__ . '/send_email.php';


if (!empty($_SESSION['logged_in']))
{
    define("DB_SERVERNAME","localhost");
    define("DB_USERNAME","root");
    define("DB_PASSWORD","root");
    define("DB_NAME","edusogno");

    // Create connection
    $conn = new mysqli(DB_SERVERNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);

    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

    $email = $_SESSION['email'];
    $sql = "SELECT id, nome, cognome, email FROM utenti WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();


    // controlla che l'utente sia loggato e recuperare la sua email dalla sessione
    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && isset($_SESSION['email'])) {
        $email = $_SESSION['email'];

    // seleziona i dati degli eventi in cui l'utente è tra gli attendees
        $sql_ev = "SELECT * FROM eventi WHERE attendees LIKE '%$email%'";
        $result_ev = $conn->query($sql_ev);
        
    // se ci sono degli eventi trovati
        if ($result_ev->num_rows > 0) {
            if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['email']))
            {
                send_email($email);
            }
?>
            <main>

                <h2 class="index">Ciao <?php echo $row['nome']?> ecco i tuoi eventi</h2>

                <div class="box-container">
<?php

            while($row_ev = $result_ev->fetch_assoc()) {
                // dati dell'evento
                $id_evento = $row_ev['id'];
                $nome_evento = $row_ev['nome_evento'];
                $data_evento = date_create($row_ev['data_evento'])->format('d/m/Y H:i');
?>
                <div class="box-wrapper">
                    <div class="box">
                        <h3><?php echo $id_evento?></h3>
                        <h3><?php echo $nome_evento?></h3>
                        <h5><?php echo $data_evento?></h5>
                        <button>JOIN</button>
                    </div>
                </div>
<?php
            }
        } else {
            echo '<h2 class="no-eventi">Ciao ' . $row['nome'] . ', <br>al momento non ci sono eventi nel tuo roster</h2>';
        }
    } else {
        //redirect al login
        header('Location: ./login.php');
    }
?>
            </div>
        </main>
    </body>
</html>
<?php
}
else
{
    echo '<main><div id="text-container"><h2 class="no-login">Non sei loggato <a href="login.php">Log in</a></h2></div></main>';
}
?>