@extends('Admin.templates.layout')
@section('form-search')
    {{ route('route_BE_Admin_Khuyen_Mai') }}
@endsection
@section('content')
    <div class="row p-3">
        <a style="color: red" href=" {{ route('route_BE_Admin_create') }}">
            <button class='btn btn-primary'> <i class="fas fa-plus "></i> Thêm</button>

        </a>

        <a style="color: red ; margin-left:10px" href=" {{ route('route_BE_Admin_Khuyen_Mai') }}">
            <button class='btn btn-warning'> <i class="fas fa-plus "></i> Tất cả danh sách</button>

        </a>
    </div>
    @if (Session::has('error'))
        <div class="alert alert-danger alert-dismissible" role="alert">
            <strong>{{ Session::get('error') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>
        </div>
    @endif


    {{-- hiển thị message đc gắn ở session::flash('success') --}}

    @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <strong>{{ Session::get('success') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>
        </div>
    @endif

    <form action="" method="get">
        @csrf
        <div class="row p-3">
            <div class="col-2">
                <select class="form-control" name="loai_giam_gia" id="">
                    <option value="">Lọc theo loại giảm giá</option>
                    <option value="1">Giảm giá theo tiền</option>
                    <option value="2">Giảm giá theo phần trăm</option>
                   
                </select>
            </div>

            <div class="col-2">
                <select class="form-control" name="loai_khuyen_mai" id="">
                    <option value="">Lọc theo loại khuyến mại</option>
                    <option value="2">Giảm giá tất cả </option>
                    <option value="1">Giảm giá theo khóa</option>
                   
                </select>
            </div>
            
             <div class="col-2"> 
               
                <input type="date" class="form-control" placeholder="ngày bắt đầu" name="ngay_bat_dau">
            </div>


            <div class="col-2"> 
               
                <input type="date" class="form-control" placeholder="ngày kết thúc" name="ngay_ket_thuc">
            </div>
          

            <div class="col-1">
                <button class="btn btn-success">Lọc</button>
            </div>

        </div>
    </form>


    <form method="post" action="{{ route('route_BE_Admin_Xoa_All_Khuyen_Mai') }}" enctype="multipart/form-data">
        @csrf
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th> <input id="check_all" type="checkbox" /></th>
                    <th scope="col">STT</th>
                    <th scope="col">Mã khuyến mại </th>
                    <th scope="col">Loại khuyến mại </th>
                    <th scope="col">Loại giảm giá </th>
                    <th scope="col">Giảm giá </th>
                    <th scope="col">Ngày bắt đầu </th>
                    <th scope="col">Ngày kết thúc</th>
                    <th scope="col">Gửi mã khuyến mại</th>
                    <th scope="col">Chi tiết</th>
                    <th scope="col">Sửa</th>
                    <th scope="col">
                        <button class="btn btn-default" type="submit" class="btn" style="">Xóa</button>

                    </th>

                </tr>
            </thead>
            <tbody>
                @foreach ($list as $key => $item)
                    <tr>
                        <td><input class="checkitem" type="checkbox" name="id[]" value="{{ $item->id }}" /></td>
                        <th scope="row"> {{ $loop->iteration }}</th>
                        <td> {{ $item->ma_khuyen_mai }}</td>
                        <td> {{ $item->loai_khuyen_mai == 1 ? 'Đối với khóa học' : 'Đối với tất cả khóa học' }}</td>
                        <td> {{ $item->loai_giam_gia == 1 ? 'Đối với giá tiềm' : 'Đối với phần trăm' }}</td>
                        <td> {{ $item->loai_giam_gia == 1 ? number_format($item->giam_gia, 0, '.', '.') . ' VNĐ' : $item->giam_gia . '%' }}
                        </td>
                        <td> {{ date('d/m/Y', strtotime($item->ngay_bat_dau)) }}</td>
                        <td> {{ date('d/m/Y', strtotime($item->ngay_ket_thuc)) }}</td>
                        <td>
                            <a class="btn btn-info" style="color: #fff" href=" {{route('route_BE_Admin_Send_Khuyen_Mai'  , ['id' => $item->id])}} ">Gửi mã khuyến mại</a>
                        </td>
                        <td>
                            @if( $item->loai_khuyen_mai == 1)
                                <a href=" {{route('route_BE_Admin_Detail_Khuyen_Mai' , ['id' => $item->id])}} " class="btn btn-warning">Chi tiết</a>
                            @endif
                        </td>
                        <td>
                            <a class="btn btn-success" style="color: #fff"
                                href="{{ route('route_BE_Admin_Edit_Khuyen_Mai', ['id' => $item->id]) }}">
                                <i class="fas fa-edit "></i> Sửa</a>
                        </td>
                        <td>

                            <a onclick="return confirm('Bạn có chắc muốn xóa ?')" class="btn btn-danger" style="color: #fff"
                                href="{{ route('route_BE_Admin_Xoa_Khuyen_Mai', ['id' => $item->id]) }}">
                                <i class="fas fa-trash-alt"></i> Xóa</a>

                        </td>

                    </tr>
                @endforeach

            </tbody>
        </table>
    </form>
    <div class="">
        <div class="d-flex align-items-center justify-content-between flex-wrap">
            {{ $list->appends('params')->links() }}
        </div>
    </div>
    <!-- Modal -->
    {{-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Chọn đối tượng </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for=""><input class="" name="doituong[]" type="radio"> Tất cả học viên</label>
                    <label for=""><input class="" name="doituong[]" style="margin-left: 20px"type="radio">
                        Chọn học viên</label>
                    <div class="list-hocvien">
                        Hoàng nhật tân
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Gửi</button>
                </div>
            </div>
        </div>
    </div> --}}
@endsection

@section('js')
    <script>
        $(document).ready(function() {
           $()
        });
    </script>
@endsection
