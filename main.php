<?php

/** libs */
include("system/config/const.php");
include("system/include/libs/bases.php");
include("system/include/libs/classes.php");
include("system/include/libs/boot.php");
include("system/include/libs/menus.php");

//include("system/config/install.php");exit;

/*
 * loading site object
 * and requested content 
 */
 
include("boot.php");

//include layout
$layout_file = $content_pack["page"]->getlayoutFile();
$layout_default = LAYOUTS_FOLDER . "/default/index.php";


if (is_file($layout_file)) {
    include($layout_file);
} elseif (is_file($layout_default)) {
    include($layout_default);
} else {
    include(SAMPLE_404);
    return false;
}
?>

