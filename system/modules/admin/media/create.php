


<?php

/** ONLY FOR PAGES */


$process_request_operation = "create";
$form_action = BASEFILE . "?process=admin_" . MEDIA_MODULE_SECTION . "_update";
$form_body = "system/include/forms/media/interfaces/" . $media_type . "/edit.php";


$post_vars=array();
$object=createNewObject($media_type,$post_vars,$system_data_classes);
$object->title="";
//superprint($form_body);


//$object_file=OBJECTS_FOLDER."/".$media_type."/".$media_id.".obj";
//$object=file_load_object($object_file);



//superprint($form_body);
//superprint($object);
?>

<form action="<?php echo $form_action ?>" method="POST" name="<?php echo $process_request_operation; ?>">



    <?php
    
    include("system/include/forms/objects/properties/document_title.php");
    if (is_file($form_body) ) { include($form_body);}
    ?>        

    <br>
    <button type="submit" class="btn btn-default">Submit</button>
    <INPUT type="hidden" name="media_id" value="<?php echo $media_id; ?>" />
    <INPUT type="hidden" name="media_type" value="<?php echo $media_type; ?>" />   
    <INPUT type="hidden" name="process_request_operation" value="<?php echo $process_request_operation; ?>" /> 


</form>




