<?php

// admin last operation feedback
//superprint($_POST);
//superprint($_GET);

$button_media_list_url = BASEFILE . "?process=admin_".MEDIA_MODULE_SECTION."_list&media_type=".$media_type;

?>

<div class="panel panel-info">
      <div class="panel-heading">
        <h3 class="panel-title">Last update : <?php echo $media_file;?></h3>
      </div>
      <div class="panel-body">
          
     <?php
	include($media_file);
	?>    
     </p>
        
      </div>
    
   
    </div>
      <a href="<?php echo $button_media_list_url;?>" class="btn btn-info" role="button">back to media list</a>