
<?php
   $process_request_operation="edit";
   $data_module_section=$content_pack["page"]->module["section"];
   $form_action=BASEFILE."?process=admin_".$data_module_section."_update";
 //superprint($object);
?>

        <form action="<?php echo $form_action ?>" method="POST" name="<?php echo $process_request_operation; ?>">

            

   <?php 

		$form_body="system/include/forms/objects/interfaces/".$object_type."/edit.php";
                //superprint($form_body);
		if(is_file($form_body) and is_object($object) ){
                 include($form_body);}
   ?>        
        
            
            
            <button type="submit" class="btn btn-default">Submit</button>
            <INPUT type="hidden" name="object_id" value="<?php echo $object->id; ?>" />
            <INPUT type="hidden" name="object_type" value="<?php echo $object->type; ?>" />   
            <INPUT type="hidden" name="process_request_operation" value="<?php echo $process_request_operation; ?>" /> 
            
            
        </form>

