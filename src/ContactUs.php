<?php

namespace SSCustomPageWithContactUsForm;

use SilverStripe\Control\Email\Email;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\HeaderField;
use SilverStripe\Forms\ReadOnlyField;
use SilverStripe\Forms\Tab;
use SilverStripe\Forms\TabSet;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\DataObject;
use SilverStripe\Security\Permission;
use SilverStripe\Security\PermissionProvider;

class ContactUs extends DataObject 
{
    private static $db = [
        'FirstName' => 'Varchar(255)',
        'LastName' => 'Varchar(255)',
        'CompanyName' => 'Varchar(255)',
        'Email' => 'Varchar(255)',
        'Phone' => 'Varchar(255)',
        'Mobile' => 'Varchar(255)',
        'Street' => 'Varchar(255)',
        'Address' => 'Varchar(255)',
        'PostalCode' => 'Varchar(255)',
        'City' => 'Varchar(255)',
        'State' => 'Varchar(255)',
        'Country' => 'Varchar(255)',        
        'Website' => 'Varchar(255)',
        'Locale' => 'Varchar(255)',
        'FromPageTitle' => 'Varchar(255)',
        'Category' => 'Varchar(255)',
        'MyDate' => 'Varchar(255)',
        'IP' => 'Varchar(255)',
        'Subject' => 'Varchar(255)',
        'Message' => 'Text',
        'FromPageUrl' => 'Varchar(255)',
        'AdminComment' => 'Text',
        'Status' => "Enum('New, Opened, Answered, Spam, Archived, Display', 'New')",
        'Sort' => 'Int',
        'ExtraData1' => 'Text',
        'ExtraData2' => 'Text',
        'ExtraData3' => 'Text',
        'ExtraData4' => 'Text',
        'ExtraData5' => 'Text',
    ];

    private static $has_one = [];

    private static $table_name = 'SSC_ContactUs';

    private static $casting = [
        'Title' => 'Varchar(255)',
    ];

    private static $defaults = [
        'Status' => 'New',
    ];

    private static $singular_name = 'Contact Us Data';
    private static $plural_name = 'Contact Us Data';
    private static $default_sort = 'Sort, ID Desc';

    private static $searchable_fields = [
        'FirstName',
        'LastName',
        'Email',
        'Phone',
        'Status',
    ];

    private static $summary_fields = [
        'FullName',
        'Email',
        'Status',
        'FromPageTitle',
        'Created',
    ];

    private static $field_labels = [
        'FullName' => 'Full Name',
        'Sort' => 'Sort Index',
    ];

    public function getFullName()
    {
        return $this->FirstName.' '.$this->LastName;
    }

    public function FullName()
    {
        return $this->getFullName();
    }

    public function getTitle()
    {
        return $this->getFullName().' / '.$this->Status.' / '.$this->Created;
    }

    public function Title()
    {
        return $this->getTitle();
    }

    public static function get_status_options()
    {
        return singleton(self::class)->dbObject('Status')->enumValues(false);
    }

    public function getCMSFields()
    {
        $fields = FieldList::create(TabSet::create('Root', Tab::create('Main')));
        $fields->removeByName('Sort');

        $dropFieldStatus = DropdownField::create('Status', 'Status', self::get_status_options());

        $tabName = singleton(self::class)->singular_name();
        $fields->addFieldsToTab('Root.Main', [
            HeaderField::create('HeaderDetails', "${tabName} details"),
            $dropFieldStatus,
            TextField::create('FirstName'),
            TextField::create('LastName'),
            TextField::create('Email', 'Email'),
            TextField::create('Phone', 'Phone'),
            TextField::create('Mobile', 'Mobile'),
            TextField::create('CompanyName', 'Company Name'),
            TextField::create('Address', 'Address'),
            TextareaField::create('Message', 'Message'),
            TextareaField::create('AdminComment', 'Admin Comment'),
            ReadOnlyField::create('FromPageTitle'),
            ReadOnlyField::create('FromPageUrl', 'From Page URL'),
            ReadOnlyField::create('IP', 'Client IP Address'),
            ReadOnlyField::create('Locale', 'Locale'),
            ReadOnlyField::create('Created', 'Created'),   
            
            
            TextField::create('Website'),
            TextField::create('PostalCode'),
            TextField::create('Street'),
            TextField::create('City'),
            TextField::create('State'),
            TextField::create('Country'),
            TextField::create('Category'),
            TextField::create('MyDate'),

            TextareaField::create('ExtraData1', 'ExtraData1'),
            TextareaField::create('ExtraData2', 'ExtraData2'),
            TextareaField::create('ExtraData3', 'ExtraData3'),
            TextareaField::create('ExtraData3', 'ExtraData4'),  
            TextareaField::create('ExtraData3', 'ExtraData5'),  
        ]);

        return $fields;
    }

}
