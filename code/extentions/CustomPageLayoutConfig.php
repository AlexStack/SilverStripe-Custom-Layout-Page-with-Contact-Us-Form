<?php

use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\ORM\DataExtension;

class CustomPageLayoutConfig extends DataExtension 
{

    private static $db = [
        'ContactUsEmail' => 'Varchar',
        'GoogleRecaptchaSiteKey' => 'Varchar',
        'GoogleRecaptchaSecretKey' => 'Varchar',
    ];

    public function updateCMSFields(FieldList $fields) 
    {

        $fields->addFieldsToTab("Root.Main", [
            TextField::create("ContactUsEmail", "Contact Us Notification Email"),

            TextField::create('GoogleRecaptchaSiteKey', 'Recaptcha Site Key')->setDescription('
            Avoid spam by adding Google Recaptcha v2 to Contact Us Form'),
            TextField::create('GoogleRecaptchaSecretKey', 'Recaptcha Secret Key')->setDescription('Get the key from https://www.google.com/recaptcha')
        ]);                       
    }
}