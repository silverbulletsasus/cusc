<?php include("header.php") ?>
<?php include("controller/c_sanpham.php") ?>
<?php
	if(isset($_POST["btn_submit"]))
	{
		$tensanpham = $_POST['txtTen'];
		$malsp = $_POST['selectLSP'];
		$mansx = $_POST['selectNSX'];
		$giasanpham = $_POST['txtGia'];
		$motasanpham = $_POST['txtMoTaNgan'];
		$motachitietsp = $_POST['txtMoTaChiTiet'];
		$soluongsp = $_POST['txtSoLuong'];
		$ngaycapnhat = date('Y-m-d H:i:s');
		$sanpham = new C_sanpham();
		$sanpham->addSP($tensanpham, $malsp, $mansx, $giasanpham, $motasanpham, $motachitietsp, $soluongsp, $ngaycapnhat);
	}
?>
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-push-2">
					<div class="panel panel-default">
						<div class="panel-heading">Thêm mới sản phẩm</div>
						<div class="panel-body">
							<form action="" method="post">
								<div>
									<label>Tên sản phẩm (*):</label>
									<input type="text" class="form-control" name="txtTen" value="" placeholder="">
								</div>
								<br>
								<div>
									<label>Loại sản phẩm (*):</label>
									<select name="selectLSP" class="form-control">
										<option value="0">Chọn loại sản phẩm</option>
										<?php
											$sanpham = new C_sanpham();
											$row = $sanpham->showLSP();
											foreach($row as $data)
											{
										?>
											<option value="<?php echo $data->lsp_ma ?>"><?php echo $data->lsp_ten ?></option>
										<?php
											}
										?>
									</select>
								</div>
								<br>
								<div>
									<label>Hãng sản xuất (*):</label>
									<select name="selectNSX" class="form-control">
										<option value="0">Chọn nhà sản xuất</option>
										<?php
											$sanpham = new C_sanpham();
											$row = $sanpham->showNSX();
											foreach($row as $data)
											{
										?>
												<option value="<?php echo $data->nsx_ma ?>"><?php echo $data->nsx_ten ?></option>
										<?php
											}
										?>
									</select>
								</div>
								<br>
								<div>
									<label>Giá :</label>
									<input type="text" class="form-control" name="txtGia" value="" placeholder="">
								</div>
								<br>
								<div>
									<label>Mô tả ngắn (*):</label>
									<input type="text" class="form-control" name="txtMoTaNgan" value="" placeholder="">
								</div>
								<br>
								<div class="form-group">
									<label>Mô tả chi tiết :</label>
									<textarea name="txtMoTaChiTiet" class="ckeditor" id="ckeditoradd"></textarea>
									<!-- tích hợp ckeditor cho trang thêm mới sản phẩm-->
									<script>
      									CKEDITOR.replace( '#ckeditoradd' );
  									</script>
								</div>
								<br>
								<div>
									<label>Số lượng :</label>
									<input type="text" class="form-control" name="txtSoLuong" value="" placeholder="">
								</div>
								<br>
								<button type="submit" class="btn btn-primary" name="btn_submit">Thêm sản phẩm</button>
								<button type="button" class="btn btn-primary" name="delete" onclick="window.location='quanly_sanpham.php'">Bỏ Qua</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php include("footer.php") ?>