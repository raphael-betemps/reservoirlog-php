<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class media extends element {

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
// sub folder with month-date: where to save document in DATA_FOLDER.
//protected $monthdir;

    var $url;
    var $extension;

    function media($title) {
        $this->type = "media";
        $this->id = date("U");
        $this->setTitle($title);
        $this->initDocDate();
//$this->setMonthDir();
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
        if (isset($post_vars["object_meta"]) and is_array($post_vars["object_meta"])) {

            $this->meta["description"] = $post_vars["object_meta"]["description"];
            $this->meta["keywords"] = $post_vars["object_meta"]["keywords"];
            $this->meta["author"] = $post_vars["object_meta"]["author"];
        }
    }

    function getPath() {
        $path = OBJECTS_FOLDER . "/" . $this->type;
        return $path;
    }

    function getFileName() {
        $file = $this->getPath() . "/" . $this->id . ".obj";
        return $file;
    }

// sauve le fichier objet
    function save() {
        $filename = $this->getFileName();
        $file = fopen($filename, "w+");
        fputs($file, $this->pack());
        fclose($file);
        unset($this->pack);
        chmod($filename, 0777);
    }

    function getSafeUploadFileName($upload_filename) {
        $filePathInfos = pathinfo($upload_filename);
        $exploded_filePathInfos = explode(".", $filePathInfos["basename"]);
        $str = array_shift($exploded_filePathInfos);
        $str = $this->getSafeString($str);
        
        $extension=$filePathInfos["extension"];
        $filename=$str . "." .$extension;
        return array($str,$extension,$filename);
    }
    
    
    function getContentFile() {
        //$htm=MEDIA_FOLDER."/".$this->type."/".$this->id.".htm";
        $filename = $this->getContentFileName();
        if (is_file($filename)) {
            return $filename;
        } else {
            return false;
        }
    }

    function getContentFileName() {
        $filename = MEDIA_FOLDER . "/" . $this->type . "/" . $this->id .".".$this->extension;
        return $filename;
    }
    
    
    function init_from_upload_filename($upload_filename){
        
        $parts=$this->getSafeUploadFileName($upload_filename);
        $this->setID($parts[0]);
        $this->extension=$parts[1];
    }
    

}

class image extends media {

    var $thumbnail_url = "";

    function image($title) {
        $this->type = "image";
        $this->id = date("U");
        $this->setTitle($title);
        $this->initDocDate();
    }

    function getImageSrc() {
        return "<img src=\"" . $this->url . "\" >\n";
    }

    function delete() {

        $obj = $this->getFileName();
        $img = $this->getFileName();

        if (is_file($img)) {
            copy($img, BACKUP_FOLDER . "/" . $this->id . ".".$this->extension);
            unlink($img);
        }

        if (is_file($obj)) {
            copy($obj, BACKUP_FOLDER . "/" . $this->id . ".obj");
            unlink($obj);
        }
    }

}

class file extends media {

    var $thumbnail_url = "";

    function file($title) {
        $this->type = "image";
        $this->id = date("U");
        $this->setTitle($title);
        $this->initDocDate();
    }

    function getHttpLink() {
        return "<a href=\"" . $this->url . "\" target=\"_blank\">" . $this->getTitle() . "</a>\n";
    }

    function delete() {
        return false;
    }

}
