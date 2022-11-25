<table class="table table-bordered">

    <thead>
        <tr>


            <th scope="col">Ngày thanh toán</th>
            <th scope="col">Tiền thanh toán</th>
            <th scope="col">Học viên</th>
            <th scope="col">Lớp đăng ký</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($list as $key => $value)
            <td> {{ $value->ngay_thanh_toan }}</td>
            <td> {{ $value->gia }}</td>
            <td>
                @foreach ($hocvien as $item)
                    @if ($item->user_id == $value->id_user)
                        {{ $item->ten_hoc_vien }}
                    @endif
                @endforeach

            </td>

            <td>
                @foreach ($lop as $item)
                    @if ($item->id == $value->id_lop)
                        {{ $item->ten_lop }}
                    @endif
                @endforeach

            </td>

            </tr>
        @endforeach
    </tbody>
</table>
