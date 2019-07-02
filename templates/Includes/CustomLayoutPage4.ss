<div class="row">
  <div class="col-md mb-4 text-center custom-page-title">
      <h1>$Title</h1>
  </div>
</div>
<div class="row">
  <div class="col-md-12 custom-page-content ">
    <div class="MainContent">
      $Content
	</div>
  </div>
</div>

<div class="row">
    <div class="col-md-4 first-card">
      <div class="card text-left ExtraImage ExtraImage1">
        <img class="card-img-top" src="$ExtraImage1.URL" alt="" />
      </div>
      <div class="card-body">
        <div class="ExtraText ExtraText1">
          <h4 class="card-title">
            $ExtraText1
          </h4>
        </div>
        <div class="card-text ExtraContent ExtraContent1">
          $ExtraContent1
        </div>
      </div>
    </div>
    <div class="col-md-4 second-card">
      <div class="card text-left ExtraImage ExtraImage2">
        <img class="card-img-top" src="$ExtraImage2.URL" alt="" />
      </div>
      <div class="card-body">
        <div class="ExtraText ExtraText2">
          <h4 class="card-title">
            $ExtraText2
          </h4>
        </div>
        <div class="card-text ExtraContent ExtraContent2">
          $ExtraContent2
        </div>
      </div>
    </div>
    <div class="col-md-4 third-card">
      <div class="card text-left ExtraImage ExtraImage3">
        <img class="card-img-top" src="$ExtraImage3.URL" alt="" />
      </div>
      <div class="card-body">
        <div class="ExtraText ExtraText3">
          <h4 class="card-title">
            $ExtraText3
          </h4>
        </div>
        <div class="card-text ExtraContent ExtraContent3">
          $ExtraContent3
        </div>
      </div>
    </div>
  </div>

</div>


  <% if FormEnable %>
  <div class="row">
  <div class="col-md-12 custom-contact-us-form">
    <% include ContactUsCustomFormCode %>
  </div>
  </div>
  <% end_if %>

