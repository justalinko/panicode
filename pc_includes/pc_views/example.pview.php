
<?php if(Config::empty_module() || Config::eq_module('all')): ?>

<h3>All data</h3>
<table>
	<thead><th>No</th><th>Example</th></thead>
	<tbody>
		<tr><td>1</td><td>Example view</td></tr>
	</tbody>
</table>

<?php if(Config::eq_module('add')): ?>

<h3>Add data</h3>
<form>
	<input type="" name="">
	<input type="" name="">
</form>

<?php if(Config::eq_module('edit')): ?>

<h3>Edit data</h3>
<form>
	<input type="" name="">
	<input type="" name="">
</form>

<?php endif; ?>
