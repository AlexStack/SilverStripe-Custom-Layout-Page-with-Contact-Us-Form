<?php

namespace SSCustomPageWithContactUsForm;

use PageController;
use GoogleRecaptchaToAnyForm\GoogleRecaptcha;
use Silverstripe\SiteConfig\SiteConfig;


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

    public function showGoogleRecaptcha()
    {
        if (!$this->GoogleRecaptchaEnable) {
            return '<!-- GoogleRecaptcha not enable for this page! -->';
        }
        $siteKey = $this->GoogleRecaptchaSiteKey;

        if (strlen($siteKey) < 20) {
            // check the site_key from mysite.xml
            
            $config = SiteConfig::current_site_config();
            if ( strlen($config->GoogleRecaptchaSiteKey)>20 ){
                $siteKey = $config->GoogleRecaptchaSiteKey; 
            } else {
                // no site key
                return '<!-- GoogleRecaptchaSiteKey not set up yet! -->';
            }
        }
        return GoogleRecaptcha::show($siteKey, 'ContactUsForm_ContactUsForm_Message', 'no_debug', $this->GoogleRecaptchaCssClass, $this->GoogleRecaptchaNoTickMsg);
    }

    function loadCustomTemplate()
    {
        $str = '';
        $ssFile = trim(str_replace('.ss', '', $this->PageLayoutFilename));
        if ($ssFile != '') {
            $str = '' . $this->renderWith('Includes/' . $ssFile);
        }
        return $str;
    }


}
