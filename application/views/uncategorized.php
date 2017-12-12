<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UNCATEGORIZED</title>
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
                        <li class="active" role="presentation"><a href="<?php echo site_url();?>/mycontroller/uncategorized">UNCATEGORIZED</a></li>
                        <li role="presentation"><a href="<?php echo site_url();?>/mycontroller/products">ALL PRODUCTS </a></li>
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
                                <?php //var_dump($categories); ?>
                                <?php 
                                if(empty($categories)){
                                         echo "<h4>no categories</h4>";
                                    }else{
                                foreach($categories as $row): 
                                    ?>
                                <li class="list-group-item"><a href="<?php echo site_url(); ?>/mycontroller/category/<?php echo $row->cat_name; ?>"><?php echo $row->cat_name; ?></a><span class="badge btn-primary">0</span></li>
                                <?php 
                                endforeach; 
                            }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        
     
            <div class="col-md-8">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">ALL PRODUCTS NOT IN A CATEGORY</h3>
                    </div>
                    <div class="panel-body">
                        <?php  //var_dump($uncategorized);  ?>
                        <?php 

                        $counter = 1; 
                        /*
                        echo "uncategorized varDump<br>";
                       var_dump($uncategorized);
                        echo "uncategorized[product] varDump<br>";
                       var_dump($uncategorized['products']);
                        echo "uncategorized[price] varDump<br>";
                       var_dump($uncategorized['price']);
                        echo "uncategorized[quality] varDump<br>";
                       var_dump($uncategorized['quantity']);
                       */
                        if(empty($uncategorized)){
                             echo "<h4>no products in the database</h4>";
                        }else{
                        foreach($uncategorized['products'] as $index => $value): 
                        ?>
                        <div class="col-md-12">
                            <div class="col-md-1">
                                <h3><?php echo $counter; $counter++;  ?> .</h3>
                            </div>
                            <div class="col-md-4">

                                <div class="thumbnail"><img src="<?php echo base_url();?>assets/img/<?php echo $uncategorized['products'][$index]->filename; ?>">
                                    <!--
                                    <div class="caption">
                                        <h3><?php //echo $row2->product_name; ?></h3>
                                        <h5 style="color:red;"><?php //echo "PRICE: ".$row3->product_price." AED"; ?></h5>
                                        <p><?php //echo $row2->product_description; ?></p>
                                        <bold><h6> <?php //echo "Created:".$row2->created_on;  ?> </h6></bold>
                                    </div>-->
                                </div>
                            </div>
                            <div class="col-md-6">
                                <form action="productUpdater" method="post"  >
                                    <div class="form-group">
                                        <label for="prod_name">Product Name</label>
                                        <input type="text" name="prod_name" class="form-control" value="<?php echo $uncategorized['products'][$index]->product_name; ?>" /> 
                                    </div>
                                    <div class="form-group">
                                        <label for="prod_price">Price</label>
                                        <input type="text" name="prod_price" class="form-control" value="<?php echo $uncategorized['price'][$index]->price; ?>"  /> 
                                    </div>
                                    <div class="form-group">
                                        <label for="quantity">Quantity</label>
                                        <input type="number" name="quantity" class="form-control" value="<?php echo $uncategorized['quantity'][$index]->quantity; ?>"/> 
                                    </div>
                                    <div class="form-group">
                                    <label for="category">Category</label>
                                    <select type="select" name="category" class="form-control" id="category" >
                                            <option value="uncategorized" >------------------NO CATEGORY------------------</option>
                                            <?php foreach($categories as $row3): ?>
                                            <option value="<?php echo $row3->cat_name ?>" ><?php echo $row3->cat_name; ?></option> 
                                            <?php endforeach; ?>
                                    </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="prod_desc">Description</label>
                                        <textarea type="text" name="prod_desc" class="form-control"><?php echo $uncategorized['products'][$index]->product_description; ?></textarea>
                                    </div>
                                
                                    <div class="form-group">
                                        <input type="hidden" name="product_id" id="product_id" value="<?php echo $uncategorized['products'][$index]->product_id; ?>" />
                                        <input type="hidden" name="currentCategory" id="currentCategory" value="uncategorized" />
                                        <input type="hidden" name="origin" id="origin" value="uncategorized" />
                                        <input type="submit" class="btn btn-primary" value="Update This Product"/>
                                    </div>
                                </form>
                                <form action="productRemover" method="post" >
                                    <input type="hidden" name="product_id" id="product_id" value="<?php echo $uncategorized['products'][$index]->product_id; ?>" />
                                    <input type="hidden" name="currentCategory" id="currentCategory" value="uncategorized" />
                                    <input type="hidden" name="origin" id="origin" value="uncategorized" />
                                    <input type="submit" class="btn btn-danger" value="Delete This Product"/>
                                </form>
                            </div>
                        </div>
                        <?php endforeach; 
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