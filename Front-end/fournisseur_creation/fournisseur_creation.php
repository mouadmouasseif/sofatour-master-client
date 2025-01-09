<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Fournisseur</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script>
        // Validation en JS
        function validateForm() {
            const nom = document.getElementById('nom_fournisseur').value;
            const email = document.getElementById('contact_email').value;
            const rib = document.getElementById('rib_iban').value;

            if (nom === '' || email === '' || rib === '') {
                alert('Veuillez remplir tous les champs obligatoires.');
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
<div class="container mt-5">
    <h2>Ajouter un Fournisseur</h2>
    <form action="add_fournisseur.php" method=" " onsubmit="return validateForm();">
        <div class="mb-3">
            <label for="nom_fournisseur" class="form-label">Nom du Fournisseur *</label>
            <input type="text" class="form-control" id="nom_fournisseur" name="nom_fournisseur" required>
        </div>
        <div class="mb-3">
            <label for="adresse_ville" class="form-label">Ville</label>
            <input type="text" class="form-control" id="adresse_ville" name="adresse_ville">
        </div>
        <div class="mb-3">
            <label for="adresse_pays" class="form-label">Pays</label>
            <input type="text" class="form-control" id="adresse_pays" name="adresse_pays">
        </div>
        <div class="mb-3">
            <label for="adresse_code_postal" class="form-label">Code Postal</label>
            <input type="text" class="form-control" id="adresse_code_postal" name="adresse_code_postal">
        </div>
        <div class="mb-3">
            <label for="contact_nom" class="form-label">Nom du Contact Principal</label>
            <input type="text" class="form-control" id="contact_nom" name="contact_nom">
        </div>
        <div class="mb-3">
            <label for="contact_telephone" class="form-label">Téléphone</label>
            <input type="text" class="form-control" id="contact_telephone" name="contact_telephone">
        </div>
        <div class="mb-3">
            <label for="contact_email" class="form-label">Email *</label>
            <input type="email" class="form-control" id="contact_email" name="contact_email" required>
        </div>
        <div class="mb-3">
            <label for="site_web" class="form-label">Site Web</label>
            <input type="url" class="form-control" id="site_web" name="site_web">
        </div>
        <div class="mb-3">
            <label for="rib_iban" class="form-label">RIB/IBAN *</label>
            <input type="text" class="form-control" id="rib_iban" name="rib_iban" required>
        </div>
        <div class="mb-3">
            <label for="identifiant_fiscal" class="form-label">Identifiant Fiscal</label>
            <input type="text" class="form-control" id="identifiant_fiscal" name="identifiant_fiscal">
        </div>
        <div class="mb-3">
            <label for="registre_commerce" class="form-label">Registre de Commerce</label>
            <input type="text" class="form-control" id="registre_commerce" name="registre_commerce">
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>
</body>
</html>
