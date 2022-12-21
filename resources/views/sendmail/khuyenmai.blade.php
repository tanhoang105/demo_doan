<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>

    <p> Trung tâm gửi tặng bạn mã khuyến mại {{ $emails['giam_gia'] }} </p>

    @if (isset($emails['khoa_hoc']) && $emails['khoa_hoc'] != null)
        <p> Những khóa học đc áp dụng mã là :
            @for ($i = 0; $i < count($emails['khoa_hoc']); $i++)
                @if ($i == count($emails['khoa_hoc']) - 1)
                    {{ $emails['khoa_hoc'][$i] }}
                @else
                    {{ $emails['khoa_hoc'][$i] . ',' }}
                @endif
            @endfor

        </p>
    @else
        <p>Áp dụng cho tất cả khóa học của trung tâm</p>
    @endif
    <p>Mã khuyến mại : {{ $emails['ma'] }}</p>
</body>

</html>
