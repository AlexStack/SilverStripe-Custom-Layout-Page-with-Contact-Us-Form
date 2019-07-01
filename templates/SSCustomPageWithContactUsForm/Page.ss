<!DOCTYPE html>
<html lang="$ContentLocale">
  <head>
  	<% base_tag %>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Alex">
	  <title><% if $URLSegment == 'home' %>$SiteConfig.Title<% else %><% if $MetaTitle %>$MetaTitle<% else %>$Title<% end_if %> - $SiteConfig.Title<% end_if %></title>

        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">

        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

  </head>
  <body class="$ClassName">
  <div class="container-fluid top-container">
 	$Layout   

	<div class="card m-5">
		<div class="card-body">
			<h4 class="card-title">Note</h4>
			<p class="card-text">You can copy this template from vendor/alexstack/silverstripe-contact-us-form/templates/SSCustomPageWithContactUsForm/*.ss to your own template folder to custom the form and page style!</p>
		</div>
	</div>
	
  </div>
  </body>
</html>