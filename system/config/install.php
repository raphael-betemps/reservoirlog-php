


<?php
/** install.php= libs and functions for refactor */

/** ############## BASE DIRS STRUCTURE  #######################*/

$data_folders=array(
DATA_FOLDER,
FTP_FOLDER,
BACKUP_FOLDER
    
);

/**  folders naming :
 * media/types and objects/classes 
 * 
 * 
*/ 

$data_subfolders=array(
MEDIA_FOLDER,
MEDIA_FOLDER."/file",
MEDIA_FOLDER."/page",
MEDIA_FOLDER."/image",
OBJECTS_FOLDER,
OBJECTS_FOLDER."/section",
OBJECTS_FOLDER."/file",
OBJECTS_FOLDER."/image",
OBJECTS_FOLDER."/link",
OBJECTS_FOLDER."/page",
OBJECTS_FOLDER."/user",
OBJECTS_FOLDER."/message",
OBJECTS_FOLDER."/process",
OBJECTS_FOLDER."/site",
OBJECTS_FOLDER."/blend"
);


function check_data_subfolders($folders){
	foreach($folders as $key=>$folder){
		
		if(! is_dir($folder)){
			mkdir($folder);
			chmod($folder,0777);
			$sample_htm=$folder."/index.htm";
                        $sample_php=$folder."/index.php";
			copy(SAMPLE_HTM,$sample_php);
			chmod($sample_php,0777);	
		}
		else{
			echo "<!-- # EXISTING  :  ",$folder," # -->\n";
			//display_obj($folder);
			}
	}

}


/**
 * 
 * SITE
 */

function createSite($id="site"){
    
$site = new site("reservoirlog CMS");
$site->changeID($id);
$site->layout=("default");
$site->style=("default");
$site->save();
//$site->display();
return $site;
}	


function createProcessSection($section_process_list,$section_id,$module){
    
$section=new section($section_id);
$section->changeID($section_id);



    $i=0;
foreach ($section_process_list as $module_page) {
	
        $process = new process($section_id ."  ".$module_page);
		$process->module["name"] = $module;
		$process->module["section"]=$section_id ;
		$process->module["page"]  = $module_page;
                
        if($module_page !="index" or $module_page !="list"){$process->status="core";}
        $process->setProcessID();
        $process_id=$process->getID();
        $section->addContent($process);
        
        if($i==0){$section->setDefault($process_id);}    
        
        $i+=1;

    
	}
//superprint($section);
return $section;
}




/** ############## CREATE BASE DIRS / STRUCTURE  ####################### */
check_data_subfolders($data_folders);
check_data_subfolders($data_subfolders);



/** ############## NEWS SITE + default page ####################### */
$site = createSite();

$accueil = new page("Home");
$accueil->changeID("home");
$accueil->createContent();
$site->addContent($accueil);


$test = new page("Test");
$test->changeID("test");
$test->createContent();
$site->addContent($test);
// superprint($site);
 //exit;
 
 
/** ############## ADMIn SECTION ####################### */

$admin_structure = array(
    "design",
    "media",
    "objects"
);



$data_process_list = array(
    "index",
    "list",
    "edit",
    "create",
    "upload",
    "update"
   
);



$admin = new section("admin");
$admin->changeID("admin");

foreach($admin_structure as $section_id){
    
    $section=createProcessSection($data_process_list,$section_id,"admin");
    $admin->addContent($section);
    
    
}

$site->addContent($admin);

/** ############## users SECTION ####################### */

$users = new section("user");
$users->changeID("user");

$users_sub_structure = array(
    "index",
    "edit",
    "login",
    "logout"
);

    $i=0;
    foreach ($users_sub_structure as $users_process) {



        $process = new process("User   ".$users_process);
		$process->module["name"] = "user";
		$process->module["section"]="";
		$process->module["page"]  = $users_process;
        $process->setProcessID();
        $process_id=$process->getID();

        $process_id=$process->getID();
        $users->addContent($process);
        //superprint($process->getFileName());
        if($i==0){$users->setDefault($process_id);}    
        
        $i+=1;
    }

$site->addContent($users);
$site->save();

//superprint($site);




?>
