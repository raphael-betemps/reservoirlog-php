<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/** libs */
include("system/config/const.php");
include("system/include/libs/bases.php");
include("system/include/libs/classes.php");
include("system/include/libs/boot.php");
include("system/include/libs/menus.php");


  $siteFileObj = OBJECTS_FOLDER . "/site/site.obj";
  $site = file_load_object($siteFileObj);
  
  $obj=$site->getContent();
  
  
 
$image=new image("test");
$upload_filename="df  sdçsd_çèsdfhsdn dsjflskdfjd .png";

$image->init_from_upload_filename($upload_filename);
superprint($image->getContentFileName());



/*
$object_file=OBJECTS_FOLDER."/process/admin_data_index.obj";
superprint($object_file);
$object=  file_load_object($object_file);


$object_file=OBJECTS_FOLDER."/process/admin_data_edit.obj";
superprint($object_file);
$object=  file_load_object($object_file);
*/

/*
function fileWriteHtm($filename, $data) {

    $html = stripslashes($data);
    $file = fopen($filename, "w+");
    //echo $txt;
    fputs($file, $html);
    fclose($file);
}


$system_data_classes=array("site","section","process","page","link","image","file");

$data_process_update_list = array(
    "edit",
    "create",
    "design",
    "link",
    "unlink",
    "delete" 
);


foreach($system_data_classes as $class){
  foreach($data_process_update_list as $process){
    
      $process_file=$class."_".$process.".php";
      $process_file_save="temp/".$class."_".$process.".php";
      
      $source_code="<?php \n //".$process_file." \n\n\n ?>\n";

}  
    
}

 */