<?php require_once '../Controllers/connection_database.php' ?>
<div class="container" id="etape_2" style="text-align: center; padding-top: 5px;   
">  

<!-- padding-right: 22px; padding-top: 5px;padding-left: 22px; -->

<div class="row">
	<div class="col-md-12">

		<!-- <ol class="breadcrumb">
		  <li><a href="dashboard.php">Home</a></li>		  
		  <li class="active">Product</li>
		</ol> -->

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Gestion du produits</div>
			</div> <!-- /panel-heading -->
			<div class="panel-body">

				<div class="remove-messages"></div>

				<?php  include '../Controllers/stockInfo.php' ; ?>


				<div class="div-action pull pull-right" style="padding-bottom:20px;">
					<button class="btn btn-default button1" data-toggle="modal" id="addProductModalBtn" data-target="#addProductModal"> <i class="glyphicon glyphicon-plus-sign"></i> Ajouter un produit </button>
				</div> <!-- /div-action -->	
					
				<div class="table-responsive " style="    margin-top: 62px;">
				<table class="table table-striped data_table_custom"  id="manageProductTable" style="float: left;  margin-top: 18px !important; ">
					<thead>
						<tr>
							<th style="width:10%;">Photo</th>							
							<th>Nom du produit</th>
							<th>Description</th>
                            <th>Quantity initial</th>					
							<th>Quantité</th>
                            <th>Prix</th>		
							<th>Société</th>
							<th>Catégorie</th>
							<th>Statut</th>
							<th style="width:15%;">Options</th>
						</tr>
					</thead>
				</table>
				</div>
				<!-- /table -->

			</div> <!-- /panel-body -->
		</div> <!-- /panel -->		
	</div> <!-- /col-md-12 -->
</div> <!-- /row -->

<!-- add product -->
<div class="modal fade" id="addProductModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">

    	<form class="form-horizontal" id="submitProductForm" action="../Controllers/createProduct.php" method="POST" enctype="multipart/form-data">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-plus"></i> Add Product</h4>
	      </div>

	      <div class="modal-body" style="max-height:450px; overflow:auto;">

	      	<div id="add-product-messages"></div>

	      	<div class="form-group">
	        	<label for="productImage" class="col-sm-3 control-label">Image du produit: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
					    <!-- the avatar markup -->
							<div id="kv-avatar-errors-1" class="center-block" style="display:none;"></div>							
					    <div class="kv-avatar center-block">					        
					        <input type="file" class="form-control" id="productImage" placeholder="Image du produit" name="productImage" class="file-loading" style="width:auto;"/>
					    </div>
				      
				    </div>
	        </div> <!-- /form-group-->	     	           	       

	        <div class="form-group">
	        	<label for="productName" class="col-sm-3 control-label">Nom du produit: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="productName" placeholder="Nom du produit" name="productName" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->	 
			<div class="form-group">
				<label for="Description" class="col-sm-3 control-label">Description :</label>
				<label class="col-sm-1 control-label">: </label>
				<div class="col-sm-8">
                	<textarea class="form-control" id="Description" name="Description" placeholder="Description" rows="4" style="resize: vertical; max-height: 200px;"></textarea>
                </div>
			</div>   


            <div class="form-group">
	        	<label for="quantity" class="col-sm-3 control-label">Quantité initial : </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="quantity_initial" placeholder="quantity initial" name="quantity_initial" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->	        	 


	        <div class="form-group">
	        	<label for="quantity" class="col-sm-3 control-label">Quantité : </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="quantity" placeholder="Quantité" name="quantity" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->	        	 

	        <div class="form-group">
	        	<label for="rate" class="col-sm-3 control-label">Prix: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="rate" placeholder="Prix" name="rate" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->	     	   
			
			
			<div class="form-group">
	        	<label for="SocieteName" class="col-sm-3 control-label">Société : </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <select type="text" class="form-control" id="SocieteName" placeholder="Société" name="SocieteName" >
				      	<option value="">~~SELECT~~</option>
                          <?php 
                                    $sql = "SELECT id_societe, societe_name  FROM societes";
                                    $stmt = $conn->query($sql);  // Use query() method for executing the SQL
                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { // fetch() is used instead of fetch_array()
                                        echo "<option value='".$row['id_societe']."'>".$row['societe_name']."</option>";
                                    } 
                                ?>
				      </select>
				    </div>
	        </div> <!-- /form-group-->		


	        <div class="form-group">
	        	<label for="categoryName" class="col-sm-3 control-label">Catégorie : </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <select type="text" class="form-control" id="categoryName" placeholder="Catégorie" name="categoryName" >
				      	<option value="">~~SELECT~~</option>
                          <?php 
                                    $sql = "SELECT categories_id, categories_name, categories_active, categories_status FROM categories WHERE categories_status = 1 AND categories_active = 1";
                                    $stmt = $conn->query($sql);  // Use query() method for executing the SQL
                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { // fetch() is used instead of fetch_array()
                                        echo "<option value='".$row['categories_id']."'>".$row['categories_name']."</option>";
                                    } 
                                ?>
				      </select>
				    </div>
	        </div> <!-- /form-group-->					        	         	       

	        <div class="form-group">
	        	<label for="productStatus" class="col-sm-3 control-label">Status: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <select class="form-control" id="productStatus" name="productStatus">
				      	<option value="">~~SELECT~~</option>
				      	<option value="1">Disponible</option>
				      	<option value="2">Non disponible</option>
				      </select>
				    </div>
	        </div> <!-- /form-group-->	         	        
	      </div> <!-- /modal-body -->
	      
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
	        
	        <button type="submit" class="btn btn-primary" id="createProductBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
	      </div> <!-- /modal-footer -->	      
     	</form> <!-- /.form -->	     
    </div> <!-- /modal-content -->    
  </div> <!-- /modal-dailog -->
