
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

			<div class="footer">
				<div class="footer-inner">
					<div class="footer-content">
						<span class="bigger-120">
							<span class="blue bolder">PaniCode x Ace Admin</span> &copy; <?=date('Y');?>
						</span>

						&nbsp; &nbsp;
						<span class="action-buttons">
							<a href="#">
								<i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
							</a>

							<a href="#">
								<i class="ace-icon fa fa-facebook-square text-primary bigger-150"></i>
							</a>

							<a href="#">
								<i class="ace-icon fa fa-rss-square orange bigger-150"></i>
							</a>
						</span>
					</div>
				</div>
			</div>

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script src="assets/js/jquery-2.1.4.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function()
			{
				$('select[name="method"]').change(function()
				{
					var vv=$('select[name="method"]').val();

					if(vv == 'crud')
					{
						$('#stable').show();
					}else{
						$('#stable').hide();
					}
				});

				$('select[name="type_menu"]').change(function()
				{
					var vv=$('select[name="type_menu"]').val();
					/*alert(vv);*/
					if(vv == 'page')
					{
						$('#method').show();
					}else{
						$('#method').hide();
					}
				})
			});
		</script>
		<!-- <![endif]-->

		<!--[if IE]>
<script src="assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="assets/js/bootstrap.min.js"></script>

		<!-- page specific plugin scripts -->

		<!-- ace scripts -->
		<script src="assets/js/ace-elements.min.js"></script>
		<script src="assets/js/ace.min.js"></script>

		<!-- inline scripts related to this page -->

		<!-- datatables -->
		<script type="text/javascript" src="assets/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="assets/js/jquery.dataTables.bootstrap.min.js"></script>
		<script type="text/javascript">
			$('#datatables').dataTable();
		</script>

		<!-- select2 -->
		<script type="text/javascript" src="assets/js/select2.min.js"></script>
	</body>
</html>
