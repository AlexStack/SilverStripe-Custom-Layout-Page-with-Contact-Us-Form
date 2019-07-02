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
    $displayFormField('FirstName', 'First Name','hideLabel', 'required="required"','input-class').RAW 

    $displayFormField('LastName', 'Last Name','hideLabel', 'required="false"','input-class').RAW 

    $displayFormField('Email', 'Email','hideLabel','type="email" required="required"','input-class').RAW 

    $displayFormField('Phone', 'Phone Number','hideLabel','type="text" ','input-class').RAW 

    $displayFormField('Mobile', 'Mobile Number','hideLabel','type="text" ','input-class').RAW 

    $displayFormField('Company', 'Company Name','hideLabel','type="text" ','input-class').RAW 
      
    $displayFormField('Website', 'Website','hideLabel','type="text" ','input-class').RAW 

    $displayFormField('Address', 'Address','hideLabel','type="text" ','input-class').RAW
    
    $displayFormField('Street', 'Street','hideLabel','type="text" ','input-class').RAW 

    $displayFormField('PostalCode', 'Postal Code','hideLabel','type="text" ','input-class').RAW 
  
    $displayFormField('City', 'City','hideLabel','type="text" ','input-class').RAW 
  
    $displayFormField('State', 'State','hideLabel','type="text" ','input-class').RAW 
  
    $displayFormField('Country', 'Country','hideLabel','type="text" ','input-class').RAW 

    $displayFormField('Subject', 'Subject','hideLabel','type="text" ','input-class').RAW 

    $displayFormField('Message', 'Message','hideLabel','type="textarea" required="required" minlength="6" rows="8" cols="20"','textarea-class w-100').RAW
 
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

