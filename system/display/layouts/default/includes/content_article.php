
<div id="content_article">

<h2><?php echo $content->title; ?></h2>

<?php
if($content->description != ""){

echo "\n<span id=\"content_page_article_chapo\">".$content->description."</span>\n";
}


?>

<?php  include($content->getFile());?>

</div>