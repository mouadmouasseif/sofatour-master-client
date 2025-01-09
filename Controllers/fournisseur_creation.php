<?php
include 'connection_database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    

    // Récupération des données du formulaire
    $nom_fournisseur = $_POST['nom_fournisseur'];
    $adresse_ville = $_POST['adresse_ville'];
    $adresse_pays = $_POST['adresse_pays'];
    $adresse_code_postal = $_POST['adresse_code_postal'];
    $contact_nom = $_POST['contact_nom'];
    $contact_telephone = $_POST['contact_telephone'];
    $contact_email = $_POST['contact_email'];
    $site_web = $_POST['site_web'];
    $rib_iban = $_POST['rib_iban'];
    $identifiant_fiscal = $_POST['identifiant_fiscal'];
    $registre_commerce = $_POST['registre_commerce'];

    // Requête d'insertion
    $sql = "INSERT INTO client_fournisseur (nom_fournisseur, adresse_ville, adresse_pays, adresse_code_postal, contact_nom, contact_telephone, contact_email, site_web, rib_iban, identifiant_fiscal, registre_commerce) 
            VALUES ('$nom_fournisseur', '$adresse_ville', '$adresse_pays', '$adresse_code_postal', '$contact_nom', '$contact_telephone', '$contact_email', '$site_web', '$rib_iban', '$identifiant_fiscal', '$registre_commerce')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Fournisseur ajouté avec succès');</script>";
    } else {
        echo "Erreur : " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
