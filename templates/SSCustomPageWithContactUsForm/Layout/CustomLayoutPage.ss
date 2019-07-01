<% include Header %>
<div class="container $URLSegment">
    <div class="row">
        <div class="col-md text-center custom-page-title">
            <h1>$Title - $PageLayout</h1>
        </div>
	</div>

<% if PageLayout =='1' %>
	<% include CustomLayoutPage1 %>
<% else_if PageLayout =='2' %>
	<% include CustomLayoutPage2 %>
<% else_if PageLayout =='3' %>
	<% include CustomLayoutPage3 %>
<% else_if PageLayout =='4' %>
	<% include CustomLayoutPage4 %>
<% else_if PageLayout =='5' %>
	<% include CustomLayoutPage5 %>	
<% else_if PageLayout =='101' %>
	$loadCustomTemplate.RAW
<% else %>
	$CustomLayoutPage1	
<% end_if %>

</div>
$showGoogleRecaptcha.RAW