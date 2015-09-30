<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include("system/config/admin.php");

//admin system vars
$object_id=false;
$object_type=false;
$media_id=false;
$media_type=false; 
$process_request_operation=false;
$process_request_operation_status=false;


// FILTERS for OBJECTS

//filter $_GET object
if( isset($_GET["object_id"]) ){$object_id=$_GET["object_id"];}

if( isset($_GET["object_type"]) ){
    $object_type=$_GET["object_type"];
    if( !in_array($object_type,$system_data_classes)  ){$object_type=false;}
}

if( isset($_GET["process_request_operation"]) ){
	$process_request_operation=$_GET["process_request_operation"];
	}

//filter $_POST object

if( isset($_POST["object_id"]) ){$object_id=$_POST["object_id"];}
if( isset($_POST["object_type"]) ){
    $object_type=$_POST["object_type"];
    if( !in_array($object_type,$system_data_classes)  ){$object_type=false;} 
}

if( isset($_POST["process_request_operation"]) ){
	$process_request_operation=$_POST["process_request_operation"];
	}

/* loading  the data to edit */


if($object_id and $object_type){
    
    $data_dir=OBJECTS_FOLDER."/".$object_type."/";
    $object_file= $data_dir.$object_id.".obj";
	
    $object=false;
    if(is_file($object_file)){
        $object=file_load_object($object_file);  
        $object_title=$object->getTitle();
		
     }
     else{
		 $object_title=$object_id;
		 }

 }
 


// FILTERS for MEDIA

//filter $_GET media
if( isset($_GET["media_id"]) ){$media_id=$_GET["media_id"];}

if( isset($_GET["media_type"]) ){
    $media_type=$_GET["media_type"];
    if( !in_array($media_type,$system_data_media)  ){$media_type=false;}
}

if( isset($_GET["process_request_operation"]) ){
	$process_request_operation=$_GET["process_request_operation"];
	}

//filter $_POST media

if( isset($_POST["media_id"]) ){$media_id=$_POST["media_id"];}
if( isset($_POST["media_type"]) ){
    $media_type=$_POST["media_type"];
    if( !in_array($media_type,$system_data_media)  ){$media_type=false;} 
}

if( isset($_POST["process_request_operation"]) ){
	$process_request_operation=$_POST["process_request_operation"];
	}

if($media_id and $media_type){
    
    if($media_type == "page"){
        $media_extention=".htm";
        
    }
    else{
        
        $media_extention=".".$media_type;
    }
    
    $media_dir=MEDIA_FOLDER."/".$media_type."/";
    $media_file= $media_dir.$media_id.$media_extention;
	
    
    if(!is_file($media_file)){$media_file=false;}
  
        
    $object_file=OBJECTS_FOLDER."/".$media_type."/".$media_id.".obj";
    $object=file_load_object($object_file);
   
     

 }
 else{
     $media_file=false;
     $media_extention=false;
     
 }
        
 //superprint($_GET);
 //superprint($media_file);