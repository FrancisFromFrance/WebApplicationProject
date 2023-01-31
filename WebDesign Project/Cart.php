<?php
	session_start();
	$database_name ="bookdata";
	$con = mysql_connect(host: "localhost", user "root", password "", $database_name);

?>


<!doctype html>
<html lang="en">
  <head>
  
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Cart</title>
	<style>
	.books {
			border : 1px solid #FF0000;
			margin : -1px 19px 3px -1px;
			padding : 10px;
			text-align: center;
	}
	
	table, th, tr {
		text-align: center;
	}
	.title2{
		text-align: center;
		color: #66afe9;
		backround-color: #efefef;
		padding : 2%;
	}
	
	h2{
		text-align: center;
		color: #66afe9;
		backround-color: #efefef;
		padding : 2%;
	}
	table th {
	backround-color: #efefef;}
	
		
	</style>
  </head>
  <body>
    <h1>Hello, world!</h1>
	
	<div class = "container" style = "width: 65%">
	<h2> Shoppping Cart </h2>
	<?php
		$query = "SELECT * FROM books";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result) > 0 {
			while($row = mysqli_fetch_array($result)) {
				
		?>
		
		<div class = "col-md-3">
		<form method = "post" action = "Cart.php?action=add&id=<?php echo $row["id"] ?>">
		<div class = "books">
			<img src ="<?php echo $row["image"] ?>" class = "img-responsive">
			<h5 class = "text-info"> <?php $row["TITLE"]; ?> </h5>
			<h5 class = "text-info"> <?php $row["AUTHOR"]; ?> </h5>
			<h5 class = "text-info"> <?php $row["GENRE"]; ?> </h5>
			<h5 class = "text-info"> <?php $row["price"]; ?> </h5>
			<input type = "text" name = "quantitiy" class = "form-control" value = "1">
			<input type = "hidden" name = "hidden_name" value = "<?php echo $row["TITLE"]; ?>">
			<input type = "hidden" name = "hidden_price"  value = "<?php echo $row["price"]; ?>">
			<input type = "submit" name = "add" style = "margin-top: 5 px;" class = "btn btn-success" value = "Add to Cart">
			</div>
		</form>
	</div>
	<?php
			}
		}
	?>
	<div style = "clear:both"> </div>
	<h3 class = "title2"> Shopping Cart Details </h3>
	<div class = "table table-bordered">
		<tr>
			<th wide = "30%"> Product Name </th>
			<th wide = "10%"> Quantitiy</th>
			<th wide = "13%"> Price Details </th>
			<th wide = "10%"> Total Price</th>
			<th wide = "17%"> Remove Item </th>
		</tr>
		<?php
			if(!empty($SESSION["cart"])) {
					$total = 0;
					foreach($SESSION["cart"] as $key => $value) {
			?>
			<tr>
				<td> <?php echo $value["item_name"]; ?> </td>
				<td> <?php echo $value ["item_quantitiy"]; ?> </td>
				<td> $ <?php echo $value ["product_price"]; ?> </td>
				<td> $ <?php echo number_format( number : $value["item_quantity" * $value["product_price"], deciaml:2); ?> </td>
				<td> <a href = "Cart.php?action=delete&id=<?php echo $value["product_id"];?>"> <span class = "text-danger" </span> Remove Item</a></td>
				
				
			</tr>
			<?php 
			$total = $total + ($value["item_quantity"] * $value["product_price"]);
					}
			?>
			<tr>
				<td colspan = "3" align "right"> Total </td>
				<th align = "right"> $ <?php echo number_format($total, decimals: 2); ?> </th>
				<td> </td>
				</tr>
				<?php
					}
			
			?>
		</div>
	</div>
   
  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  </body>
</html>