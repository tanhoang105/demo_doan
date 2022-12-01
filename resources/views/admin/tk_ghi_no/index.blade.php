@extends('Admin.templates.layout')
@section('content')
<h2 style="text-align: center;padding-top: 20px; margin-bottom: 20px">Quản Lý Số dư tài khoản</h2>
    {{-- <div class="row p-3">
        <a style="color: red" href=" {{ route('route_BE_Admin_Add_Giang_Vien') }}">
            <button class='btn btn-primary'> <i class="fas fa-plus "></i> Thêm</button>
        </a>
    </div> --}}
    <form method="post" action="" enctype="multipart/form-data">
        @csrf
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">
                        <input id="check_all" type="checkbox"/>
                        {{-- <button type="submit" class="btn" style="">Xóa</button> --}}
                    </th>
                    <th scope="col">STT</th>
                    <th scope="col">Mã học viên </th>
                    <th scope="col">Tên học viên</th>
                    <th scope="col">Số dư tài khoản </th>
                    <th  scope="col">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ghi_no as $key => $item)
                    <tr>
                        <td><input class="checkitem" type="checkbox" name="id[]" value="" /></td>
                        <th scope="row"> {{ $item->id }}</th>
                        <td> {{ $item->user_id }}</td>
                        <td>
                            {{ $item->name }}
                        </td>
                        <td> {{ number_format($item->tien_no )}} VND
                        </td>
                        <td>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{$item->id}}">
                                Cập nhật số dư
                              </button>
                        </td>
                    </tr>
                     <!-- Modal -->
  <div class="modal fade" id="exampleModal{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Cập nhật só dư</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="{{route('route_BE_Admin_cap_nhat_so_du',$item->id)}}" method="POST">
            @csrf
            @method('PUT')
            <div>
                <label for="">Số dư</label>
                <input type="text" class="form-control" name="tien_no_new" value="{{$item->tien_no}}" id="">
            </div>
            <br>
            <button class="btn btn-success">Cập nhật</button>
        </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
        </div>
      </div>
    </div>
  </div>
                @endforeach

            </tbody>
        </table>
 
    </form>
    <div class="">
        <div class="d-flex align-items-center justify-content-between flex-wrap">
            {{ $ghi_no->appends('params')->links() }}
        </div>
    </div>
@endsection
