<?php
/*
superprint($_POST);
superprint($_GET);
superprint($content_page);

exit
*/




// http vars filtered
include("system/include/admin/filters/http_sent_vars.php");
include("system/include/admin/filters/http_get_vars.php");
include("system/include/admin/filters/http_post_vars.php");

// $process_request_operation from $_GET or $_POST

if($object_id and $object_type and $process_request_operation ){
    
    $data_dir=OBJECTS_FOLDER."/".$object_type."/";
    $object_file= $data_dir.$object_id.".obj";
    
    $object=false;
    if(is_file($object_file)){
        $object=file_load_object($object_file);   

     }
     elseif($process_request_operation == "create"){
         
            $object=new process("create new process");
         
     }
     if(is_object($object) and $object->type=$object_type ){
        
        
     
        $post_vars=$_POST;
        switch ($process_request_operation) {

            case "edit" :
                
                $object->update_document_props($post_vars);
                //superprint($object);
                $parent_file=$object->parent;
                $parent=  file_load_object($parent_file);
                if($parent){
                    $parent->updateContent($object);
                    $parent->save();
                }
                
                break;
            
            case "design" :
                
                $object->update_document_props($post_vars);
                //superprint($object);
                $parent_file=$object->parent;
                $parent=  file_load_object($parent_file);
                if($parent){
                    $parent->updateContent($object);
                    $parent->save();
                }

            case "create" :
                //superprint($_POST);
                $object = new process("new process");
                /*
                $process->module = "admin";
                $process->class = "";
                $process->name = "index";
                  */
                 $object->update_document_props($post_vars);
                $object->setProcessID();
                $object->save();
                //superprint($object);
                //exit;
                
                break;
            
            
            case "delete" :
                //superprint($_GET);exit;
               $object->delete();
                
                
                break;
            
            
            default:
                break;
        }
    }
     
     
}

//redirection and informations link
$redirection=BASEFILE."?process=admin_".$content_page->classe."_index";
$redirection.="&object_type=".$object_type."&object_id=".$object_id;
$redirection.="&process_request_operation=".$process_request_operation;

?>

<SCRIPT LANGUAGE="JavaScript">
window.location.replace("<?php echo $redirection; ?>");
</SCRIPT>
