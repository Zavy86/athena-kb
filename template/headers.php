<!DOCTYPE html>
<html lang="en">

 <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" type="image/png" href="<?php echo URL.TEMPLATE; ?>img/icon-32.png" />
  <link rel="stylesheet" href="<?php echo URL.TEMPLATE; ?>style.css" type="text/css" media="screen" />

  <!-- Bootstrap -->
  <link rel="stylesheet" href="<?php echo URL; ?>helpers/bootstrap/css/bootstrap.min.css" type="text/css" media="screen" />
  <link rel="stylesheet" href="<?php echo URL; ?>helpers/bootstrap/css/bootstrap-theme.min.css" type="text/css" media="screen" />

  <title><?php echo $settings->title; ?></title>

 </head>

 <body>

  <div class="container">

   <!-- Static navbar -->
   <div class="navbar navbar-default navbar-fixed-top" role="navigation">

    <div class="container-fluid">

     <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
       <span class="sr-only">Toggle navigation</span>
       <span class="icon-bar"></span>
       <span class="icon-bar"></span>
       <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo URL; ?>"><?php echo $settings->title; ?></a>
     </div>

     <div class="navbar-collapse collapse">

      <ul class="nav navbar-nav">
       <li<?php if(CONTROLLER=="view"&&ACTION=="index"){echo " class='active'";} ?>><a href="?controller=view&action=index"><small class="glyphicon glyphicon-home"></small>&nbsp; {nav-index}</a></li>
       <li><a href="?controller=view&content=random"><small class="glyphicon glyphicon-random"></small>&nbsp; {nav-random}</a></li>

       <?php if($content->id){ ?>
        <li><a href='?controller=view&action=export&idContent=<?php echo $content->id; ?>'><small class="glyphicon glyphicon-floppy-disk"></small>&nbsp; {nav-export}</a></li>
        <!-- check if can edit -->
        <li<?php if(CONTROLLER=="edit"&&ACTION=="edit"){echo " class='active'";}?>><a href='?controller=edit&action=edit&idContent=<?php echo $content->id; ?>'><small class="glyphicon glyphicon-edit"></small>&nbsp; {nav-edit}</a></li>
       <?php } ?>

       <li<?php if(CONTROLLER=="edit"&&ACTION=="add"){echo " class='active'";}?>><a href="?controller=edit&action=add"><small class="glyphicon glyphicon-pencil"></small>&nbsp; {nav-create}</a></li>

      </ul>

      <form class="navbar-form navbar-right" role="search" method="get" action="<?php echo URL; ?>">

       <input type="hidden" name="controller" value="search">
       <input type="hidden" name="action" value="search">

       <div class="form-group">

        <div class="input-group">
         <input type="text" name="search" class="form-control" placeholder="Ricerca" value="<?php echo $_GET['search']; ?>">
         <span class="input-group-btn">
          <input type="submit" class="btn btn-default" value="Cerca">
         </span>
        </div><!-- /input-group -->

       </div>
      </form>

      <ul class="nav navbar-nav navbar-right">
       <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><small class="glyphicon glyphicon-cog"></small> <span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu">
         <li><a href="#">Action</a></li>
         <li><a href="#">Another action</a></li>
         <li><a href="#">Something else here</a></li>
         <li class="divider"></li>
         <li class="dropdown-header">Nav header</li>
         <li><a href="#">Separated link</a></li>
         <li><a href="#">One more separated link</a></li>
        </ul>
       </li>
      </ul>

     </div><!--/.nav-collapse -->
    </div><!--/.container-fluid -->
   </div>