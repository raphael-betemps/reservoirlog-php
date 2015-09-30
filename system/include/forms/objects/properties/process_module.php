

<!-- form edit process module name-->
<div class="form-group">
    <label for="object_module_name">Module name</label>
    <select class="form-control" id="object_module_name" name="object_module_name">
        <?php
        //superprint($system_modules );
        
        foreach ($system_modules as $object_module) {
            if ($object->module["name"] == $object_module) {
                $selected = "selected";
            } else {
                $selected = "";
            }
            echo "\n<option value=\"" . $object_module . "\" " . $selected . ">" . $object_module . "</option>\n";
        }
        ?>
    </select>
</div>


<!-- form edit process classe -->
<div class="form-group">
    <label for="object_module_section">Module section</label>
    <select class="form-control" id="object_module_section" name="object_module_section">
<?php
if ($object->module["section"] == " ") {
    $object_module_section_label = "";
    $object_module_section_value = "";
    $selected = "selected";
    echo "<option value=\"" . $object_module_section_value . "\" " . $selected . ">" . $object_module_section_label . "</option>\n";
}
else{
    
    $selected = "";
}

//array_push($system_modules_sub_sections,"");

foreach ($system_modules_sub_sections as $object_module_section) {


    if ($object_module_section == $object->module["section"]) {
        $selected = "selected";
    } else {
        $selected = "";
    }

    $object_module_section_label = $object_module_section;
    $object_module_section_value = $object_module_section;
    echo "<option value=\"" . $object_module_section_value . "\" " . $selected . ">" . $object_module_section_label . "</option>\n";
}
?>
    </select>
</div>




<!-- form edit process name -->
<div class="form-group">
    <label for="object_module_page">Process filename
    <button type="button" class="btn btn-primary btn-xs" id="process_file_update">update process files</button>
    
    </label>
    <input type="text" class="form-control" id="object_module_page" name="object_module_page" value="<?php echo $object->module["page"]; ?>">
    
   
</div>



  
  <!-- object files  -->
    <div class="form-group">
        <label for="object_file">Object_file:</label>
        <input type="text" class="form-control" id="object_file" name="object_file" value="<?php echo $object->getFileName(); ?>" readonly>
    </div>
    <div class="form-group">
        <label for="process_file">Process_file:</label>
        <input type="text" class="form-control" id="process_file" name="process_file" value="<?php echo $object->getProcessFileName(); ?>" readonly>
    </div>
  


  



      



      

  
  
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
    
$object_module_name=$('#object_module_name option:selected').text()+"_";
if($object_module_name == "_"){$object_module_name="";}
$object_module_section=$('#object_module_section option:selected').text()+"_";
if($object_module_section == "_"){$object_module_section="";}
$object_module_page=$('#object_module_page').val();

$object_id=$object_module_name+$object_module_section+$object_module_page;
return $object_id;
}

function getprocessFile(){
    
$object_module_name=$('#object_module_name option:selected').text()+"/";
if($object_module_name == "/"){$object_module_name="";}
$object_module_section=$('#object_module_section option:selected').text()+"/";
if($object_module_section == "/"){$object_module_section="";}
$object_module_page=$('#object_module_page').val();

$object_file=$object_module_name+$object_module_section+$object_module_page;
return $object_file;
}

function setObectFiles($object_id){

$object_filename=getprocessFile();

$('#object_file').val("data/objects/process/"+$object_id+".obj");
$('#process_file').val("system/process/"+$object_filename+".php");  
//$('#object_id').val($object_id);
//alert($('#object_id').val());
}



$( ".form-control" ).change(function() {

$object_id=getprocessid();
setObectFiles($object_id);
$('#object_id').val($object_id);

// keep this for later 
//$text=$("option:selected", this).text();
});

</script>