<?php

class link {

    var $url;
    var $title;
    var $target;
    var $type; // page (html int /ext), alias  or process
    var $parent;
    var $status; //for process : interface or core

    function link() {
        $this->title = "link";
    }

    function objectInit($obj) {

        $this->title = $obj->title;
        $this->type = $obj->getType();
        $this->id = $obj->getID();
        $this->parent = $obj->parent;
        $this->url = $obj->getFileName();
        if (isset($obj->status)) {
            $this->status = $obj->status;
        }
    }

    function getTitle() {

        return htmlentities($this->title, ENT_NOQUOTES, 'iso-8859-1');
        //POUR FAIRE LE CONTRAIRE:
        //convertir les &eacute; en é sans toucher aux balises HTML
        //echo html_entity_decode($chaine, ENT_NOQUOTES, "UTF-8");
    }

    function setTitle($title) {
        $this->title = stripslashes($title);
    }

}

class element {

    var $id;
    var $type;
    protected $pack;

    function element() {
        $this->setID();
        $this->type = "element";
    }

    function gzpack() {
        $str = serialize($this);
        $this->pack = gzcompress($str, 1);
        return $this->pack;
    }

    function pack() {
        $this->pack = serialize($this);
        return $this->pack;
    }

    function getCleanString($string) {
        $string = strip_tags($string);
        return stripslashes($string);
    }

    function getSafeString($string) {

	$string = preg_replace('#\&[^;]+\;#', '', $string);
	$search = array ('@[éèêëÊË]@i','@[àâäÂÄ]@i','@[îïÎÏ]@i','@[ûùüÛÜ]@i','@[ôöÔÖ]@i','@[ç]@i','@[ ]@i','@[^a-zA-Z0-9_]@');
	$replace = array ('e','a','i','u','o','c','_','');
	return preg_replace($search, $replace, $string);
		
    }
    
    function display() {
        echo "<pre>";
        print_r($this);
        echo "</pre>";
    }

    function setID() {
        $this->id = date("U") . "." . uniqid();
    }

    function changeID($id) {
        $this->id = $id;
    }

    function getID() {
        return $this->id;
    }

    function getType() {
        return $this->type;
    }

    function setType($type) {
        $this->type = $type;
    }

}

class document extends element {

    /** properties from element
      var $type;
      var $id;
      var $pack;
     */
    var $title;
    var $document_header;
    var $meta = array(
        "description" => "",
        "keywords" => "",
        "author" => "www.reservoirlog.fr");
    protected $date;
    var $level;

    /** status :
     * core and service in data/system/
     * standard in data/site/
     * 
     * standard=normal web page
     * service=system operation visible in menu
     * core=system operation, not visible
     * 
     */
    var $status = "standard";
    // sub folder with month-date: where to save document in DATA_FOLDER.
    protected $monthdir;

    function document($title) {
        $this->type = "document";
        $this->id = date("U");
        $this->setTitle($title);
        $this->initDocDate();
        $this->status = "standard";
        $this->setMonthDir();
    }

    function getTitle() {

        return htmlentities($this->title, ENT_NOQUOTES, 'iso-8859-1');
        //POUR FAIRE LE CONTRAIRE:
        //convertir les &eacute; en é sans toucher aux balises HTML
        //echo html_entity_decode($chaine, ENT_NOQUOTES, "UTF-8");
    }

    function setTitle($title) {
        $this->title = stripslashes($title);
    }

    function getMetaDescription() {
        return htmlentities($this->meta["description"], ENT_NOQUOTES, 'iso-8859-1');
    }

    function setMetaDescription($description) {
        $description = strip_tags($description, '<a></a><b><br><p></p><ul></ul><li></li>');
        $this->meta["description"] = stripslashes($description);
    }

    function getDocumentHeader() {
        return htmlentities($this->document_header, ENT_NOQUOTES, 'iso-8859-1');
    }

    function setDocumentHeader($document_header) {
        $document_header = strip_tags($document_header, '<a></a><b><br><p></p><ul></ul><li></li>');
        $this->document_header = stripslashes($document_header);
    }

    function initDocDate() {
        $this->date = date("N d m Y");
    }

    function getDocDate() {
        $days = explode(",", DAYS);
        $months = explode(",", MONTHS);
        if ($this->date == "") {
            $this->initDocDate();
        }
        $date = explode(" ", $this->date);
        $day = $date[0];
        if (!is_numeric($day)) {
            $day = 0;
        }
        //$date_fr=array($days[$day],$date[1],$months[$date[2]-1],$date[3]);
        $date_fr = array($days[$date[0] - 1], $date[1], $months[$date[2] - 1], $date[3]);
        return $date_fr;
    }

    function displayDocDate() {
        $date_fr = $this->getDocDate();
        echo implode(" ", $date_fr);
    }

    // month_dir, for saving all extended classes objects and medias
    function getMonthDir() {
        return date("Y_m");
    }

    function setMonthDir() {
        $this->monthdir = $this->getMonthDir();
    }

    /** $_POST update functions
     * 
     */
    function update_document_props($post_vars) {
        // superprint($post_vars);
        if (isset($post_vars["object_title"])) {
            $this->setTitle($post_vars["object_title"]);
        }
        if (isset($post_vars["object_document_header"])) {
            $this->setDocumentHeader($post_vars["object_document_header"]);
        }
        if (isset($post_vars["object_level"])) {
            $this->level = $post_vars["object_level"];
        }

        // for pages and section
        if (isset($post_vars["object_layout"])) {
            $this->layout = $post_vars["object_layout"];
        }
        if (isset($post_vars["object_style"])) {
            $this->style = $post_vars["object_style"];
        }

        if (isset($post_vars["object_meta"]) and is_array($post_vars["object_meta"])) {

            $this->meta["description"] = $post_vars["object_meta"]["description"];
            $this->meta["keywords"] = $post_vars["object_meta"]["keywords"];
            $this->meta["author"] = $post_vars["object_meta"]["author"];
        }
    }

}

// #########################################################################
?>
