
<?php 

$creation_steps_functional_class="";
if($process_request_operation !="create"){ 
    
    $creation_steps_functional_class=" class=\"disabled\"";
    
}
?>    

<div>

  <!-- Nav tabs -->
  <ul id="creation_steps"  class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#properties" aria-controls="properties" role="tab" data-toggle="tab">1 Bases properties</a></li>
    <li role="presentation" <?php echo $creation_steps_functional_class; ?> ><a href="#functional" aria-controls="functional" role="tab" data-toggle="tab">2 Fonctionnal components </a></li>
  
  </ul>

  
  
  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="properties">
        <!--Bases properties -->
    
        <p></p>
        <?php
        include("system/include/forms/objects/properties/document_title.php");
        include("system/include/forms/objects/properties/document_header.php");
        include("system/include/forms/objects/properties/document_layout.php");
        include("system/include/forms/objects/properties/document_style.php");
        include("system/include/forms/objects/properties/document_level.php");
        include("system/include/forms/objects/properties/process_status.php");

  
        ?>
 
    </div>
      
    
      
<?php if($process_request_operation=="create"){ ?>      
      
<!-- Fonctionnal components -->
 <div role="tabpanel" class="tab-pane" id="functional">
        
    
    
  <p></p>
   
<div class="panel panel-danger">
      <div class="panel-heading">
        <h3 class="panel-title">Be careful!</h3>
      </div>
      <div class="panel-body">
          <P>
              <strong>The properties below are fonctionnals components.</strong> They are used by the 
        sytem to find and load the PHP process and database object files.
        </p>
        
       
     
      <div class="checkbox">
        <label>
          <input type="checkbox" id="process_files_update" name="process_files_update" value="">check this if you want to update process files
        </label>
      </div>
        
        
      </div>
</div>
     
        
        <?php
        
        
        include("system/include/forms/objects/properties/process_module.php");
  
        ?>

  
    </div>
  </div>

</div>

<?php } ?>