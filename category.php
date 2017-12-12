<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $thisCategoryName; ?></title>
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
                        <li role="presentation"><a href="<?php echo site_url();?>mycontroller/dashboard">DASH BOARD</a></li>
                        <li role="presentation"><a href="<?php echo site_url();?>/mycontroller/categories">ALL CATEGORIES </a></li>
                        <li role="presentation"><a href="<?php echo site_url();?>/mycontroller/uncategorized">UNCATEGORIZED</a></li>
                        <li role="presentation"><a href="<?php echo site_url();?>/mycontroller/products">ALL PRODUCTS </a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <h3 class="panel-title">All CATEGORIES</h3><a href="<?php echo site_url(); ?>/mycontroller/categories/" >MANAGE CATEGORIES</a>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <ul class="list-group">
                                <?php foreach($categories as $row): ?>
                                <li class="list-group-item"><a href="<?php echo site_url(); ?>/mycontroller/category/<?php echo $row->cat_name; ?>"><?php echo $row->cat_name; ?></a><span class="badge btn-primary">0</span></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
        </div>
        <div class="col-md-8">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <h3 class="panel-title">Add a product to <?php echo $thisCategoryName; ?> category</h3>
                </div>
                    <div class="panel-body">
                        <div class="col-md-12">
                        <form action="../productAdder" method="post" >
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
                                    <input type="text" name="prod_price" class="form-control" id="prod_price"  /> 
                                </div>
                                <div class="form-group">
                                    <label for="quantity">Quantity</label>
                                    <input type="number" name="quantity" class="form-control" id="quantity" /> 
                                </div>
                                <div class="form-group">
                                    <label for="prod_desc">Description</label>
                                    <textarea type="text" name="prod_desc" class="form-control" id="prod_desc"></textarea>
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name='origin' class="form-control" id="origin" value="<?php echo "category/".$thisCategoryName; ?>" >
                                    <input type="hidden" name='category' class="form-control" id="category" value="<?php echo $thisCategoryName; ?>" >
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
                        <h3 class="panel-title"><?php echo $thisCategoryName; ?></h3>
                    </div>
                    <div class="panel-body">
                        <?php  //var_dump($thisCategory);  ?>
                        <?php  
                        $counter = 1;  
                        if(empty($thisCategory)){
                            echo "<h5>no products</h5>";
                        }else{
                        foreach($thisCategory['products'] as $index=>$value): 
                        ?>
                        <div class="col-md-12">
                            <div class="col-md-1">
                                <h1><?php echo $counter; $counter++;  ?> .</h1>
                            </div>
                            <div class="col-md-4">
                                <div class="thumbnail"><img src="<?php echo base_url();?>assets/img/<?php echo $thisCategory['products'][$index]->filename; ?>">
                                    <div class="caption">
                                        <h3><?php echo $thisCategory['products'][$index]->product_name; ?></h3>
                                        <h5 style="color:red;">PRICE: <?php echo $thisCategory['price'][$index]->price; ?> AED</h5>
                                        <p><?php echo $thisCategory['products'][$index]->product_description; ?></p>
                                        <bold><h6>Created: <?php echo $thisCategory['products'][$index]->created_on;  ?> </h6></bold>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <form action="../productUpdater" method="post">
                                    <div class="form-group">
                                        <label for="prod_name">Product Name</label>
                                        <input type="text" name="prod_name" class="form-control" value="<?php echo $thisCategory['products'][$index]->product_name; ?>" /> 
                                    </div>
                                    <div class="form-group">
                                        <label for="prod_price">Price</label>
                                        <input type="text" name="prod_price" class="form-control" value="<?php echo $thisCategory['price'][$index]->price; ?>" /> 
                                    </div>
                                    <div class="form-group">
                                        <label for="quantity">Quantity</label>
                                        <input type="number" name="quantity" class="form-control" value="<?php echo $thisCategory['quantity'][$index]->quantity; ?>" /> 
                                    </div>
                                    <div class="form-group">
                                    <label for="category">Category</label>
                                    <select type="select" name="category" class="form-control" id="category" >
                                            <option value="uncategorized" >------------------NO CATEGORY------------------</option>
                                            <?php foreach($categories as $row3):
                                                if($row3->cat_name == $thisCategoryName){
                                                    echo "<option value=".$row3->cat_name." ".set_select('category',$row->cat_name,TRUE).">".$row3->cat_name."</option>";
                                                }else{
                                                    echo " <option value=".$row3->cat_name.">".$row3->cat_name."</option>";
                                                }
                                                endforeach; 
                                            ?>
                                    </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="prod_desc">Description</label>
                                        <textarea type="text" name="prod_desc" class="form-control"><?php echo $thisCategory['products'][$index]->product_description; ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" name="product_id" id="product_id" value="<?php echo $thisCategory['products'][$index]->product_id; ?>" />
                                        <input type="hidden" name="origin" id="origin" value="<?php echo "category/".$thisCategoryName; ?>" />
                                        <input type="hidden" name="currentCategory" id="currentCategory" value="<?php echo $thisCategoryName; ?>" />
                                        <input type="submit" class="btn btn-primary" value="Update This Product"/>
                                    </div>
                                </form>
                                <form action="../productRemover" method="post">
                                    <input type="hidden" name="product_id" id="product_id" value="<?php echo $thisCategory['products'][$index]->product_id; ?>" />
                                    <input type="hidden" name="origin" id="origin" value="<?php echo "category/".$thisCategoryName; ?>" />
                                    <input type="hidden" name="currentCategory" id="currentCategory" value="<?php echo $thisCategoryName; ?>" />
                                    <input type="submit" class="btn btn-danger" value="Delete This Product"/>
                                </form>
                            </div>
                        </div>
                        <?php endforeach; }?>
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