<form
  id="ContactUsForm_ContactUsForm"
  action="/$URLSegment/ContactUsForm/"
  method="post"
  enctype="application/x-www-form-urlencoded"
  class="w-100 contact-us-form"
>
  <p
    id="ContactUsForm_ContactUsForm_error"
    class="message "
    style="display: none"
  ></p>

<fieldset>
<div class="row">
    $displayFormField('FirstName', 'First Name','showLabel', 'required="required"','mb-3', 'col-md-6').RAW 

    $displayFormField('LastName', 'Last Name','showLabel', 'required="false"','mb-3', 'col-md-6').RAW 

    $displayFormField('Email', 'Email','showLabel','type="email" required="required"','mb-3', 'col-md-6').RAW 

    $displayFormField('Phone', 'Phone Number','showLabel','type="text" ','mb-3', 'col-md-6').RAW 

    $displayFormField('Mobile', 'Mobile Number','showLabel','type="text" ','mb-3', 'col-md-6').RAW 

    $displayFormField('Company', 'Company Name','showLabel','type="text" ','mb-3', 'col-md-6').RAW 
      
    $displayFormField('Website', 'Website','showLabel','type="text" ','mb-3', 'col-md-6').RAW 

    $displayFormField('Address', 'Address','showLabel','type="text" ','mb-3', 'col-md-6').RAW
    
    $displayFormField('Street', 'Street','showLabel','type="text" ','mb-3', 'col-md-6').RAW 

    $displayFormField('PostalCode', 'Postal Code','showLabel','type="text" ','mb-3', 'col-md-6').RAW 
  
    $displayFormField('City', 'City','showLabel','type="text" ','mb-3', 'col-md-6').RAW 
  
    $displayFormField('State', 'State','showLabel','type="text" ','mb-3', 'col-md-6').RAW 
  
    $displayFormField('Country', 'Country','showLabel','type="text" ','mb-3', 'col-md-6').RAW 

    $displayFormField('Subject', 'Subject','showLabel','type="text" ','mb-3', 'col-md-6').RAW 

    <div class="w-100"></div>
    $displayFormField('Message', 'Message','showLabel','type="textarea" required="required" minlength="6" rows="8" cols="20"','textarea-class w-100', 'col-md-12').RAW
</div>
</fieldset>

  <div class="btn-toolbar">
    <button
      type="submit"
      name="action_SaveFormData"
      value="Submit"
      class="btn btn-primary mt-2 btn-submit"
      id="ContactUsForm_ContactUsForm_action_SaveFormData"
    >
      <span>Submit</span>
    </button>
  </div>
</form>

