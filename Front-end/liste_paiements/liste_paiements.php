<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, minimum-scale=1.0, user-scalable=yes">

<div class="container" id="etape_2" style="text-align: center;">

             
    <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="data-table-list">
                    <div class="basic-tb-hd">
                        <h2>Listes des paiements<?php ?></h2>
                        <p>
                    </p>
                    </div>
                    <div class="table-responsive ">
                        <table id="data-table-basic" class="table table-striped data_table_custom">
                        <?php  include '../Controllers/list_paiements.php' ; ?>
                        </table>
                    </div>
                </div>
            </div>
    </div>
    <div class="modal fade" id="myModalone" role="dialog"  >
        <div class="modal-dialog modals-default">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <h2 style="    border-bottom: 1px solid #dddddd;">Veuillez confirmer la validation du paiement ! <span id="title_event_00"> </span></h2>
                    <br/>
                    <div class="form-group ic-cmp-int">
                                            <div class="form-ic-cmp">
                                                <i class="notika-icon notika-edit"></i>
                                            </div>
                                            <div class="nk-int-st">
                                            <textarea class="form-control commentaire" name="Prestation" placeholder="*Commentaire"  >
                                            </textarea>
                                                <!-- <input type="textarea" class="form-control" name="Nom_societe" placeholder="*Prestation" > -->
                                            </div>
                                        </div>
                </div>
                <div class="modal-footer" style="display: flex; justify-content: center;">
                    <button class="btn btn-info waves-effect confirmer_b" id = "" onclick="confirmer_paiement(this);" >Payé</button> </td>
                    <button class="btn btn-warning waves-effect confirmer_b" id = "" onclick="en_attente_paiement(this);" >En attente</button> </td>
                    <button class="btn btn-danger waves-effect confirmer_b" id = "" onclick="refuser_paiement(this);" >Impayé</button> </td>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="myModalone_2" role="dialog"  >
        <div class="modal-dialog modal-large">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <iframe class="_iframe" style=" min-height: 500px;  width: 100%;  zoom: 100%;" src="" ></iframe>
                </div>
                <div class="modal-footer" style="display: flex; justify-content: center;">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>

</div>
<script src="../Front-end/liste_paiements/liste_paiements.js"></script> 