</div> 
<!-- /add categories -->


<!-- edit categories brand -->
<div class="modal fade" id="editProductModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	    	
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-edit"></i> Modifier le produit</h4>
	      </div>
	      <div class="modal-body" style="max-height:450px; overflow:auto;">

	      	<div class="div-loading">
	      		<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
						<span class="sr-only">Loading...</span>
	      	</div>

	      	<div class="div-result">

				  <!-- Nav tabs -->
				  <ul class="nav nav-tabs" role="tablist">
				    <li role="presentation" class="active"><a href="#photo" aria-controls="home" role="tab" data-toggle="tab">Photo</a></li>
				    <li role="presentation"><a href="#productInfo" aria-controls="profile" role="tab" data-toggle="tab">Produit Info</a></li>    
				  </ul>

				  <!-- Tab panes -->
				  <div class="tab-content">

				  	
				    <div role="tabpanel" class="tab-pane active" id="photo">
				    	<form action="../Controllers/editProductImage.php" method="POST" id="updateProductImageForm" class="form-horizontal" enctype="multipart/form-data">

				    	<br />
				    	<div id="edit-productPhoto-messages"></div>

				    	<div class="form-group">
			        	<label for="editProductImage" class="col-sm-3 control-label">Image du produit : </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">							    				   
						      <img src="" id="getProductImage" class="thumbnail" style="width:250px; height:250px;" />
						    </div>
			        </div> <!-- /form-group-->	     	           	       
