<?php

namespace SSCustomPageWithContactUsForm;

use SilverStripe\Control\Controller;
use SilverStripe\Control\Email\Email;
use SilverStripe\Control\HTTPRequest;
use SilverStripe\Core\Convert;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\EmailField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\Form;
use SilverStripe\Forms\FormAction;
use SilverStripe\Forms\HiddenField;
use SilverStripe\Forms\RequiredFields;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\TextField;
use GoogleRecaptchaToAnyForm\GoogleRecaptcha;
use Silverstripe\SiteConfig\SiteConfig;
use Exception;

class ContactUsForm extends Form
{
    protected $currentController = false;

    public function __construct(Controller $controller, $name)
    {
        $this->currentController = $controller; 

        $fields = FieldList::create(
            [
                TextField::create('FirstName')
                    ->setTitle('First Name')
                    ->setAttribute('required', 'required')
                    ->setAttribute('class', 'form-control')
                    ,

                TextField::create('LastName')
                    ->setTitle('Last Name')
                    ->setAttribute('class', 'form-control')
                    ,

                EmailField::create('Email')
                    ->setTitle('Email')
                    ->setAttribute('type', 'email')
                    ->setAttribute('class', 'form-control')
                    ->setAttribute('required', 'required')
                    ,

                TextField::create('Phone')
                    ->setTitle('Phone')
                    ->setAttribute('class', 'form-control')
                    ,
                TextField::create('Mobile')
                    ->setAttribute('class', 'form-control')
                    ,
                
                TextField::create('CompanyName')
                    ->setTitle('Company Name')
                    ->setAttribute('class', 'form-control')
                    ,
                TextField::create('Website')
                ->setAttribute('class', 'form-control'),


                TextField::create('Address')
                ->setTitle('Address')
                ->setAttribute('placeholder', '')->setAttribute('class', 'form-control'),

                TextField::create('Street')
                ->setAttribute('class', 'form-control')
                ,
                TextField::create('PostalCode')
                ->setAttribute('class', 'form-control')
                ,
                TextField::create('City')
                ->setAttribute('class', 'form-control')
                ,
                TextField::create('State')
                ->setAttribute('class', 'form-control')
                ,
                TextField::create('Country')
                ->setAttribute('class', 'form-control')
                ,
                TextField::create('Subject')
                ->setAttribute('class', 'form-control')
                ,                
                TextareaField::create('Message')
                    ->setTitle('Message')
                    ->setRows(8)->setAttribute('class', 'form-control')
                    ->setAttribute('required', 'required')
                    ->setAttribute('minlength', '6'),
 

                HiddenField::create('ExtraData1'),
                HiddenField::create('ExtraData2'),
                HiddenField::create('ExtraData3'),
                HiddenField::create('ExtraData4'),
                HiddenField::create('ExtraData5'),
                HiddenField::create('Category'),
                HiddenField::create('MyDate'),

            ]
        );

        $actions = FieldList::create(
            FormAction::create('SaveFormData', 'Submit')->setUseButtonTag(true)->setAttribute('class', 'btn btn-primary mt-2 btn-submit')
        );

        $validator = RequiredFields::create('FirstName');
 
        parent::__construct($controller, $name, $fields, $actions, $validator);

        $this->disableSecurityToken();

        if (null !== $this->extend('updateFields', $fields)) {
            $this->setFields($fields);
        }
        if (null !== $this->extend('updateActions', $actions)) {
            $this->setActions($actions);
        }

        $session = $this->currentController->getRequest()->getSession();
        $oldData = $session->get("FormInfo.{$this->FormName()}.data");
        if ($oldData && (is_array($oldData) || is_object($oldData))) {
            $this->loadDataFrom($oldData);
        }
        $this->extend('updateContactUsForm', $this);
    }

    /**
     * Form action handler for ContactUsForm.
     *
     * @param array $data The form request data submitted
     * @param Form  $form The {@link Form} this was submitted on
     */
    public function SaveFormData(array $data, Form $form, HTTPRequest $request)
    {
        $data['FromPageUrl'] = $this->currentController->AbsoluteLink();
        $data['FromPageTitle'] = $this->currentController->Title;

        $raw2sqlData = Convert::raw2sql($data);
        $config = SiteConfig::current_site_config();

        if ( $this->currentController->GoogleRecaptchaEnable ){
            $secretKey = $this->currentController->GoogleRecaptchaSecretKey;

            if ( strlen($secretKey) < 20 ){
                $secretKey = $config->GoogleRecaptchaSecretKey;
            }
            
            
            GoogleRecaptcha::verify($secretKey, 'Google Recaptcha Validation Failed!!');
        }

        $item = ContactUs::create();

        $item->FromPageTitle = $data['FromPageTitle'];
        $item->FromPageUrl = $data['FromPageUrl'];
        $item->IP = $this->getClientIP();
        $form->saveInto($item);
        $item->write();



        /**
         * Send Email notification to site administrator or
         * to email specified in MailTo field.
         */
        $email_sent = true; //?
        $mailFrom = $raw2sqlData['Email'];
        $mailTo = $this->currentController->MailTo ? $this->currentController->MailTo : $config->ContactUsEmail;

        try{
            if ( strpos($mailFrom, '@') && strpos($mailTo, '@') ){

                $mailSubject = $this->currentController->MailSubject ?
                    ($this->currentController->MailSubject . ' from ' . $config->Title) :
                    'no-subject';
                $email = Email::create($mailFrom, $mailTo, $mailSubject);
                $email->setReplyTo($raw2sqlData['Email']);
                $email->setHTMLTemplate('SSCustomPageWithContactUsForm\\Email\\ContactUsEmail');
                $email->setData($raw2sqlData);
                $email_sent = $email->send();
                
                // maybe send the user an email as well
    
            }
        } 
        catch(Exception $e) {
            $email_sent = false;
        }



        /*
         * Handle validation messages
         * Error message is presented on ContactUsPage.ss layout as
         * a variable $ErrorMessage
         */
        if ($email_sent) {
            $this->currentController->redirect($this->currentController->Link().'success');
        } else {
            $this->currentController->redirect($this->currentController->Link().'error');
        }

        return false;
    }

    /**
     * saves the form into session.
     *
     * @param array $data - data from form
     */
    public function saveDataToSession()
    {
        $data = $this->getData();
        $session = $this->currentController->getRequest()->getSession();
        $session->set("FormInfo.{$this->FormName()}.data", $data);
    }

    // Function to get the client IP address
    function getClientIP() {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }    
}



class ContactUsForm_Validator extends RequiredFields
{
    public function php($data)
    {
        $this->form->saveDataToSession();

        return parent::validate($data);
    }
}
