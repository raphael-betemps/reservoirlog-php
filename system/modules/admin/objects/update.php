<?php
//superprint($_POST);
//superprint($_GET);
//superprint($content_pack["page"]);
//exit;

//superprint($objet)

$post_vars = $_POST;

switch ($process_request_operation) {

    case "edit" :

        if (!is_object($object) and $object->type != $object_type) {
            break;
        }

        $object->update_object_props($post_vars);
        $parent_file = $object->parent;
        $parent = file_load_object($parent_file);
        if ($parent) {
            $parent->updateContent($object);
            $parent->save();
        } else {
            $object->save();
        }
        
        break;
    

    case "create" :
    
        $object = createNewObject($object_type, $post_vars, $system_data_classes);

        if (is_object($object) and $object->type == $object_type) {
            $object->save();
        } 
        
      
        break;


    case "delete" :
        if (is_object($object) and $object->type == $object_type) {
            $object->delete();
        }
   
        break;


    default:
        break;
}

