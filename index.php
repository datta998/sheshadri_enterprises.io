<?php include("Config.php")?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="chrome=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Sheshadri Enterprises Price Management</title>
    <link rel="icon" href="Img/logo.png" type="image/icon type">
    <link rel="stylesheet" type="text/css" href="dist/css/jquery.dataTables.min.css">    
    <link rel="stylesheet" type="text/css" href="dist/css/dataTables.bootstrap5.min.css">
    <link  href="dist/css/mdb.min.css" rel="stylesheet"/>
    <link  href="dist/css/buttons.dataTables.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />

  </head>

<body>
   <header>
   <nav class="navbar navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand">
            <img src="Img/logo.png"
                 height="100"
                 alt="Logo"
                 loading="lazy" />
                 <h3>Sheshadri Enterprises Price Management</h3>
        </a>
    </div>
</nav>
<br/>
        <h4></h4>
   </header>
   <br/>
   <div style="text-align:right;">
    <button type="button" id="AddStockType" class="btn btn-primary btn-rounded" >
        <i class="fas fa-plus" style="padding-right: 5px;"></i>Add Quantity Type</button>
    <button type="button" id="AddProd" class="btn btn-primary btn-rounded" >
        <i class="fas fa-plus" style="padding-right: 5px;"></i>Add Product</button>
</div>
        <br/>
<table id="datatable">
            <thead>
                <tr>
                <th>SL.No</th>
                <th>Product Name</th>
                <th>WholeSale Price</th>
                <th>Retail Price</th>
                <th>Quantity</th>
                <th>Edit Product</th>
                <th>Delete Product</th>
            </tr>
            </thead>
            <tbody>
                <?php
                 $rowcount=0;
                    $query=mysqli_query($conn,"select p.*,s.StockName from products p,StockType s where isactive=1 and p.stocktype=s.Id order by p.updateddate desc;");
                    while($row=mysqli_fetch_array($query)){
                        $rowcount=$rowcount+1;
                        ?>
                        <tr>
                            <td><?php echo $rowcount ?></td>
                            <td><?php echo $row['Name']; ?></td>
                            <td><?php echo $row['WholeSalePrice']; ?></td>
                            <td><?php echo $row['RetailPrice']; ?></td>
                            <td><?php echo $row['Stock']; ?> (in <?php echo $row['StockName']; ?> )</td>
                            <td><a id="edit_<?php echo $row['Id']; ?>" onclick="editModal(<?php echo $row['Id']; ?>)" value="<?php echo $row['Id']; ?>" ><i class="far fa-edit fa-lg" style="color:#3b71ca"></i></a></td>
                            <td><a id="delete_<?php echo $row['Id']; ?>" onclick="deleteprod(<?php echo $row['Id']; ?>)" value="<?php echo $row['Id']; ?>"><i class="fas fa-trash fa-lg" style="color:#3b71ca"></i></a></td>
                        </tr>
                        <?php
                    }
                ?>
            </tbody>
        </table>
        
        <footer>
            
        </footer>
</body>
    <script src="dist/jquery/jquery.min.js"></script>
    <script type="text/javascript" charset="utf8" src="dist/jquery/jquery.dataTables.min.js"></script>
    <script src="dist/jquery/dataTables.buttons.min.js"></script>
    <script src="dist/jquery/buttons.html5.min.js"></script>
    <script src="dist/jquery/buttons.print.min.js"></script>

    <script type="text/javascript"  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.js"></script>
  
    <script>
        $('#datatable').dataTable({
          lengthMenu: [
            [10, 25, 50, 100,200,-1],
            [10, 25, 50, 100,200,'All'],
        ],
        "pageLength": 50,
        dom: 'frltip',
        //buttons: [
          //  'csv', 'print'
        //]
        })
       
        $( "#AddProd" ).click(function() {
			  $('#elegantModalForm').modal('show');
			  $('#addbutton').show();
        $('#updatebutton').hide();
        $("#form_edit").attr("id", "form_add");
        $("#action").val("add")

        $("#pid").val('')
            $("#productname").val('')
            $("#wholesaleprice").val('')
            $("#retailprice").val('')
            $("#stockquantity").val('')
            $("#stocktype").val('')

			});
        
      $("#AddStockType").click(function(){
        $('#elegantstockForm').modal('show');
      })
function closeprodmodal()
{
$('#elegantModalForm').modal('hide');
}
function closestockmodal()
{
$('#elegantstockForm').modal('hide');
}
function editModal(id){
        $('#elegantModalForm').modal('show');
			  $('#updatebutton').show();
        $('#addbutton').hide();
        $("#action").val("edit")
        $("#form_add").attr("id", "form_edit");
        $.ajax({
				  type: "POST",  
				  url: "fetch.php", 
          data: {id:id},
				  dataType: "json", 
				  success: function(response)  
				  {
            $("#pid").val(response[0].Id)
            $("#productname").val(response[0].Name)
            $("#wholesaleprice").val(response[0].WholeSalePrice)
            $("#retailprice").val(response[0].RetailPrice)
            $("#stockquantity").val(response[0].Stock)
            $("#stocktype").val(response[0].StockType)

          }
				});

}
    
