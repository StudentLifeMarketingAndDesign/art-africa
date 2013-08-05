<?php

class ImageExtension extends DataExtension {
		
  private static $db = array(
  
   'PhotoID' => 'Text',
  'Photographer' => 'Text',
  'Description' => 'Text',
  'Date' => 'Text',
  'Location' => 'Text',
  'CreditLine' => 'Text',
  'Caption' => 'Text',
  'Tags' => 'Text',
  
  'Type' => "Enum('Image, ArtPhoto, FieldPhoto', 'Image')",
  
  'AccessionNumber' => 'Text',
  'TraditionalName' => 'Text',
  'Material' => 'Text',
  'ArtDimensions' => 'Text',
  'Function' => 'Text',
  'Style' => 'Text',
  'Substyle' => 'Text',
  'Collection' => 'Text',
  'Source' => 'Text'
  
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
  

  
  private static $plural_name = "Images";  	
  
	public function updateCMSFields(FieldList $fields) {
	
		$fields = $this->owner->addCommonFields($fields);
	
		$fields->addFieldToTab('Root.Main', new TextField('Title', 'Name'));
		$fields->addFieldToTab('Root.Main', new DropdownField('Type','Type of Image', $this->owner->dbObject('Type')->enumValues()));
 		$fields->addFieldToTab('Root.Main', new TextField('PhotoID', 'Photo ID'));
 		$fields->addFieldToTab('Root.Main', new TextField('Photographer', 'Photographer'));
 		$fields->addFieldToTab('Root.Main', new TextAreaField('Description', 'Description'));
 		$fields->addFieldToTab('Root.Main', new TextField('Date', 'Date')); 
 		$fields->addFieldToTab('Root.Main', new TextField('Location', 'Location'));
 		 		
 		$creditField = new TextField('CreditLine', 'Credit Line');
 		$fields->addFieldToTab('Root.Main', $creditField);
 		
 		$fields->addFieldToTab('Root.Main', new TextAreaField('Tags', 'Tags'));
 		$fields->addFieldToTab('Root.Main', new TextField('AccessionNumber', 'Accession Number'));
 		$fields->addFieldToTab('Root.Main', new TextAreaField('Description', 'Description'));
  	$fields->addFieldToTab('Root.Main', new TextField('TraditionalName', 'Traditional Name'));
 		$fields->addFieldToTab('Root.Main', new TextField('Material', 'Material'));
 		$fields->addFieldToTab('Root.Main', new TextField('ArtDimensions', 'Dimensions'));
 		$fields->addFieldToTab('Root.Main', new TextField('Function', 'Function'));
 		$fields->addFieldToTab('Root.Main', new TextField('Style', 'Style'));
 		$fields->addFieldToTab('Root.Main', new TextField('Substyle', 'Substyle'));
 		$fields->addFieldToTab('Root.Main', new TextField('Collection', 'Collection'));
 		$fields->addFieldToTab('Root.Main', new TextField('Source', 'Source'));

	}

  public function ShowLink(){
    $imageHolder = ImageHolder::get_one("ImageHolder");
    return $imageHolder->Link().'show/'.$this->owner->ID;
  }

	}