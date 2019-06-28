<?php

namespace SilverStripeContactUsForm;

use Page;
use SilverStripe\Assets\Image;
use SilverStripe\Assets\File;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\OptionsetField;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\ORM\FieldType\DBBoolean;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\AssetAdmin\Forms\UploadField;

/**
 * Defines the CustomLayoutPage page type.
 */
class CustomLayoutPage extends Page
{
    private static $add_action = 'a Custom Layout Page';
    private static $allowed_children = 'none';
    private static $singular_name = 'Custom Page with Contact Us Form';
    private static $plural_name = 'Custom Pages with Contact Us Form';
    private static $description = 'Custom Layout Page with Contact Us Form';

    private static $db = [
        'FormStyle' => 'Varchar(255)',
        'PageLayout' => 'Varchar(255)',
        'MailFrom' => 'Varchar(255)',
        'MailTo' => 'Varchar(255)',
        'MailSubject' => 'Varchar(255)',
        'SuccessTitle' => 'Varchar(255)',
        'SuccessText' => 'HTMLText',
        'GoogleRecaptchaSiteKey' => 'Text',
        'GoogleRecaptchaSecretKey' => 'Text',
        'GoogleRecaptchaCssClass' => 'Varchar(255)',
        'GoogleRecaptchaNoTickMsg' => 'Varchar(255)',
        'GoogleRecaptchaEnable' => DBBoolean::class,
        'FormEnable' => DBBoolean::class,
        'ExtraContent1' => 'HTMLText',
        'ExtraContent2' => 'HTMLText',
        'ExtraContent3' => 'HTMLText',
        'ExtraText1' => 'Text',
        'ExtraText2' => 'Text',
        'ExtraText3' => 'Text',     
    ];

    private static $has_one = [
        'ExtraImage1' => Image::class,
        'ExtraImage2' => Image::class,
        'ExtraImage3' => Image::class,
        'ExtraFile1' => File::class,
        'ExtraFile2' => File::class,
        'ExtraFile3' => File::class,
    ];

    private static $table_name = 'SSC_CustomLayoutPage';

    private static $owns = ['ExtraImage1','ExtraImage2','ExtraImage3','ExtraFile1','ExtraFile2','ExtraFile3'];

    private static $default_sort = 'ID DESC';

    private static $defaults = [
        'FormEnable' => true,
        'FormStyle' => '1',
        'PageLayout' => '1',
        'MailFrom' => 'you@example.com',
        'MailTo' => 'who-will-get-notification@example.com',
        'MailSubject' => 'New contact form inquiry',
        'SuccessTitle' => 'Thank you for submitting the contact form!',
        'SuccessText' => 'We will get back to you ASAP.'
    ];

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->addFieldsToTab('Root.ExtraContent', [
            new OptionsetField( $name = "PageLayout", $title = "Page Layout", $source = array( "1" => "Option 1", "2" => "Option 2", "3" => "Option 3", "4" => "Option 4", "5" => "Option 5<img src='https://www.developer.com/imagesvr_ce/3977/Figure01.png'/>" ), $value = "1" ),


            TextField::create('ExtraText1', 'Extra Text 1'),
            TextField::create('ExtraText2', 'Extra Text 2'),
            TextField::create('ExtraText3', 'Extra Text 3'),
            UploadField::create('ExtraImage1', 'Extra Image 1'),
            UploadField::create('ExtraImage2', 'Extra Image 2'),
            UploadField::create('ExtraImage3', 'Extra Image 3'),
            HtmlEditorField::create('ExtraContent1', 'Extra Content 1'),
            HtmlEditorField::create('ExtraContent2', 'Extra Content 2'),
            HtmlEditorField::create('ExtraContent3', 'Extra Content 3'),

            UploadField::create('ExtraFile1', 'Extra File 1'),
            UploadField::create('ExtraFile2', 'Extra File 2'),
            UploadField::create('ExtraFile3', 'Extra File 3'),

        ]);



        $fields->addFieldsToTab('Root.FormSettings', [
            CheckboxField::create('FormEnable', 'Enable Contact Us Form')->setDescription(''),
            new DropdownField('FormStyle', 'Form Style', [
                '1'=>'Vertical with label',
                '2'=>'Vertical without label',
                '3'=>'Horizontal with label',
                '4'=>'Horizontal without label',
                '5'=>'System Generated - For Dev Test',
                ]),


            TextField::create('MailFrom', 'Mail From'),
            TextField::create('MailTo', 'Notify Email')          ->setDescription('This person will get notification after someone submit the form'),
            TextField::create('MailSubject', 'Mail Subject')
                ->setDescription('We will not send email if this Mail Subject is empty'),

            TextField::create('SuccessTitle', 'Success Title')
                ->setDescription('This will display as a title after the form success submitted.'),
            HTMLEditorField::create('SuccessText', 'Success Text')
            ->setDescription('This will display as a content after the form success submitted.You can put links or images here.'),
        ]);


        $fields->addFieldsToTab('Root.GoogleRecaptcha', [
            CheckboxField::create('GoogleRecaptchaEnable', 'Enable Google Recaptcha')->setDescription(''),
            TextField::create('GoogleRecaptchaSiteKey', 'Recaptcha Site Key')->setDescription('
            Avoid spam by using Google Recaptcha v2'),
            TextField::create('GoogleRecaptchaSecretKey', 'Recaptcha Secret Key')->setDescription('Get the key from https://www.google.com/recaptcha'),
            TextField::create('GoogleRecaptchaCssClass', 'Recaptcha Css Class')->setDescription('Extra css class name for the Google Recaptcha area.'),
            TextField::create('GoogleRecaptchaNoTickMsg', 'Recaptcha No Tick Msg')->setDescription('Frontend alert message if the end user does not tick the checkbox.'),
            

        ]);

        return $fields;
    }
}
