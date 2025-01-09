
<!-- Importations_models -->
<script src = "../Front-end/Models/client_modalite_payement_sans_avances.js"></script>
<script src = "../Front-end/Models/client_modalite_payement_avances.js"></script>
<script src = "../Front-end/Models/responsable_interlocuteur.js"></script>
<script src = "../Front-end/Models/client.js"></script>
<!-- Importations_models -->
<?php
if (isset($_GET['page_name'])) {
    $page_name = $_GET['page_name'];
    
    if($_GET['page_name'] == 'Personne_Morale' || $_GET['page_name'] == 'Personne_Physique' || $_GET['page_name'] == 'Personne_Individuelle' && ($_SESSION['profil'] == 'Responsable' || $_SESSION['profil'] == 'Gestionnaire client' || $_SESSION['profil'] == 'Administrateur system' ))
    {
        include '../Front-end/personne_morale_physique/personne_morale_physique.php';
    }
    elseif ($_GET['page_name'] == 'fournisseur_creation' && 
    ($_SESSION['profil'] == 'Responsable' || 
     $_SESSION['profil'] == 'Gestionnaire client' || 
     $_SESSION['profil'] == 'Administrateur système')) {
 include '../Front-end/fournisseur_creation/fournisseur_creation.php';
} elseif ($_GET['page_name'] == 'list_fournisseur' && 
       ($_SESSION['profil'] == 'Responsable' || 
        $_SESSION['profil'] == 'Gestionnaire client' || 
        $_SESSION['profil'] == 'Administrateur système')) {
 include '../Front-end/list_fournisseur/list_fournisseur.php';
}
    else if($_GET['page_name'] == 'list_client' && ($_SESSION['profil'] == 'Responsable' || $_SESSION['profil'] == 'Gestionnaire client' || $_SESSION['profil'] == 'Administrateur system' ))
    {
        include '../Front-end/liste_clients/liste_clients.php';
    }
    else if($_GET['page_name'] == "devis_creation" && ($_SESSION['profil'] == 'Responsable'  || $_SESSION['profil'] == 'Administrateur system' ))
    {
        include '../Front-end/devis_creation/devis_creation.php';
    }
    else if($_GET['page_name'] == "Agenda" && ($_SESSION['profil'] == 'Responsable'  || $_SESSION['profil'] == 'Administrateur system' ))
    {
        include '../Front-end/agenda/agenda.php';
    }
    else if($_GET['page_name'] == "tous_les_devis" && ($_SESSION['profil'] == 'Responsable'  || $_SESSION['profil'] == 'Administrateur system' ))
    {
        include '../Front-end/liste_devis/liste_devis.php';
    } 
    else if($_GET['page_name'] == "ChiffreDaffaires" && ($_SESSION['profil'] == 'Administrateur system' ))
    {
        include '../Front-end/Rapport_chiffres_daffaire/Rapport_chiffres_daffaire.php';
    }
    else if($_GET['page_name']  == 'toutes_les_factures' && ($_SESSION['profil'] == 'Responsable'  || $_SESSION['profil'] == 'Administrateur system' ))
    {
        include '../Front-end/liste_factures/liste_factures.php';
    }
    else if($_GET['page_name']  == 'tous_les_paiements' && ($_SESSION['profil'] == 'Responsable  Caisse'  || $_SESSION['profil'] == 'Administrateur system' ))
    {
        include '../Front-end/liste_paiements/liste_paiements.php';
    }
    else if($_GET['page_name']  == 'bilanGenerale' && ($_SESSION['profil'] == 'Administrateur system' ))
    {
        include '../Front-end/Rapports_bilan_generale/Rapports_bilan_generale.php';
    }
    else if( $_GET['page_name']  == 'rapportParPrestation' && ($_SESSION['profil'] == 'Administrateur system' ))
    {
        include '../Front-end/rapport_par_prestation/rapport_par_prestation.php';
    }
    else if( $_GET['page_name']  == 'ChiffreDaffaireParPersonnel' && ($_SESSION['profil'] == 'Administrateur system' ))
    {
        include '../Front-end/Chiffre_d_affaire_par_personnel/Chiffre_d_affaire_par_personnel.php';
    }
    else if( $_GET['page_name']  == 'Produits' && ($_SESSION['profil'] == 'Administrateur system' || $_SESSION['profil'] == 'Responsable stock'))
    {
        include '../Front-end/produits/produits.php';
    }
    else if( $_GET['page_name']  == 'Prestations' && ($_SESSION['profil'] == 'Responsable'))
    {
        include '../Front-end/prestations/prestations.php';
    }
}
else
{
    if(  $_SESSION['profil'] == 'Responsable stock')
    {
         $page_name = 'Produits';
        include '../Front-end/produits/produits.php';
    }
    else
    {
       $page_name = 'Personne_Morale';
      include '../Front-end/personne_morale_physique/personne_morale_physique.php';
    }
   
}

?>
<meta name="id_page" content="<?php if(isset($_GET['page'])) { echo $_GET['page']; } else { echo 'all_menu_id li:first';} ?>" />
<script src ="../Front-end/menu/menu.js"></script>