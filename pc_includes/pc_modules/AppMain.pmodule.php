<?php 

if(Config::eq_module('download'))
{
	echo "<center><b> Anda akan di alihkan ...</b><br>";
	echo "Tidak di alihkan? <a href='https://github.com/justalinko/panicode' target='_blank'>Klik di sini</a></center>";
	echo "<meta http-equiv='refresh' content='2;url=https://github.com/justalinko/panicode'>";
	exit;
}elseif(Config::eq_module('docs'))
{
	echo "<center><h1>Sorry !</h1></center><hr>";
	echo "<b>Documentation not available for right now.</b>";
	echo "<a href='?p=AppMain'>Back</a>";
	exit;
}

?>