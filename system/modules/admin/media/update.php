<?php
//superprint($_POST);exit;
//superprint($_GET);
//superprint($content_pack["page"]);
//superprint($media_file);

if( is_file($media_file)){ 

   include("system/display/messages/admin/data/media_feedback_update.php");
       
}



$post_vars = $_POST;
$media_action_file = MODULES_FOLDER . "/admin/" . MEDIA_MODULE_SECTION . "/actions/" . $process_request_operation . "_" . $media_type . ".php";



switch ($process_request_operation) {

    case "edit" :

       
        //Edit the database object and the media
        if (is_object($object)) {
            $object->update_object_props($post_vars);
            $object->update_media_props($post_vars);
            //superprint($object);
            //exit;
            $parent_file = $object->parent;
            $parent = file_load_object($parent_file);
            if ($parent) {
                $parent->updateContent($object);
                $parent->save();
            } else {
                $object->save();
            }
        }
        else{
            //Edit only the media
            if ($media_id and is_file($media_action_file)) {
            include($media_action_file);
        }

            
            
        }
    
        break;


    case "create" :

        $object = createNewObject($media_type, $post_vars, $system_data_classes);
        //superprint($_POST);
        //exit;
        if (is_object($object) and $object->type == $media_type) {
            
            $object->save();
            $object->createContent();
            $object->update_media_props($post_vars);
            
        } else {
            break;
        }

        break;

    case "upload" :

        break;

    case "delete" :

       //DELETE the database object AND the media
        if (is_object($object) and $media_type == $object->type) {
            $object->delete();
        }
        //DELETE only the media
        if (is_file($media_file)) {
            unlink($media_file);
        }
       
        break;


    default:
        break;
}


