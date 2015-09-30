


<?php

//superprint($content_pack);
// convention for dirs : OBJECTS_FOLDER/object's class/
// and $content_process_page->classe == edited_objet->classe

$data_dir=OBJECTS_FOLDER."/".$content_page->classe."/";

//link to the edit process. 
// All the admin's process are named with the following convention:
// (module)_(classe)_(operation) > ex: admin_site_edit, admin_page_create
// so it's possible to build generic links and edit pages
// 
// the ID of each objects added later in the loop 
$editLink_base=BASEFILE."?process=admin_".$content_page->classe."_edit";
$designLink_base=BASEFILE."?process=admin_".$content_page->classe."_design";
//$deleteLink_base=BASEFILE."?process=admin_".$content_page->classe."_delete";
$deleteLink_base=BASEFILE."?process=admin_".$content_page->classe."_update&process_request_operation=delete";

$createLink_base=BASEFILE."?process=admin_".$content_page->classe."_create";
$create_glyphicon="<span class=\"glyphicon  glyphicon-plus\" ></span>\n";
$createLinkButton="<a href=\"".$createLink_base."\" title=\"create a new process\">".$create_glyphicon."</a>\n";


$data_files=dirToArray($data_dir,1);
//superprint($data_files);
//superprint($content_page);

?>

<table cellpadding="0" cellspacing="0" border="0"  class="table table-striped table-hover" id="objects_list">

    
        <colgroup>
        <col class="col-xs-1">
        <col class="col-xs-8">
        <col class="col-xs-1">
         <col class="col-xs-1">
          <col class="col-xs-1">
      </colgroup>
    
        <thead>
        <tr>
          <th><?php echo $createLinkButton ?></th>
          <th>title</th>
          <th>edit</th>
           <th>design</th>
            <th>delete</th>
    
        </tr>
      </thead>
      
  
      <tbody>
          
<?php 
foreach ($data_files as $key=>$object_filename){
    
$obj_file_parts = pathinfo($object_filename);
if($obj_file_parts['extension'] != "obj"){continue;}
$object_file= $data_dir.$object_filename;
$object=file_load_object($object_file);   
if(!$object){continue;}


$edit_glyphicon="<span class=\"glyphicon  glyphicon-wrench\" ></span>\n";
$editLink=$editLink_base."&object_type=".$object->type."&object_id=".$object->id;
$editLinkButton="<a href=\"".$editLink."\"  title=\"edit\">".$edit_glyphicon."</a>\n";


$design_glyphicon="<span class=\"glyphicon  glyphicon-pencil\" ></span>\n";
$designLink=$designLink_base."&object_type=".$object->type."&object_id=".$object->id;
$designLinkButton="<a href=\"".$designLink."\"  title=\"design\">".$design_glyphicon."</a>\n";



$delete_glyphicon="<span class=\"glyphicon  glyphicon-erase \" ></span>\n";
$deleteLink=$deleteLink_base."&object_type=".$object->type."&object_id=".$object->id;
$deleteLinkButton="<a href=\"".$deleteLink."\" title=\"delete\">".$delete_glyphicon."</a>\n";


?>
        <tr>
          <td scope="row" id="<?php echo $object->type."_".$key; ?>"><?php echo $key; ?></td>
          <td> <?php echo $object->getTitle(); ?></td>
          <td class="nosort"><?php echo $editLinkButton ?></td>
          <td class="nosort"><?php echo $designLinkButton ?></td>
          <td class="nosort"><?php echo $deleteLinkButton ?></td>
        </tr>
  
      
<?php
}
?>
</tbody>
</table>
