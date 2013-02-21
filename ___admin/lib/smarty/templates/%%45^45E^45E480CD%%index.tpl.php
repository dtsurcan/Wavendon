<?php /* Smarty version 2.6.11, created on 2012-03-17 07:04:18
         compiled from index.tpl */ ?>
<!DOCTYPE html>

<html>
<head>
<title>Refer</title>
<meta charset="utf-8">

<script src="js/ga.js"></script>
<script src="http://code.jquery.com/jquery.min.js" type="text/javascript"></script>
 
<script type="text/javascript">
	function lookup(searchFirm) {
		if(searchFirm.length == 0) {
			// Hide the suggestion box.
			//$('#suggestions').hide();
		} else {
			$.post("index.php", {firmName: ""+encodeURIComponent(searchFirm)+"", mod_name: "firms"}, function(data){
				if(data.length >0) {
					$('#suggestions').show();
					$('#autoSuggestionsList').html(data);
				}
              else {
                 $('#autoSuggestionsList').html('');
              }
                
			});
		}
	} // lookup
	
	function fill(thisValue) {
		$('#searchFirm').val(thisValue);
		$('#firm_id').val(thisValue);
		setTimeout("$('#suggestions').hide();", 200);
	}
    

    
</script>

<style type="text/css">
	body {
		font-family: Helvetica;
		font-size: 11px;
		color: #000;
	}
	
	h3 {
		margin: 0px;
		padding: 0px;	
	}

	.suggestionsBox {
		position: relative;
		left: 30px;
		margin: 10px 0px 0px 0px;
		width: 200px;
		background-color: #212427;
		-moz-border-radius: 7px;
		-webkit-border-radius: 7px;
		border: 2px solid #000;	
		color: #fff;
	}
	
	.suggestionList {
		margin: 0px;
		padding: 0px;
	}
	
	.suggestionList li {
		
		margin: 0px 0px 3px 0px;
		padding: 3px;
		cursor: pointer;
	}
	
	.suggestionList li:hover {
		background-color: #659CD8;
	}
</style>

     
</head>
<body>

	<div>
		<form>
			<div>
				firm :
				<br />
				<input type="text" size="30" value='' id="searchFirm" onkeyup="lookup(this.value);" onblur="fill();" />
				<input type="hidden" value='' name="firm_id" id="firm_id" />
			</div>
			
			<div class="suggestionsBox" id="suggestions" style="display: none;">
				<img src="images/upArrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
				<div class="suggestionList" id="autoSuggestionsList">
					
				</div>
			</div>
		</form>
	</div>
    
    
</body>
</html>