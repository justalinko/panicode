<?php
if(empty($_GET['m']))
{
	echo "<meta http-equiv='refresh' content='0;url=?m=view'/>";
}else{
	if($_GET['m'] == 'view'){
	?>
	<!DOCTYPE html>
<html>
<head>
	<title>:: Installer :: PaniCode v1.0-2018</title>
	<link rel="stylesheet" type="text/css" href="pc_assets/css/fedora.min.css">
	<link rel="stylesheet" type="text/css" href="pc_assets/css/addon.css">
	<style type="text/css">
		.form-control{border: 2px solid #333;padding: 6px;background: white;margin: 6px;width:90%;}
		.form-control:focus,.form-control:hover,.form-control:active{box-shadow: 0px 0px 3px  #333;transition-duration: 0.3s;-o-transition-duration: 0.3s;-moz-transition-duration: 0.3s;-webkit-transition-duration: 0.3s;-o-box-shadow: 0px 0px 3px  #333;-moz-box-shadow: 0px 0px 3px  #333;-webkit-box-shadow: 0px 0px 3px  #333}
	</style>
</head>
<body style="background: #eee">
<div class="container w-50 bg-white">
	<div class="alert spacer-2" id="ap">
		<h3 class="align-center text-dark">Just one step installation ~</h3>
	</div><br>
	<div class="alert  spacer-2">
		<form method="post" id="form_install">
			<div class="alert info">
				<h4>Database configuration</h4>
			</div>
			<label>Hostname</label>&nbsp;
			<input type="text" name="hostname" placeholder="localhost" class="form-control" required="required"><br>
			<label>Username</label>&nbsp;
			<input type="text" name="username" placeholder="root" class="form-control" required="required"><br>
			<label>Password</label>&nbsp;&nbsp;
			<input type="password" name="password" placeholder="*****" class="form-control" required="required"><br>
			<label>Database</label>&nbsp;&nbsp;
			<input type="text" name="database" placeholder="database name ( buatlah terlebih dahulu )" class="form-control" required="required"><br>
			<div class="alert info">
				<h4>Website configuration</h4>
			</div>
			<label>Base URL</label>&nbsp;
			<input type="url" name="base_url" placeholder="http://localhost/path/" class="form-control" required="required"><br>
			<label>Base Directory</label>&nbsp;
			<input type="text" name="base_dir" placeholder="path/" class="form-control" required="required"><br>
			<label>Base Admin</label>&nbsp;&nbsp;
			<input type="text" name="base_admin" placeholder="path/administrator/" class="form-control" required="required"><br>
			<label>Private key</label>&nbsp;&nbsp;
			<input type="text" name="key" placeholder="Key" class="form-control" required="required"><br>
			<br><br>
			<input type="submit" name="install" value="Install sekarang" class="btn info block" id="install">
		</form>
	</div>
</div>
<script type="text/javascript" src="assets/js/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function()
	{
		$('#install').click(function()
		{
			$('#install').attr({
				disabled : true,
				class : 'btn warning block',
				value : 'Loading.. Installation in proccess !',
			});
			$.ajax({
				type : 'POST',
				url : 'install.php?m=execute',
				data : $('#form_install').serialize(),
				success:function(data)
				{
					if(data == "good")
					{
						$('#ap').attr('class','alert success spacer-2');
						$('#ap').html('<h3 class="align-center text-white">Installasi berhasil!</h3><meta http-equiv="refresh" content="2;url=./";?>');
					}else{
						$('#ap').attr('class','alert danger spacer-2');
						$('#ap').html('<h3 class="align-center text-white">Installasi gagal!</h3><br>'+data);
						$('#install').attr({
					class : 'btn info block',
					value : 'Install sekarang !',
					disabled : false,
					});
					}
				},error:function(data)
				{
					alert('ERROR : '+data);
				}
			});
			
			return false;
		});
	});
</script>
</body>
</html>
<?php

}

}