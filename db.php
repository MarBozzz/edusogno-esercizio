<?php
// Connessione al database
define("DB_SERVERNAME","localhost");
define("DB_USERNAME","root");
define("DB_PASSWORD","root");
define("DB_NAME","edusogno");

$conn = new mysqli(DB_SERVERNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Creazione tabella utenti
$sql_utenti = "CREATE TABLE IF NOT EXISTS utenti (
id int NOT NULL AUTO_INCREMENT,
nome varchar(45),
cognome varchar(45),
email varchar(255),
password varchar(255),
PRIMARY KEY (id)
)";

if ($conn->query($sql_utenti) === TRUE) {
    echo "Tabella utenti creata con successo";
} else {
    echo "Errore nella creazione della tabella utenti: " . $conn->error;
}

// Creazione tabella eventi
$sql_eventi = "CREATE TABLE IF NOT EXISTS eventi (
id int NOT NULL AUTO_INCREMENT,
attendees text,
nome_evento varchar(255),
data_evento datetime,
PRIMARY KEY (id)
)";

if ($conn->query($sql_eventi) === TRUE) {
    echo "Tabella eventi creata con successo";
} else {
    echo "Errore nella creazione della tabella eventi: " . $conn->error;
}

// Dati degli eventi
$eventi = array(
    array('attendees' => 'ulysses200915@varen8.com,qmonkey14@falixiao.com,mavbafpcmq@hitbase.net', 'nome_evento' => 'Test Edusogno 1', 'data_evento' => '2022-10-13 14:00'),
    array('attendees' => 'dgipolga@edume.me,qmonkey14@falixiao.com,mavbafpcmq@hitbase.net', 'nome_evento' => 'Test Edusogno 2', 'data_evento' => '2022-10-15 19:00'),
    array('attendees' => 'dgipolga@edume.me,ulysses200915@varen8.com,mavbafpcmq@hitbase.net', 'nome_evento' => 'Test Edusogno 2', 'data_evento' => '2022-10-15 19:00')
);

// Inserimento dei dati degli eventi nella tabella eventi
foreach ($eventi as $evento) {
    $sql = "INSERT INTO eventi (attendees, nome_evento, data_evento) VALUES ('".$evento['attendees']."', '".$evento['nome_evento']."', '".$evento['data_evento']."')";

    if ($conn->query($sql) === TRUE) {
        echo "Dati evento inseriti con successo";
    } else {
        echo "Errore nell'inserimento dei dati evento: " . $conn->error;
    }
}

// Chiusura della connessione al database
$conn->close();
?>
