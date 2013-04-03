<?php
 
class CollectionPiece extends DataObject {
 
  
  private static $db = array(	
	  'SortOrder' => 'Int',
	  'Title' => 'Varchar',
	  'ArtistName' => 'Varchar',
	  'Description'=> 'HTMLText'
  );
 
  // One-to-one relationship with gallery page
  private static $has_one = array(
    'Image' => 'Image',
    'CollectionHolderPage' => 'CollectionHolderPage'	
  );
  
  private static $many_many = array(
  	"Categories" => "Category"
  );
 
 // tidy up the CMS by not showing these fields
  public function getCMSFields() {
 		$fields = parent::getCMSFields();
		$fields->removeFieldFromTab("Root.Main","CollectionHolderPageID");
		$fields->removeFieldFromTab("Root.Main","SortOrder");
		return $fields;		
  }
  
  // Tell the datagrid what fields to show in the table
   private static $summary_fields = array( 
       'ID' => 'ID',
	   'Title' => 'Title',
	   'ArtistName' => 'Artist',
	   'Thumbnail' => 'Thumbnail'
   );
   
	static $searchable_fields = array( 
		'ID', 
		'Title',
		'ArtistName' 
	);
  
  // this function creates the thumnail for the summary fields to use
   public function getThumbnail() { 
     return $this->Image()->CMSThumbnail();
  }
 
}