<?php include '../doc/header.php';?>

<?php
require('../config/db.php');

if (isset($_REQUEST['username'])){
	$username = stripslashes($_REQUEST['username']);
	$username = mysqli_real_escape_string($con,$username); 
	$email = stripslashes($_REQUEST['email']);
	$email = mysqli_real_escape_string($con,$email);
	$password = stripslashes($_REQUEST['password']);
	$password = mysqli_real_escape_string($con,$password);
	$create_date = date("Y-m-d H:i:s");
        $query = "INSERT into `users` (username,password,email,create_date,user_type,first_name,last_name,is_active)
VALUES ('$username', '".md5($password)."', '$email', '$create_date','','','','')";
        $result = mysqli_query($con,$query);
        if(!$result){
        		  
			echo"Error description: " . mysqli_error($con);		
		?>
		 <input type="button" class="btn btn-dark"" VALUE="Close"
        onclick="window.location.href='../doc/dashboard'"> 
		  
<?php
        }else{
			 echo "<div class='form'>
<h3>You are registered successfully.</h3>
<br/>Click here to <a href='login'>Login</a></div>";
		}
    }else{
?>
	
		  
	
		      <div class="card-body">
                    <h4 class="card-title">User Registration</h4>                   
                    <form class="forms-sample" action="" method="post">
                      <div class="form-group">
                        <label for="username">User Name</label>                        
						<input type="text" class="form-control" id="username" name="username" placeholder="Username" required />
                      </div>
                      <div class="form-group">
                        <label for="email">Email address</label>                        
						 <input type="text" class="form-control" id="email" name="email" placeholder="Email Adress">
						 
                      </div>
                      <div class="form-group">
                        <label for="password">Password</label>                        
						<input type="password" class="form-control" name="password" id="password" placeholder="Password">
                      </div>
                      <div class="form-group">
                        <label>File upload</label>
                        <!--input type="file" name="img[]" class="file-upload-default"-->
                        <div class="input-group col-xs-12">
                          <input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload Image" id="profieplaceholder">
                          <span class="input-group-append">
                            <input type="file" id="selectedProfilePic" class="file-upload-browse btn btn-info" placeholder="Upload Image" style="display:none;" oninput="document.getElementById('profieplaceholder').placeholder=document.getElementById('selectedProfilePic').files.item(0).name;" >
                             <button class="file-upload-browse btn btn-info" type="button"  onclick="document.getElementById('selectedProfilePic').click();">Upload</button>
                             
                          </span>
                        </div>
                      </div>                      
                      <div class="form-group">
                        <label for="exampleTextarea1">Textarea</label>
                        <textarea class="form-control" id="exampleTextarea1" rows="2"></textarea>
                      </div>                      
					  <input type="submit" name="submitRegister" value="Register" class="btn btn-success mr-2">                     
                      <input type="button" class="btn btn-outline-dark" VALUE="Cancel"
        onclick="window.location.href='../doc/dashboard'"> 
                    </form>
                  </div>
		  

<?php }  ?>

	<?php include '../doc/footer.php';?>