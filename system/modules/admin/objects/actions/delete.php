<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
superprint($_POST);
superprint($_GET);

include("system/include/admin/filters/http_sent_vars.php");
include("system/include/admin/filters/http_get_vars.php");
include("system/include/admin/filters/http_post_vars.php");
superprint($object_id);