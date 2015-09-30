<?php

class process extends blend {

    /**
     * Special pages to launch system/process
     * php files, so you can use the CMS to
     * extend admin, services or make plugin
     */
    //var $parent=false or $parent=xxxx.obj; // in use or not			
    var $parent = false;
    //module vars to build path to module file
    // and set process id
    var $module = array("name" => " ", "section" =>" ", "page" => " ");

    function process($title) {
        $this->type = "process";
        $this->setID();
        $this->setTitle($title);
        $this->initDocDate();
        $this->status = "interface"; //if  status="core", process is not shown menu
        //$this->setMonthDir();
    }

    function getProcessFile() {

        $file = $this->getProcessFileName();


        if (is_file($file)) {
            return $file;
        } else {
            return SAMPLE_410;
        }
    }

    function getProcessFileName() {

        $file = MODULES_FOLDER . "/";

        if ($this->module["name"] != "") {
            $file.=$this->module["name"] . "/";
        }
        if ($this->module["section"] != "") {
            $file.=$this->module["section"] . "/";
        }
        if ($this->module["page"] != "") {
            $file.=$this->module["page"];
        }
        $file.=".php";

        return $file;
    }

    function setProcessID() {
        $ID = "";
        if ($this->module["name"] != "") {
            $ID.=$this->module["name"] . "_";
        }
        if ($this->module["section"] != "") {
            $ID.=$this->module["section"] . "_";
        }
        if ($this->module["page"] != "") {
            $ID.=$this->module["page"];
        }

        $this->changeID($ID);
    }

    function getContentFile() {
        $phpfile = $this->getProcessFile();
        return $phpfile;
    }

    /* UPDATE OPERATION */

    //extends update from class document

    
    function update_document_props($post_vars){
        
        parent::update_document_props($post_vars);
        //superprint($post_vars);
		//exit;
        if (isset($post_vars["object_status"])) {
            $this->status = $post_vars["object_status"];
        }
        
    }
    
    function update_design_props($post_vars) {

        
        if (isset($post_vars["object_module_name"])) {
            $this->module["name"] = $post_vars["object_module_name"];
        }

        if (isset($post_vars["object_module_section"])) {
            $this->module["section"] = $post_vars["object_module_section"];
        }
        if (isset($post_vars["object_module_page"])) {
        $this->module["page"] = $post_vars["object_module_page"];
        }
        
        //AT THE END , after setting MODULE
        if( isset($post_vars["object_id"]) ){
           
            $this->setProcessID($post_vars["object_id"]);
        }
        
    }
    
    function update_object_props($post_vars){
        $this->update_document_props($post_vars);
        
    if( isset($post_vars["process_files_update"]) or $post_vars["process_request_operation"] == "create"){
        $this->update_design_props($post_vars);
    }
        
        
    }

    function delete() {

        if (is_file($this->parent)) {
            $parent = file_load_object($this->parent);
            $parent->removeContent($this->id);
            $parent->setDefaultID();
            $parent->save();
            //superprint($parent);
        }

        $obj = $this->getFileName();


        if (is_file($obj)) {
            copy($obj, BACKUP_FOLDER . "/" . $this->id . ".obj");
            unlink($obj);
        }
    }

}

class page extends blend {

    /**
     *
     * classic html pages with embeded .html
     * body. Handles titles, heading, images, etc...
     * 
     */
    //var $parent=false or $parent=xxxx.obj; // in use or not			
    var $parent = false;
    var $messages; // embeded messaging (for futur blog)
    //
    //linked media
    var $images;
    var $files;

    // linked pages,video,music.
    //var $content=array("pages"=>"","video"=>"","music"=>""); 
    //var $body; //html file

    function page($title) {
        $this->type = "page";
        $this->setID();
        $this->setTitle($title);
        $this->initDocDate();
        $this->setMonthDir();
    }

    function getContentFile() {
        //$htm=MEDIA_FOLDER."/".$this->type."/".$this->id.".htm";
        $htm = $this->getContentFileName();
        if (is_file($htm)) {
            return $htm;
        } else {
            return SAMPLE_404;
        }
    }

    function getContentFileName() {
        $htm = MEDIA_FOLDER . "/" . $this->type . "/" . $this->id . ".htm";
        return $htm;
    }

    function createContent() {
        $htm = $this->getContentFileName();
        if (!is_file($htm)) {
            copy(SAMPLE_HTM, $htm);
            chmod($htm, 0777);
        }
    }

    function delete() {

        if (is_file($this->parent)) {
            $parent = file_load_object($this->parent);
            $parent->removeContent($this->id);
            $parent->setDefaultID();
            $parent->save();
            //superprint($parent);
        }

        $obj = $this->getFileName();
        $htm = $this->getContentFile();

        if (is_file($htm)) {
            copy($htm, BACKUP_FOLDER . "/" . $this->id . ".htm");
            unlink($htm);
        }

        if (is_file($obj)) {
            copy($obj, BACKUP_FOLDER . "/" . $this->id . ".obj");
            unlink($obj);
        }
    }

    
    function update_object_props($post_vars){
        $this->update_document_props($post_vars);
        //$this->update_design_props($post_vars);
    }
    
    function update_media_props($post_vars) {

        //parent::update_document_props($post_vars);
        //superprint($post_vars["content_html_body"]);
        
        if(isset($post_vars["content_html_body"]) ){
			$html_code=$post_vars["content_html_body"];
			$htm_file = $this->getContentFile();
			fileWriteHtm($htm_file, $html_code) ;
			}
			
        if(isset($post_vars["document_header"]) ){
			$document_header=$post_vars["document_header"];
			// setDocumentHeader from class "document";
			$this->setDocumentHeader($document_header);			
			}
    }

    
}

?>
