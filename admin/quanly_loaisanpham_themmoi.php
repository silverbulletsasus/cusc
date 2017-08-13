<?php include("header.php") ?>
<?php include("controller/c_loaisanpham.php") ?>
<?php
	if(isset($_POST['submit']))
	{
		$tenloailsp = $_POST['tenlsp'];
		$motalsp = $_POST['mota'];
		$c_loaisanpham = new C_loaisanpham();
		$loaisanpham = $c_loaisanpham->addLSP($tenloailsp, $motalsp);
	}

?>
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-push-2">
				<div class="panel panel-default">
					<div class="panel-heading">Thêm mới loại sản phẩm</div>
					<div class="panel-body">
						<form action="" method="post">
							<div>
								<label>Tên loại sản phẩm:</label>
								<input type="text" name="tenlsp" class="form-control" placeholder="Nhập vào tên loại sản phẩm">
							</div>
							<br>
							<div>
								<label>Mô tả loại sản phẩm:</label>
								<input type="text" name="mota" class="form-control" placeholder="Nhập vào mô tả loại sản phẩm">
							</div>
							<br>
							<button type="submit" class="btn btn-primary" name="submit">Thêm mới</button>
							<button type="button" class="btn btn-primary" onclick="window.location='quanly_loaisanpham.php'">Bỏ Qua</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php include("footer.php") ?>