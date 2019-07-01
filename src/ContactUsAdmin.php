<?php

namespace SSCustomPageWithContactUsForm;

use SilverStripe\Admin\ModelAdmin;

class ContactUsAdmin extends ModelAdmin
{
    public $showImportForm = false;

    private static $managed_models = [
        ContactUs::class,
    ];

    private static $url_segment = 'ContactUsData';

    private static $menu_title = 'Contact Us Data';

    private static $menu_icon_class = 'font-icon-news';

    public function init()
    {
        parent::init();
    }
}
