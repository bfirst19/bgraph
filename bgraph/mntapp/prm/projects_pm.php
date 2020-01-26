<?php include '../doc/header.php'; ?>



<div style="background-color: rgba(0, 0, 255, .1)">
	<h6 align="left">Project List</h6>
</div>
<table id="projects_table_id" class="table table-striped table-bordered"
	style="width: 100%">
</table>

<div class="modal fade" id="altViewer-modal" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="calendarModalLabel">Project Details</h5>

				<div>
					<button class="btn btn-info btn-sm mr-1 " type="button"
						data-dismiss="modal" aria-label="Close">
						<i class="fas fa-window-close"></i>
					</button>
				</div>

			</div>
			<div class="modal-body">
				<p></p>
			</div>
			<div class="modal-footer"></div>
		</div>
	</div>
</div>

<?php include '../doc/footer.php'; ?>

<script type="text/javascript">

var columnDefs = [{
    title: "",
    id:"",
    type:"hidden"
  }, {
    title: "Id",
    name:"id",
    type: "hidden"    
  }, {
    title: "Number",
    name:"number",
    type: "readonly"   
  }, {
	    title: "Name",
	    name:"name"  
	},
	{
	    title: "Description",
	    name:"description"  
	},
	{
		    title: "Start Date",
		    name:"start_date",
		    type:"date"
	},
	{
	    title: "End Date",
	    name:"end_date",
	    type:"date"
	},
	{
	    title: "Manager",
	    name:"Manager"  
	},
	{
	    title: "Customer",
	    name:"customer_name"  
	}];
                    
$(document).ready( function() {
	 var table = $('#projects_table_id').DataTable({		  
		 "dom": '<"dt-buttons"lr><"clear">fBtip',
		  "responsive": true,
          "processing": true,
          "serverSide": false,
          select: 'single',
          altEditor: true,
          "ajax": {
              url: "./queryProjects", // json datasource
              //data: {action: 'getEMP'},  Set the POST variable  array and adds action: getEMP
              type: 'post',  // method  , by default get
          },
          columns:columnDefs,
          columnDefs: [ {
              orderable: false,
              className: 'select-checkbox',
              targets:   0
          }, {              
              targets:   1,
              visible:false
          } ],
          
          order: [[ 1, 'asc' ]],
          buttons: [{
        	  className: 'btn-success btn-sm mr-1',
              text: "<i class='fas fa-plus-info'>View</i>",
              action: function ( e, dt, node, config ) {
   	        	 e.preventDefault();
   	        	var row = dt.rows( { selected: true } ).data();     	        		        	
   	        	//return '<a class="btn btn-info btn-sm dt-view" href=./complete?id=' + row[0][1] + '>' + 'View' + '</a>';
   	        	openDetailsModal(row);
   	        },
              name: 'view'        
          }
          ],//,"copy","excel","pdf",""print"],
          onAddRow: function(datatable, rowdata, success, error) {
        	  console.log(rowdata);              
        	  $.ajax({
      			type: "POST",
      			url: "./createProject",				
      			data: rowdata,
      			success: function(resp){ 
      				var table = $('#projects_table_id').DataTable();				
    				table.ajax.reload();  
    				 $(datatable.modal_selector).modal('hide');					
      				/*swal({
      					  title: "Success",
      					  text: resp,
      					  icon: "success",
      					});			*/	
                   
      			},
      			error: error
      		});
              
          },
          onDeleteRow: function(datatable, rowdata, success, error) {         	  
        	  swal({
        		  title: "Are you sure?",
        		  text: "Are you sure want to delete the Project?",
        		  icon: "warning",
        		  buttons: true,
        		  dangerMode: true,
        		})
        		.then((willDelete) => {            		
        		  if (willDelete) {
        			  $.ajax({
     	                 type:'POST',
     	                 url:'./deleteProject',
     	                 data:rowdata,
     	                 success: success,
     	        		 error: error	        		

     	                 });	
        		  } else {
        		    swal("Project not deleted");
        		  }
        		});
      		     
        	  
          },
          onEditRow: function(datatable, rowdata, success, error) {
        	  $.ajax({
        			type: "POST",
        			url: "./editProject",				
        			data: rowdata,
        			success: function(resp){   	
        				var table = $('#projects_table_id').DataTable();				
        				table.ajax.reload();	
        				 $(datatable.modal_selector).modal('hide');			
        				/*swal({
        					  title: "Success",
        					  text: resp,
        					  icon: "success",
        					});		*/		
                     
        			},
        			error: error
        		});
          }
		    
		});

		function openDetailsModal(row){
			//var table = $('#projects_table_id').DataTable();
			var columnDefs = table.init().columns;

			var dt = table;
			var adata = dt.rows({
				selected : true
			});
			
			 var data = "";

				data += "<form name='altEditor-form' role='form'>";
				for (j = 0; j < columnDefs.length; j++) {
					if (columnDefs[j].type && columnDefs[j].type
							.indexOf("hidden") >= 0) {
						data += "<input type='hidden' id='"
								+ columnDefs[j].title
								+ "' value='"
								+ adata.data()[0][j]
								+ "'></input>";
					} else {
						data += "<div style='margin-left: initial;margin-right: initial;' class='form-group row'><label for='"
								+ columnDefs[j].name
								+ "'>"
								+ columnDefs[j].title
								+ ":&nbsp</label> <input  type='hidden'  id='"
								+ columnDefs[j].title
								+ "' name='"
								+ columnDefs[j].title
								+ "' placeholder='"
								+ columnDefs[j].title
								+ "' style='overflow:hidden'  class='form-control' value='"
								+ adata.data()[0][j]
								+ "' >"
								+ adata.data()[0][j]
								+ "</input></div>";
					}
				}
				data += "</form>";

				 var selector = $('#altViewer-modal');
				 $(selector).find('.modal-body').html(data);
				 $(selector).modal('show'); 
				
		}
	} );

</script>


