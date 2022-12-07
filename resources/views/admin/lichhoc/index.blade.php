@extends('Admin.templates.layout')
@section('form-search')
    {{ route('route_BE_Admin_List_Ca_Thu') }}
@endsection
@section('content')
    <div class="row p-3">
        <a style="color: red" href=" {{ route('route_BE_Admin_Add_Ca_Thu') }}">
            <button class='btn btn-primary'> <i class="fas fa-plus "></i> Thêm</button>

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
    <form method="post" action="{{ route('route_BE_Admin_Xoa_All_Ca_Thu') }}" enctype="multipart/form-data">

        @csrf
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th> <i class="fa-solid fa-circle-play"></i> <input id="check_all" type="checkbox" /></th>
                    <th scope="col">STT</th>
                    <th scope="col">Ca</th>
                    <th scope="col">Thứ</th>
                    <th scope="col">Sửa</th>
                    <th scope="col">
                        <button class="btn btn-default" type="submit" class="btn" style="">Xóa</button>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($list as $key => $item)
                    <tr>
                        <td><input {{ in_array($item->id, $arrayidCaThu) == true ? 'hidden' : 'value=' . $item->id }} class="checkitem" type="checkbox" name="id[]"  /></td>
                        <th scope="row"> {{ $loop->iteration }}</th>

                        <td>
                            @foreach ($cahoc as $ca)
                                @if ($ca->id == $item->ca_id)
                                    {{ $ca->ca_hoc }}
                                @endif
                            @endforeach

                        </td>


                        <td>
                            <?php
                            
                            for ($i = 0; $i < count([$item->thu_hoc_id]); $i++) {
                                $str = explode(',', $item->thu_hoc_id);
                            }
                            
                            for ($i = 0; $i < count($str); $i++) {
                                foreach ($thu as $key => $value) {
                                    if ($str[$i] == $value->id) {
                                        echo '<li>' . $value->ten_thu . '</li><br>';
                                    }
                                }
                            }
                            
                            ?>


                        </td>

                        <td>
                                <a class="btn btn-success" style="color:aliceblue" href="{{ route('route_BE_Admin_Edit_Ca_Thu', ['id' => $item->id]) }}">
                                    <i class="fas fa-edit "></i> Sửa</a>
                        </td>
                        <td>
                                <a {{ in_array($item->id, $arrayidCaThu) == true ? 'hidden' : '' }}  onclick="return confirm('Bạn có chắc muốn xóa ?')" class="btn btn-danger" style="color:aliceblue" href="{{ route('route_BE_Admin_Xoa_Ca_Thu', ['id' => $item->id]) }}">
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
@endsection
