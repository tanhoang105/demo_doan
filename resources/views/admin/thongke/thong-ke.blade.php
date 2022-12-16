<?php
use App\Models\DangKy;
?>
@extends('Admin.templates.layout')
@section('content')
    {{-- {{dd($listTK)}} --}}
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Thống kê</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">

                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <!-- /.row -->
            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <section class="col-lg-7 connectedSortable">
                    <!-- Custom tabs (Charts with tabs)-->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-chart-area mr-1"></i>
                                Thống kê
                            </h3>
                            <div class="card-tools">
                            </div>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content p-0">
                                <!-- Morris chart - Sales -->
                                <div id="chart_div" style="height: 350px;"></div>
                            </div>
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                </section>
                <!-- /.Left col -->
                <!-- right col (We are only adding the ID to make the widgets sortable)-->
                <section class="col-lg-5 connectedSortable">

                    <!-- PieChart card -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-chart-pie mr-1"></i>
                                Số lượng đăng ký
                            </h3>
                            <div class="card-tools">
                            </div>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content p-0">
                                <!-- Morris chart - Sales -->
                                <div id="donutchart" style=" height: 300px;"></div>
                            </div>
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                </section>
                <!-- right col -->
            </div>
            <div class="row">
                <div class="col-lg-4 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $hocvien }}</h3>

                            <p>Số lượng học viên</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person"></i>
                        </div>
                        <a href="{{ route('route_BE_Admin_List_Hoc_Vien') }}" class="small-box-footer">Xem chi tiết
                            <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $soHocVienThang->count() }}</h3>

                            <p>Số lượng học viên tháng này</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person"></i>
                        </div>
                        <a href="{{ route('route_BE_Admin_List_Hoc_Vien') }}" class="small-box-footer">Xem chi tiết
                            <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ number_format($doanhthutong, 0, '.', '.') }}<sup style="font-size: 20px">₫</sup></h3>

                            <p>Doanh thu tổng</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="{{ route('route_BE_Admin_List_Thanh_Toan') }}" class="small-box-footer">Xem chi tiết <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ number_format($doanhthudathu, 0, '.', '.') }}<sup style="font-size: 20px">₫</sup></h3>

                            <p>Doanh thu đã thu</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="{{ route('route_BE_Admin_List_Thanh_Toan') }}" class="small-box-footer">Xem chi tiết <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $dangky }}</h3>

                            <p>Số lượng đăng ký</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="{{ route('route_BE_Admin_List_Dang_Ky') }}" class="small-box-footer">Xem chi tiết
                            <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3> {{ $khoahoc }} </h3>

                            <p>Số khóa học hiện tại</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="{{ route('route_BE_Admin_Khoa_Hoc') }}" class="small-box-footer">Xem chi tiết
                            <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <br>
            <form action="" class="row" id="form-search">
                <div class="form-group col-3">
                    <input type="date" class="form-control" name="date_start" class="date_start">
                </div>
                <div class="form-group col-3">
                    <input type="date" class="form-control" name="date_end" class="date_end">
                </div>
                <div class="form-group col-2">
                    <button type="button" class="btn-search btn btn-primary"
                        data-url='{{ route('route_BE_Admin_Thong_Ke') }}'>Lọc</button>
                </div>
            </form>
            <div class="bg-red rounded"><span style="margin-left: 20px;font-size: 20px">Doanh thu khóa học</span></div> <br>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" class="col-6">Khóa học</th>
                        <th scope="col">Doanh thu</th>
                        <th scope="col">Học viên nhập học</th>
                    </tr>
                </thead>

                <tbody id="listTK">
                    @foreach ($listTK as $item)
                        <tr>
                            <th scope="row">{{ $item->ten_khoa_hoc }}</th>
                            @if ($item->doanh_thu != null)
                                <td>{{ number_format($item->doanh_thu) }} VNĐ</td>
                            @else
                                <td>0 VNĐ</td>
                            @endif
                           
                                <?php
                                $query = DB::table('dang_ky')
                                    ->join('lop', 'lop.id', '=', 'dang_ky.id_lop')
                                    ->join('khoa_hoc', 'khoa_hoc.id', '=', 'lop.id_khoa_hoc')
                                    ->groupBy('khoa_hoc.id')
                                    ->having('khoa_hoc.id', $item->id_khoa_hoc)
                                    ->select(DB::raw('COUNT(dang_ky.id_user) as hv'))
                                    ->first();
                                
                                if(!empty($query)){
                                    echo '<td>' . $query->hv . '</td>';
                                }else  {
                                    echo '<td>' . 0 . ' </td>';
                                }
                                    

                                    
                                
                                ?>

                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
        <br class="mt-6">
    </section>

    <!-- /.content -->

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load("current", {
            packages: ["corechart"]
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Name category', 'Count by category'],
                <?php echo $donutChart; ?>
            ]);

            var options = {
                title: 'Số lượng đăng ký theo danh mục',
                pieHole: 0.4,
            };

            var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
            chart.draw(data, options);
        }

        $(document).ready(function() {
            $('.btn-search').on('click', function(e) {
                e.preventDefault();
                var url = $(this).data('url');
                let data = $('#form-search').serializeArray();

                let dateStart = new Date($('input[name=date_start]').val());
                let dateEnd = new Date($('input[name=date_end]').val());

                if (dateStart > dateEnd) {
                    alert('Vui lòng chọn ngày kết thúc không nhỏ hơn ngày bắt đầu')
                } else {
                    $.ajax({
                        type: 'get',
                        url: url,
                        data: data,
                        success: function(res) {
                            if (res.success) {
                                htmls = res.data.map(item => `
                                <tr>
                                    <th scope="row">${item.ten_khoa_hoc}</th>
                                    <td>${item.doanh_thu} VNĐ</td>
                                </tr>`);
                                $('#listTK').html(htmls);
                            }
                        }
                    })
                }
            })
        })
    </script>

    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Day', 'Tổng doanh thu'],
                <?php echo $areaChart; ?>
            ]);

            var options = {
                title: 'Doanh thu theo ngày',
                hAxis: {
                    title: 'Ngày',
                    titleTextStyle: {
                        color: '#333'
                    }
                },
                vAxis: {
                    minValue: 0
                }
            };

            var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }
    </script>
@endsection
