<?php

//layouts and styles
$system_layouts=array("default");
$system_styles=array("default");

//admin modules vars

define("OBJECTS_MODULE_SECTION","objects");
define("MEDIA_MODULE_SECTION","media");
define("DESIGN_MODULE_SECTION","design");

$system_modules=array("admin","contact","search","user");
$system_modules_sub_sections=array(OBJECTS_MODULE_SECTION,MEDIA_MODULE_SECTION,DESIGN_MODULE_SECTION);



//objects types
$system_data_classes=array("site","section","process","page","link","image","file");

//media types
$system_data_media=array("image","file","page");

//objects properties
$system_data_levels=array("www","user","admin");
$system_data_process_status=array("interface","core");

