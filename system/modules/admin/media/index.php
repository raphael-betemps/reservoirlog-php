<?php

if( isset($_GET["process_request_operation"]) ){
	$process_request_operation_status=$_GET["process_request_operation_status"];
	}
if($process_request_operation_status=="1"){
	
	include("system/display/messages/admin/data/media_feedback_update.php");
	}

?>


<ul class="list-group">
    
    <?php
    
    
    $data_list_process_id=$content_pack["page"]->module["name"]."_";
    $data_list_process_id.=$content_pack["page"]->module["section"]."_list";
    
    foreach($system_data_media as $system_data_type){
        
        
        
         $data_dir=MEDIA_FOLDER."/".$system_data_type."/";
         //superprint($data_dir);
         
         $data_files = dirToArray($data_dir, 1,"index.php");
         //$data_files = filesToArray($data_dir,"index.php");
         
         $data_count=count($data_files);
         
         $data_list_baselink = BASEFILE . "?process=".$data_list_process_id."&media_type=".$system_data_type;
         $data_list_link = "\n<a href=\"" . $data_list_baselink . "\" title=\"".$data_list_process_id."\">" . $system_data_type . "s</a>\n";
         //$data_list_link.=$system_data_type."</a>\n";
    ?>
  <li class="list-group-item">
    <span class="badge"> <?php echo $data_count; ?></span>
    <?php echo $data_list_link; ?>
  </li>
  
  
  <?php
  }
  ?>
  
</ul>
