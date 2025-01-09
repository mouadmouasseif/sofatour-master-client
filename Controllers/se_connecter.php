<?php
ini_set('session.cookie_lifetime', 86400);
ini_set('session.gc_maxlifetime', 86400);
session_start();
header("Location:../Ressources/index.php");
include 'connection_database.php';
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    $username = $_POST['nom_utilisateur'];
    $motdepasse = $_POST['mot_de_passe'];


    $query = "SELECT us.* , pr.* FROM utilisateurs us JOIN profils pr ON pr.id_profil = us.profils  WHERE nom_utilisateur = :username ";
    $statement = $conn->prepare($query);
    $statement->bindParam(':username', $username);
    $statement->execute();

    
    $user = $statement->fetch(PDO::FETCH_ASSOC);


    if ($user && $motdepasse == $user['mot_de_passe']) {
       
        $_SESSION['id_user'] = $user['id_user'];
        $_SESSION['nom_utilisateur'] = $user['nom_utilisateur'];
        $_SESSION['nom'] = $user['nom'];
        $_SESSION['prenom'] = $user['prenom'];
        $_SESSION['profil'] = $user['nom_profil'];
        $_SESSION['telephone'] = $user['telephone'];
        
  
        header("Location:../Ressources/index.php");
         exit();
    } else {
        header("Location:../Ressources/index.php?error=Login ou mot de passe incorrect.");
          exit();
    }
}

?>