<?php


function displaySideMenuBootstrap($content_pack, $http_regular_request,$level = 0) {

    
    $pack_keys=array_keys($content_pack);
    $foler_margin = $level * 15;
    $glyphicon_style = "style=\"margin-left:" . $foler_margin . "px\" ";

    $li_class = "list-group-item";
    $glyphicon = "";



    if ($level === 0) {
        echo "<div class=\"list-group side_menu\">\n";
    } else {
        //superprint($content_pack);
    }
    $pack_keys = array_keys($content_pack);
    $object_id = $pack_keys[$level];
    $object = $content_pack[$object_id];


    if (isset($pack_keys[$level + 1])) {
        $next_key = $pack_keys[$level + 1];
        $next_pack = $content_pack[$next_key];
        
       
        
        foreach ($object->content as $key => $data) {

           
            /*
            if ($content_pack["page"]->id == $key) {
                $li_class = "list-group-item active ";
       
            } else {
                $li_class = "list-group-item";
        
            }
            
            if ($http_regular_request["id"] == $key) {
                $li_class = "list-group-item active";
          
            } else {
                $li_class = "list-group-item";
         
            }
              */
            
          
            if ( in_array($key,$pack_keys)) {
                $li_class = "list-group-item active ";
     
            } else {
                $li_class = "list-group-item";
   
            }
            
            if(isset($data->status) and $data->status=="core"){
                continue;
            }
            //echo "\n<li>";
            //echo $data->type," ",$data->title;

            //$glyphicons
            if ($data->type == "page") {
                $glyphicon = "<span class=\"glyphicon glyphicon-file\" " . $glyphicon_style . "></span> \n";
            }
            if ($data->type == "process") {
                $glyphicon = "<span class=\"glyphicon glyphicon-cog\" " . $glyphicon_style . "></span> \n";
            } elseif ($data->type == "section") {
                $glyphicon = "<span class=\"glyphicon glyphicon-menu-right\" " . $glyphicon_style . "></span> \n";
            } else {
                $glyphicon = "<span class=\"glyphicon glyphicon-file\" " . $glyphicon_style . "></span> \n";
            }


            //echo "<li class=\"" . $li_class . "\"><a href=\"main.php?";
            echo "<a href=\"main.php?";
            echo $data->type . "=" . $key . "\" ";
            echo " class=\"" . $li_class . "\"  >";
            echo $glyphicon;
            echo $data->title;
            echo "</a>\n";

            /*
            $link = "<a href=\"main.php?" . $data->type . "=" . $key . "\" ";
            $link.=" class=\"" . $li_class . "\"  >";
            $link.=$data->title;
            $link.="</a>\n";
            echo $link;
            */

            if ($next_key == $key) {
                $sublevel = $level + 1;

                displaySideMenuBootstrap($content_pack,$http_regular_request, $sublevel);
            }


            //echo "</li>\n";
        }
    }



    if ($level === 0) {
        echo "</div> <!--displaySideMenuBootstrap END -->\n";
    }
    $level+=1;
}

function displayNavBar($section, $content_id) {

    $li = "";
    foreach ($section->content as $key => $linkObj) {

        //if dropdown needed

        /*
          if ($linkObj->type == "section" and $content_id == $key) {
          if(isset($content_pack[$content_id])){
          displayNavBarDropDown($content_pack[$content_id]);
          }

          }
         * 
         */
        if ($linkObj->type == "section") {

            $sub_section = file_load_object($linkObj->url);

            if ($sub_section) {
                displayNavBarDropDown($sub_section);
            }
        }


        //pages and process
        else {
            $link = BASEFILE . "?" . $linkObj->type . "=" . $key;
            if ($content_id == $key) {
                $class = "active";
            } else {
                $class = "";
            }

            echo "<li class=\"" . $class . "\"><a href=\"" . $link . "\">" . $linkObj->getTitle() . "</a></li>\n";
        }
    }
}

function displayNavBarDropDown($section) {

    echo "<li class=\"dropdown\">\n";
    echo "<a href=\"#\" class=\"dropdown-toggl\" data-toggle=\"dropdown\" ";
    echo " role=\"button\" aria-expanded=\"false\">";
    echo $section->getTitle();
    echo "<span class=\"caret\"></span></a>\n";
    echo "<ul class=\"dropdown-menu\" role=\"menu\">\n";
    foreach ($section->content as $key => $linkObj) {

        if ($section->default == $key and $linkObj->type != "section") {
            continue;
        }

        $link = BASEFILE . "?" . $linkObj->type . "=" . $key;
        echo "<li><a href=\"" . $link . "\">" . $linkObj->getTitle() . "</a></li>\n";
    }
    echo "</ul>\n";
    echo "</li>";
}
