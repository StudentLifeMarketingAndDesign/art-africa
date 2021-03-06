<?php

use SilverStripe\Assets\Image;
use SilverStripe\Security\Permission;
use SilverStripe\Forms\ReadonlyField;
use SilverStripe\Forms\TextField;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\ORM\DataObject;
 
class Country extends DataObject {
 
  
  private static $db = array(	
  'Title' => 'Text',
  'AlternativeName' => 'Text',
  'Location' => 'Text',
  'DateOfIndependence' => 'Text',
  'Nationality' => 'Text',
  'CapitalCity' => 'Text',
  'Population' => 'Text',
  'ImportantCities' => 'Text',
  'HeadOfState' => 'Text',
  'Area' => 'Text',
  'TypeOfGovernment' => 'Text',
  'Currency' => 'Text',
  'MajorPeoples' => 'Text',
  'Latitude' => 'Varchar(255)',
  'Longitude' => 'Varchar(255)',
  'Religion' => 'Text',
  'Climate' => 'Text',
  'Literacy' => 'Text',
  'OfficialLanguage' => 'Text',
  'PrincipalLanguage' => 'Text',
  'MajorExports' => 'Text',
  'PrecolonialHistory' => 'Text',
  'PostcolonialHistory' => 'Text',
  'Tags' => 'Text',
  'GoogleName' => 'Varchar(255)'
  
  
  );
 
  // One-to-one relationship with gallery page
  private static $has_one = array(
  'Picture' => Image::class
  
  );
  
  
  
  private static $many_many = array(
  'People' => 'People',
  'Essays' => 'Essay',
  'AudioPieces' => 'AudioPiece',
  'VideoPieces' => 'VideoPiece',
  'Images' => Image::class
  );
  
  private static $belongs_many_many = array(
  'Subtopics' => 'Subtopic',
  'Chapters' => 'Chapter'
  
  );
  
  private static $plural_name = "Countries";
  
  public function canView($member = null) {
      return Permission::check('CMS_ACCESS', 'any', $member);
  }

  public function canEdit($member = null) {
      return Permission::check('CMS_ACCESS', 'any', $member);
  }

  public function canDelete($member = null) {
      return Permission::check('CMS_ACCESS', 'any', $member);
  }

  public function canCreate($member = null, $content=null) {
      return Permission::check('CMS_ACCESS', 'any', $member);
  }   
 // tidy up the CMS by not showing these fields
  public function getCMSFields() {
  
 		$fields = parent::getCMSFields();
 		$fields = $this->addCommonFields($fields);
 		
 		$fields->addFieldToTab('Root.Main', new ReadonlyField('ID', 'Temporary ID Field'));
 		$fields->addFieldToTab('Root.Main', new TextField('Title', 'Name'));
 		//$fields->addFieldToTab('Root.Main', new TextField('AlternativeName', 'Put the name Google Maps uses for a country if it differs from the name used on the site:'));
 		$fields->addFieldToTab('Root.Main', new TextField('Location', 'Location'));
 		$fields->addFieldToTab('Root.Main', new TextField('DateOfIndependence', 'Date Of Independence'));
 		$fields->addFieldToTab('Root.Main', new TextField('Nationality', 'Nationality'));
 		$fields->addFieldToTab('Root.Main', new TextField('CapitalCity', 'Capital City'));
 		$fields->addFieldToTab('Root.Main', new TextField('Population', 'Population'));
 		$fields->addFieldToTab('Root.Main', new TextField('ImportantCities', 'Important Cities'));
 		$fields->addFieldToTab('Root.Main', new TextField('HeadOfState', 'Head Of State'));
 		$fields->addFieldToTab('Root.Main', new TextField('Latitude'));
 		$fields->addFieldToTab('Root.Main', new TextField('Longitude'));
 		$fields->addFieldToTab('Root.Main', new TextField('Area', 'Area'));
 		$fields->addFieldToTab('Root.Main', new TextField('TypeOfGovernment', 'Type Of Government'));
 		$fields->addFieldToTab('Root.Main', new TextField('Currency', 'Currency'));
 		//$fields->addFieldToTab('Root.Main', new TextField('MajorPeoples', 'Major Peoples'));
 		$fields->addFieldToTab('Root.Main', new TextField('Religion', 'Religion'));
 		$fields->addFieldToTab('Root.Main', new TextField('Climate', 'Climate'));
 		$fields->addFieldToTab('Root.Main', new TextField('Literacy', 'Literacy'));
 		$fields->addFieldToTab('Root.Main', new TextField('OfficialLanguage', 'Official Language'));
 		$fields->addFieldToTab('Root.Main', new TextField('PrincipalLanguage', 'Principal Language'));
 		$fields->addFieldToTab('Root.Main', new TextField('MajorExports', 'Major Exports'));
 		$fields->addFieldToTab('Root.Main', new TextAreaField('PrecolonialHistory', 'Precolonial History'));
 		$fields->addFieldToTab('Root.Main', new TextAreaField('PostcolonialHistory', 'Postcolonial History'));
 		$fields->addFieldToTab('Root.Main', new TextField('Tags', 'Tags'));
 		$fields->addFieldToTab('Root.Main', new UploadField('Picture', 'Picture'));
 		$fields->addFieldToTab('Root.Main', new TextField('GoogleName', 'Google Name'));

		return $fields;	
  }
  
