<?php include '../doc/header.php'; ?>

<div class="row">
	<div class="col-sm-8" id='builder'></div>
	<div class="col-sm-4" hidden="true">
		<h3 class="text-center text-muted">as JSON Schema</h3>
		<div class="card card-body bg-light jsonviewer">
			<pre id="json" hidden="true"></pre>
		</div>
	</div>
	<div class="col-sm-4" style="float: right;">
		<button class="btn btn-info btn-sm mr-1" tabindex="0"
			aria-controls="#builder" type="button" onclick="saveForm();">
			<span><i class="fas fa-save">Save</i></span>
		</button>
	</div>
</div>
<?php include '../doc/footer.php'; ?>


<link rel='stylesheet' href='../formio/formio.full.min.css'>

<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.min.js"></script>
<script src='../formio/formio.full.min.js'></script>
<script src="../js/jquery.ba-throttle-debounce.js"></script>

<?php 
require ('../config/db.php');
$tempId =  $_GET['tempId'];
$template_content;

$qry = "select  * from checklist_template where id='$tempId'";
    $result = mysqli_query($con,$qry);
    $row = mysqli_fetch_assoc($result);
    $template_content = $row['template_content'];    
?>

<script type='text/javascript'>

var jsonElement = document.getElementById('json');
var form;
var chkl_id;
$(document).ready( function() {

	       chkl_id = "<?php echo $_GET['tempId'] ?>";
	
           var str = <?php echo $template_content ?>;
          
          jsonElement.appendChild(document.createTextNode(JSON.stringify(str, null, 4)));
          
		  console.log('checklist -d');
		  console.log(chkl_id);
          form  = Formio.builder(document.getElementById('builder'), str, {
			  builder: {    
    			  basic:false,
    			  advanced:false,
    			  data:false,
    			  layout:false,
    			  premium:false,			    
			    customBasic: {
			      title: 'Drag Components',
			      default: true,
			      weight: 0,
			      components: {
    			    fieldset:true,
			        textfield: true,
			        textarea: true,
			        datetime:true,
			        selectboxes:true,
			        radio:true,
			        signature:true,
			        file:true
			        
			      }
			    },    			    
			  },
			  editForm: {    				  
			    textfield: [
  			      {
  			        key: 'Help',
  			        ignore: true
  			      }        
  			    ]            		
			  }
			}).then(function(builder) {
			  builder.on('saveComponent', function() {
				console.log("build component:"+builder.schema);
			    console.log(builder);
			    console.log(JSON.stringify(builder.schema));    			    
			    jsonElement.innerHTML = '';
			   
			    jsonElement.appendChild(document.createTextNode(JSON.stringify(builder.schema, null, 4)));
			    //Formio.createForm(formElement, builder.form).then(onForm);
			  });

			  builder.on('change', function() {					  			    
				    jsonElement = document.getElementById('json');				    
				    jsonElement.innerHTML = '';
				    console.log('in change event');
				    jsonElement.appendChild(document.createTextNode(JSON.stringify(builder.schema, null, 4)));
				    //Formio.createForm(formElement, builder.form).then(onForm);
				  });

			  
			});
         
      });
      
function saveForm(){ 
	  console.log(jsonElement.innerHTML);
	 var content = jsonElement.innerHTML;  
	 if(content == ""){
		 alert("Cannot save empty form");
		 return null;
	 }     		 
	 $.ajax({
               type:'POST',
               url:'./update',	                
               data:{jsonData:jsonElement.innerHTML,chkl_id:chkl_id},
               success: function(resp){ 			
    				swal({
    					  title: "Info",
    					  text: resp,
    					  icon: "info",
    					});	
    				 
    			},
      		 error: "Error"	        		

               });
	 
	}

      
    </script>



