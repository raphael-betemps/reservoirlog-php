
   <script>

$(document).ready(function() {
    //$('#objects_list').dataTable();
    $('#objects_list').dataTable( { "aaSorting" : [[0]]} );
    
} );



</script>


<script src="system/webkits/bootstrap-3.3.4/js/jquery.dataTables.min.js"></script>
<script src="system/webkits/bootstrap-3.3.4/js/dataTables.bootstrap.min.js"></script>

<?php
//superprint($content_pack);
// convention for dirs : OBJECTS_FOLDER/object's class/
// and $content_process_page->classe == edited_objet->classe
if ($object_type) {

    $data_dir = OBJECTS_FOLDER . "/" . $object_type . "/";

    $data_files = dirToArray($data_dir, 1);
    
    $data_module_section=$content_pack["page"]->module["section"];
    
    
//superprint($data_files);
//superprint($content_page);
// the ID of each objects added later in the loop 
    $editLink_base = BASEFILE . "?process=admin_".$data_module_section."_edit";
   
    $deleteLink_base = BASEFILE . "?process=admin_".$data_module_section."_update&process_request_operation=delete";

    $createLink_base = BASEFILE . "?process=admin_".$data_module_section."_create&object_type=".$object_type;
    $create_glyphicon = "<span class=\"glyphicon  glyphicon-plus\" ></span>\n";
    $createLinkButton = "<a href=\"" . $createLink_base . "\" title=\"create a new ";
    $createLinkButton.= $object_type."\">" . $create_glyphicon . "</a>\n";
    ?>

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


    <table cellpadding="0" cellspacing="0" border="0"  class="table table-striped table-hover" id="objects_list">


        <colgroup>
            <col class="col-xs-1">
            <col class="col-xs-8">
            <col class="col-xs-1">
            <col class="col-xs-1">
           
        </colgroup>

        <thead>
            <tr>
                <th><?php echo $createLinkButton ?></th>
                <th><?php echo $object_type; ?>  title</th>
                <th>edit</th>
               
                <th>delete</th>

            </tr>
        </thead>


        <tbody>

    <?php
    foreach ($data_files as $key => $object_filename) {

        $obj_file_parts = pathinfo($object_filename);
        if ($obj_file_parts['extension'] != "obj") {
            continue;
        }
        $object_file = $data_dir . $object_filename;
        $object = file_load_object($object_file);
        
        //superprint($object_file);
        //superprint($object);
        
        if (!isset($object->type) or $object->type != $object_type) {
            continue;
        }


        $edit_glyphicon = "<span class=\"glyphicon  glyphicon-wrench\" ></span>\n";
        $editLink = $editLink_base . "&object_type=" . $object->type . "&object_id=" . $object->id;
        $editLinkButton = "<a href=\"" . $editLink . "\"  title=\"edit\">" . $edit_glyphicon . "</a>\n";

        $delete_glyphicon = "<span class=\"glyphicon  glyphicon-erase \" ></span>\n";
        $deleteLink = $deleteLink_base . "&object_type=" . $object->type . "&object_id=" . $object->id;
        $deleteLinkButton = "<a href=\"" . $deleteLink . "\" title=\"delete\" class=\"delete_confirm\">" . $delete_glyphicon . "</a>\n";
        
        
        ?>
                <tr>
                    <td scope="row" id="<?php echo $object->type . "_" . $key; ?>"><?php echo $key; ?></td>
                    <td> <?php echo $object->getTitle(); ?></td>
                    <td class="nosort"><?php echo $editLinkButton ?></td>
          
                    <td class="nosort"><?php echo $deleteLinkButton ?></td>
                </tr>


        <?php
    }
    ?>
        </tbody>
    </table>
            <?php
        }
        ?>
