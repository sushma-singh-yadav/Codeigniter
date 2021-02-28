<div class="row">
<div class="col-md-12 center">
	<h4>Product View</h4>
    <hr>
    <div class="row">
    <div class="col-md-6">
    	 <img class="card-img-top" src="<?php echo base_url('uploads/'.$productdata->product_image);?>" alt="Product Image" style="height: 250px;object-fit: cover;">
    </div>
     <div class="col-md-6">
    <h4><?php echo $productdata->product_name;?></h4>
    <h6>&#8377; <?php echo $productdata->product_price;?></h6>
    <p>Description : <br><?php echo $productdata->product_description;?></p>
    <p>Quantity : <input type="number" name="quantity" class="form-control"></p>
    <button class="btn btn-danger">Add to Cart</button>
    </div>
    </div>
</div>
</div><!-- Row -->