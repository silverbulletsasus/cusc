<?php include("header.php") ?>
<?php include("controller/c_loaisanpham.php") ?>
<?php
	// kiểm tra truyển mã loại sản phẩm qua GET
	if(isset($_GET['lsp_ma']))
	{
		$lsp_ma = $_GET['lsp_ma'];
		$loaisanpham = new C_loaisanpham();
		$result = $loaisanpham->getdataLSP($lsp_ma);
	}
	else
	{
		header('location: quanly_loaisanpham.php');
	}
?>

<?php
	//kiểm tra nhấn nút submit để cập nhật
	if(isset($_POST['submit']))
	{
		$ten = $_POST['tenlsp'];
		$mota = $_POST['motalsp'];
		$loaisanpham->updateLSP($lsp_ma, $ten, $mota);
	}
?>
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-push-2">
				<div class="panel panel-default">
					<div class="panel-heading">Cập nhật thông tin loại sản phẩm</div>
					<div class="panel-body">
						<form action="" method="post">
							<div>
								<label>Tên loại sản phẩm</label>
								<input type="text" class="form-control" name="tenlsp" value="<?php echo $result->lsp_ten ?>">
							</div>
							<br>
							<div>
								<label>Mô tả loại sản phẩm</label>
								<input type="text" class="form-control" name="motalsp" value="<?php echo $result->lsp_mota ?>">
							</div>
							<br>
							<div>
								<button type="submit" class="btn btn-primary" name="submit">Sửa</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php include("footer.php") ?>