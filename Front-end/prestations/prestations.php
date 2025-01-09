<?php require_once '../Controllers/connection_database.php'; ?>

<div class="container" id="gestion_prestations" style="text-align: center; padding-top: 5px;">  
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="page-heading"><i class="glyphicon glyphicon-edit"></i> Gestion des prestations</div>
                </div>
                <div class="panel-body">
                    <div class="remove-messages"></div>

                    <div class="div-action pull pull-right" style="padding-bottom:20px;">
                        <button class="btn btn-default button1" data-toggle="modal" id="addPrestationModalBtn" data-target="#addPrestationModal">
                            <i class="glyphicon glyphicon-plus-sign"></i> Ajouter une prestation
                        </button>
                    </div>

                    <div class="table-responsive" style="margin-top: 62px;">
                        <table class="table table-striped data_table_custom" id="managePrestationTable">
                            <thead>
                                <tr>
                                    <th>Designation</th>
                                    <th>Prestation</th>
                                    <th>Type</th>
                                    <th>Société</th>
                                    <th>Opérations</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal: Ajouter une prestation -->
    <div class="modal fade" id="addPrestationModal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form class="form-horizontal" id="submitPrestationForm" action="../Controllers/PrestationController/createPrestation.php" method="POST">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>&times;</span></button>
                        <h4 class="modal-title"><i class="fa fa-plus"></i> Ajouter une prestation</h4>
                    </div>
                    <div class="modal-body" style="max-height:450px; overflow:auto;">
                        <div id="add-prestation-messages"></div>
                        <div class="form-group">
                            <label for="designation" class="col-sm-3 control-label">Désignation :</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" id="designation" name="designation" placeholder="Désignation" rows="4" style="resize: vertical; max-height: 200px;"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="prestation" class="col-sm-3 control-label">Prestation :</label>
                            <div class="col-sm-8">
                                <input class="form-control" id="prestation" name="prestation" placeholder="Prestation">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="type" class="col-sm-3 control-label">Type :</label>
                            <div class="col-sm-8">
                                <select class="form-control" id="type" name="type">
                                    <option value="">~~SELECT~~</option>
                                    <?php 
                                    $sql = "SELECT id_client_ligne_devis_type_prestation, ligne_devis_type_prestation FROM client_ligne_devis_type_prestation";
                                    $stmt = $conn->query($sql);
                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                        echo "<option value='".$row['id_client_ligne_devis_type_prestation']."'>".$row['ligne_devis_type_prestation']."</option>";
                                    } 
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="societe" class="col-sm-3 control-label">Société :</label>
                            <div class="col-sm-8">
                                <select class="form-control" id="societe" name="societe">
                                    <option value="">~~SELECT~~</option>
                                    <?php 
                                    $sql = "SELECT id_societe, societe_name FROM societes";
                                    $stmt = $conn->query($sql);
                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                        echo "<option value='".$row['id_societe']."'>".$row['societe_name']."</option>";
                                    } 
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-remove-sign"></i> Fermer</button>
                        <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-ok-sign"></i> Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal: Éditer une prestation -->
    <div class="modal fade" id="editPrestationModal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    <h4 class="modal-title"><i class="fa fa-edit"></i> Modifier la prestation</h4>
                </div>
                <div class="modal-body" style="max-height:450px; overflow:auto;">
                    <div class="div-loading">
                        <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
                        <span class="sr-only">Loading...</span>
                    </div>
                    <div class="div-result">
                        <form class="form-horizontal" id="editPrestationForm" action="../Controllers/PrestationController/editPrestation.php" method="POST">
                            <br />
                            <div id="edit-prestation-messages"></div>
                            <div class="form-group">
                                <label for="editDesignation" class="col-sm-3 control-label">Désignation :</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" id="editDesignation" name="editDesignation" placeholder="Désignation" rows="4" style="resize: vertical; max-height: 200px;"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="editPrestation" class="col-sm-3 control-label">Prestation :</label>
                                <div class="col-sm-8">
                                    <input class="form-control" id="editPrestation" name="editPrestation" placeholder="Prestation">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="editType" class="col-sm-3 control-label">Type :</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="editType" name="editType">
                                        <option value="">~~SELECT~~</option>
                                        <?php 
                                        $sql = "SELECT id_client_ligne_devis_type_prestation, ligne_devis_type_prestation FROM client_ligne_devis_type_prestation";
                                        $stmt = $conn->query($sql);
                                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                            echo "<option value='".$row['id_client_ligne_devis_type_prestation']."'>".$row['ligne_devis_type_prestation']."</option>";
                                        } 
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="editSociete" class="col-sm-3 control-label">Société :</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="editSociete" name="editSociete">
                                        <option value="">~~SELECT~~</option>
                                        <?php 
                                        $sql = "SELECT id_societe, societe_name FROM societes";
                                        $stmt = $conn->query($sql);
                                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                            echo "<option value='".$row['id_societe']."'>".$row['societe_name']."</option>";
                                        } 
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-remove-sign"></i> Fermer</button>
                                <button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-ok-sign"></i> Enregistrer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal: Supprimer une prestation -->
    <div class="modal fade" id="removePrestationModal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Supprimer une prestation</h4>
                </div>
                <div class="modal-body">
                    <p>Voulez-vous vraiment supprimer cette prestation ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-remove-sign"></i> Fermer</button>
                    <button type="button" class="btn btn-danger" id="removePrestationBtn"><i class="glyphicon glyphicon-ok-sign"></i> Supprimer</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="../Front-end/prestations/prestations.js"></script>
