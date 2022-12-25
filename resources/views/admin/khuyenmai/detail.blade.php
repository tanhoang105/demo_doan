@extends('Admin.templates.layout')
@section('form-search')
    {{ route('route_BE_Admin_Khuyen_Mai') }}
@endsection
@section('content')
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
     <div class="row p-3" >
          <h2>Những khóa học được áp dụng mã khuyến mại  :  {{ $result->ma_khuyen_mai  }} </h2>
     </div>


    <form class="p-2" method="post" action="{{ route('route_BE_Admin_Xoa_All_Khuyen_Mai') }}" enctype="multipart/form-data">
        @csrf
        <table class="table table-bordered">
            <thead>
                <tr>

                    <th scope="col">STT</th>
                    <th scope="col">Tên khóa</th>

                </tr>
            </thead>
            <tbody>

              
                @foreach ($list as $key=>$item)
                    <tr>
                        <td> {{ $loop->iteration  }} </td>
                        <td>
                          {{-- {{$item}} --}}
                            @foreach ($khoa_hoc as $itemKH)
                                @if ( $item  == $itemKH->id)
                                    {{ $itemKH->ten_khoa_hoc }}
                                @endif
                            @endforeach
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </form>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $()
        });
    </script>
@endsection
