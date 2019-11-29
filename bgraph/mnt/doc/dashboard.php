<?php include 'header.php'; ?>

<div style="background-color: rgba(0,0,255,.1)" ><h6 align="left">My Tasks</h6></div>       
<table id="mytasks_table_id" class="table table-striped table-bordered" style="width:100%">    

</table>


<?php include 'footer.php'; ?>

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
    title: "Task Name",
    name:"name",
    type:"text"    
  }, {
	    title: "Assigned to",
	    name:"assigned_to",
	    type: "readonly"
  },
   {
    title: "Maintenance On",
    name:"start_date",
    type: "readonly"
  }, {
	    title: "Status",
	    name:"status",
	    type: "readonly"
  },
  {
	    title: "Created On",
	    name:"create_date",
	    type: "readonly"
  },
	   {
    title: "Created By",
    name:"created_by" ,
    type: "readonly"   
  },
  {
      "mData": null,
      "bSortable": false,
      "mRender": function(data, type, full) {
        return '<a class="btn btn-info btn-sm dt-view" href=./complete?id=' + full[1] + '>' + 'Complete' + '</a>';
      }
  }];

$(document).ready( function() {
	 var table = $('#mytasks_table_id').DataTable({		  
		  "dom": '<"dt-buttons"lr><"clear">fBtip',		  
		  "responsive": true,
          "processing": true,
          "serverSide": false,
         "ajax": {
             url: "./myTasksQry ", // json datasource
             //data: {action: 'getEMP'},  Set the POST variable  array and adds action: getEMP
             type: 'post',  // method  , by default get
         },
         columns: columnDefs,
         columnDefs: [ {
             orderable: false,
             className: 'select-checkbox',
             targets:   0
         } ],
         select: {
             style:    'os',
             selector: 'td:first-child'
         },
         order: [[ 1, 'asc' ]],
         buttons: [
             //"copy","excel","pdf","print"
             ],

	 });

});

</script>