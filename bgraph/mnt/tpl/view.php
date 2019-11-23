<?php include '../doc/header.php'; ?>

 <div id='formio'></div>
 s
<?php include '../doc/footer.php'; ?>

<link rel='stylesheet' href='../formio/formio.full.min.css'>

<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.min.js"></script>
<script src='../formio/formio.full.min.js'></script>

<script>
var str = "{
	   "components": [
		      {
		         "key": "textField",
		         "type": "textfield",
		         "input": true,
		         "label": "Text Field",
		         "spellcheck": true
		      },	
		      {
		         "key": "submit",
		         "type": "button",
		         "input": true,
		         "label": "Submit",
		         "disableOnInvalid": true
		      }
		   ]
		}";

		
window.onload = function() {
    Formio.createForm(document.getElementById('formio'), str);
  };
		
</script>