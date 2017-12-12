<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ALL CATEGORIES</title>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/styles.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/styles.css">
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header"><a class="navbar-brand navbar-link" href="#">FlamingoImpex Product Manager</a>
                    <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
                </div>
                <div class="collapse navbar-collapse" id="navcol-1">
                    <ul class="nav navbar-nav">
                        <li role="presentation"><a href="<?php echo site_url();?>mycontroller/dashboard">DASH BOARD</a></li>
                        <li class="active" role="presentation"><a href="<?php echo site_url();?>/mycontroller/categories">ALL CATEGORIES </a></li>
                        <li role="presentation"><a href="<?php echo site_url();?>/mycontroller/uncategorized">UNCATEGORIZED</a></li>
                        <li role="presentation"><a href="<?php echo site_url();?>/mycontroller/products">ALL PRODUCTS </a></li>                        
                    </ul>
                </div>
            </div>
        </nav>
        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-danger">
                    <div class="panel-heading">
                        <h3 class="panel-title">ALL CATEGORIES</h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <ul class="list-group">
                                <?php foreach($categories as $row): ?>
                                <li class="list-group-item"><a href="<?php echo site_url(); ?>/mycontroller/category/<?php echo $row->cat_name; ?>"><?php echo $row->cat_name; ?></a><span class="badge btn-primary">00</span></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>                
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">ADD A NEW CATEGORY</h3>
                    </div>
                    <div class="panel-body">
                       <form action="categoryAdder" method="post" >
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="category_name">Table name</label>
                                    <input type="text" name="category_name" class="form-control" id="category_name" /> 
                                </div>
                                <div class="form-group">
                                </div>
                                <div class="form-group">
                                    <input type=submit class="btn btn-warning" value="Create Table"/>
                                </div>
                            </div>
                        </form>
                
                    </div>
                </div>
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <h3 class="panel-title">MANAGE CATEGORIES</h3>
                    </div>
                    <div class="panel-body">
                        <ul class="list-group">
                            <?php foreach($categories as $row): ?>
                            <li class="list-group-item" style="height: 70px;"><?php echo $row->cat_name; ?>
                                <form action="categoryRemover" method="post" >
                                    <input type="hidden" name="category_name" class="form-control" value="<?php echo $row->cat_name?>" />
                                    <input type="submit" class="pull-right btn-default" value="delete"/>  
                                </form>
                                <form action="categoryUpdater" method="post">
                                <input type="submit"  class="pull-right btn-warning" value="update"/>   
                                <input type="text" name="new_name" class="pull-right" id="new_name" size="30" />
                                <input type="hidden" name="old_name" class="form-control" value="<?php echo $row->cat_name?>" />
                                </form>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <!--
                <div class="panel panel-danger">
                    <div class="panel-heading">
                        <h3 class="panel-title">DELETE CATEGORIES</h3>
                    </div>
                    <div class="panel-body">
                        <ul class="list-group">
                            <?php foreach($categories as $row): ?>
                            <li class="list-group-item"><?php echo $row->cat_name; ?><span class="badge btn-danger"><a href='#' style="color: white;">X</a></span></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                ---->
            </div>
        </div>
    </div>
    <script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
    <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>