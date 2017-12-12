<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ALL PRODUCTS</title>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/styles.css">
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand navbar-link" href="#">FlamingoImpex Product Manager</a>
                    <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navcol-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="navcol-1">
                    <ul class="nav navbar-nav">
                        <li role="presentation"><a href="<?php //echo site_url();?>mycontroller/dashboard">DASH BOARD</a></li>
                        <li role="presentation"><a href="<?php echo site_url();?>/mycontroller/categories">ALL CATEGORIES</a></li>
                        <li role="presentation"><a href="<?php echo site_url();?>/mycontroller/uncategorized">UNCATEGORIZED</a></li>
                        <li class="active" role="presentation"><a href="<?php echo site_url();?>/mycontroller/products">ALL PRODUCTS </a></li>
                        
                    </ul>
                </div>
            </div>
        </nav>
        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <h3 class="panel-title">All CATEGORIES</h3><a href="<?php echo site_url(); ?>/mycontroller/categories" >MANAGE CATEGORIES</a>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <ul class="list-group">
                                
                                <?php
                                if(empty($categories)){
                                    echo "<h5>no categories</h5>";
                                }else{

                                
                                 foreach($categories as $row): ?>
                                
                                
                                <li class="list-group-item"><a href="<?php echo site_url(); ?>/mycontroller/category/<?php echo $row->cat_name; ?>"><?php echo $row->cat_name; ?></a><span class="badge btn-primary">0</span></li>
                                <?php endforeach; }?>
                            </ul>
                        </div>
                    </div>
                </div>
        </div>
        <div class="col-md-8">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <h3 class="panel-title">ADD PRODUCTS TO THE DATABASE</h3>
                </div>
                    <div class="panel-body">
                        <div class="col-md-12">
                        <form action="productAdder" method="post" >
                            <div class="col-md-5">
                                <div class="form-group">
                                    <input type="file" id="file_name" name="file_name">
                                </div>
                                <div class="thumbnail">
                                    <img id="previewHolder" src="<?php echo base_url(); ?>assets/img/image_placeholder.png">
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label for="prod_name">Product Name</label>
                                    <input type="text" name="prod_name" class="form-control" id="prod_name" /> 
                                </div>
                                <div class="form-group">
                                    <label for="prod_price">Price</label>
                                    <input type="text" name="prod_price" class="form-control" id="prod_price" /> 
                                </div>
                                <div class="form-group">
                                    <label for="prod_quantity">Quantity</label>
                                    <input type="number" name="quantity" class="form-control" id="quantity"  /> 
                                </div>
                                <div class="form-group">
                                    <label for="prod_quantity">Category</label>
                                    <select type="select" name="category" class="form-control" id="category" >
                                            <option value="uncategorized" >------Select a Category-----</option>
                                            <?php foreach($categories as $row): ?>
                                            <option value="<?php echo $row->cat_name ?>" ><?php echo $row->cat_name; ?></option> 
                                            <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="prod_desc">Description</label>
                                    <textarea type="text" name="prod_desc" class="form-control" id="prod_desc"></textarea>
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name='currentCategory' class="form-control" id="currentCategory" value="uncategorized" >
                                    <input type="hidden" name='origin' class="form-control" id="origin" value="products" >
                                    <input type=submit class="btn btn-warning" value="Upload"/>
                                </div>
                            </div>
                        </form>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">ALL PRODUCTS IN THE DATABASE</h3>
                    </div>
                    <div class="panel-body">
                        <?php  //var_dump($allproducts);  ?>
                        <?php  
                        $counter = 1;
                        if(empty($allproducts)){
                            echo "<h4>no products in the database</h4>";
                        }else{

                        
                        foreach($allproducts as $row3): 
                            ?>
                        <!--<div class="col-md-12">-->
                            <div class="col-md-2">
                                <div class="thumbnail">

                                    <img src="<?php echo base_url();?>assets/img/<?php echo $row3->filename; ?>">                                                                        
                                    <div class="caption">
                                        
                                        <h3><span><?php echo $counter; $counter++;  ?></span> . <?php echo $row3->product_name; ?></h3>
                                        <h5 style="color:red;">PRICE: <?php //echo $row3->product_price; ?>0.00 AED</h5>
                                        <p><?php //echo $row3->product_description; ?></p>
                                        <bold><h6><?php //echo "".$row3->created_on;  ?> </h6></bold>
                                    </div>
                                </div>
                            </div>

                        <?php 
                    endforeach;
                    } 
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
    <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/preview_image.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/prevent_enter_key.js"></script>
</body>
</html>