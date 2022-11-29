@foreach ($listKh as $value)
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="feat_course_item">
            <img src="{{ asset('client/images/courses1.jpg') }}" alt="image">
            <div class="feat_cour_price">
                <span class="feat_cour_tag">{{ $value->ten_danh_muc }}</span>
                <span class="feat_cour_p">{{ number_format($value->gia_khoa_hoc) }} VNĐ</span>
            </div>
            <h4 class="feat_cour_tit">{{ $value->ten_khoa_hoc }}</h4>
            <div class="feat_cour_lesson">
                <span
                    hidden>{{ $sl_lop = DB::table('lop')->where('lop.id_khoa_hoc', '=', $value->id)->get() }}</span>
                <span hidden>{{ $total = 0 }}</span>
                @foreach ($sl_lop as $data)
                    <span hidden>{{ $lg_sv = 40 - $data->so_luong }}</span>
                    <span hidden>{{ $total = $total + $lg_sv }}</span>
                @endforeach
                <span class="feat_cour_less"> <i class="pe-7s-note2"></i>{{ count($sl_lop) }}
                    Lớp học</span>
                <span class="feat_cour_stu"> <i class="fas fa-user"> {{ $total }} Học
                        viên</i></span>
            </div>
            <div class="feat_cour_rating">
                <span class="feat_cour_rat">
                    <span>Lượt xem</span>
                    ({{ number_format($value->luot_xem) }})
                </span>
                <a href="{{ route('client_chi_tiet_khoa_hoc', $value->id) }}"> <i
                        class="arrow_right"></i> </a>
            </div>
        </div>
    </div>
@endforeach
