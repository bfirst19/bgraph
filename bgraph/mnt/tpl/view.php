<?php include '../doc/header.php'; ?>


 <div>
 <button class="btn btn-primary btn-rounded" tabindex="0"
			aria-controls="#builder" type="button" onclick="parent.history.back();"><span class="fas fa-arrow-left"></span>			
	</button>
  <div id='formio'> </div>
 </div>

     
<?php 

require('../config/db.php');
session_start();

$template_content;
if (isset($_GET['id'])){
    $id = stripslashes($_GET['id']);
    $id = mysqli_real_escape_string($con,$id);
    
    $qry = "SELECT template_content from checklist_template where id='$id'";
    $result = mysqli_query($con,$qry) or die(mysqli_error($con));
    while ($row = mysqli_fetch_array($result)) {
        $template_content = $row["template_content"];
    }
    
   // echo json_encode($template_content);
   // exit();    
}
?>
 
<?php include '../doc/footer.php'; ?>

<link rel='stylesheet' href='../formio/formio.full.min.css'>

<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.min.js"></script>
<script src='../formio/formio.full.min.js'></script>

<script>
var json = <?php echo $template_content;?>;

window.onload = function() {
	Formio.createForm(document.getElementById('formio'), json).then(function(form) {
			 	  form.on('submit', (submission) => {
				    console.log('The form was just submitted!!!');
				  });
				  form.on('error', (errors) => {
				    console.log('We have errors!');
				  })
		});
  };
  	
</script>