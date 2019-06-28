<?php

namespace SilverStripeContactUsForm;

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

class ContactUsForm extends Form
{
    protected $currController = false;

    public function __construct(Controller $controller, $name)
    {
        $this->currController = $controller; 

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
 
                HiddenField::create('FromPageUrl')->setValue($this->currController->Link),
                HiddenField::create('ExtraData1'),
                HiddenField::create('ExtraData2'),
                HiddenField::create('ExtraData3'),

                HiddenField::create('FromPageTitle')->setValue($this->currController->Title),
                HiddenField::create('Locale')->setValue($this->currController->Locale),
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

        $session = $this->currController->getRequest()->getSession();
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
        $SQLData = Convert::raw2sql($data);
        //$attrs = $foSaveFormDatatAttributes();

        if ( $this->currController->GoogleRecaptchaEnable ){
            //TODO: try get secret_key from mysite.xml if not set up in this page
            GoogleRecaptcha::verify($this->currController->GoogleRecaptchaSecretKey, 'Google Recaptcha Validation Failed!!');            
        }
 

        $item = ContactUs::create();
        $form->saveInto($item);
        $item->write();



        /**
         * Send Email notification to site administrator or
         * to email specified in MailTo field.
         */
        $email_sent = true; //?
        if ( strpos($SQLData['Email'], '@') ){
            $mailFrom = $this->currController->MailFrom ? $this->currController->MailFrom : $SQLData['Email'];
            $mailTo = $this->currController->MailTo ? $this->currController->MailTo : Email::getAdminEmail();
            $mailSubject = $this->currController->MailSubject ?
                ($this->currController->MailSubject.' - '.$SQLData['FromPageTitle']) :
                'no-subject';
            $email = Email::create($mailFrom, $mailTo, $mailSubject);
            $email->setReplyTo($SQLData['Email']);
            $email->setHTMLTemplate('SilverStripeContactUsForm\\Email\\ContactUsEmail');
            $email->setData($SQLData);
            $email_sent = $email->send();

            // maybe send the user an email as well

        }


        /*
         * Handle validation messages
         * Error message is presented on ContactUsPage.ss layout as
         * a variable $ErrorMessage
         */
        if ($email_sent) {
            $this->currController->redirect($this->currController->Link().'success');
        } else {
            $this->currController->redirect($this->currController->Link().'error');
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
        $session = $this->currController->getRequest()->getSession();
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
