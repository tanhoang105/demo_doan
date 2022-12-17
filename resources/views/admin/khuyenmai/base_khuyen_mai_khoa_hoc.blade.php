<div class="card-header mb-2">
    <h3 class="h6">Thêm phiếu giảm giá cho khóa học</h3>
</div>
<div class="form-group row">
    <label class="col-lg-3 col-from-label" for="coupon_code">Mã khuyến mãi </label>
    <div class="col-lg-9">
        <input type="text" placeholder="Nhập mã khuyến mãi" id="ma_km" name="ma_khuyen_mai" class="form-control" required>
    </div>
</div>
<div class="form-group row">
    <label class="col-md-3 col-from-label">Mô tả</label>
    <div class="col-md-9">
        <textarea class="aiz-text-editor form-control" name="mo_ta" rows="7" required></textarea>
    </div>
</div>
<div class="product-choose-list">
    <div class="product-choose">
        <div class="form-group row">
            <label class="col-lg-3 col-from-label" for="name">Khóa học</label>
            <div class="col-lg-9">
                <select name="khoa_hoc_ids[]" class="form-control chosen-select aiz-selectpicker" data-live-search="true" data-selected-text-format="count" required multiple>
                    @foreach($khoaHocs as $khoaHoc)
                        <option value="{{$khoaHoc->id}}">{{ $khoaHoc->ten_khoa_hoc }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>
<br>
<div class="form-group row">
    <label class="col-sm-3 control-label" for="start_date">Ngày bắt đầu </label>
    <div class="col-sm-9">
      <input type="date" class="form-control aiz-date-range" name="ngay_bat_dau" placeholder="Select Date" required>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-3 control-label" for="start_date">Ngày kết thúc </label>
    <div class="col-sm-9">
      <input type="date" class="form-control aiz-date-range" name="ngay_ket_thuc" placeholder="Select Date" required>
    </div>
</div>
<div class="form-group row">
   <label class="col-lg-3 col-from-label">Giảm giá</label>
   <div class="col-lg-7">
      <input type="number" lang="en" min="0" step="0.01" placeholder="Giảm giá" name="giam_gia" class="form-control" required>
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
        <input type="number" lang="en" min="0" step="0.01" placeholder="Nhập số lượng" name="so_luong" class="form-control" required>
    </div>
</div>
<script type="text/javascript">

    $(document).ready(function(){
        $(".chosen-select").chosen();
    });

</script>
