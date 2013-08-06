<?php
 
class MediaPiece extends DataObject {
 
  
  private static $db = array(	
  'Title' => 'Varchar(255)',
  'CreditLine' => 'Varchar(255)',
  'Caption' => 'Text',
  /*'Bibliography' => 'Text',*/
  'Tags' => 'Varchar(255)',
  'Description' => 'HTMLText',
  'MediaLink' => 'Varchar(255)'


  );
 
  // One-to-one relationship with gallery page
  private static $has_one = array(

  'Thumbnail' => 'Image'
  
  
  

  );
  
  private static $plural_name = "Media Pieces";

     
     
 // tidy up the CMS by not showing these fields
  public function getCMSFields() {
 		$fields = parent::getCMSFields();
 		
 		$fields->addFieldToTab('Root.Main', new ReadonlyField('ID'));
 		$fields->addFieldToTab('Root.Main', new TextField('Title', 'Name'));
 		
 		//$fields->addFieldToTab('Root.Main', new TextAreaField('Bibliography', 'Bibliography'));
 		$fields->addFieldToTab('Root.Main', new TextAreaField('Tags', 'Tags'));
 		$fields->addFieldToTab('Root.Main', new TextField('CreditLine', 'CreditLine'));
 		$fields->addFieldToTab('Root.Main', new TextAreaField('Caption', 'Caption'));
 		
 		$fields->addFieldToTab('Root.Main', new UploadField('Thumbnail'));
 		
 		$fields->addFieldToTab('Root.Main', new HTMLEditorField('Description', 'Description'));
 		


 		
		return $fields;		
  }
  
    public function formattedIFrameURL(){
  	  $link = $this->MediaLink;
  	  $parsedLink = parse_url($link);

  	  if (isset($parsedLink['path'])){
  	  	$URLFragment = $parsedLink['path'];
  	  	return $URLFragment;
  	  }

  }
  
}


