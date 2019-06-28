<?php

namespace SilverStripeContactUsForm;

use SilverStripe\Core\Extension;

class ContactUsController extends Extension
{
    private static $allowed_actions = [
        'ContactUsForm',
    ];

    public function ContactUsForm()
    {
        return ContactUsForm::create($this->owner, 'ContactUsForm');
    }
}
