<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$object_title="news process";
$object=new process($object_title);
$object->level="www";

$form_content_file="system/process/admin/process/forms/create_form_body.php";



// http vars filtered
include("system/include/admin/filters/http_sent_vars.php");
include("system/include/admin/filters/http_get_vars.php");


//form operation = name of the current process
// -> edit, remove, add, etc....
$process_request_operation=$content_page->name;

//form action
$form_action=BASEFILE."?process=admin_".$content_page->classe."_update";


    ?>


        <form action="<?php echo $form_action ?>" method="POST" name="<?php echo $process_request_operation; ?>" id="main_form">
              

            
     
   <?php include($form_content_file); ?>        
        
            
            
            <button type="submit" class="btn btn-default" id="submit">Submit</button>
            <INPUT type="hidden" id="object_id" name="object_id" value="<?php echo $object->id; ?>" />
            <INPUT type="hidden" id="object_type" name="object_type" value="<?php echo $object->type; ?>" />   
            <INPUT type="hidden" name="process_request_operation" value="<?php echo $process_request_operation; ?>" /> 
            
            
        </form>




<script>
    
// avoid "enter" key to submit the form
$('form input:not([type="submit"])').keydown(function(e) {
    if (e.keyCode == 13) {
        e.preventDefault();
        return false;
    }
});



//** object FILES / ID construction **/
function getprocessid(){
$object_module=$('#object_module option:selected').text()+"_";
if($object_module == "_"){$object_module="";}
$object_classe=$('#object_classe option:selected').text()+"_";
if($object_classe == "_"){$object_classe="";}
$object_name=$('#object_name').val();



$object_id=$object_module+$object_classe+$object_name;
return $object_id;
}

function setObectFiles($object_id){

$('#object_file').val("data/objects/process/"+$object_id+".obj");
$('#process_file').val("system/process/"+$object_id+".php");  
$('#object_id').val($object_id);
//alert($('#object_id').val());
}


$( ".form-control" ).change(function() {
    
$object_module=$('#object_module option:selected').text(); 
$object_classe=$('#object_classe option:selected').text();
$object_name=$('#object_name').val();

$object_id=getprocessid();
setObectFiles($object_id);

// keep this for later 
//$text=$("option:selected", this).text();
});


/** TABS 1 & 2 */

$('#creation_steps a').click(function (e) {
  e.preventDefault()
  $(this).tab('show')
});


</script>





         
 