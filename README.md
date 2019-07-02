# SilverStripe Custom Layout Page with Contact Us Form & Google Recaptcha

- SilverStripe Custom Layout Page with Contact Us Form & flexible frontend with Google Recaptcha.

# How to install

```php
composer require alexstack/silverstripe-custom-page-with-contact-us-form
```

# How to use it
- Create a new page in SilverStripe admin and choose page type "Custom Page with Contact Us Form"
- Choose custom page layout or use your own template xxx.ss
- Change Form Settings 
- Set up Google Recaptcha
- Save & publish the page

# Create a new page in SilverStripe admin and choose page type "Custom Page with Contact Us Form"
![choose page type](docs/images/choose-page-type.png "choose page type")

# Choose custom page layout
![Choose custom page layout](docs/images/select-page-layout.png "Choose custom page layout")

# Change Form Settings 
![Change Form Settings](docs/images/contact-us-form-settings.png "Change Form Settings")

# Set up Google Recaptcha
![Set up Google Recaptcha](docs/images/set-up-google-recaptcha.png "Set up Google Recaptcha")

# Change global settings
![Change global settings](docs/images/global-settings.png "Change global settings")

# Built-in page layouts
- It will use your page.ss in your own theme folder for global layout. eg. it will use your own header/footer/css/js
- Built-in page layouts use bootstrap 4.x for grid layout
### Content Left, Form right if enabled 
![Content Left, Form right if enabled](docs/images/page-layout-001.png "Content Left, Form right if enabled")
### Content Right, Form left if enabled  
![Content Right, Form left if enabled ](docs/images/page-layout-002.png "Content Right, Form left if enabled ")
### Content Top, Form bottom if enabled  
![Content Top, Form bottom if enabled ](docs/images/page-layout-003.png "Content Top, Form bottom if enabled ")
### Content Top, 3 cards below with Extra Images 1,2,3  
![Content Top, 3 cards below with Extra Images 1,2,3 ](docs/images/page-layout-004.png "Content Top, 3 cards below with Extra Images 1,2,3 ")
### 2 Contents per line, 2 lines with Extra Content 1,2,3  
![2 Contents per line, 2 lines with Extra Content 1,2,3 ](docs/images/page-layout-005.png "2 Contents per line, 2 lines with Extra Content 1,2,3 ")

# Use your own .ss template file for a custom page layout
- eg. NewProductPage.ss. Please make sure the template file your-theme/templates/includes/xxx.ss already exists!
- How to start the .ss: Copy vendor/alexstack/silverstripe-custom-page-with-contact-us-form/templates/Includes/CustomLayoutPage1.ss to your-theme/includes, rename it to NewProductPage.ss, change the .ss code inside to what you want. Just keep the variable name the same.
- Do not forget to run /dev/build?flush=1 first to load your new .ss template

# Contact Us Form display fields
- There are some built-in fields. You can choose what fields will display from FirstName | Email | Phone | Message | LastName | Mobile | Company | Website | Address | Street | PostalCode | City | State | Country 
- Use | for the fields separator.  

# Override the frontend form template
- You can override the .ss template file if you want to add more fields or change fields display orders, or something else. 
- How to override: Copy vendor/alexstack/silverstripe-custom-page-with-contact-us-form/templates/Includes/ContactUsCustomForm1.ss to your-theme/includes, and add/change the html inside to what you want. Just keep the input field name the same.
- Can I add more fields to the form? You can also add some extra fields to extend the form without touch a php file or database. Available extra field names are: ExtraData1, ExtraData2, ExtraData3, ExtraData4, ExtraData5, Category, MyDate

# License
- New BSD