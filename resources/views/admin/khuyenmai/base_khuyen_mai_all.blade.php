<div class="card-header mb-2">
    <h3 class="h6">Thêm phiếu giảm giá cho tất cả khóa học</h3>
</div>
<div class="form-group row">
    <label class="col-lg-3 col-from-label" for="coupon_code">Mã khuyến mãi </label>
    <div class="col-lg-9">
        <input type="text" placeholder="Nhập mã khuyến mãi" id="ma_km" name="ma_khuyen_mai" class="form-control input" data-name="Mã khuyến mãi" required>
        <div class="text-danger msg_error"></div>
    </div>
</div>
<div class="form-group row">
    <label class="col-md-3 col-from-label">Mô tả</label>
    <div class="col-md-9">
        <textarea class="aiz-text-editor form-control" name="mo_ta" rows="7" required></textarea>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-3 control-label" for="start_date">Ngày bắt đầu </label>
    <div class="col-sm-9">
      <input type="date" class="form-control aiz-date-range input" name="ngay_bat_dau" placeholder="Select Date" data-name="Ngày bắt đầu" required>
      <div class="text-danger msg_error"></div>
    </div>
</div>
<div class="form-group row">
    <label  class="col-lg-3 col-from-label">Ngày kết thúc</label>
    <div class="col-sm-9">
        <input type="date" data-name="Ngày kết thúc" class="form-control aiz-date-range input" name="ngay_ket_thuc" placeholder="Select Date" required>
        <div class="text-danger msg_error"></div>
    </div>
</div>

<div class="form-group row">
   <label class="col-lg-3 col-from-label">Giảm giá</label>
   <div class="col-lg-7">
      <input type="number" lang="en"  data-name="Giảm giá" min="0" step="1" placeholder="Giảm giá" name="giam_gia" class="form-control input_coupon_type input" required>
      <div class="text-danger msg_error"></div>
   </div>
   <div class="col-lg-2">
       <select class="form-control aiz-selectpicker select_coupon_type sl_chosen" name="loai_giam_gia" onchange="changeCouponType()">
           <option value="1">Tiền</option>
           <option value="2">Phần trăm</option>
       </select>
   </div>
</div>

<div class="form-group row">
    <label for="" class="col-lg-3">Số lượng</label>
    <div class="col-lg-9">
        <input type="number" data-name="Số lượng" lang="en" min="0" step="1" placeholder="So luong" name="so_luong" class="form-control input input_quantity"required>
        <div class="text-danger msg_error"></div>

    </div>
</div>

