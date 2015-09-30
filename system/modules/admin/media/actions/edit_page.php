<?php

//superprint($media_file);
//exit;
if (isset($post_vars["content_html_body"]) and is_file($media_file)) {
    $html_code = $post_vars["content_html_body"];
    fileWriteHtm($media_file, $html_code);
}

?>