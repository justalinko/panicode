
<!DOCTYPE html>
<html>
<head>
	<title>PaniCode - Code for fast project </title>
	<meta name="author" content="alinko">
	<meta name="description" content="PaniCode - Code for fast project ">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?=$html->assets('data:image/png;base64,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','emptylink',['rel' => 'icon']);?>
	<?=$html->assets('fedora.min.css','link');?>
	<?=$html->assets('addon.css','link');?>
</head>
<body>
	<div class="container-full spacer-4">
		<header class="align-center">
			<h1 class="fs-xxlarge">PaniC{/}de</h1>
			<h4>Code for fast project </h4>
			<div class="spacer-1">
				<a href="#" class="btn dark">Download</a> &nbsp; <a href="#" class="btn dark">Documentation</a>
			</div>
			<small>Version 1.0-2018</small>
		</header>

	</div>
	<footer class="align-center text-black">
		<p>Copyright &copy; 2018 <span class="text-dark">PaniC{/}de</span> | Created with <span class="text-dark">&lt;3</span> & <span class="text-dark">&lt;/&gt;</span> by <span class="text-dark">alinko.ID</span></p>
	</footer>
</html>	