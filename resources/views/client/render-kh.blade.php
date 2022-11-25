@foreach ($listKh as $value)
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="feat_course_item">
            <img src="{{ asset('client/images/courses1.jpg') }}" alt="image">
            <div class="feat_cour_price">
                <span class="feat_cour_tag">{{ $value->ten_danh_muc }}</span>
                <span class="feat_cour_p">{{ number_format($value->gia_khoa_hoc) }}</span>
            </div>
            <h4 class="feat_cour_tit">{{ $value->ten_khoa_hoc }}</h4>
            <div class="feat_cour_lesson">
                <span class="feat_cour_less"> <i class="pe-7s-note2"></i> 20 lessons </span>
                <span class="feat_cour_stu"> <i class="pe-7s-add-user"></i> 237 Students </span>
            </div>
            <div class="feat_cour_rating">
                                            <span class="feat_cour_rat">
                                                4.6
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                (3,539)
                                            </span>
                <a href="{{ route('client_chi_tiet_khoa_hoc', $value->id) }}"> <i
                        class="arrow_right"></i> </a>
            </div>
        </div>
    </div>
@endforeach
