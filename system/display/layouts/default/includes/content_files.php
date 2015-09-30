<div id="content_page_files">



<?php
$files_content_count=0;
$files_content_count+=count($content->files_uploads);
$files_content_count+=count($content->pages_file_links);
$files_content_count+=count($content->files_links_ftp);

if($files_content_count > 0){

?>
<h3><?php echo CONTENT_FILES ?></h3>
				
<ul >
		
<?php
foreach($content->files_uploads as $fileID=>$fileOBJ){
echo "<li>\n";
echo "<a href=\"".$fileOBJ->filename."\" target=_blank class=simple-popup>".$fileOBJ->title."</a>\n";
echo "</li>\n";
}

foreach($content->pages_file_links as $fileID=>$fileOBJ){
echo "<li>\n";
echo "<a href=\"".$fileOBJ->filename."\" target=_blank class=simple-popup>".$fileOBJ->title."</a>\n";
echo "</li>\n";
}

foreach($content->files_links_ftp as $fileID=>$fileOBJ){
echo "<li>\n";
echo "<a href=\"".$fileOBJ->filename."\" target=_blank class=simple-popup>".$fileOBJ->title."</a>\n";
echo "</li>\n";
}

?>

								
</ul>
			


<?php
} //$files_content_count fin
?>

</div>
