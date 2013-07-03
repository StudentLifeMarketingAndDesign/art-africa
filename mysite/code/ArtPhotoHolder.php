<?php
 
class ArtPhotoHolder extends Page {
 
  
  private static $db = array(	

  );
 
  // One-to-one relationship with gallery page
  private static $has_one = array(

  );
  
  
  private static $belongs_many_many = array();
  

 // tidy up the CMS by not showing these fields
  public function getCMSFields() {
 		$fields = parent::getCMSFields();
		
		
		$gridFieldConfigArtPhoto = GridFieldConfig_RecordEditor::create(); 
		$gridfield = new GridField("ArtPhoto", "ArtPhotos", ArtPhoto::get(), $gridFieldConfigArtPhoto);		
		$fields->addFieldToTab('Root.ArtPhotos', $gridfield);
		
		return $fields;		
  }
  
  
  

}


class ArtPhotoHolder_Controller extends Page_Controller {

	/**
	 * An array of actions that can be accessed via a request. Each array element should be an action name, and the
	 * permissions or conditions required to allow the user to access it.
	 *
	 * <code>
	 * array (
	 *     'action', // anyone can access this action
	 *     'action' => true, // same as above
	 *     'action' => 'ADMIN', // you must have ADMIN permissions to access this action
	 *     'action' => '->checkAction' // you can only access this action if $this->checkAction() returns true
	 * );
	 * </code>
	 *
	 * @var array
	 */
	private static $allowed_actions = array ('show', 'getArtPhotos');
	
	public static $childPage = 'ArtPhoto';
	
	public function getPeople(){
	$artPhotos = ArtPhoto::get();
	return $artPhotos;
	}
	
	
	
	
	
	 
	
	
	
}
