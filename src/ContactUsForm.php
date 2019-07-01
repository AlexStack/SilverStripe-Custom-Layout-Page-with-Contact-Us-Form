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
                    ->setAttribute('placeholder','Your Phone number')
                    ->setAttribute('class', 'form-control')
                    ,

                TextField::create('Address')
                    ->setTitle('Address')
                    ->setAttribute('placeholder', '')->setAttribute('class', 'form-control'),
                TextField::create('CompanyName')
                    ->setTitle('Company Name')
                    ->setAttribute('class', 'form-control')
                    ,
                TextField::create('Website')
                ->setAttribute('class', 'form-control'),

                TextareaField::create('Message')
                    ->setTitle('Message')
                    ->setRows(8)->setAttribute('class', 'form-control')
                    ->setAttribute('required', 'required')
                    ->setAttribute('minlength', '6'),
 
                HiddenField::create('FromPageUrl')->setValue($this->currentController->Link),
                HiddenField::create('ExtraData1'),
                HiddenField::create('ExtraData2'),
                HiddenField::create('ExtraData3'),

                HiddenField::create('FromPageTitle')->setValue($this->currentController->Title),
                HiddenField::create('Locale')->setValue($this->currentController->Locale),
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
        $form->saveInto($item);
        $item->write();



        /**
         * Send Email notification to site administrator or
         * to email specified in MailTo field.
         */
        $email_sent = true; //?
        if ( strpos($raw2sqlData['Email'], '@') ){
            $mailFrom = $raw2sqlData['Email'];
            $mailTo = $this->currentController->MailTo ? $this->currentController->MailTo : $config->ContactUsEmail;
            $mailSubject = $this->currentController->MailSubject ?
                ($this->currentController->MailSubject.' - '.$raw2sqlData['FromPageTitle']) :
                'no-subject';
            $email = Email::create($mailFrom, $mailTo, $mailSubject);
            $email->setReplyTo($raw2sqlData['Email']);
            $email->setHTMLTemplate('SSCustomPageWithContactUsForm\\Email\\ContactUsEmail');
            $email->setData($raw2sqlData);
            $email_sent = $email->send();

            // maybe send the user an email as well

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
}

class ContactUsForm_Validator extends RequiredFields
{
    public function php($data)
    {
        $this->form->saveDataToSession();

        return parent::validate($data);
    }
}