<?php include('header.php'); ?>
<body>
<?php include('navbar.php'); ?>
<?php 	include('conn.php');?>
<div class="container">
	<h1 class="page-header text-center">Total purchase</h1>
	<form method="POST" action="purchase.php">
<table class="table table-striped table-bordered">
    <p>Customer Name: <?php echo $_POST['customer'];?>   </p>
			<thead>
				<!-- //<th class="text-center"><input type="checkbox" id="checkAll"></th> -->
				
				<th>Product Name</th>
				<th>Price</th>
				<th>Quantity</th>
                <th>Subtotal</th>
			</thead>
            <tbody>
                <?php 
            $total=0;
            $subt=0;
foreach($_POST['productid'] as $product){
    
    $proinfo=explode("||",$product);
		$productid=$proinfo[0];
		$iterate=$proinfo[1];
      echo '<input type="hidden" name="productid1[]" value="'; echo $product; echo'">';

        
    //    echo '<input type="hidden" name="productid1[]" value="'; echo $product; echo'">';
        $sql="select * from product where productid='$productid'";
		$query=$conn->query($sql);
		$row=$query->fetch_array();

       echo '<tr> <td>';
       echo $row['productname'];
       echo '</td>';
       echo '<td>';
       echo $row['price']; echo '</td>';

        if (isset($_POST['quantity_'.$iterate])){
        $subt=$row['price']*$_POST['quantity_'.$iterate];
       echo '<input type="hidden" name="quantity_'; echo $iterate; echo '" value="'; echo  $_POST['quantity_'.$iterate]; echo '">';
        echo '<td>';
        echo $_POST['quantity_'.$iterate];
        echo '</td>';
        echo '<td>';
        echo $subt;

        echo ' </td></tr>';
       
			$total+=$subt;
        }
     
}
 $discount=0;
if($_POST['coupon']=="GO2018"){
    $discount= $total*0.1;
    $total= $total-$discount;
    echo "10%off";
}
elseif($_POST['coupon']!=null){
    echo '<script> alert("invalid coupon code");</script>';
}

echo '<tr><td>Total:';  echo $total;  echo '</tr></td>';
echo  '<input type="hidden" name="customer" class="form-control" placeholder="Customer Name" value="';
echo $_POST['customer'];
 echo '" >';
 
?>

            </tbody>
            </table>
            <input type="hidden" name="coupon" value="<?php echo $_POST['coupon'];?>">
        <input  class="btn btn-primary" type="submit"> 

</form>
            </div>
            