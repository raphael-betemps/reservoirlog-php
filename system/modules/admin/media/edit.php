
<?php
$process_request_operation = "edit";
$form_action = BASEFILE . "?process=admin_" . MEDIA_MODULE_SECTION . "_update";
$form_body = "system/include/forms/media/interfaces/" . $media_type . "/edit.php";

//$object_file=OBJECTS_FOLDER."/".$media_type."/".$media_id.".obj";
//$object=file_load_object($object_file);



//superprint($form_body);
//superprint($object);
?>

<form action="<?php echo $form_action ?>" method="POST" name="<?php echo $process_request_operation; ?>">



    <?php
    if (is_file($form_body) and is_file($media_file)) {
        include($form_body);
    }
    ?>        


    <br>
    <button type="submit" class="btn btn-default">Submit</button>
    <INPUT type="hidden" name="media_id" value="<?php echo $media_id; ?>" />
    <INPUT type="hidden" name="media_type" value="<?php echo $media_type; ?>" />   
    <INPUT type="hidden" name="process_request_operation" value="<?php echo $process_request_operation; ?>" /> 


</form>