<!-- 				    	
			      	<div class="form-group">
			        	<label for="editProductImage" class="col-sm-3 control-label">Select Photo: </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
							    
									<div id="kv-avatar-errors-1" class="center-block" style="display:none;"></div>							
							    <div class="kv-avatar center-block">					        
							        <input type="file" class="form-control" id="editProductImage" placeholder="Product Name" name="editProductImage" class="file-loading" style="width:auto;"/>
							    </div>
						      
						    </div>
			        </div>     	           	        -->

			        <div class="modal-footer editProductPhotoFooter">
				        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
				        
				        <!-- <button type="submit" class="btn btn-success" id="editProductImageBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button> -->
				      </div>
				      <!-- /modal-footer -->
				      </form>
				      <!-- /form -->
				    </div>
				    <!-- product image -->
				    <div role="tabpanel" class="tab-pane" id="productInfo">
				    	<form class="form-horizontal" id="editProductForm" action="../Controllers/editProduct.php" method="POST">				    
				    	<br />

				    	<div id="edit-product-messages"></div>

				    	<div class="form-group">
			        	<label for="editProductName" class="col-sm-3 control-label">Nom du produit : </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <input type="text" class="form-control" id="editProductName" placeholder="Nom du produit" name="editProductName" autocomplete="off">
						    </div>
			        </div> <!-- /form-group-->	   
					<div class="form-group">
			        	<label for="editdescription" class="col-sm-3 control-label">Nom du produit : </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <textarea class="form-control" id="editdescription" name="editdescription" placeholder="description" rows="4" style="resize: vertical; max-height: 200px;"></textarea>
							</div>
			        </div> <!-- /form-group-->	  

                    <div class="form-group">
                        <label for="quantity" class="col-sm-3 control-label">Quantité initial : </label>
                        <label class="col-sm-1 control-label">: </label>
                            <div class="col-sm-8">
                            <input type="text" class="form-control" id="editQuantity_initial" placeholder="quantity initial" name="editQuantity_initial" autocomplete="off">
                            </div>
                    </div> <!-- /form-group-->	   

			        <div class="form-group">
			        	<label for="editQuantity" class="col-sm-3 control-label">Quantité : </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <input type="text" class="form-control" id="editQuantity" placeholder="Quantity" name="editQuantity" autocomplete="off">
						    </div>
			        </div> <!-- /form-group-->	        	 

			        <div class="form-group">
			        	<label for="editRate" class="col-sm-3 control-label">Prix : </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <input type="text" class="form-control" id="editRate" placeholder="Prix" name="editRate" autocomplete="off">
						    </div>
			        </div> <!-- /form-group-->	     
					
			<div class="form-group">
	        	<label for="SocieteName" class="col-sm-3 control-label">Société : </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <select type="text" class="form-control" id="SocieteName" placeholder="Société" name="SocieteName" >
				      	<option value="">~~SELECT~~</option>
                          <?php 
                                    $sql = "SELECT id_societe, societe_name  FROM societes";
                                    $stmt = $conn->query($sql);  // Use query() method for executing the SQL
                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { // fetch() is used instead of fetch_array()
                                        echo "<option value='".$row['id_societe']."'>".$row['societe_name']."</option>";
                                    } 
                                ?>
				      </select>
				    </div>
	        </div> <!-- /form-group-->		

			    

                    
			        <div class="form-group">
			        	<label for="editCategoryName" class="col-sm-3 control-label">Catégorie : </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <select type="text" class="form-control" id="editCategoryName" name="editCategoryName" >
						      	<option value="">~~SELECT~~</option>
						      	<?php 
                                    $sql = "SELECT categories_id, categories_name, categories_active, categories_status FROM categories WHERE categories_status = 1 AND categories_active = 1";
                                    $stmt = $conn->query($sql);  // Use query() method for executing the SQL
                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { // fetch() is used instead of fetch_array()
                                        echo "<option value='".$row['categories_id']."'>".$row['categories_name']."</option>";
                                    } 
                                ?>
						      </select>
						    </div>
			        </div> <!-- /form-group-->					        	         	       

			        <div class="form-group">
			        	<label for="editProductStatus" class="col-sm-3 control-label">Statut: </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <select class="form-control" id="editProductStatus" name="editProductStatus">
						      	<option value="">~~SELECT~~</option>
						      	<option value="1">Disponible</option>
						      	<option value="2">Non disponible</option>
						      </select>
						    </div>
			        </div> <!-- /form-group-->	         	        

			        <div class="modal-footer editProductFooter">
				        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
				        
				        <button type="submit" class="btn btn-success" id="editProductBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
				      </div> <!-- /modal-footer -->				     
			        </form> <!-- /.form -->				     	
				    </div>    
				    <!-- /product info -->
				  </div>

				</div>
	      	
	      </div> <!-- /modal-body -->
	      	      
     	
    </div>
    <!-- /modal-content -->
  </div>
  <!-- /modal-dailog -->
</div>
<!-- /categories brand -->

<!-- categories brand -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeProductModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Supprimer le produit</h4>
      </div>
      <div class="modal-body">

      	<div class="removeProductMessages"></div>

        <p>Voulez-vous vraiment supprimer ?</p>
      </div>
      <div class="modal-footer removeProductFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
        <button type="button" class="btn btn-danger" id="removeProductBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Supprimer</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /categories brand -->
</div>

<script src="../Front-end/produits/produits.js"></script>

