<?php if(Config::empty_module() || Config::eq_module('all')): ?>
<a href="?p=page&m=add" class="btn btn-primary"><i class="fa fa-plus"></i> Add data</a><br><br>
<table id="datatables" class="table table-striped table-bordered table-hover">
	<thead>
		<tr>
			<th><label class="pos-rel">
				<input type="checkbox" class="ace" />
				<span class="lbl"></span>
				</label></th>
			<th>Icon</th>
			<th>Nama menu</th>
			<th>Parent</th>
			<th>Type menu</th>
			<th>Tampil</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($data as $d): ?>
		<tr>
			<td><label class="pos-rel">
				<input type="checkbox" class="ace" />
				<span class="lbl"></span>
				</label></td>
			<td><i class="fa <?=$d['icon'];?>"></i></td>
			<td><?=$d['page_name'];?></td>
			<td><?=($d['parent'] != 0 || $d['parent'] != null) ? $db->fetch_rows_where('pc_menu',$d['parent'])['page_name'] : 'NONE'; ?></td>
			<td><?=$d['type_menu'];?></td>
			<td><?=($d['tampil'] == 'Y') ? "Ya" : "Tidak";?></td>
			<td>
				<?=Config::admin_action(['r','e','d'],'page',1);?>
			</td>
		</tr>
	<?php endforeach;?>
	</tbody>
</table>

<?php elseif(Config::eq_module('add')): ?>

<div class="widget-box">
<div class="widget-header">
<h4 class="widget-title">Default</h4>
</div>

<div class="widget-body">
<div class="widget-main ">
<form class="form-horizontal" method="post">
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Page name / menu </label>
<div class="col-sm-9">
<input type="text" name="page_name" placeholder="page name" class="col-xs-10 col-sm-5 form-control" />
</div>
</div>

<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Icon </label>
<div class="col-sm-9">
<input type="text" name="icon" placeholder="fa-users" class="col-xs-10 col-sm-5 form-control" />
</div>
</div>

<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Type menu </label>
<div class="col-sm-9">
<select class="form-control select2" name="type_menu">
	<option></option>
	<option value="main">Main ( Tree )</option>
	<option value="page">Page</option>
</select>
</div>
</div>

<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Parent </label>
<div class="col-sm-9">
<select class="form-control select2" name="parent">
<option>NONE</option>
<?php foreach($data as $d): ?>
	<option value="<?=$d['id'];?>"><?=$d['page_name'];?></option>
<?php endforeach; ?>
</select>
</div>
</div>

<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" > Urutan Menu </label>
<div class="col-sm-9">
<input type="number" name="urutan" placeholder="urutan" class="col-xs-10 col-sm-5 form-control" />
</div>
</div>

<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" >Tampil </label>
<div class="col-sm-9">
<label>
<input name="switch-field-1" name="tampil" class="ace ace-switch ace-switch-2" type="checkbox" checked="checked" />
<span class="lbl"></span>
</label>
</div>
</div>

<div class="form-group" id="method" style="display: none;">
<label class="col-sm-3 control-label no-padding-right" >Method </label>
<div class="col-sm-9">
<select class="form-control select2" name="method" >
	<option></option>
	<option value="empty">Empty page</option>
	<option value="crud">CRUD Datatables</option>
</select>
</div>
</div>

<div class="form-group" id="stable" style="display: none;">
<label class="col-sm-3 control-label no-padding-right" >Select tables </label>
<div class="col-sm-9">
<select class="form-control select2" name="stable" >
	<option></option>
	<?php foreach($tables as $tbl): ?>
	<option><?=$tbl[0];?></option>
	<?php endforeach;?>
</select>
</div>
</div>
<div id="add_content"></div>

														

<div class="form-actions">
<a href="javascript:history.go(-1);" class="btn btn-sm btn-danger"><i class="ace-icon fa fa-arrow-left icon-on-left bigger-110"></i> Back</a>
<button type="submit" class="btn btn-sm btn-success">Submit<i class="ace-icon fa fa-arrow-right icon-on-right bigger-110" name="submit"></i></button>
</div>
</form>
</div>
</div>
</div>

<?php endif;?>