function deleteprod(id)
{
  if(confirm("Are You Sure You Want To Delete The Product!")==true)
  {
  $.ajax({
				  type: "POST",  
				  url: "delete.php", 
          data: {id:id},
				  dataType: "json", 
				  success: function(response)  
				  {
				    alert("Product Deleted Successfully")
            window.location="index.php"	
          }
				});
      }
}
function ajaxAction(action) {
				data = $("#form_"+action).serializeArray();
				$.ajax({
				  type: "POST",  
				  url: "insert.php",  
				  data: data,
				  dataType: "json",       
				  success: function(response)  
				  {
				    alert("Product Updated Successfully")
            window.location="index.php"	
          }
				});
			}

      function ajaxstockAction() {
				data = $("#form_stock").serializeArray();
				$.ajax({
				  type: "POST",  
				  url: "stock.php",  
				  data: data,
				  dataType: "json",       
				  success: function(response)  
				  {
				    alert("Product Updated Successfully")
            window.location="index.php"	
          }
				});
			}

    </script>

</html>



<div class="modal fade" style="display:none;" id="elegantModalForm" tabindex="-1" aria-labelledby="myModalLabel" style="display: block; padding-right: 17px;" data-gtm-vis-first-on-screen-2340190_1302="29573" data-gtm-vis-total-visible-time-2340190_1302="100" data-gtm-vis-has-fired-2340190_1302="1" aria-modal="true" role="dialog">
    <div class="modal-dialog" role="document">
      <!--Content-->
      <div class="modal-content form-elegant">
        <!--Header-->
        <div class="modal-header text-center">
          <h3 class="modal-title w-100 dark-grey-text font-weight-bold my-3" id="myModalLabel"><strong>Product Details</strong></h3>
          <button type="button" class="close" onclick="closeprodmodal()" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <!--Body-->
        <div class="modal-body mx-4">
        <form id="form_add" action="insert.php">

          <!--Body-->
          <div class="md-form pb-3">
            <label data-error="wrong" data-success="right" for="pname" class="">Product Name</label>  
            <input type="text" id="productname" name="productname" class="form-control validate">
          </div>
          
				<input type="hidden" value="add" name="action" id="action">
        <input type="hidden" name="pid" id="pid">
          <div class="md-form pb-3">
            <label data-error="wrong" data-success="right" for="wprice">Wholesale Price</label>
            <input type="number" id="wholesaleprice" name="wholesaleprice" class="form-control validate">
           </div>
           <div class="md-form pb-3">
            <label data-error="wrong" data-success="right" for="rprice" class="">Retail Price</label>
            <input type="number" id="retailprice" name="retailprice" class="form-control validate">
          </div>
          <div class="md-form pb-3">
            <label data-error="wrong" data-success="right" for="squantity">Quantity</label>
            <input type="number" id="stockquantity" name="stockquantity" class="form-control validate">
           </div>
           <div class="md-form pb-3">
           <label data-error="wrong" data-success="right" for="stype">Quantity Type</label>
            <select id="stocktype" name="stocktype" class="form-control browser-default custom-select validate">
            <option selected disabled>Select Quantity Type</option>
            <?php
                    $query1=mysqli_query($conn,"select * from StockType;");
                    while($row1=mysqli_fetch_array($query1)){?>
                    <option value="<?php echo $row1['Id']?>"><?php echo $row1['StockName']?></option>
                    <?php } ?>
            </select>
           </div>
          <div class="text-center mb-3">
            <button type="button" onclick="ajaxAction('add')" id="addbutton" style="display:none;" class="btn btn-primary btn-block btn-rounded z-depth-1a waves-effect waves-light">Add Product</button>
            <button type="button" onclick="ajaxAction('edit')" id="updatebutton" style="display:none;" class="btn btn-primary btn-block btn-rounded z-depth-1a waves-effect waves-light">Update Product</button>

          </div>
        </form>
        </div>
        <!--Footer-->
        <div class="modal-footer mx-5 pt-3 mb-1">
        </div>
      </div>
      <!--/.Content-->
    </div>
  </div>




  
<div class="modal fade" style="display:none;" id="elegantstockForm" tabindex="-1" aria-labelledby="myModalLabel" style="display: block; padding-right: 17px;" data-gtm-vis-first-on-screen-2340190_1302="29573" data-gtm-vis-total-visible-time-2340190_1302="100" data-gtm-vis-has-fired-2340190_1302="1" aria-modal="true" role="dialog">
    <div class="modal-dialog" role="document">
      <!--Content-->
      <div class="modal-content form-elegant">
        <!--Header-->
        <div class="modal-header text-center">
          <h3 class="modal-title w-100 dark-grey-text font-weight-bold my-3" id="myModalLabel"><strong>Product Details</strong></h3>
          <button type="button" class="close" onclick="closeprodmodal()" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <!--Body-->
        <div class="modal-body mx-4">
        <form id="form_stock" action="stock.php">

          <!--Body-->
          <div class="md-form pb-3">
            <label data-error="wrong" data-success="right" for="pname" class="">Stock Name</label>  
            <input type="text" id="stockname" name="stockname" class="form-control validate">
          </div>
          
				  <div class="text-center mb-3">
            <button type="button" onclick="ajaxstockAction()" id="stockbutton" class="btn btn-primary btn-block btn-rounded z-depth-1a waves-effect waves-light">Add Stock Type</button>
          </div>
        </form>
        </div>
        <!--Footer-->
        <div class="modal-footer mx-5 pt-3 mb-1">
        </div>
      </div>
      <!--/.Content-->
    </div>
  </div>