<div class="header-top-area" >
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="logo-area">
                        <a href="#"><img src="img/logo/logo_v1.png" style="max-width: 48%;" alt="" /></a>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="header-top-menu">
                        <ul class="nav navbar-nav notika-top-nav">
                            <li class="nav-item dropdown">
                                <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><span><i class="notika-icon notika-search"></i></span></a>
                                <div role="menu" class="dropdown-menu search-dd animated flipInX">
                                    <div class="search-input">
                                        <i class="notika-icon notika-left-arrow"></i>
                                        <input type="text" />
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><span><i class="notika-icon notika-mail"></i></span></a>
                                <div role="menu" class="dropdown-menu message-dd animated zoomIn">
                                    <div class="hd-mg-tt">
                                        <h2>Messages</h2>
                                    </div>
                                    <div class="hd-message-info">
                                        <!-- <a href="#">
                                            <div class="hd-message-sn">
                                                <div class="hd-message-img">
                                                    <img src="img/post/1.jpg" alt="" />
                                                </div>
                                                <div class="hd-mg-ctn">
                                                    <h3>David Belle</h3>
                                                    <p>Cum sociis natoque penatibus et magnis dis parturient montes</p>
                                                </div>
                                            </div>
                                        </a> -->
                                    </div>
                                    <div class="hd-mg-va">
                                        <a href="#">View All</a>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item nc-al"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><span><i class="notika-icon notika-alarm"></i></span><div class="spinner4 spinner-4"></div><div class="ntd-ctn"><span>3</span></div></a>
                                <div role="menu" class="dropdown-menu message-dd notification-dd animated zoomIn">
                                    <div class="hd-mg-tt">
                                        <h2>Notification</h2>
                                    </div>
                                    <div class="hd-message-info">
                                        <!-- <a href="#">
                                            <div class="hd-message-sn">
                                                <div class="hd-message-img">
                                                    <img src="img/post/1.jpg" alt="" />
                                                </div>
                                                <div class="hd-mg-ctn">
                                                    <h3>David Belle</h3>
                                                    <p>Cum sociis natoque penatibus et magnis dis parturient montes</p>
                                                </div>
                                            </div>
                                        </a> -->
                                    </div>
                                    <div class="hd-mg-va">
                                        <a href="#">View All</a>
                                    </div>
                                </div>
                            </li>
                            <!-- <li class="nav-item"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><span><i class="notika-icon notika-menus"></i></span><div class="spinner4 spinner-4"></div><div class="ntd-ctn"><span>2</span></div></a>
                                <div role="menu" class="dropdown-menu message-dd task-dd animated zoomIn">
                                    <div class="hd-mg-tt">
                                        <h2>Tasks</h2>
                                    </div>
                                    <div class="hd-message-info hd-task-info">
                                        <div class="skill">
                                            <div class="progress">
                                                <div class="lead-content">
                                                    <p>HTML5 Validation Report</p>
                                                </div>
                                                <div class="progress-bar wow fadeInLeft" data-progress="95%" style="width: 95%;" data-wow-duration="1.5s" data-wow-delay="1.2s"> <span>95%</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="hd-mg-va">
                                        <a href="#">View All</a>
                                    </div>
                                </div>
                            </li> -->
                            <!-- <li class="nav-item"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><span><i class="notika-icon notika-chat"></i></span></a>
                                <div role="menu" class="dropdown-menu message-dd chat-dd animated zoomIn">
                                    <div class="hd-mg-tt">
                                        <h2>Chat</h2>
                                    </div>
                                    <div class="search-people">
                                        <i class="notika-icon notika-left-arrow"></i>
                                        <input type="text" placeholder="Search People" />
                                    </div>
                                    <div class="hd-message-info">
                                        <a href="#">
                                            <div class="hd-message-sn">
                                                <div class="hd-message-img chat-img">
                                                    <img src="img/post/1.jpg" alt="" />
                                                    <div class="chat-avaible"><i class="notika-icon notika-dot"></i></div>
                                                </div>
                                                <div class="hd-mg-ctn">
                                                    <h3>David Belle</h3>
                                                    <p>Available</p>
                                                </div>
                                            </div>
                                        </a>
                                       
                                    </div>
                                    <div class="hd-mg-va">
                                        <a href="#">View All</a>
                                    </div>
                                </div>
                            </li> -->
                            <li class="nav-item"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><span class="se_deconecter"><?php echo $_SESSION['nom'] .' '.  $_SESSION['prenom'] ?><span><?php echo ' '. $_SESSION['profil'] ?><span></span> </span></a>
                                <div role="menu" class="dropdown-menu message-dd chat-dd animated zoomIn" style ="left: 25px;" >
                                    
                                    <div class="hd-mg-va">
                                        <a href="../Controllers/se_deconnecter.php">Se déconnecter</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mobile-menu-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="mobile-menu">
                        <nav id="dropdown">
                            <ul class="mobile-menu-nav">
                                <li><a data-toggle="collapse" data-target="#Client_m" href="#">Clients</a>
                                    <ul id="Client_m" class="collapse dropdown-header-top">
                                        <li><a href="index.php?page_name=Personne_Morale&page=Client_id">Personne Morale</a></li>
                                        <li><a href="index.php?page_name=Personne_Physique&page=Client_id">Personne Physique</a></li>
                                        <!-- <li><a href="index.php?page_name=Personne_Individuelle&page=Client_id">Personne Individuelle</a></li> -->
                                        <li id="Repertoire_Client00" ><a href="index.php?page_name=list_client&page=Client_id">Répertoire Client</a></li>
                                    </ul>
                                </li>
                            
                                <li><a data-toggle="collapse" id="Devis_head" data-target="#Devis_m" href="#">Devis et Facturation</a>
                                    <ul id="Devis_m" class="collapse dropdown-header-top">
                                        <li><a href="index.php?page_name=devis_creation&page=Devis_client_id&De_Fa=Devis">Création Devis</a></li>
                                        <li><a href="index.php?page_name=devis_creation&page=Devis_client_id&De_Fa=Facture">Création Facture</a></li>
                                        <li><a href="index.php?page_name=tous_les_devis&page=Devis_client_id&De_Fa=Devis">Tous les devis</a></li>
                                        <li><a href="index.php?page_name=toutes_les_factures&page=Devis_client_id&De_Fa=Facture">Toutes les factures</a></li>
                                        <!-- <li><a href="index.php?page_name=tous_les_paiements&page=Devis_client_id&De_Fa=Facture">Tous les paiements</a></li> -->

                                    </ul>
                                </li>
                                <li><a data-toggle="collapse" id="Agenda_head" data-target="#Agenda_m" href="#">Événements</a>
                                    <ul id="Agenda_m" class="collapse dropdown-header-top">
                                        <li><a  href="index.php?page_name=Agenda&page=Agenda_id">Agenda</a></li>
                                    </ul>
                                </li>
                                <li><a data-toggle="collapse" id="paiement_head" data-target="#paiement_m" href="#">Paiements</a>
                                        <ul id="paiement_m" class="collapse dropdown-header-top">
                                            <li><a href="index.php?page_name=tous_les_paiements&page=paiement_id&De_Fa=Facture">Tous les paiements</a></li>
                                        </ul>
                                </li>
                                <li><a data-toggle="collapse" id="Rapports_head" data-target="#Rapports_m" href="#">Suivi</a>
                                    <ul id="Rapports_m" class="collapse dropdown-header-top">
                                        <li><a  href="index.php?page_name=ChiffreDaffaires&page=Rapports_id">Chiffre d'affaires</a></li>
                                    </ul>
                                </li>

                                <li><a data-toggle="collapse" id="RapportsCal_head" data-target="#RapportsCal_m" href="#">Rapports</a>
                                    <ul id="RapportsCal_m" class="collapse dropdown-header-top">
                                    <li><a  href="index.php?page_name=bilanGenerale&page=RapportsCal_id">Bilan Générale</a></li>
                                    <li><a  href="index.php?page_name=rapportParPrestation&page=RapportsCal_id">Rapport Des Prestations</a></li>
                                    <li><a  href="index.php?page_name=ChiffreDaffaireParPersonnel&page=RapportsCal_id">Chiffre D'affaires Par Employé</a></li>

                                    </ul>
                                </li>

                                <li><a data-toggle="collapse" id="RapportsCal_head" data-target="#Stocks_m" href="#">Stocks</a>
                                    <ul id="Stocks_m" class="collapse dropdown-header-top">
                                    <li><a  href="index.php?page_name=Produits&page=Stocks_id">Produits</a></li>
                                    <!-- <li><a  href="index.php?page_name=rapportParPrestation&page=RapportsCal_id">Rapport Des Prestations</a></li>
                                    <li><a  href="index.php?page_name=ChiffreDaffaireParPersonnel&page=RapportsCal_id">Chiffre D'affaires Par Employé</a></li> -->

                                    </ul>
                                </li>
                                <li><a data-toggle="collapse" id="Devis_head" data-target="#Prestations_m" href="#">Administration</a>
                                    <ul id="Prestations_m" class="collapse dropdown-header-top">
                                        <li><a href="index.php?page_name=Prestations&page=Prestations_id">Prestations</a></li>
                                        <!-- <li><a href="index.php?page_name=tous_les_paiements&page=Devis_client_id&De_Fa=Facture">Tous les paiements</a></li> -->

                                    </ul>
                                </li>
                           
                               ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Mobile Menu end -->
    <!-- Main Menu area start-->
    <div class="main-menu-area mg-tb-40">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <ul class="nav nav-tabs notika-menu-wrap menu-it-icon-pro" id="all_menu_id">
                        <li id="Client_id" ><a data-toggle="tab" href="#Client"><i class="notika-icon notika-edit"></i> Clients</a>
                        </li>
                        <li id="Devis_client_id" ><a data-toggle="tab" href="#Devis"><i class="notika-icon notika-form"></i>Devis et Facturation</a>
                        </li>
                        <li id="Agenda_id" ><a data-toggle="tab" href="#Agenda"><i class="notika-icon notika-windows"></i>Événements</a>
                        </li>
                        <li id="paiement_id" ><a data-toggle="tab" href="#paiement"><i class="notika-icon notika-windows"></i>Paiements</a>
                        </li>
                        <li id="Rapports_id" ><a data-toggle="tab" href="#Rapports"><i class="notika-icon notika-bar-chart"></i>Suivi</a>
                        </li>
                        <li id="RapportsCal_id"  ><a data-toggle="tab" href="#RapportsCal"><i class="notika-icon notika-bar-chart"></i> Rapports</a>  
                        </li>
                        <li id="Stocks_id"  ><a data-toggle="tab" href="#Stocks"><i class="notika-icon notika-app"></i> Stocks</a>
                        </li>
                        <li id="Prestations_id" ><a data-toggle="tab" href="#Prestations"><i class="notika-icon notika-form"></i>Administration</a>
                        </li>
                                          </ul>
                    <div class="tab-content custom-menu-content">
                        <div id="Client" class="tab-pane in active notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                                <li><a href="index.php?page_name=Personne_Morale&page=Client_id">Personne Morale</a></li>
                                <li><a href="index.php?page_name=Personne_Physique&page=Client_id">Personne Physique</a></li>
                                <!-- <li><a href="index.php?page_name=Personne_Individuelle&page=Client_id">Personne Individuelle</a></li> -->
                                <li id="Repertoire_Client"><a href="index.php?page_name=list_client&page=Client_id">Répertoire Client</a></li>
                            </ul>
                        </div>
                       
                        <div id="Devis" class="tab-pane notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                                <li><a href="index.php?page_name=devis_creation&page=Devis_client_id&De_Fa=Devis">Création Devis</a>
                                <li><a href="index.php?page_name=devis_creation&page=Devis_client_id&De_Fa=Facture">Création Facture</a></li>
                                <li><a href="index.php?page_name=tous_les_devis&page=Devis_client_id&De_Fa=Devis">Tous les devis</a></li>
                                <li><a href="index.php?page_name=toutes_les_factures&page=Devis_client_id&De_Fa=Facture">Toutes les factures</a></li>
                                                          </ul>
                        </div>
                        <div id="Agenda" class="tab-pane notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                                <li><a href="index.php?page_name=Agenda&page=Agenda_id">Agenda</a>
                               </ul>
                        </div>
                        <div id="paiement" class="tab-pane notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                                <li><a href="index.php?page_name=tous_les_paiements&page=paiement_id&De_Fa=Facture">Tous les paiements</a></li>
                                
                            </ul>
                        </div>
                        <div id="Rapports" class="tab-pane notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                                <li><a href="index.php?page_name=ChiffreDaffaires&page=Rapports_id">Chiffre d'affaires</a>
                            </ul>
                        </div>


                        <div id="RapportsCal" class="tab-pane notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                            <li><a  href="index.php?page_name=bilanGenerale&page=RapportsCal_id">Bilan Générale</a></li>
                            <li><a  href="index.php?page_name=rapportParPrestation&page=RapportsCal_id">Rapport Des Prestations</a></li>
                            <li><a  href="index.php?page_name=ChiffreDaffaireParPersonnel&page=RapportsCal_id">Chiffre D'affaires Par Employé</a></li>

                        
                            </ul>
                        </div>



                        <div id="Stocks" class="tab-pane notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                            <li><a  href="index.php?page_name=Produits&page=Stocks_id">Produits</a></li>
                            <li><a  href="index.php?page_name=fournisseur_creation&page=Fournisseur_id">Founisseur</a></li>

                           
                            </ul>
                        </div>
                        <div id="Prestations" class="tab-pane notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                                <li><a href="index.php?page_name=Prestations&page=Prestations_id">Prestations</a></li>
                            </ul>
                        </div>
                      
                        <!-- <div id="Charts" class="tab-pane notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                                <li><a href="flot-charts.html">Flot Charts</a>
                                </li>
                                <li><a href="bar-charts.html">Bar Charts</a>
                                </li>
                                <li><a href="line-charts.html">Line Charts</a>
                                </li>
                                <li><a href="area-charts.html">Area Charts</a>
                                </li>
                            </ul>
                        </div> -->
                        <!-- <div id="Tables" class="tab-pane notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                                <li><a href="normal-table.html">Normal Table</a>
                                </li>
                                <li><a href="data-table.html">Data Table</a>
                                </li>
                            </ul>
                        </div> -->
                        <!-- <div id="Forms" class="tab-pane notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                                <li><a href="form-elements.html">Form Elements</a>
                                </li>
                                <li><a href="form-components.html">Form Components</a>
                                </li>
                                <li><a href="form-examples.html">Form Examples</a>
                                </li>
                            </ul>
                        </div> -->
                        <!-- <div id="Appviews" class="tab-pane notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                                <li><a href="notification.html">Notifications</a>
                                </li>
                                <li><a href="alert.html">Alerts</a>
                                </li>
                                <li><a href="modals.html">Modals</a>
                                </li>
                                <li><a href="buttons.html">Buttons</a>
                                </li>
                                <li><a href="tabs.html">Tabs</a>
                                </li>
                                <li><a href="accordion.html">Accordion</a>
                                </li>
                                <li><a href="dialog.html">Dialogs</a>
                                </li>
                                <li><a href="popovers.html">Popovers</a>
                                </li>
                                <li><a href="tooltips.html">Tooltips</a>
                                </li>
                                <li><a href="dropdown.html">Dropdowns</a>
                                </li>
                            </ul>
                        </div> -->
                        <!-- <div id="Page" class="tab-pane notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                                <li><a href="contact.html">Contact</a>
                                </li>
                                <li><a href="invoice.html">Invoice</a>
                                </li>
                                <li><a href="typography.html">Typography</a>
                                </li>
                                <li><a href="color.html">Color</a>
                                </li>
                                <li><a href="login-register.html">Login Register</a>
                                </li>
                                <li><a href="404.html">404 Page</a>
                                </li>
                            </ul>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Main Menu area End-->


    <script>
       
          var profile = "<?php echo $_SESSION['profil']; ?>";
          console.log(profile);


          if (profile == 'Administrateur system') {
            
            $('#Prestations').remove();
            $('#Prestations_m').remove();
            $('#Prestations_id').remove();

          }
         
          if(profile == 'Responsable')
          {
              $('#Rapports').remove();
              $('#Rapports_m').remove();
              $('#Rapports_id').remove();


              $('#RapportsCal').remove();
              $('#RapportsCal_head').remove();
              $('#RapportsCal_id').remove();

              
              $('#paiement').remove();
              $('#paiement_head').remove();
              $('#paiement_id').remove();


              $('#Stocks').remove();
              $('#Stocks_head').remove();
              $('#Stocks_client_id').remove();


          }
          if(profile == 'Gestionnaire client')
          {
              $('#Devis').remove();
              $('#Devis_head').remove();
              $('#Devis_client_id').remove();


              $('#Agenda').remove();
              $('#Agenda_head').remove();
              $('#Agenda_id').remove();

              $('#Rapports').remove();
              $('#Rapports_head').remove();
              $('#Rapports_id').remove();

              $('#RapportsCal').remove();
              $('#RapportsCal_head').remove();
              $('#RapportsCal_id').remove();

              


              $('#paiement').remove();
              $('#paiement_head').remove();
              $('#paiement_id').remove();

              $('#Stocks').remove();
              $('#Stocks_head').remove();
              $('#Stocks_client_id').remove();


              $('#Repertoire_Client01').remove();
          
          }

   


          if(profile == 'Responsable  Caisse')
          {

              $('#Client_m').remove();
              $('#Client_head').remove();
              $('#Client_id').remove();

              $('#Devis').remove();
              $('#Devis_head').remove();
              $('#Devis_client_id').remove();


              $('#Agenda').remove();
              $('#Agenda_head').remove();
              $('#Agenda_id').remove();

              $('#Rapports').remove();
              $('#Rapports_head').remove();
              $('#Rapports_id').remove();

              $('#RapportsCal').remove();
              $('#RapportsCal_head').remove();
              $('#RapportsCal_id').remove();

              $('#Stocks').remove();
              $('#Stocks_head').remove();
              $('#Stocks_client_id').remove();



              $('#Repertoire_Client01').remove();
          
          }

          
          if(profile== 'Responsable stock')
          {
              $('#Client').remove();
              $('#Client_m').remove();
              $('#Client_head').remove();
              $('#Client_id').remove();

              $('#Devis').remove();
              $('#Devis_head').remove();
              $('#Devis_client_id').remove();


              $('#Agenda').remove();
              $('#Agenda_head').remove();
              $('#Agenda_id').remove();

              $('#Rapports').remove();
              $('#Rapports_head').remove();
              $('#Rapports_id').remove();

              $('#RapportsCal').remove();
              $('#RapportsCal_head').remove();
              $('#RapportsCal_id').remove();


              $('#paiement').remove();
              $('#paiement_head').remove();
              $('#paiement_id').remove();

            
              $('#Repertoire_Client01').remove();

              $('#Stocks').addClass('active');
              $('#Stocks_id').addClass('active');
          }


    </script>