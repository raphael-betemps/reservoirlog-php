<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="<?php echo $content_pack["site"]->meta["description"]; ?>">
        <meta name="author" content="<?php echo "raphael betemps" ?>">
        <meta name="generator" content="<?php echo $content_pack["site"]->meta["generator"]; ?>">

        <title><?php echo $content_pack["site"]->getTitle(); ?></title>

        <!-- Bootstrap core CSS -->
        <script src="system/webkits/jquery-ui-1.11.4/external/jquery/jquery.js"></script>
    
      
          
        <link href="system/webkits/bootstrap-3.3.4/css/bootstrap.min.css" rel="stylesheet">
        <link href="system/webkits/bootstrap-3.3.4/css/sticky-footer-navbar.css" rel="stylesheet">
         
        
           <link href="system/webkits/bootstrap-3.3.4/css/dataTables.bootstrap.css" rel="stylesheet">
           
      
         
         
        <style>
            #content {/*border:solid 1px #CCCCCC;*/}
            #sidebar{/*background: #9acfea;*/}
            #footer{height:50px;background: #E37E1D;}
            div.side_menu a {font-size:14px;padding:2px;}
            h1 {margin-top: 0;}
      
        </style>

        
       
        
        

    </head>
    <body>
        
     
        
        
        <!-- Fixed navbar -->
        <!--<nav class="navbar navbar-default navbar-fixed-top"> -->
         <nav class="navbar navbar-default navbar-fixed-top">  
            <div class="container">

                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="main.php"><?php echo $content_pack["site"]->getTitle(); ?></a>
                </div>

                <div id="navbar" class="collapse navbar-collapse">

                    <ul class="nav navbar-nav">

                        <?php
                        displayNavBar($content_pack["site"], $content_pack["page"]->id);
                        ?>

                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </nav>


        
        <div class="container">
            <!-- /PAGE 2 cols -->
            <div class="row">
                <!-- /SIDE BAR -->
                <div id="sidebar" class="col-xs-12 col-sm-3 col-md-3">
                    <?php displaySideMenuBootstrap($content_pack,$http_regular_request,0); ?>
                </div>
                <!-- /SIDE BAR END-->
                <!-- /CONTENT (Page, articles, album, video, downloads)-->
                <div id="content" class="col-xs-12 col-sm-9 col-md-9">
                    <!-- /CONTENT article-->
                    <div id="content_article">
                        
           
                                    
                        <h1><?php echo $content_pack["page"]->getTitle(); ?></h1>
                        <?php
                        $content_file = $content_pack["page"]->getContentFile();
                        
                        
                        
                        if(isset($content_pack["page"]->module)){
                            $content_module=MODULES_FOLDER."/".$content_pack["page"]->module["name"]."/init.php";
                            if( is_file($content_module) ){include($content_module);}
                            
                            }
                        
                        
                        if (is_file($content_file)) {
                            include($content_file);
                        } else {
                            include(SAMPLE_404);
                        }
                        ?>
                    </div>
                </div>
                <!-- /CONTENT END-->
            </div><!-- /PAGE 2 cols end -->
        </div>
        
        
        
                

        
        
        <footer class="footer">
            <div class="container">
                
                
                
                
                
               <ol class="breadcrumb">
<?php foreach($content_pack as $content_key => $content_obj){ 
    
    if($content_key =="page"  ){ $bread_style="class=\"active\"";}
    else{$bread_style="";}
    echo "<li ".$bread_style.">".$content_obj->title."</li>";
    
}
?>
</ol>
            </div>
        </footer>

        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        

           <script src="system/webkits/bootstrap-3.3.4/js/bootstrap.min.js"></script>

            
         

    </body>
</html>
