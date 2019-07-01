<% include Header %>
<div class="container $URLSegment">
    <div class="row">
        <div class="col-md">
            <h1>$Title</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <% if Action = success %>
				<h2>$SuccessTitle</h2>
				$SuccessText
			<% else_if Action = error %>
            <div class="message required">$ErrorMessage</div>
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
        <div class="col-md-6">
            <div class="MainContent">
				$Content
			</div>			
            <div class="ExtraText ExtraText1">
				$ExtraText1
			</div>	
            <div class="ExtraImage ExtraImage1">
				$ExtraImage1
			</div>						
            <div class="ExtraContent ExtraContent1">
                $ExtraContent1
			</div>
            <div class="ExtraText ExtraText2">
				$ExtraText2
			</div>	
			<div class="ExtraImage ExtraImage2">
				$ExtraImage2
			</div>			
            <div class="ExtraContent ExtraContent2">
				$ExtraContent2
			</div>
            <div class="ExtraText ExtraText3">
				$ExtraText3
			</div>	
			<div class="ExtraImage ExtraImage3">
				$ExtraImage3
			</div>				
			<div class="ExtraContent ExtraContent3">
				$ExtraContent3
			</div>							
        </div>
    </div>
</div>
$showGoogleRecaptcha.RAW