
<script src="system/webkits/tinymce/js/tinymce/tinymce.min.js"></script>
<?php

//superprint($object);




//$sources_data="";
$content_html_body="";
if ( isset($process_request_operation) and $process_request_operation=="edit") {

    $content_html_body_file = $media_file;
 
    if (is_file($content_html_body_file)) {
		
        $lines = file($content_html_body_file);
        $content_html_body = "";
        foreach ($lines as $line_num => $line) {
            if ($line != "") {
                $content_html_body.=trim($line);
                $content_html_body.="\n";
                
            }
        }
    }
}

//if ( isset($process_type) and $process_type=="create") {$content_html_body="new page";}

?>




<?php  if(!$object){ 
?>

<div class="panel panel-danger">
      <div class="panel-heading">
        <h3 class="panel-title">Warning!</h3>
      </div>
      <div class="panel-body">
          <P>
            This document is not linked to any object in the database.
        </p>
        
      </div>
</div>

<?php } ?>

<h3>Supression du formatage</h3>       
<textarea rows="3" name="format_sandbox" style="background : #eeeeee;width:99%">Espace copier-coller : si vous utilisez du contenu provenant de Word ou Open Office, copier votre texte ici avant de le coller dans l'&eacute;diteur  ci-dessous</textarea>
<br><br>


<!--CONTENU HTML -->
<h3>Corps de la page</h3>


<script>


tinymce.init({
    selector: "textarea.mceEditor",
    theme: "modern",
    relative_urls : true,
    plugins: [
         "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
         "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
         "save table contextmenu directionality emoticons template paste textcolor imagetools"
   ],
   
   image_advtab: true,
   toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor table",

   content_css: "css/content.css",
   toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
   style_formats: [
 
 			{
                            title: "Headers",
                            items: [
                                {title: "Header 1",format: "h1"},
                                {title: "Header 2",format: "h2"},
                                {title: "Header 3",format: "h3"},
                                {title: "Header 4",format: "h4"},
                                {title: "Header 5",format: "h5"},
                                {title: "Header 6",format: "h6"}
                            ]
                        },

			{title: 'simple-popup', selector: 'a', classes: 'simple-popup'}
    ]
 }); 




</script>





        	
          <textarea class="mceEditor" name="content_html_body" style="width:99%;" rows="50">
          <?php  echo $content_html_body; ?>
          </textarea>
        <!-- END edit content -->


