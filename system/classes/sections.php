<?php

class section extends blend {

    var $content; /* reservoir for links - links_Objs=reducced pages, process, sections */
    var $default;
    var $pool;
    var $meta = array(
        "description" => "",
        "keywords" => "",
        "author" => "www.reservoirlog.fr",
        "generator" => "reservoirlog 0.1",
        "google-site-verification" => ""
    );

    function section($title) {
        $this->type = "section";
        $this->setID();
        $this->setTitle($title);
        $this->initDocDate();
        $this->content = array();
    }

    function createContent() {
        return false;
    }

    function addContent($obj) {
        $obj->parent = $this->getFileName();
        $link = new link();
        $link->objectInit($obj);
        //unset($link->id);
        if ($this->default == "") {
            $this->default = $obj->id;
        }
        $this->content[$obj->id] = $link;
        //superprint($obj);
        $obj->save();
    }

    function updateContent($obj) {

        $link = new link();
        $link->objectInit($obj);
        unset($link->id);
        $this->content[$obj->id] = $link;
        $obj->save();
    }

    function getDefault() {
        //return default content link
        $keys = array_keys($this->content);
        if (isset($this->content[$this->default])) {
            return $this->content[$this->default];
        } else {
            return $this->content[$keys[0]];
        }
    }

    function setDefaultID($id = false) {

        if (isset($this->content[$id])) {
            // set default ID
            $this->default = $id;
        } elseif (count($this->content) > 0) {
            $ckeys = array_keys($this->content);
            $ckey = $ckeys[0];
            $this->default = $ckey;
        }
    }

    function setDefault($id) {

        if (isset($this->content[$id])) {
            // set default ID
            $this->default = $id;

            // move default obj to the top of the content
            $content_obj = $this->content[$id];

            $this->removeContent($id);
            $this->content = array_reverse($this->content);
            // be carrefull, do not use addContent()
            // addContent expect page/section.
            // here content_obj is a link 
            $this->content[$id] = $content_obj;
            $this->content = array_reverse($this->content);
        }
    }

    function removeContent($key) {
        $prop = "content";
        $this->arraykeyRemove($prop, $key);
    }

    function getContentLinkObj($id = "") {

        $count = count($this->content);
        if ($count == 0) {
            return false;
        }
        if (isset($this->content[$id])) {
            return $this->content[$id];
        } else {
            if (isset($this->content[$this->default])) {
                return $this->content[$this->default];
            } else {
                return false;
            }
        }
    }

    function loadContentObj($link_obj) {

        $filename = $link_obj->url;
        $content = file_load_object($filename);
        return $content;
    }

    function getContent($id = "") {

        // getContent() always returns a page or a process
        $link_obj = $this->getContentLinkObj($id);
        if (!$link_obj) {
            return false;
        }
        $content = $this->loadContentObj($link_obj);
        // check if $content is a section.
        // if true, load the default content of this section

        if ($content->type == "section") {
            $page = $content->getContent();
        } else {
            $page = $content;
        }

        return $page;
    }

    function delete() {

        // delete link in childs objects
        foreach ($this->content as $link) {
            $content = $this->loadContentObj($link);
            if (!is_object($content)) {
                continue;
            }
            $content->parent = "";
            superprint($content->title);
            superprint($content->parent);
            $content->save();
        }

        //delete link in parent
        if (is_file($this->parent)) {
            $parent = file_load_object($this->parent);
            $parent->removeContent($this->id);
            $parent->setDefaultID();
            $parent->save();
            //superprint($parent);
        }

        // delete section object
        $obj = $this->getFileName();
        if (is_file($obj)) {
            copy($obj, BACKUP_FOLDER . "/" . $this->id . ".obj");
            unlink($obj);
        }
    }
    
    
    function update_object_props($post_vars){
        $this->update_document_props($post_vars);
        //$this->update_design_props($post_vars);
    }

}

class site extends section {

    //var $layouts=array("default");
    //var $styles=array("default");

    function site($title) {
        $this->type = "site";
        $this->setID();
        $this->setTitle($title);
        $this->initDocDate();
        $this->content = array();
    }

    function delete() {
        return false;
    }
    
    
    function update_object_props($post_vars){
        $this->update_document_props($post_vars);
        //$this->update_design_props($post_vars);
    }

}
?>

