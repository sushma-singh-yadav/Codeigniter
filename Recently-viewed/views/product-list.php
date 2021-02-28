<div class="row">
<div class="col-md-12 center">
    <h4>Product List</h4>
    <hr>
    <div class="row">
    <?php
    foreach ($productList as $productList) {
    ?>
    <div class="col-md-4 center">
    <div class="card">
    <a href="<?php echo base_url('home/productView/'.$productList->product_id);?>">
  <img class="card-img-top" src="<?php echo base_url('uploads/'.$productList->product_image);?>" alt="Product Image" style="height: 250px;object-fit: cover;"></a>
  <div class="card-body">
    <h5 class="card-title">
        <a href="<?php echo base_url('home/productView/'.$productList->product_id);?>">
            <?php echo $productList->product_name;?></a>
        </h5>
    <p class="card-text"><?php echo $productList->product_description;?></p>
    <a href="<?php echo base_url('home/productView/'.$productList->product_id);?>" class="btn btn-primary">View</a>
  </div>
</div>
</div>
    <?php
    }
    ?>
</div>
</div>
</div><!-- Row -->