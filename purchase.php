<?php
	include('conn.php');
	if(isset($_POST['productid1'])){
 
		$customer=$_POST['customer'];
		$sql="insert into purchase (customer, date_purchase) values ('$customer', NOW())";
		$conn->query($sql);
		$pid=$conn->insert_id;
 
		$total=0;
 
		foreach($_POST['productid1'] as $product):
		$proinfo=explode("||",$product);
		$productid=$proinfo[0];
		$iterate=$proinfo[1];
		$sql="select * from product where productid='$productid'";
		$query=$conn->query($sql);
		$row=$query->fetch_array();
 
		if (isset($_POST['quantity_'.$iterate])){
			$subt=$row['price']*$_POST['quantity_'.$iterate];
			$total+=$subt;

			$sql="insert into purchase_detail (purchaseid, productid, quantity) values ('$pid', '$productid', '".$_POST['quantity_'.$iterate]."')";
			$conn->query($sql);
		}
		endforeach;
		if($_POST['coupon']=="GO2018"){
			$discount= $total*0.1;
			$total= $total-$discount;
			echo "10%off";
		}
 		
 		$sql="update purchase set total='$total' where purchaseid='$pid'";
 		if($conn->query($sql)){
			
			
			header('location:order.php');
		 }

				
	}
	else{
		?>
		<script>
			window.alert('Please select a product');
			window.location.href='order.php';
		</script>	header('location:sales.php');
		<?php
	}
?>