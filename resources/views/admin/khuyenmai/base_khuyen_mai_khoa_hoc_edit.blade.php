
<div class="card-header mb-2">
    <h5 class="mb-0 h6">Chỉnh sửa phiếu giảm giá cho khóa học</h5>
</div>
<input type="text" name="id" value="{{$coupon->id}}" hidden>
<div class="form-group row">
    <label class="col-lg-3 col-from-label" for="coupon_code">Ma </label>
    <div class="col-lg-9">
        <input type="text" placeholder="Nhap ma" value="{{$coupon->ma_khuyen_mai}}" id="ma_km" name="ma_khuyen_mai" class="form-control" required>
    </div>
</div>
<div class="form-group row">
    <label class="col-md-3 col-from-label">Mô tả</label>
    <div class="col-md-9">
        <textarea class="aiz-text-editor" value="{{$coupon->mo_ta}}" name="mo_ta" rows="9"></textarea>
    </div>
</div>
<div class="product-choose-list">
    <div class="product-choose">
        <div class="form-group row">
            <label class="col-lg-3 control-label" for="name">Khóa học</label>
            <div class="col-lg-9">
                <select name="khoa_hoc_ids[]" class="form-control chosen-select aiz-selectpicker" data-live-search="true" data-selected-text-format="count" required multiple>
                    @foreach($khoaHocs as $khoaHoc)
                        <option value="{{$khoaHoc->id}}" {{in_array($khoaHoc->id,json_decode($coupon->chi_tiet_khoa)) ? 'selected' : ''}}>{{$khoaHoc->ten_khoa_hoc}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>
<br>
<div class="form-group row">
    <label class="col-sm-3 control-label" for="start_date">Ngày bắt đầu và kết thúc</label>
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
            <option value="1">Tiền</option>
            <option value="2">Phần trăm</option>
        </select>
    </div>

</div>
<div class="form-group row">
    <label for="" class="col-lg-3">Số lượng</label>
    <div class="col-lg-9">
        <input type="number" lang="en" value="{{$coupon->so_luong}}" min="0" step="0.01" placeholder="So luong" name="so_luong" class="form-control" required>
    </div>
</div>
<script type="text/javascript">

    $(document).ready(function(){
        $(".chosen-select").chosen();
        // $('.chosen-select').trigger('chosen:update');
        
    });

</script>
