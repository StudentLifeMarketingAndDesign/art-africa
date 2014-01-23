<?php

class ImageExtension extends DataExtension {
		
  private static $db = array(
  
   'PhotoID' => 'Text',
  'Photographer' => 'Text',
  'Description' => 'HTMLText',
  'Date' => 'Text',
  'Location' => 'Text',
  'CreditLine' => 'HTMLText',
  'Caption' => 'HTMLText',
  'Tags' => 'Text',
  
  'Type' => "Enum('Image, ArtPhoto, FieldPhoto', 'Image')",
  
  'AccessionNumber' => 'Text',
  'TraditionalName' => 'HTMLText',
  'Material' => 'Text',
  'ArtDimensions' => 'Text',
  'Function' => 'Text',
  'Style' => 'Text',
  'Substyle' => 'Text',
  'Collection' => 'Text',
  'Source' => 'Text',

  "HideFromMediaGrid" => "Boolean"
  
  );

  private static $has_one = array(
  'AltImage' => 'Image',
  );
  
  private static $many_many = array(
  'Essays' => 'Essay',
  'AudioPieces' => 'AudioPiece',
  'VideoPieces' => 'VideoPiece',
  );
  
  private static $belongs_many_many = array(
   'People' => 'People',
   'Essays' => 'Essay',
   'Countries' => 'Country',
   'Subtopics' => 'Subtopic',
   'Chapters' => 'Chapter'

  );

  
  private static $searchable_fields = array('Title', 'PhotoID', 'Filename', 'Name');
  private static $default_sort = array('Title');
  

  
  private static $plural_name = "Images";  	
  
	public function updateCMSFields(FieldList $fields) {
	
		$fields = $this->owner->addCommonFields($fields);
    $parentImage = $this->ParentImage();

    if(!$parentImage){
	  $fields->addFieldToTab('Root.Main', new UploadField('AltImage', 'Alternate / Better Quality Image (takes precedence over the image above)'), 'Name'); 


    $fields->addFieldToTab('Root.Main', new TextField('Title', 'Name'));
    $fields->addFieldToTab('Root.Main', new CheckboxField('HideFromMediaGrid', 'Hide this image from the media grid.'));
       $captionField = new HTMLEditorField('Caption', 'Caption');
    //å$captionField->setRows(1);
    $fields->addFieldToTab('Root.Main', $captionField);
    
    $descriptionField = new HTMLEditorField('Description', 'Description');
      //$descriptionField->setRows(2);
      $fields->addFieldToTab('Root.Main', $descriptionField);
    
    $fields->addFieldToTab('Root.Main', new DropdownField('Type','Type of Image', $this->owner->dbObject('Type')->enumValues()));
    //$fields->addFieldToTab('Root.Main', new TextField('PhotoID', 'Photo ID'));
    $fields->addFieldToTab('Root.Main', new TextField('Photographer', 'Photographer'));

    

    $fields->addFieldToTab('Root.Main', new TextField('Date', 'Date')); 
    $fields->addFieldToTab('Root.Main', new TextField('Location', 'Location'));
        
    $creditField = new HTMLEditorField('CreditLine', 'Credit Line');
    $creditField->setRows(1);
    $fields->addFieldToTab('Root.Main', $creditField);

 
    
    $fields->addFieldToTab('Root.Main', new TextAreaField('Tags', 'Tags'));
    $fields->addFieldToTab('Root.Main', new TextField('AccessionNumber', 'Accession Number'));

    

    $traditionalNameField = new HTMLEditorField('TraditionalName', 'Traditional Name');
    $traditionalNameField->setRows(1);
    $fields->addFieldToTab('Root.Main', $traditionalNameField);

    $fields->addFieldToTab('Root.Main', new TextField('Material', 'Material'));
    $fields->addFieldToTab('Root.Main', new TextField('ArtDimensions', 'Dimensions'));
    $fields->addFieldToTab('Root.Main', new TextField('Function', 'Function'));
    $fields->addFieldToTab('Root.Main', new TextField('Style', 'Style'));
    $fields->addFieldToTab('Root.Main', new TextField('Substyle', 'Substyle'));

    }else{
      $fields->addFieldToTab('Root.Main', new LabelField('ParentImage','This image is an alternate/better quality version of'.$parentImage->Title));
    }

 		//$fields->addFieldToTab('Root.Main', new TextField('Collection', 'Collection'));
 		//$fields->addFieldToTab('Root.Main', new TextField('Source', 'Source'));

	}

  public function ShowLink(){
    $imageHolder = ImageHolder::get_one("ImageHolder");
    $sourcePage = Director::get_current_page();
    $controller = Controller::curr();

    $backURL = urlencode($controller->request->getURL(true));
    
    $link = $imageHolder->Link().'show/'.$this->owner->ID;
    $link .='?back='.$backURL;

    return $link;
    
  }

  public function PopupLink(){

  	$link = $this->ShowLink().'&popup=true';

  	return $link;

  
  }
    public function Landscape() {
        return $this->owner->getWidth() > $this->owner->getHeight();
    }
     
    public function Portrait() {
    	$height = $this->owner->getHeight();
    	$width = $this->owner->getWidth();

        return $this->owner->getWidth() < $this->owner->getHeight();
    }

