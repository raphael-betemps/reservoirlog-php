<?php

/** BOOT STAGE 1   :
 * 
 * init $content_pack feed $content_pack with a blank page
 *  
 */

$content_pack = array();


/** BOOT STAGE 2  : HTTP GET VARS and init vars  
 * compare $_GET with what expected.
 * regular request = only 1 regular object with an ID 
 */

$http_regular_types = array("section", "process", "page");
$http_regular_request=array();

foreach($http_regular_types as $regular_key){
    if(isset($_GET[$regular_key])){
        $http_regular_request["type"]=$regular_key; 
        $http_regular_request["id"]=$_GET[$regular_key];
    }    
}
//superprint($http_regular_request);

if (count($http_regular_request) == 0){
	$http_regular_request["type"]="site";
        $http_regular_request["id"]="site";
        $content_pack=loadDefaultSite($content_pack);
} 

else{

    switch ($http_regular_request["type"]) {
        case "process":
            //superprint("load process");
            $content_pack=loadRequestPage("process",$http_regular_request["id"],$content_pack);
            break;
        case "page":
            $content_pack=loadRequestPage("page",$http_regular_request["id"],$content_pack);
            break;
        case "section":
            $content_pack=loadRequestSection($http_regular_request["id"],$content_pack);
            break;

        case "site":
            $content_pack=loadDefaultSite($content_pack);
            break;
        default:
            break;
    }

}



