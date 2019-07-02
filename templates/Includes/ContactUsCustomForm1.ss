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
    $displayFormField('FirstName', 'First Name','showLabel', 'required="required"','input-class').RAW 

    $displayFormField('LastName', 'Last Name','showLabel', 'required="false"','input-class').RAW 

    $displayFormField('Email', 'Email','showLabel','type="email" required="required"','input-class').RAW 

    $displayFormField('Phone', 'Phone Number','showLabel','type="text" ','input-class').RAW 

    $displayFormField('Mobile', 'Mobile Number','showLabel','type="text" ','input-class').RAW 

    $displayFormField('Company', 'Company Name','showLabel','type="text" ','input-class').RAW 
      
    $displayFormField('Website', 'Website','showLabel','type="text" ','input-class').RAW 

    $displayFormField('Address', 'Address','showLabel','type="text" ','input-class').RAW
    
    $displayFormField('Street', 'Street','showLabel','type="text" ','input-class').RAW 

    $displayFormField('PostalCode', 'Postal Code','showLabel','type="text" ','input-class').RAW 
  
    $displayFormField('City', 'City','showLabel','type="text" ','input-class').RAW 
  
    $displayFormField('State', 'State','showLabel','type="text" ','input-class').RAW 
  
    $displayFormField('Country', 'Country','showLabel','type="text" ','input-class').RAW 

    $displayFormField('Subject', 'Subject','showLabel','type="text" ','input-class').RAW 

    $displayFormField('Message', 'Message','showLabel','type="textarea" required="required" minlength="6" rows="8" cols="20"','textarea-class w-100').RAW
 
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

