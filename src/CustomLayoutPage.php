<?php

namespace SSCustomPageWithContactUsForm;

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
        'FormLayout' => 'Varchar(255)',
        'PageLayout' => 'Varchar(255)',
        'PageLayoutFilename' => 'Varchar(255)',
        'FormLayoutFilename' => 'Varchar(255)',
        'DisplayFormFields' => 'Text',
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
        'ExtraFeaturedText' => 'Text',
        'ExtraFeaturedContent' => 'HTMLText',
    ];

    private static $has_one = [
        'ExtraImage1' => Image::class,
        'ExtraImage2' => Image::class,
        'ExtraImage3' => Image::class,
        'ExtraFile1' => File::class,
        'ExtraFile2' => File::class,
        'ExtraFile3' => File::class,
        'ExtraFeaturedImage' => Image::class,
    ];

    private static $table_name = 'SSC_CustomLayoutPage';

    private static $owns = ['ExtraImage1', 'ExtraImage2', 'ExtraImage3', 'ExtraFile1', 'ExtraFile2', 'ExtraFile3'];

    private static $default_sort = 'ID DESC';

    private static $defaults = [
        'FormEnable' => true,
        'FormLayout' => '1',
        'PageLayout' => '1',
        'MailFrom' => '',
        'MailTo' => '',
        'MailSubject' => 'New contact us form inquiry',
        'SuccessTitle' => 'Thank You',
        'DisplayFormFields' => 'FirstName | Email | Phone | Company | Message',
        'SuccessText' => '<p style="color: red;">Thank you for submitting the contact form!<br/><br/>We will get back to you ASAP.</p>',
        'GoogleRecaptchaCssClass' => 'mt-3 mb-3',
        'GoogleRecaptchaNoTickMsg' => 'Please tick the I\'m not a robot checkbox first!'
    ];


    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $pageLayoutSourceAry = array(
            "1" => "Content Left, Form right if enabled",
            "2" => "Content Right, Form left if enabled",
            "3" => "Content Top, Form bottom if enabled",
            "4" => "Content Top, 3 cards below with Extra Images 1,2,3",
            "5" => "Two Contents per line, two lines with Extra Content 1,2,3",
            "101" => "My Custom Template File xxx.ss",
        );

        $fields->addFieldsToTab('Root.ExtraContent', [
            TextField::create('ExtraFeaturedText', 'Extra Featured Text'),
            TextField::create('ExtraText1', 'Extra Text 1'),
            TextField::create('ExtraText2', 'Extra Text 2'),
            TextField::create('ExtraText3', 'Extra Text 3'),
            UploadField::create('ExtraFeaturedImage', 'Extra Featured Image'),
            UploadField::create('ExtraImage1', 'Extra Image 1'),
            UploadField::create('ExtraImage2', 'Extra Image 2'),
            UploadField::create('ExtraImage3', 'Extra Image 3'),
            HtmlEditorField::create('ExtraFeaturedContent', 'Extra Featured Content'),
            HtmlEditorField::create('ExtraContent1', 'Extra Content 1'),
            HtmlEditorField::create('ExtraContent2', 'Extra Content 2'),
            HtmlEditorField::create('ExtraContent3', 'Extra Content 3'),

            UploadField::create('ExtraFile1', 'Extra File 1'),
            UploadField::create('ExtraFile2', 'Extra File 2'),
            UploadField::create('ExtraFile3', 'Extra File 3'),

        ]);
        $fields->addFieldsToTab('Root.PageLayout', [
            $pageLayout = new OptionsetField("PageLayout", "Page Layout", $pageLayoutSourceAry, $value = "1"),
            TextField::create('PageLayoutFilename', 'Custom Template File')
                ->setDescription("eg. NewProductPage.ss. Please make sure the template file your-theme/templates/includes/xxx.ss already exists!"),
        ]);
        $pageLayout->addExtraClass('PageLayoutOptions')->setDescription("<h3 id='layout-title'>" . $pageLayoutSourceAry[$this->PageLayout] . "</h3> <img id='layout-image' src='https://raw.githubusercontent.com/AlexStack/SilverStripe-Custom-Layout-Page-with-Contact-Us-Form/master/docs/images/page-layout-00" . $this->PageLayout . ".png'/>
        <script>
        function changeLayoutDescription(radioVal, radioText)  {
            jQuery('#layout-title').text(''+ radioText);
            jQuery('#layout-image').attr('src','https://raw.githubusercontent.com/AlexStack/SilverStripe-Custom-Layout-Page-with-Contact-Us-Form/master/docs/images/page-layout-00'+ radioVal + '.png');
        }
        jQuery('.PageLayoutOptions input:radio').click(function() {
            var radioVal = jQuery(this).val();
            var radioText = jQuery(this).parent().text();
            changeLayoutDescription(radioVal,radioText);
        });

        </script>");

        $fields->addFieldsToTab('Root.FormSettings', [
            CheckboxField::create('FormEnable', 'Enable Contact Us Form')->setDescription(''),
            new DropdownField('FormLayout', 'Form Layout', [
                '1' => 'Vertical with label',
                '2' => 'Vertical without label',
                '3' => 'Horizontal with label',
                '4' => 'Horizontal without label',
                '5' => 'System Generated - For Dev Test',
            ]),

            TextField::create('DisplayFormFields', 'Display Fields')->setDescription('You can choose what fields will display from FirstName | Email | Phone | Message | LastName | Mobile | Company | Website | Address | Street | PostalCode | City | State | Country. <a href="https://github.com/AlexStack/SilverStripe-Custom-Layout-Page-with-Contact-Us-Form#display-fields" target="_blank">Document is here</a>. '),
            TextField::create('MailTo', 'Notify Email')->setDescription('This person will get notification after someone submit the form. Will get the value from <a href="/admin/settings/">the global settings</a> if it is empty.'),
            TextField::create('MailSubject', 'Mail Subject')
                ->setDescription('We will not send email if this Mail Subject is empty'),

            TextField::create('SuccessTitle', 'Success Title')
                ->setDescription('This will display as a title after the form success submitted.'),
            HTMLEditorField::create('SuccessText', 'Success Text')
                ->setDescription('This will display as a content after the form success submitted.You can put links or images here.'),
        ]);


        $fields->addFieldsToTab('Root.GoogleRecaptcha', [
            CheckboxField::create('GoogleRecaptchaEnable', 'Enable Google Recaptcha')->setDescription(''),

            TextField::create('GoogleRecaptchaCssClass', 'Recaptcha Css Class')->setDescription('Extra css class name for the Google Recaptcha area. eg. mt-4  show-inline-badge mb-5<br/>GoogleRecaptcha v3: Add a string <b>show-inline-badge</b> will display a badge instead of float at right bottom'),

            TextField::create('GoogleRecaptchaNoTickMsg', 'Recaptcha No Tick Msg')->setDescription('GoogleRecaptcha v2: Frontend alert message if not tick the I\'m not a robot checkbox.<br/>GoogleRecaptcha v3: Change the value to <b>v3</b> will use GoogleRecaptcha v3 instead of v2'),

            TextField::create('GoogleRecaptchaSiteKey', 'Recaptcha Site Key')->setDescription('Will get the Site Key from <a href="/admin/settings/">the global settings</a> if it is empty'),
            TextField::create('GoogleRecaptchaSecretKey', 'Recaptcha Secret Key')->setDescription('Will get the Secret Key from <a href="/admin/settings/">the global settings</a> if it is empty'),

        ]);

        return $fields;
    }
}
