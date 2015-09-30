<?php

function superprint($objet) {
    if (isset($objet)) {
        echo "<pre>";
        print_r($objet);
        echo "</pre>";
    }
}

function getObjBasesFormEdit($obj) {
    $form = "";
    foreach ($obj as $key => $value) {

        $form.="<label>" . $key . "</label>\n";
        $form.= "<input type=\"text\" id=\"" . $key . "\" value=\"" . $value . "\">\n";
    }
    return $form;
}

function file_load_object($file) {
    //superprint(" --- LOADING ".$file);
    if (is_file($file)) {

        $obj = unserialize(implode("", file($file)));
        return $obj;
    } else {
        return false;
    }
}

function fileSaveObject($obj, $filename) {
    $file = fopen($filename, "w+");
    fputs($file, $obj->pack());
    fclose($file);
}

function fileWriteHtm($filename, $data) {

    $html = stripslashes($data);
    $file = fopen($filename, "w+");
    //echo $txt;
    fputs($file, $html);
    fclose($file);
}

function fileWriteTxt($filename, $data) {
    $txt = stripslashes($data);
    //echo $filename;
    $file = fopen($filename, "w+");
    fputs($file, $txt);
    fclose($file);
    chmod($filename, 0777);
}

function mkRecursiveDirs($dirName) {
    $dirs = explode('/', $dirName);
    $dir = '';
    foreach ($dirs as $part) {
        $dir.=$part . '/';
        if (!is_dir($dir) && strlen($dir) > 0) {
            mkdir($dir);
            chmod($dir, 0777);
        }
    }
}

function dirToArray($dir, $level = 0, $exclude = "") {

    //recursive function if $level !=0
    // if level ==1 , only scan given $dir
    if (!is_dir($dir)) {
        return false;
    }
    $result = array();
    $cdir = scandir($dir);
    foreach ($cdir as $key => $value) {

        if (is_dir($dir . DIRECTORY_SEPARATOR . $value) and $level === 1) {
            continue;
        }

        if (!in_array($value, array(".", "..", $exclude))) {

            if (is_dir($dir . DIRECTORY_SEPARATOR . $value) and $level === 0) {
                $result[$value] = dirToArray($dir . DIRECTORY_SEPARATOR . $value, $level, $exclude);
            } else {
                $result[] = $value;
            }
        }
    }
    return $result;
}

function array_pushTop($input_array, $array_value) {
    $result = array_reverse($input_array);
    $result = array_merge($result, $array_value);
    $result = array_reverse($result);
    return $result;
}

function array_pushTop_newvalue($input_array, $value) {
    $result = array_reverse($input_array);
    array_push($result, $value);
    $result = array_reverse($result);
    return $result;
}

function createNewObject($object_type, $post_vars, $system_data_classes, $object_save = 0) {


    if (!$object_type) {
        return false;
    }
    if (!in_array($object_type, $system_data_classes)) {
        return false;
    }


    switch ($object_type) {



        case "page" :
            $object = new page("new page");
            $object->update_document_props($post_vars);
            if ($object_save == 1) {
                $object->createContent();
                $object->save();
            }

            break;

        case "process" :

            $object = new process("new process");
            $object->update_document_props($post_vars);
            $object->update_design_props($post_vars);
            if ($object_save == 1) {
                $object->save();
            }
            break;

        case "section" :
            $object = new section("new section");
            $object->update_document_props($post_vars);
            if ($object_save == 1) {
                $object->createContent();
                $object->save();
            }
            break;
            
        case "image" :
            $object = new image("new image");
            $object->update_document_props($post_vars);
            if ($object_save == 1) {
                $object->save();
            }

            break;
            
        case "file" :
            $object = new file("new file");
            $object->update_document_props($post_vars);
            if ($object_save == 1) {
                $object->save();
            }

            break;  

        default:
            break;
    }


    return $object;
}

?>
