<div class="card-header mb-2">
    <h3 class="h6">Thêm phiếu giảm giá cho tất cả khóa học</h3>
</div>
<div class="form-group row">
    <label class="col-lg-3 col-from-label" for="coupon_code">Ma </label>
    <div class="col-lg-9">
        <input type="text" placeholder="Nhap ma" id="ma_km" name="ma_khuyen_mai" class="form-control" required>
    </div>
</div>
<div class="form-group row">
    <label class="col-md-3 col-from-label">Mo ta</label>
    <div class="col-md-9">
        <textarea class="aiz-text-editor" name="mo_ta" rows="9" required></textarea>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-3 control-label" for="start_date">Ngày bắt đầu và ngày kết thúc </label>
    <div class="col-sm-9">
      <input type="date" class="form-control aiz-date-range" name="ngay_bat_dau" placeholder="Select Date" required>
      <input type="date" class="form-control aiz-date-range" name="ngay_ket_thuc" placeholder="Select Date" required>
    </div>
</div>
<div class="form-group row">
   <label class="col-lg-3 col-from-label">Giam gia</label>
   <div class="col-lg-7">
      <input type="number" lang="en" min="0" step="0.01" placeholder="Giam gia" name="giam_gia" class="form-control" required>
   </div>
   <div class="col-lg-2">
       <select class="form-control aiz-selectpicker sl_chosen" name="loai_giam_gia">
           <option value="1">Tien</option>
           <option value="2">Phan tram</option>
       </select>
   </div>
</div>

<div class="form-group row">
    <label for="" class="col-lg-3">So luong</label>
    <div class="col-lg-9">
        <input type="number" lang="en" min="0" step="0.01" placeholder="So luong" name="so_luong" class="form-control" required>
    </div>
</div>

