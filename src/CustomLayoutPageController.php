<?php

namespace SSCustomPageWithContactUsForm;

use PageController;
use GoogleRecaptchaToAnyForm\GoogleRecaptcha;
use Silverstripe\SiteConfig\SiteConfig;
use SilverStripe\View\Requirements;


class CustomLayoutPageController extends PageController
{
    private static $allowed_actions = [
        'success',
        'error',
    ];

    public function init()
    {
        parent::init();
        // in case the simple theme doesn't has bootstrap.css
        if ( strpos($this->ThemeDir(), '/simple')) {
            Requirements::css('https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css');
        }

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

    function formFieldEnabled($fieldName) {
        $ary = explode('|',str_replace(' ','', strtolower($this->DisplayFormFields)));
        if ( in_array(strtolower(trim($fieldName)), $ary) ){
            return true;
        }
        return false;
    }

    function displayFormField($fieldName, $labelText = '', $showLabel = 'showLabel', $attributeStr= '', $inputClass= '', $holderClass= '') {
        if ( !$this->formFieldEnabled($fieldName) ){
            return '';
        }
        if ( $labelText == 'First Name' && !$this->formFieldEnabled('LastName') ){
            $labelText = 'Your Name';
        }

        $labelCss =  ( $showLabel == 'showLabel' ) ? 'showLabel' : 'd-none hideLabel';
        $placeholder =  ( $showLabel == 'showLabel' ) ? '' : $labelText;

        $fieldHtml = '<div id="ContactUsForm_ContactUsForm_' . $fieldName . '_Holder" class="field inputHolder ' . $holderClass .'">
        <label class="' . $labelCss . '" for="ContactUsForm_ContactUsForm_' . $fieldName . '">' . $labelText . '</label>
        <div class="middleColumn">';
        if ( strpos($attributeStr, 'textarea') ){
            $fieldHtml .= '<textarea
            name="' . $fieldName . '"
            class="form-control input-' . $fieldName . ' ' . $inputClass . '"
            id="ContactUsForm_ContactUsForm_' . $fieldName . '"
            placeholder="' . $placeholder . '"
            ' . $attributeStr . '
            ></textarea>';
        } else {
            $fieldHtml .= '<input
            name="' . $fieldName . '"
            class="form-control input-' . $fieldName . ' ' . $inputClass . '"
            id="ContactUsForm_ContactUsForm_' . $fieldName . '"
            placeholder="' . $placeholder . '"
                ' . $attributeStr . '
            />';
        }


        $fieldHtml .= '  </div>
        </div>';

      return $fieldHtml;
    }

}
