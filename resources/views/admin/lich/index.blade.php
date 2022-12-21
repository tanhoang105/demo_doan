<@php
    use App\Models\Lich;
    
@endphp @extends('Admin.templates.layout') @section('styles') <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
        <style>
            .datepicker-container.datepicker-dropdown.datepicker-top-right,
            .datepicker-container.datepicker-dropdown.datepicker-top-left {
                border: none !important;
                width: 293px !important;
                box-shadow: 0 8px 6px rgb(0 0 0 / 18%);
                border-radius: 4px;
                -webkit-border-radius: 4px;
                -moz-border-radius: 4px;
                -ms-border-radius: 4px;
                -o-border-radius: 4px;
                z-index: 10000 !important;
            }

            .datepicker-container.datepicker-dropdown.datepicker-top-right {
                left: 65px !important;
            }

            .datepicker-panel>ul {
                width: 100%;
            }

            .datepicker-top-left:before,
            .datepicker-top-right:before {
                display: none;
            }

            .datepicker-panel>ul>li[data-view="month current"],
            .datepicker-panel>ul>li[data-view="week"],
            .datepicker-panel>ul>li[data-view="year current"],
            .datepicker-panel>ul>li[data-view="years current"] {
                font-weight: 600 !important;
                width: 191px;
                font-size: 14px !important;
                color: #333333;

            }

            .datepicker-panel>ul:first-child {
                padding-top: 12px !important;
            }

            .datepicker-panel>ul[data-view=week]>li {
                width: calc(100% / 7);
                font-weight: 600;
                color: #333333;
            }

            .datepicker-panel>ul {
                padding: 0 12px;
            }

            .datepicker-panel>ul>li {
                height: unset;
                color: #333333;
                font-size: 14px !important;
                font-family: "Helvetica Neue", Helvetica, Arial, sans-serif !important;
                padding: 4px 5px;
                width: calc(100% / 7);
            }

            .datepicker-panel>ul>li.picked,
            .datepicker-panel>ul>li.picked:hover {
                background-color: #337AB7 !important;
                color: #fff !important
            }

            .datepicker-panel>ul[data-view=years],
            .datepicker-panel>ul[data-view=months],
            .datepicker-panel>ul[data-view="days"] {
                margin-bottom: 12px;
            }

            .datepicker-panel>ul[data-view=months]>li,
            .datepicker-panel>ul[data-view=years]>li {
                height: unset;
                padding: 12px 0;
                font-weight: 600;
                color: #808080;
                font-size: 16px;
                margin-top: 12px 0;
                width: calc(100% / 4);
            }

            .datepicker-panel>ul>li.picked .datepicker-panel>ul>li.picked:hover {
                color: #fff;
            }
        </style>
    @endsection
    @section('form-search')
        {{ route('route_BE_Admin_List_Lich_Hoc') }}
    @endsection

    @section('content')
        <div class="row p-3">
            <a style="color: red" href=" {{ route('route_BE_Admin_Add_Lich_Hoc') }}">
                <button class='btn btn-primary'> <i class="fas fa-plus "></i> Thêm</button>

            </a>
        </div>
        {{-- 
    @if (Session::has('error'))
        <div class="alert alert-danger alert-dismissible" role="alert">
            <strong>{{ Session::get('error') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>
        </div>
    @endif --}}


        {{-- hiển thị message đc gắn ở session::flash('success') --}}
        {{-- 
    @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <strong>{{ Session::get('success') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>
        </div>
    @endif --}}

        <div class="alert-msg">

        </div>
        {{-- <form method="post" action="{{ route('route_BE_Admin_Xoa_All_Lich_Hoc') }}" enctype="multipart/form-data">

        @csrf --}}
        <table class="table table-bordered">
            <thead>
                <tr>
                    {{-- <th> <i class="fa-solid fa-circle-play"></i> <input id="check_all" type="checkbox" /></th> --}}
                    <th scope="col">STT</th>
                    <th scope="col">Thứ</th>
                    <th scope="col">Ngày</th>
                    <th scope="col">Phòng</th>
                    <th scope="col">Khóa hoc</th>
                    <th scope="col">Lớp</th>
                    <th scope="col">Giảng viên</th>
                    <th scope="col">Ca</th>

                    <th scope="col">Sửa</th>
                    <th scope="col">
                        <button class="btn btn-default" type="submit" class="btn" style="">Xóa</button>
                    </th>
                </tr>
            </thead>
            <tbody>
                {{-- {{dd($list)}} --}}
                @foreach ($list as $key => $item)
                    {{-- <input type="text" name="_token" value="{{ csrf_field() }}" hidden> --}}
                    @if ($item->ngay_hoc >= date('Y-m-d'))
                        <tr>
                            <form class="form_{{ $key }}">
                                @csrf
                                <input type="hidden" name="id" value=" {{ $item->id }} ">
                                {{-- <td><input class="checkitem" type="checkbox" name="id[]" value="{{ $item->id }}" /></td> --}}
                                <th scope="row"> {{ $loop->iteration }}</th>
                                <td>
                                    <select class="form-control" name="ma_thu" id="">
                                        @foreach ($thu as $itemThu)
                                            @if ($item->ma_thu == $itemThu->ma_thu)
                                                <option selected value=" {{ $itemThu->ma_thu }} ">{{ $itemThu->ten_thu }}
                                                </option>
                                            @else
                                                <option value=" {{ $itemThu->ma_thu }} ">{{ $itemThu->ten_thu }}</option>
                                            @endif
                                        @endforeach

                                    </select>
                                </td>

                                <td>

                                    <input class="form-control" type="text" value=" {{ date('d/m/Y', strtotime($item->ngay_hoc)) }}">
                                    {{-- <input name="ngay_hoc" type="date" value=" {{ date_format($item->ngay_hoc,"m/d/y") }}"> --}}

                                </td>

                                <td>
                                    <select class="form-control" name="phong_id" id="">
                                        @foreach ($phong as $itemPhongHoc)
                                            @if ($item->phong_id == $itemPhongHoc->id)
                                                <option selected value="{{ $itemPhongHoc->id }} ">
                                                    {{ $itemPhongHoc->ten_phong }}
                                                </option>
                                            @else
                                                <option value="{{ $itemPhongHoc->id }} "> {{ $itemPhongHoc->ten_phong }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </td>

                                <td>
                                    @foreach ($khoahoc as $itemKhoaHoc)
                                        @if ($item->id_khoa_hoc == $itemKhoaHoc->id)
                                            {{ $itemKhoaHoc->ten_khoa_hoc }}
                                        @endif
                                    @endforeach
                                </td>

                                <td>
                                    @foreach ($lop as $itemLop)
                                        @if ($item->id_lop == $itemLop->id)
                                            {{ $itemLop->ten_lop }}
                                        @endif
                                    @endforeach
                                </td>

                                <td>
                                    <select class="form-control" name="giang_vien_id" id="">
                                        @foreach ($giangvien as $itemGiangVien)
                                            @if ($item->giang_vien_id == $itemGiangVien->id_user)
                                                <option selected value="  {{ $itemGiangVien->id_user }} ">
                                                    {{ $itemGiangVien->ten_giang_vien }}</option>
                                            @else
                                                <?php
                                                $res = Lich::where('ngay_hoc', $item->ngay_hoc)
                                                    ->where('ca_id', $item->ca_id)
                                                    ->whereNotIn('giang_vien_id' , [$item->giang_vien_id])
                                                    ->get();
                                                if(count($res) >= 1){

                                                    foreach ($res as $key => $value) {
                                                        // echo $value->giang_vien_id . '<br>';
                                                        if( $value->giang_vien_id == $itemGiangVien->id_user ){
                                                            
                                                        }else  {
                                                            echo '<option value="' . $itemGiangVien->id_user . ' ">
                                                       ' . $itemGiangVien->ten_giang_vien . '</option>';
                                                        }
                                                        
                                                    }
                                                }else {
                                                    echo '<option value="' . $itemGiangVien->id_user . ' ">
                                                       ' . $itemGiangVien->ten_giang_vien . '</option>';
                                                }
                                                
                                                
                                                ?>

                                                {{-- <option value="  {{ $itemGiangVien->id_user }} ">
                                                    {{ $itemGiangVien->ten_giang_vien }}</option> --}}
                                            @endif
                                        @endforeach
                                    </select>

                                </td>

                                <td>
                                    <select class="form-control" name="ca_id" id="">
                                        @foreach ($ca as $itemCa)
                                            @if ($item->ca_id == $itemCa->id)
                                                <option selected value="  {{ $itemCa->id }} ">
                                                    {{ $itemCa->ca_hoc }}
                                                    {{ ' ( ' . $item->thoi_gian_bat_dau . ' - ' . $item->thoi_gian_ket_thuc . ' ) ' }}
                                                </option>
                                            @else
                                                <option value="  {{ $itemCa->id }} ">
                                                    {{ $itemCa->ca_hoc }}
                                                    {{ ' ( ' . $item->thoi_gian_bat_dau . ' - ' . $item->thoi_gian_ket_thuc . ' ) ' }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </td>


                                <td>
                                    <button class="btn btn-success btn-update" data-key="{{ $key }}"
                                        data-url='{{ route('route_BE_Admin_Update_Lich_Hoc') }}'>
                                        <i class="fas fa-edit "></i> Cập nhật
                                    </button>
                                </td>
                                <td>
                                    <button onclick="return confirm('Bạn có chắc muốn xóa ?')" class="btn btn-danger">
                                        <a style="color:#fff"
                                            href="{{ route('route_BE_Admin_Xoa_Lich_Hoc', ['id' => $item->id]) }}">
                                            <i class="fas fa-trash-alt"></i> Xóa</a>

                                    </button>
                                </td>

                            </form>
                        </tr>
                    @endif
                @endforeach

            </tbody>
        </table>
        {{-- </form> --}}


        <div class="">
            <div class="d-flex align-items-center justify-content-between flex-wrap">
                {{ $list->appends('params')->links() }}
            </div>
        </div>
    @endsection


    @section('js')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

        <script type="text/javascript">
            $(document).ready(function() {

                $('[data-toggle="datepicker"]').datepicker({
                    format: 'dd/mm/yyyy',
                    days: ['Chủ Nhật', 'Thứ Hai', 'Thứ Ba', 'Thứ Tư', 'Thứ Năm', 'Thứ Sáu', 'Thứ Bảy'],
                    daysShort: ['CN', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7'],
                    daysMin: ['CN', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7'],
                    months: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7',
                        'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'
                    ],
                    monthsShort: ['T1', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'T8', 'T9', 'T10', 'T11', 'T12'],
                })

                $('.btn-update').on('click', function(e) {

                    e.preventDefault();
                    let key = $(this).data('key');
                    let data = $('.form_' + key).serialize();
                    let url = $(this).data('url');

                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: data,
                        success: function(res) {
                            if (res.success) {
                                let html = showAlert('success', res.msg)
                                $('.alert-msg').html(html)
                            } else {
                                let html = showAlert('danger', res.msg)
                                $('.alert-msg').html(html)
                            }
                        },
                        error: function(err) {
                            $('.alert-msg').html()
                        }
                    })
                })

                function showAlert(status, msg) {
                    return `<div class="alert alert-${status} alert-dismissible" role="alert">
                            <strong>${msg}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                            </button>
                        </div>`
                }
            })
        </script>
    @endsection
