<!-- album /scrapbook de la page -->
<?php
if(isset($content->images) and count($content->images)>0 and $_SESSION['user_level'] > 5){
?>


<!--<h3>Album (Scrapbook) de la page </h3>-->
<div class="content_album_thumbs_edit">

<?php
//echo "<h3>Images</h3>\n";




foreach($content->images as $key=>$image){
    
    	$imgfiles=$image->getFiles();
		if(!is_file($imgfiles["im"])){
			$clean_tank=true;
			//echo $clean_tank;
			continue;
		}
    
    	$imgEditLink=getGalleryEditURL("edit",$content,$image->name);
		echo "<a href=\"".$imgEditLink."\" class=\"simple-popup\" alt=\"".$imgfiles["im"]."\">";
		echo "<img src=\"".$imgfiles["th"]."\"  id=\"".$image->name."\" />\n";
		echo "</a>\n";
    
	//echo $image->getBasicSrcThLink()."\n";
}
?>

</div>

<?php } ?>