 /* public function Link(){
	  
	  $countryHolder = DataObject::get_one("CountryHolder");
	  $countryTitle = $this->Title;
	  $countryTitle = urlencode($countryTitle);
	  $link = $countryHolder->Link().'show/'.$countryTitle;
	  
	  return $link;
  }*/
 
  /*
  public function onBeforeWrite(){
	  
	  $allRelationships = new ArrayList();
	  
	  
	  foreach(Country::$many_many as $relationshipKey => $relationshipValue){
		  $allRelationships->merge($this->$relationshipKey());
	  }
	  
	  foreach(Country::$belongs_many_many as $relationshipKey => $relationshipValue){
	  	  $allRelationships->merge($this->$relationshipKey());
	  }
	  
	  
	  $allRelationships->merge($this->AudioPieces());
	  $allRelationships->merge($this->ArtPhotos());
	  $allRelationships->merge($this->Essays());
	  $allRelationships->merge($this->FieldPhotos());
	  $allRelationships->merge($this->People());
	  $allRelationships->merge($this->Subtopics());
	  $allRelationships->merge($this->VideoPieces());  
	  
	  $newTags = $this->Tags;
	
	  $lastCharacterOfTags = substr($newTags, -1);
	  
	  $newTagsArray = explode(",", $newTags);
	  $newTagsLength = strlen($newTags);
	  $newTagsCount = count($newTagsArray);
	  $allRelationshipsCount = count($allRelationshipsCount);
	  $iter = 0;
	  $changeMade = false;
	  
	  foreach($allRelationships as $relatedItem){
	    $addTag = true;
	  	foreach ($newTagsArray as $tag){
	  	    $stripTag = trim($tag);
		  	if ($relatedItem->Name == $stripTag){
			  	$addTag = false;
			  			  
			 }
		}
		print_r("NEW TAGS COUNT " . $newTagsCount);
		print_r($newTagsCount);
		
		
		if ($addTag == true){
			$iter++;
		    if (($iter == 1) && ($newTagsLength > 0))	{
			    $newTags .= ', ';
		    }
			if ($iter == $allRelationshipsCount) {
				$newTags = $newTags . $relatedItem->Name;
			}					
			else {
				$newTags = $newTags . $relatedItem->Name . ', ';
			}
			$changeMade = true;
		}		
		
	  }
	if ($changeMade){  
	  	$newTagsLength = strlen($newTagsLength);
		$newTags = substr($newTags, 0, $newTagsLength - 2);
	}
	
	$this->Tags = $newTags;
	$this->PrecolonialHistory = 'New Tags Array Length ' . $newTagsLength;
	$this->PostcolonialHistory = 'New Tags Change Made '  . ($changeMade == true) ? 'true' : 'false';
	
	

	parent::onBeforeWrite();
  }
  */
  
  
}

