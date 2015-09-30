
<script src="system/webkits/bootstrap-3.3.4/js/jquery.dataTables.min.js"></script>
<script src="system/webkits/bootstrap-3.3.4/js/dataTables.bootstrap.min.js"></script>
<script>



$(document).ready(function() {
    $('#objects_list').DataTable( {
        "ordering": false,
        "info":     false
    } );
} );

</script>


  <script>
    $(document).ready(function () {

        $(".delete_confirm").click(function (e) {
            var result = window.confirm('Delete this object, Are you sure?');
            if (result == false) {
                e.preventDefault();
            };
        });
    });
  </script>


<?php
//superprint($content_pack);
// convention for dirs : OBJECTS_FOLDER/object's class/
// and $content_process_page->classe == edited_objet->classe
if ($media_type) {

    $media_dir = MEDIA_FOLDER . "/" . $media_type . "/";

    $object_type=$media_type;
    $objects_dir = OBJECTS_FOLDER . "/" . $media_type . "/";
    $media_files = dirToArray($media_dir, 1,"index.php");
    
    
  
    //superprint($media_files);
    $data_module_section=$content_pack["page"]->module["section"];
    
    

    // the ID of each objects added later in the loop 
    $editLink_base = BASEFILE . "?process=admin_".MEDIA_MODULE_SECTION."_edit";
   
    $deleteLink_base = BASEFILE . "?process=admin_".MEDIA_MODULE_SECTION."_update&process_request_operation=delete";

    $createLink_base = BASEFILE . "?process=admin_".MEDIA_MODULE_SECTION."_create&media_type=".$media_type;
    $create_glyphicon = "<span class=\"glyphicon  glyphicon-plus\" ></span>\n";
    $createLinkButton = "<a href=\"" . $createLink_base . "\" title=\"create a new ";
    $createLinkButton.= $media_type."\">" . $create_glyphicon . "</a>\n";
    ?>

    
    <table  cellpadding="0" cellspacing="0" border="0"  class="table table-striped table-hover compact" id="objects_list">


        <colgroup>
            <col class="col-xs-1">
       
            <col class="col-xs-8">
            <col class="col-xs-1">
            <col class="col-xs-1">
           
        </colgroup>

        <thead>
            <tr>
                <th><?php echo $createLinkButton ?></th>
       
                <th><?php echo $media_type; ?> title</th>
                <th>edit</th>
               
                <th>delete</th>

            </tr>
        </thead>


        <tbody>

    <?php
    
    $media_count=0;
    
    foreach ($media_files as $key => $media_filename) {

        
        
        $media_file_parts = pathinfo($media_filename);
        $object_filename=$media_file_parts['filename'].".obj";
        
        
        $object_file = $objects_dir.$object_filename;
        $object = file_load_object($object_file);
        
        //superprint($object_file);
        //superprint($object);
        
        
        
        if (!isset($object->type) or $object->type != $object_type) {
            $createLink_object = BASEFILE . "?process=admin_".OBJECTS_MODULE_SECTION."_create&object_type=".$media_type;
            $createLink_media_object=$createLink_object."&object_id=".$media_file_parts['filename'];
           
            $media_exist_in_database = "<a href=\"".$createLink_media_object."\" title=\"create an object in the database\" >";
            $media_exist_in_database=$media_exist_in_database. "<span class=\"glyphicon  glyphicon-exclamation-sign\" style=\"color: rgb(240, 20, 20);\" ></span></a>\n";
            $post_vars=array("object_id=".$media_file_parts['filename']);
            $object=  createNewObject($object_type, $post_vars, $system_data_classes);
            $object->changeID($media_file_parts['filename']);
            $media_title=$media_filename;
            
            $media_state="0";
            
        }
    
        else{
            $media_exist_in_database = "<span class=\"glyphicon  glyphicon-link\" style=\"color: rgb(20, 200, 20);\"></span>\n";
            $media_title=$object->title;
            $media_state="1";
        }
        
        
        
        $edit_glyphicon = "<span class=\"glyphicon  glyphicon-wrench\" ></span>\n";
        $editLink = $editLink_base . "&media_type=" . $media_type . "&media_id=" . $object->id;
        $editLinkButton = "<a href=\"" . $editLink . "\"  title=\"edit\">" . $edit_glyphicon . "</a>\n";

        $delete_glyphicon = "<span class=\"glyphicon  glyphicon-erase \" ></span>\n";
        $deleteLink = $deleteLink_base . "&media_type=" . $media_type . "&media_id=" . $object->id;
        $deleteLinkButton = "<a href=\"" . $deleteLink . "\" title=\"delete\" class=\"delete_confirm\">" . $delete_glyphicon . "</a>\n";
        
        
        ?>
                <tr>
                    <td scope="row" id="<?php echo $media_state; ?>"> <?php echo $media_exist_in_database; ?></td>
                    
                    <td scope="row" > <?php echo $media_title; ?></td>
                    <td class="nosort"><?php echo $editLinkButton ?></td>
          
                    <td class="nosort"><?php echo $deleteLinkButton ?></td>
                </tr>


        <?php
    $media_count+=1;    
    }
    ?>
        </tbody>
    </table>
            <?php
        }
        ?>
