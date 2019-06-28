<?php

namespace SilverStripeContactUsForm;

use PageController;
use GoogleRecaptchaToAnyForm\GoogleRecaptcha;


class CustomLayoutPageController extends PageController
{
    private static $allowed_actions = [
        'success',
        'error',
    ];

    public function init()
    {
        parent::init();

    }

    public function ErrorMessage()
    {
        return 'Woops, Something went wrong with the submission. Please contact us or try again later.';
    }

    public function showGoogleRecaptcha()   {
        if ( !$this->GoogleRecaptchaEnable ){
            return '<!-- GoogleRecaptcha not enable for this page! -->';
        }
        if ( strlen($this->GoogleRecaptchaSiteKey) < 20 ) {
            // check the site_key from mysite.xml

            // no site key
            return '<!-- GoogleRecaptchaSiteKey not set up yet! -->';
        }
        return GoogleRecaptcha::show($this->GoogleRecaptchaSiteKey, 'CustomLayoutForm_CustomLayoutForm_Message', 'no_debug', $this->GoogleRecaptchaCssClass, $this->GoogleRecaptchaNoTickMsg);
    }    
}
