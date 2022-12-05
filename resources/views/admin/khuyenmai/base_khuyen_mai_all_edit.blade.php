<div class="card-header mb-2">
    <h3 class="h6">Chỉnh phiếu giảm giá cho tất cả khóa học</h3>
</div>
<div class="form-group row">
    <label class="col-lg-3 col-from-label" for="coupon_code">Mã </label>
    <div class="col-lg-9">
        <input type="text" value="{{$coupon->ma_khuyen_mai}}" placeholder="Nhap ma" id="ma_km" name="ma_khuyen_mai" class="form-control" required>
    </div>
</div>
<div class="form-group row">
    <label class="col-md-3 col-from-label">Mô tả</label>
    <div class="col-md-9">
        <textarea class="aiz-text-editor" value="{{$coupon->mo_ta}}" name="mo_ta" rows="9"></textarea>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-3 control-label" for="start_date">Ngày bắt đầu và ngày kết thúc </label>
    <div class="col-sm-9">
        <input type="date" value="{{$coupon->ngay_bat_dau}}" class="form-control aiz-date-range" name="ngay_bat_dau" placeholder="Select Date">
        <input type="date" value="{{$coupon->ngay_ket_thuc}}" class="form-control aiz-date-range" name="ngay_ket_thuc" placeholder="Select Date">
    </div>
</div>
<div class="form-group row">
    <label class="col-lg-3 col-from-label">Giảm giá</label>
    <div class="col-lg-7">
        <input type="number" value="{{$coupon->giam_gia}}" lang="en" min="0" step="0.01" placeholder="Giam gia" name="giam_gia" class="form-control" required>
    </div>
    <div class="col-lg-2">
        <select class="form-control aiz-selectpicker sl_chosen" name="loai_giam_gia">
            <option value="1" {{$coupon->loai_giam_gia == 1 ? 'selected' : ''}}>Tiền</option>
            <option value="2" {{$coupon->loai_giam_gia ==2 ? 'selected' : ''}}>Phần trăm</option>
        </select>
    </div>
</div>

<div class="form-group row">
    <label for="" class="col-lg-3">So luong</label>
    <div class="col-lg-9">
        <input type="number" value="{{$coupon->so_luong}}" lang="en" min="0" step="0.01" placeholder="So luong" name="so_luong" class="form-control" required>
    </div>
</div>

