
<?php include '../doc/header.php'; ?>



<div style="background-color: rgba(0,0,255,.1)" ><h6 align="left">Check List Templates</h6></div>       
<table id="checklist_table_id" class="table table-striped table-bordered" style="width:100%">    
</table>


<?php include '../doc/footer.php'; ?>


<script type="text/javascript">

var columnDefs = [{
    title: "",
    id:"",
    type:"hidden"
  }, {
    title: "Id",
    name:"id",
    type: "readonly"    
  }, {
    title: "CheckList Name",
    name:"name",
    type:"text"    
  }, {
    title: "Created On",
    name:"create_date",
    type: "readonly"
  }, {
    title: "Created By",
    name:"created_by" ,
    type: "readonly"   
  },
  {
	  
      "mData": null,
      "bSortable": false,
      "mRender": function(data, type, full) {
        return '<a class="btn btn-info btn-sm dt-view" href=./view?id=' + full[1] + '>' + 'View' + '</a>';
      }
  }
  ];


$(document).ready( function() {
	 var table = $('#checklist_table_id').DataTable({		  
		  "dom": '<"dt-buttons"lr><"clear">fBtip',
		  "responsive": true,
          "processing": true,
          "serverSide": false,
          altEditor: true,
          "ajax": {
              url: "./qryclists ", // json datasource
              //data: {action: 'getEMP'},  Set the POST variable  array and adds action: getEMP
              type: 'post',  // method  , by default get
          },
          columns: columnDefs,
          columnDefs: [ {
              orderable: false,
              className: 'select-checkbox',
              targets:  0
          } ],
          select: {
              style:    'os',
              selector: 'td:first-child'
          },
          order: [[ 1, 'asc' ]],
          buttons: [        	         
          {
              extend: 'selected', 
              text: "<i class=' fas fa-minus-circle'>Delete</i>",
              className: 'btn buttons-selected btn-danger btn-sm mr-1',
              name: 'delete'      
          },{
              text: "<i class='fa fa-edit'>Edit</i>",
              className: 'btn btn-primary btn-sm mr-1',
              action: function ( e, dt, node, config ) {
                  editTemplate(e, dt, node, config);
              }
          }//,"copy","excel","pdf","print"
          ],
          
          onDeleteRow: function(datatable, rowdata, success, error) { 

        	  swal({
        		  title: "Are you sure?",
        		  text: "Are you sure want to delete the template?",
        		  icon: "warning",
        		  buttons: true,
        		  dangerMode: true,
        		})
        		.then((willDelete) => {
        		  if (willDelete) {
        			  $.ajax({
     	                 type:'POST',
     	                 url:'./delete',
     	                 data:rowdata,
     	                 success: success,
     	        		 error: error	        		

     	                 });	
        		  } else {
        		    swal("template not deleted");
        		  }
        		});
      		     
        	  
          },
         	  
		    
		});


	 function editTemplate(e, dt, node, config){			
			var row = dt.rows( { selected: true } ).data();			
			window.open('./editTemplate?tempId='+row[0][1]);		
	}
	 
	 $('#checklist_table_id tbody').on( 'click', 'a', function () {
	        var data = table.row( $(this).parents('tr') ).data();	       
	        $(this).attr('target','_self');
	    } );
	    
	
	} );



</script>