<?php include("header.php") ?>
<?php include("controller/c_sanpham.php") ?>
<?php
	if(isset($_GET['masp']))
	{
		$masp = $_GET['masp'];
		$sanpham = new C_sanpham(); // tạo đối tượng dùng cho tất cả xử lý của trang
		$data = $sanpham->getdataSP($masp);
	}
?>
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
		/*$sanpham = new C_sanpham();*/ // đối tượng đã được tạo ở trên
		$sanpham->updateSP($masp, $tensanpham, $malsp, $mansx, $giasanpham, $motasanpham, $motachitietsp, $soluongsp, $ngaycapnhat);
	}
?>
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-push-2">
					<div class="panel panel-default">
						<div class="panel-heading">Cập nhật sản phẩm</div>
						<div class="panel-body">
							<form action="" method="post">
								<div>
									<label>Tên sản phẩm (*):</label>
									<input type="text" class="form-control" name="txtTen" value="<?php echo $data->sp_ten ?>" placeholder="">
								</div>
								<br>
								<div>
									<label>Loại sản phẩm (*):</label>
									<select name="selectLSP" class="form-control">
										<option value="0">Chọn loại sản phẩm</option>
										<?php
											// lấy dữ liệu loại sản phẩm từ database
											$lsp = $sanpham->showLSP();
											foreach($lsp as $temp)
											{
												if($temp->lsp_ma == $data->lsp_ma)// so sánh dữ liệu từ $temp và dữ liệu từ $data lấy ở getdataSP
												{
													echo "<option value='".$temp->lsp_ma."' selected>".$temp->lsp_ten."</option>";
												}
												else
												{
													echo "<option value='".$temp->lsp_ma."'>".$temp->lsp_ten."</option>";
												}
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
											// lấy dữ liệu loại sản phẩm từ database
											$nsx = $sanpham->showNSX();
											foreach($nsx as $temp)// so sánh dữ liệu từ $temp và dữ liệu từ $data lấy ở getdataSP
											{
												if($temp->nsx_ma == $data->nsx_ma)
												{
													echo "<option value='".$temp->nsx_ma."' selected>".$temp->nsx_ten."</option>";
												}
												else
												{
													echo "<option value='".$temp->nsx_ma."'>".$temp->nsx_ten."</option>";
												}
											}
										?>
									</select>
								</div>
								<br>
								<div>
									<label>Giá :</label>
									<input type="text" class="form-control" name="txtGia" value="<?php echo $data->sp_gia ?>" placeholder="">
								</div>
								<br>
								<div>
									<label>Mô tả ngắn (*):</label>
									<input type="text" class="form-control" name="txtMoTaNgan" value="<?php echo $data->sp_mota_ngan ?>" placeholder="">
								</div>
								<br>
								<div class="form-group">
									<label>Mô tả chi tiết :</label>
									<textarea name="txtMoTaChiTiet" class="ckeditor" id="ckeditorupdate"><?php echo $data->sp_mota_chitiet ?></textarea>
									<!-- tích hợp ckeditor cho trang cập nhật sản phẩm-->
									<script>
      										CKEDITOR.replace( '#ckeditorupdate');
  									</script>
								</div>
								<br>
								<div>
									<label>Số lượng :</label>
									<input type="text" class="form-control" name="txtSoLuong" value="<?php echo $data->sp_soluong ?>" placeholder="">
								</div>
								<br>
								<button type="submit" class="btn btn-primary" name="btn_submit">Cập nhật sản phẩm</button>
								<button type="button" class="btn btn-primary" name="delete" onclick="window.location='quanly_sanpham.php'">Bỏ Qua</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php include("footer.php") ?>