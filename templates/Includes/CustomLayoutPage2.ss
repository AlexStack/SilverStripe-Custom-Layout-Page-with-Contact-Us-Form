<div class="row">
  <div class="col-md mb-4 text-center custom-page-title">
      <h1>$Title</h1>
  </div>
</div>
<div class="row">
  <% if FormEnable %>
  <div class="col-md custom-contact-us-form">
    <% include ContactUsCustomFormCode %>
  </div>
  <% end_if %>
  <div class="col-md custom-page-content ">
    <% include CustomLayoutPageContent %>
  </div>
</div>
