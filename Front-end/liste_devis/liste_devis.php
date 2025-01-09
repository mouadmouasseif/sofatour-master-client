
<div class="container" id="etape_2" style="text-align: center;">

             
<div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="data-table-list">
                <div class="basic-tb-hd">
                    <h2>Listes des <?php echo "Devis" ?></h2>
                    <p>
                    Vous pouvez confirmer un devis ou voir l'aperçu d'un devis.
                </p>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <div class="form-group ic-cmp-int">
                            <div class="form-ic-cmp">
                                <i class="notika-icon notika-edit"></i>
                            </div>
                            <div class="nk-int-st">
                            <select class="dropdown_custom"  name="filter_devis" id='filter_devis_01' onchange="changeValueOfFilterDevis(this)" >
                                <option value="0">*Toutes Les Devis ...</option>
                                <option value="1">Les Devis Annuler</option>
                                    <!-- } -->
                               
                                    
                            </select>              
                                                            
                                <!-- <input type="textarea" class="form-control" name="Nom_societe" placeholder="*Prestation" > -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive ">
                    <table id="data-table-basic" class="table table-striped data_table_custom">
                    <?php  include '../Controllers/list_devis.php' ; ?>
                    </table>
                </div>
            </div>
        </div>
</div>


                                <div class="modal fade" id="myModalone" role="dialog"  >
                                    <div class="modal-dialog modals-default">
                                        <div class="modal-content customModelPadding-paiement-creation">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- <h2>Société : <span id="title_event_00"> </span></h2>
                                                <p><span id="du_event_00" class="date_agenda01"> </span> <span style="font-weight: 900; font-size: larger;" > >> </span><span id="a_tel_event_00"  class="date_agenda02"></span></p>
                                                <p>Detail Événements : <span id="det_event_00" class="date_agenda01"> </span></p>
                                                <p>créé par : <span id="creer_par_event_00" style="    font-weight: 700;"> </span>  </p> -->
                                                
                                                <?php  include '../Front-end/paiement_creation/paiement_creation.php' ; ?>
                                            </div>
                                            <div class="modal-footer">
                                            <!-- <button class="btn btn-info waves-effect confirmer_b" id = "" onclick="confirmer_devis(this);" >Confirmer</button> </td>
                                            <button class="btn btn-danger waves-effect annuler_b" id = "" onclick="annuler_devis(this);" >Annuler</button> </td>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>


<script src="../Front-end/liste_devis/liste_devis.js"></script> 

</div>

