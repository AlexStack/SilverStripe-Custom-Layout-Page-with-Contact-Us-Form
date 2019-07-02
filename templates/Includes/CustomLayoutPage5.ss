<div class="row">
  <div class="col-md mb-4 text-center custom-page-title">
      <h1>$Title</h1>
  </div>
</div>
<div class="row custom-page-content">
  <div class="col-md-6 MainContent">
    $Content
  </div>
  <div class="col-md-6 ExtraContent ExtraContent1">
    $ExtraContent1
  </div>
  <div class="col-md-6 ExtraContent ExtraContent2">
    $ExtraContent2
  </div>
  <div class="col-md-6 ExtraContent ExtraContent3">
    $ExtraContent3
  </div>
</div>

<% if FormEnable %>
<div class="row">
  <div class="col-md-12 custom-contact-us-form">
    <% include ContactUsCustomFormCode %>
  </div>
</div>
<% end_if %>
