

<!-- album /scrapbook de la page -->
<?php
if(isset($content->album) and count($content->album)>0){
?>


<!--<h3>Album (Scrapbook) de la page </h3>-->
<div class="content_album row">

<?php

foreach($content->album as $key=>$image){
	$images_files=$image->getFiles();
	if(!is_file($images_files["im"])){continue;}
        echo " <div class=\"col-xs-6 col-md-4\">\n";
       
	echo $image->getBasicSrcThLink("_blank","thumbnail")."\n";
        echo "</div>\n";
}
?>

</div>




<?php } ?>

<script>

$('.content_album').magnificPopup({
  delegate: 'a', // child items selector, by clicking on it popup will open
  type: 'image',
  // other options


  gallery:{
    enabled:true
  }

});


</script>