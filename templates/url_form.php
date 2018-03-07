
<style type="text/css">

html body {
	margin-top: 50px !important;
}

#top_form {
	position: fixed;
	top:0;
	left:0;
	width: 100%;
	
	margin:0;
	
	z-index: 2100000000;
	-moz-user-select: none; 
	-khtml-user-select: none; 
	-webkit-user-select: none; 
	-o-user-select: none; 
	
	border-bottom:1px #B5B5B5;
	
    background:#FFF;
	
	height:45px;
	line-height:45px;
}

#top_form input[name=url] {
	width: 1300px;
	height: 20px;
	padding: 5px;
	font: 13px "Helvetica Neue",Helvetica,Arial,sans-serif;
	border: 1px #FFFF
	background: none repeat scroll 0% 0% #FFF;
}

</style>

<script>
var url_text_selected = false;

function smart_select(ele){

	ele.onblur = function(){
		url_text_selected = false;
	};
	
	ele.onclick = function(){
		if(url_text_selected == false){
			this.focus();
			this.select();
			url_text_selected = true;
		}
	};
}
</script>

<div id="top_form">

	<div style="width:800px; margin:0 auto;">
	
		<form action="index.php" method="post" style="margin-bottom:0;">
			<input type="button" value="Home" onclick="window.location.href='index.php'">
			<input name="url" type="text" style="width:650px;" autocomplete="off" placeholder="Url or search" />
			<input type="submit" value="Go" />
		</form>
		
	</div>
	
</div>


<script type="text/javascript">
	smart_select(document.getElementsByName("url")[0]);
</script>
