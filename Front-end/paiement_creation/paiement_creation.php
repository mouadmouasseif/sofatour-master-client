<h1 class="titre_piem">Paiements : Devis : <span class="devis_id"><?php  ?><span></h1>
<div class="content"     style ="padding: 22px;">
<form id="paymentForm" enctype="multipart/form-data">
        <input type="hidden" name="id_devis" class="input_devis_id">
        <table class="PaiementCreationTable">
            <thead class="PaiementCreationTable-thead">
                <tr>
                    <th>Mode de paiement</th>
                    <th>Montant</th>
                    <th>Document</th>
                    <th>Exonérer</th>
                    <th>Supprimer</th>
                </tr>
            </thead>
            <tbody class="PaiementCreationTable-tbody">
                <input type="hidden" name="recordsJson">
                <tr class="PaiementCreationTable-add-row">
                    <td colspan="5" class="PaiementCreationTable-new-row"><i class="fa fa-plus" aria-hidden="true"></i> Ajouter paiement</td>
                </tr>
            </tbody>
        </table>
        <br/>
        <button type="submit" class="btn btn-info">Enregistrer</button>
    </form>
</div>
<script src="../Front-end/paiement_creation/paiement_creation.js"></script> 