
ContactUsCustomFormCode
<a name="custom-contact-us-form"></a>
<% if Action = success %>
    <div class="success-content">
    <h2>$SuccessTitle</h2>
        $SuccessText
    </div>
<% else_if Action = error %>
<div class="error-message">$ErrorMessage</div>
<div class="contact-us-custom-form">
<% else_if FormEnable %>
    <% if FormLayout =='1' %>
        <% include ContactUsCustomForm1 %>
    <% else_if FormLayout =='2' %>
        <% include ContactUsCustomForm2 %>
    <% else_if FormLayout =='3' %>
        <% include ContactUsCustomForm3 %>
    <% else_if FormLayout =='4' %>
        <% include ContactUsCustomForm4 %>
    <% else %>
        $ContactUsForm	
    <% end_if %>
<% end_if %>
</div>