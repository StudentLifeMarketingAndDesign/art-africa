<?php

class MediaFilterForm extends Form
{

    public function __construct($controller, $name, $filters =
        array('Country' => '',
            'People' => '',
            'Chapter' => '',
            'Subtopic' => '',
            'MediaType' => '',
            'ObjectType' => '',
            'ObjectOwner' => '',
        )) {

        $audioPieces = AudioPiece::get()->First();

        if ($audioPieces) {
            $mediaFormTypes = array('Image' => 'Image', 'ArtPhoto' => 'Art Photo', 'FieldPhoto' => 'Field Photo', 'AudioPiece' => 'Audio', 'VideoPiece' => 'Video');
        } else {
            $mediaFormTypes = array('Image' => 'Image', 'ArtPhoto' => 'Art Photo', 'FieldPhoto' => 'Field Photo', 'VideoPiece' => 'Video');
        }
        
        $fields = new FieldList(

            TextField::create('ObjectTitle', 'Object Title')->setAttribute('placeholder', 'Object Title Contains'),
            TextField::create('Photographer', 'Photographer')->setAttribute('placeholder', 'Photographer Contains'),
            DropdownField::create('ObjectType', 'Object Type', ObjectType::get()->map('ID', 'Title'), $filters['ObjectType'])->setEmptyString('Any Object Type'),
            DropdownField::create('ObjectOwner', 'Object Owner', ObjectOwner::get()->map('ID', 'Title'), $filters['ObjectOwner'])->setEmptyString('Any Object Owner'),

            DropdownField::create('MediaType', 'MediaType', $mediaFormTypes, $filters['MediaType']),
            LiteralField::create('MediaFilterSep1', '<hr>'),
            DropdownField::create('Country', 'Countries', Country::get()->map('ID', 'Title'), $filters['Country'])->setEmptyString('Any Country'),
            DropdownField::create('People', 'Peoples', People::get()->map('ID', 'Title'), $filters['People'])->setEmptyString('Any People'),
            DropdownField::create('Chapter', 'Chapters', Chapter::get()->map('ID', 'Title'), $filters['Chapter'])->setEmptyString('Any Chapter')

        );
        $actions = new FieldList(FormAction::create('', 'Use Filter'));
        $this->setFormMethod('GET');

        parent::__construct($controller, $name, $fields, $actions);
        $this->disableSecurityToken();
    }

    public function login(array $data, Form $form)
    {
        // Authenticate the user and redirect the user somewhere
        Controller::curr()->redirectBack();
    }
}
