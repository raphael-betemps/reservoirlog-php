<?php

class blend extends document {

    //blend = canvas form page,section and site
    //blend can have nested content/sub content
    //$content=array(0,1,2,3,4,5,6); //test array
    var $parent;
    //var $parent_id;
    //var $parent_type;
    var $layout;
    var $style;

    function blend($title) {
        $this->type = "blend";
        $this->setID();
        $this->setTitle($title);
        $this->initDocDate();
        //$this->setMonthDir();
    }

    function arraykeyRemove($prop, $key) {
        //generic function
        if (isset($this->$prop)) {
            $content = $this->$prop;
        } else {
            return false;
        }
        if (isset($content[$key])) {
            $tmp = array();

            foreach ($content as $ckey => $cvalue) {
                if ($ckey == $key) {
                    continue;
                } else {
                    $tmp[$ckey] = $cvalue;
                }
            }
            $this->$prop = $tmp;
        } else {
            return false;
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

    function getlayoutFile() {
        $layout_file = LAYOUTS_FOLDER . "/" . $this->layout . "/index.php";
        return $layout_file;
    }

    /*
    function includeLayout() {
        $layout_file = $this->getlayoutFile();
        $default=LAYOUTS_FOLDER . "/default/index.php";
        if (is_file($layout_file)) {
            include($layout_file);
        }
        elseif(is_file($default)){
            include($default);
        } else {
            include(SAMPLE_404);
            return false;
        }
    }
    */
    // sauve le fichier objet
    function save() {
        $filename = $this->getFileName();
        //if(is_file($filename)){$this->backup($filename);}
        $file = fopen($filename, "w+");
        fputs($file, $this->pack());
        fclose($file);
        // BUGBOX
        unset($this->pack);
        chmod($filename, 0777);
    }

}

?>
