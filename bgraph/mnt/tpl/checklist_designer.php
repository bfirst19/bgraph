<?php include '../doc/header.php'; ?>



<div class="row">
	<div class="col-sm-8">
		<div id="builder"></div>
	</div>
	<div class="col-sm-4" hidden="true">
		<h3 class="text-center text-muted">as JSON Schema</h3>
		<div class="card card-body bg-light jsonviewer">
			<pre id="json" hidden="true"></pre>
		</div>
	</div>
	<div class="col-sm-4" style="float: right;">
		<div class="form-group">
						<label for="template_name">Template Name</label> <input class="form-control"
							id="template_name" name="template_name" type="text"
							placeholder="Template Name" required="required">
					</div>
		<button class="btn btn-primary" tabindex="0"
			aria-controls="#builder" type="button" onclick="saveForm();">
			<span><i class="fas fa-save">Save</i></span>
		</button>
		<button class="btn btn-primary" tabindex="0"
			aria-controls="#builder" type="button" onclick="location.reload(true);">
			<span><i class="fas fa-plus-circle">New</i></span>
		</button>
	</div>
</div>
<?php include '../doc/footer.php'; ?>


<link rel='stylesheet' href='../formio/formio.full.min.css'>

<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.min.js"></script>
<script src='../formio/formio.full.min.js'></script>

<script type='text/javascript'>
var jsonElement = document.getElementById('json');

   var form;
    	$(document).ready( function() {
    		 form =Formio.builder(document.getElementById('builder'), {}, {
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
    			        //phoneNumber: true,
    			        datetime:true,
    			        //checkbox:true,
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
      			        key: 'api',
      			        ignore: true
      			      }        
      			    ]            		
    			  }
    			}).then(function(builder) {
    			  builder.on('saveComponent', function() {
    				 console.log("build component:"+builder.schema);
    			    console.log(builder.schema);
    			    console.log(JSON.stringify(builder.schema));    			    
    			    jsonElement.innerHTML = '';
    			   
    			    jsonElement.appendChild(document.createTextNode(JSON.stringify(builder.schema, null, 4)));
    			    //Formio.createForm(formElement, builder.form).then(onForm);
    			  });
    			});
	    	console.log('me..'+form);
		        
    });
    	 function saveForm(){
        	 console.log('return to save:');                	
    		 console.log(jsonElement.innerHTML);
    		 var tempName = $("#template_name").val();

    		 var content = jsonElement.innerHTML;
    		 
    		 if(tempName ==""){
        		 alert ("Enter template name");
        		 return null;
    		 }
    		 
    		 if(content == ""){
        		 alert("Cannot save empty form");
        		 return null;
    		 }
    		 
    		
    		
    		 $.ajax({
	                 type:'POST',
	                 url:'./create',	                
	                 data:{jsonData:jsonElement.innerHTML,template_name:tempName},
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

</head>