    public function SizeCategory(){

      $size = 'full';

      if($this->owner->AltImage()){
        $image = $this->owner->AltImage();
        print_r('theres an alt image');
      }else{
        $image = $this->owner;
      }

      $height = $image->getHeight();
      $width = $image->getWidth();

      if(($width < 1000) || ($height < 1000)) {
        $size = 'medium';
      }

      if(($width < 600) || ($height < 600)){
        $size = 'small';
      }

      if(($width < 300) || ($height < 300)){
        $size = 'tiny';
      }

      print_r('w='.$width.', h='.$height);

      return $size;



    }

    public function SingleDisplay(GD $gd){
    	$height = $this->owner->getHeight();
    	$width = $this->owner->getWidth();

    	if($this->Landscape()){
    		return $this->owner->SetWidth(1000);

    	} elseif ($this->Portrait() && $width >= 300){
    		return $this->owner->SetWidth(300);
    	} else {
    		return $this->owner;
    	}

    }

    public function ScaledImage(){

      $image = $this->owner;

      $height = $image->getHeight();
      $width = $image->getWidth();

      //Debug::message("Wow, that's great");

      if(($width < 1000) && ($height < 1000)){
        return $image;

      }else{

        $scaledImage = $image->SetRatioSize(1000,1000);
        return $scaledImage;
      }

    }


  public function ParentImage(){

    $parent = Image::get()->filter(array("AltImageID"=>$this->owner->ID))->first();

    //print_r($parent);

    if(isset($parent)){
      return $parent;
    }else{
      return false;
    }
  }


  //returns returnedCaption
  public function parsedCaption(){
  
      $returnedCaption = $this->owner->Caption; //make a copy of Caption to modify progressively in the function
      
      if ($returnedCaption == '') {
	      return $returnedCaption;
      }
      
  	  $captionTemp = explode("</p>", $this->owner->Caption); //Index 0 should be the first paragraph
  	  
  	  $captionFirstParagraph = $captionTemp[0]; //Get index 0
  	  
  	  $captionFirstParagraph = trim($captionFirstParagraph); //Trim off leading white space
  	  
  	  $captionFirstParagraph = str_replace("<p>", "", $captionFirstParagraph);
  	  
  	  //Take first paragraph out of what we'll be returning, as we'll be putting our own in
  	  $returnedCaption = str_replace($captionFirstParagraph, '', $returnedCaption);

	  $captionArray = explode(';', $captionFirstParagraph); //break first line of caption up into its setions
	  
	 /*  ----DEBUGGING-----
	 print_r('CAPTION ARRAY IS');
	  
	 print_r($captionArray);*/
	  
	  $classOfCaptionItem = array('Country', 'People'); //these are in the order they appear using what we believe to be the standard museum format
	  
	  $newCaptionLine = ''; //Once completed, this is the line we want to insert at the beginning of the caption
	  
	  $captionSectionIndex = 0; // we will iterate through the classOfCaptionItem array by incrementing this for each run-through of the inner loop

	  foreach ($captionArray as $captionSection){ //captionSection should be items that are in the class 
	  
	  	  if (!(isset($classOfCaptionItem[$captionSectionIndex]))){
		  	  break;
	  	  }
	  	  
	  	  $captionSection = trim($captionSection); //takes white space off beginning/end 
	  	  		  
		  $captionItems = explode(',', $captionSection); //The different parts of a section, separated by commas
		  
		  $newCaptionSection = ' '; //This is the part (I use the word 'section') of a line that's between two semicolons.  We want it to start with a space
		 
		  
		  foreach ($captionItems as $captionItem){ //now we're iterating through the items in a section
			  $captionItem = trim($captionItem); //takes white space off beginning/end
		  
			  $searchedForClass = $classOfCaptionItem[$captionSectionIndex]; //This is the class we're looking for using $searchedForClass::get below
			  
			  $newCaptionItem = '';  //We will build a new caption item and add it to the caption section (each line has multiple sections).  Once the line is completed, we will add it to the beginning of the original caption
			  
			  $object = $searchedForClass::get()->filter(array('Title' => $captionItem))->First(); 
			  
			  if ($object){

				  $newCaptionItem = '<a href="' . $object->Link() . '">' . $captionItem . '</a>, '; //Note the comma -- if this is not necessary, it should be stripped off later

				  //print_r($object);
			  }
			  
			  else {
			  
			      $newCaptionItem = $captionItem . ', ';
				 
			  }
			  
			  $newCaptionSection = $newCaptionSection . $newCaptionItem; //Build the section out of each of the items
		  }
		  
		  $newCaptionSection = substr($newCaptionSection, 0, -2); //Get rid of final comma and space at end of section
		  
		  if (!($classOfCaptionItem[$captionSectionIndex] == $classOfCaptionItem[count($classOfCaptionItem)-1])){ //If not on the last class we're going through, add a semicolon	  
				$newCaptionSection = $newCaptionSection . ';';	  
		  }
		  //else {
		  			  
		  //}

		  $newCaptionLine = $newCaptionLine . $newCaptionSection; //Add section to line
		   
		  $captionSectionIndex++; //Used to check what class we're searching for
		  		  
	  }
	  
	   //Add closing p tag at the end, since you exploded using it
	  $newCaptionLine = $newCaptionLine . '</p>';
	  
	  $returnedCaption = $newCaptionLine . $returnedCaption; //Add line to caption
	  
	  return $returnedCaption; //Et voila!
  }

}