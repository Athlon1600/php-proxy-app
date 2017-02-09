<!DOCTYPE html>
<html>
<head>

<title>PHP-Proxy</title>

<meta name="generator" content="php-proxy.com">
<meta name="version" content="<?=$version;?>">

<style type="text/css">
* {
	box-sizing: border-box;
}

body {
	padding-top: 6em;
	background-color: #002B36;
	color: #93A1A1;
	font-family: Arial,Helvetica,sans-serif;
}

a {
	color: #93A1A1;
}

.url:focus,
.url:active,
.go:focus,
.go:active {
	outline: none;
}

.url {
	width: 88%;
	margin-right: 2%;
	background-color: #FDF6E3;
	color: #657B83;
}

.go {
	width: 10%;
	background-color: #2AA198;
	color: #FDF6E3;
	cursor: pointer;
}

.url,
.go {
	display: block;
	padding: .5em;
	float: left;
	border: none;
	font-size: 14px;
}

.container {
	padding: 1em;
	margin: 1em auto;
	width: 36em;
	background-color: #073642;
}

.container:after {
	display: table;
	content: '';
	clear: both;
}

.footer {
	text-align: center;
}

</style>

</head>

<body>


<div class="container">

	<div style="text-align:center;">
		<h1>PHP-Proxy</h1>
	</div>
	
	<?php if(isset($error_msg)){ ?>
	
	<div id="error">
		<p><?php echo $error_msg; ?></p>
	</div>
	
	<?php } ?>
	
	<div id="frm">
	
	<!-- I wouldn't touch this part -->
	
		<form action="index.php" method="post">
			<input class="url" name="url" type="text" autocomplete="off" placeholder="http://" />
			<input class="go" type="submit" value="Go" />
		</form>
		
		<script type="text/javascript">
			document.getElementsByName("url")[0].focus();
		</script>
		
	<!-- [END] -->
	
	</div>
	
</div>

<div class="footer">
	Powered by <a href="//www.php-proxy.com/" target="_blank">PHP-Proxy</a> <?php echo $version; ?>
</div>


</body>
</html>