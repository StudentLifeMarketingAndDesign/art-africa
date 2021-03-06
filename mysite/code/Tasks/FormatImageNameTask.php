<?php

use SilverStripe\Assets\File;
use SilverStripe\Assets\Folder;
use SilverStripe\Dev\BuildTask;
class FormatImageNameTask extends BuildTask {
 
    protected $title = 'Format image names';
 
    protected $description = 'Change image names (not filenames, but the names used to pair images with essays) with long names like 075-97-3936-DHR001 to shorter names like DHR001';
 
    protected $enabled = false;
 
    function run($request) {
        /*
        
        Here is some regex testing code
        
        
        $subject = "000 97 3936 CMS330 G";
        print_r("subject = ");
        print_r($subject);
        print_r("<br><br>");
		$pattern = '/[A-Z]{3}[0-9]{3}/';
		preg_match($pattern, $subject, $matches, PREG_OFFSET_CAPTURE);*/
		
		$imageList = File::get()->where("\"ClassName\" = 'Image' and Name LIKE '%CMS%'");
		
		$imageListIterator = $imageList->getIterator();
		$iter = 0;
		foreach ($imageListIterator as $image){
			
			
			$imageTitle = $image->Filename;
			print_r($imageTitle);
			
			//Match IDs like CMS380, AFR101, whatever
			$pattern = '/[A-Z]{3}[0-9]{1,3}[-]?[A-Z]?[0-9]{2}?[-]?[A-Z]?/';
			preg_match($pattern, $imageTitle, $matches, PREG_OFFSET_CAPTURE);
			//print_r('<br><br>');
			//print_r($matches);
			//print_r('<br><br>');
			
			

			if (isset($matches[0][0])){
				$match = $matches[0][0];
				print_r('<br><br>');
				print_r($match . ' MATCH');
				//print_r($image->ParentID);
				$folder = Folder::get_by_id(Folder::class, $image->ParentID);
				$path = $folder->getRelativePath();
				
				$image->setName($match . '.jpg');
				$image->setFilename($path.$match.'.jpg');
				$image->write();
				
			}
			else {
			
			}
			
			print_r('<br><br>');
			$iter++;
	
			
			
			
		}
		print_r("<br><br><br><br><br><br>");
		print_r("AFTER TASK");
		print_r("<br><br><br><br><br><br>");
		
		foreach($imageListIterator as $image){
			print_r($image->Name);
			print_r("<br><br>");
		}
		
		
    }
}


