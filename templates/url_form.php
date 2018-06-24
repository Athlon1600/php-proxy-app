<style type="text/css">
html body {
	margin-top: 50px !important;
}
#php-proxy-bar {
	position: fixed;
	top:0;
	left:0;
	width: 100%;
	transition: top 0.3s;
	
	margin:0;
	
	z-index: 2100000000;
	-moz-user-select: none; 
	-khtml-user-select: none; 
	-webkit-user-select: none; 
	-o-user-select: none; 
	
	border-bottom:1px solid #151515;
	
    background:#073642;
	
	height:46px;
	line-height:46px;
}
#php-proxy-form {
	width: 800px;
	margin: 8px auto 0;
}
#php-proxy-home {
	margin: 0 2% 0 0;
	background-color: #586E75;
	color: #FDF6E3;
	font-size: 24px;
}
#php-proxy-url {
	margin: 0 2% 0 0;
	width: 74%;
	background-color: #FDF6E3;
	color: #657B83;
}
#php-proxy-url:focus,
#php-proxy-url:active,
#php-proxy-go:focus,
#php-proxy-go:active,
#php-proxy-home:focus,
#php-proxy-home:active {
	outline: none;
}
#php-proxy-go {
	margin: 0;
	background-color: #2AA198;
	background-image: none;
	color: #FDF6E3;
	line-height: normal;
}
#php-proxy-home,
#php-proxy-go {
	width: 10%;
	text-align: center;
	text-shadow: none;
	cursor: pointer;
}
#php-proxy-home,
#php-proxy-url,
#php-proxy-go {
	box-sizing: border-box;
	display: block;
	float: left;
	padding: .5em;
	height: 30px;
	font-size: 14px;
	border: none;
	font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
	border-radius: 0;
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

<div id="php-proxy-bar">
	<form id="php-proxy-form" method="post" action="index.php" target="_top">
		<input id="php-proxy-home" type="button" value="Home" onclick="window.location.href='index.php'" />
		<input id="php-proxy-url" type="text" name="url" value="<?php echo $url; ?>" autocomplete="off">
		
		<input type="hidden" name="form" value="1">
		<input id="php-proxy-go" type="submit" value="Go" />
	</form>
</div>

<script>
var prevScrollpos = window.pageYOffset;
window.onscroll = function() {
var currentScrollPos = window.pageYOffset;
  if (prevScrollpos > currentScrollPos) {
    document.getElementById("php-proxy-bar").style.top = "0";
  } else {
    document.getElementById("php-proxy-bar").style.top = "-50px";
  }
  prevScrollpos = currentScrollPos;
}
</script>

<script type="text/javascript">
	smart_select(document.getElementsByName("url")[0]);
</script>
