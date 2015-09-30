<?php

/*
 * ALL theese functions are made to build
 * the $content_pack
 * $content_pack is a hierachical tree
 * site = root
 * page or process = last leave
 * 
 * $content_pack = [site,embeded section(s),page]
 * 
 */

function loadDefaultSite($content_pack, $load_default = 1) {
    
    $content_siteFileObj = OBJECTS_FOLDER . "/site/site.obj";
    $content_site = file_load_object($content_siteFileObj);
    $content_pack["site"] = $content_site;
    
    $default=$content_site->getDefault();
   
    
    if ($load_default == 1 and  !isset($content_pack["page"])) {
        $content_pack["page"] = $content_site->getContent();
    }
    return $content_pack;
}

function getSample_404(){
	
	    $content_page = new page("page not found in database");
        $content_page->setType("blank");
        $content_page->body = SAMPLE_404;
        $content_siteFileObj = OBJECTS_FOLDER . "/site/site.obj";
        $content_page->parent=$content_siteFileObj;
        return $content_page;
	
	}

function getBlendObjectFromID($object_id,$object_type){
    
    $object_file = OBJECTS_FOLDER . "/".$object_type."/" . $object_id . ".obj";
    $object=file_load_object($object_file);
    if (!is_object($object)) {
        
        $content_page = getSample_404();
        return $content_page;
    }
    else{
        return $object;
    }  
    
}

function getBlendObjectFromURL($object_file){
    
    $object=file_load_object($object_file);
    if (!is_object($object)) {
        
        $content_page = getSample_404();
        return $content_page;
    }
    else{
        return $object;
    }  
    
}



function loadRequestPage($page_type, $page_id,$content_pack) {

    $content_page = getBlendObjectFromID($page_id,$page_type);
    //superprint($content_page);
    if(is_file($content_page->parent)){
        $content_pack=loadSection_up($content_page->parent,$content_pack);
    }
    else{
        $content_pack=loadDefaultSite($content_pack);
    }
    $content_pack["page"] = $content_page;
    return $content_pack;
}


function loadSection_up($object_file,$content_pack){
    //superprint("load section up");
    $content_section = file_load_object($object_file);
    if($content_section->type =="section" or $content_section->type =="site"){
        
            if(is_file($content_section->parent)){
            $content_pack=loadSection_up($content_section->parent,$content_pack);
        }
        $content_pack[$content_section->id] = $content_section;
    }
    return $content_pack;
    
}

function loadSection_close_loop($object_file,$content_pack){
	//superprint("loadsection close loop");
	
    $object=getBlendObjectFromURL($object_file);
    if ($object->type !="section") {
        
        $content_pack["page"]=$object;
        return $content_pack;
    }
    
    
    else{
		$default=$object->getDefault();
		
		if($default->type == "section"){
				$content_page = getSample_404();
				$content_pack["page"]=$content_page;
				return $content_pack;
			}
		else{
				$content_page=$object->getContent();
				$content_pack[$object->id] = $object;
				$content_pack["page"]=$content_page;
				return $content_pack;
			}
    }  
	
	}

function loadRequestSection($section_id, $content_pack) {

    $content_section = getBlendObjectFromID($section_id,"section");

	if($content_section->type != "section"){
		$content_pack=loadDefaultSite($content_pack,0);
		$content_pack["page"]=$content_section;
		return $content_pack;
		}

    if (isset($content_section->parent) and is_file($content_section->parent)) {
        $content_pack = loadSection_up($content_section->parent, $content_pack);
        $content_pack[$content_section->id] = $content_section;
        
    }
    
    
    $default=$content_section->getDefault();
    
    
    if( $default->type == "section"){
		
		$content_pack = loadSection_close_loop($default->url, $content_pack);
		
		return $content_pack;
		}
	else{
		$page=$content_section->getContent($default->id);
		$content_pack["page"]=$page;
		return $content_pack;
		}
	
    
}


 
