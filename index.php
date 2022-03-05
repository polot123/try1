<?php include('header.php'); ?>
<body>
<?php include('navbar.php'); ?>

<style>
	.panel-body img{
	    width: 100%;
	    height: 23rem;
	    object-fit: cover;
	}
</style>
<div class="container">
	<h1 class="page-header text-center">ADMIN LOGIN</h1>
	<form action="index.php" method="post">
	<center>	<label for="username">username</label>
		<p></p>
		<input type="text" class="form-control" name="username" required >
		<p></p>
		<label for="password">username</label>
		<p></p>
		<input type="password" class="form-control"name="password" >
		<p></p>
		<input type="submit"  class="btn btn-primary" name="submit" value="submit" required>
</center>
	</form>
		    	</div>
			
	</div>
</div>
</body>
</html>
<?php 
 if(isset($_POST['submit'])){

if(($_POST['username']=='admin')&&($_POST['password']=='admin')){
	$_SESSION['admin']="ONLINE";
	echo $_SESSION['admin'];
	header("location:sales.php");
}

 }
 ?>
