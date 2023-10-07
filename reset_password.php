<?php
// Connessione al database (sostituisci con i tuoi dati di connessione)
$dbhost = 'localhost';
$dbuser = 'root';
$dbpassword = 'root';
$dbname = 'edusogno';

$conn = new mysqli($dbhost, $dbuser, $dbpassword, $dbname);

// Verifica la connessione al database
if ($conn->connect_error) {
    die("Connessione al database fallita: " . $conn->connect_error);
}

// Verifica se il modulo di reset della password è stato inviato
if (isset($_POST['reset_password'])) {
  // Recupera l'email inserita dall'utente
  $email = $_POST['email'];

  // Verifica se l'email esiste nel database
  $query = "SELECT * FROM utenti WHERE email = '$email'";
  $result = $conn->query($query);

  if ($result->num_rows > 0) {
      // Genera una nuova password casuale
      $nuova_password = bin2hex(random_bytes(8)); // Modifica la lunghezza della password a tuo piacimento

      // Hash della nuova password
      $hashed_password = password_hash($nuova_password, PASSWORD_DEFAULT);

      // Aggiorna la password nel database
      $update_query = "UPDATE utenti SET password = '$hashed_password' WHERE email = '$email'";
      if ($conn->query($update_query) === TRUE) {
          // Invia la nuova password all'utente via email
          $oggetto = "Password reset";
          $messaggio = "La tua nuova password è: " . $nuova_password;

          
          mail($email, $oggetto, $messaggio);

          echo "La tua password è stata reimpostata con successo. Controlla la tua email per la nuova password.";
      } else {
          echo "Errore durante la reimpostazione della password: " . $conn->error;
      }
  } else {
      echo "Nessun utente trovato con questa email.";
  }

  // Chiudi la connessione al database
  $conn->close();
}
?>
