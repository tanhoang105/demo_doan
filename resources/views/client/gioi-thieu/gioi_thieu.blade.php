@extends('Client.templates.layout')
@section('title') - About
@endsection
@section('content')

<main id="main">
    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs" data-aos="fade-in">
        <div class="container">
            <h2>Giới Thiệu</h2>
            <p>Đó là một nỗi đau mà chúng tôi không thể làm cho một số người có được niềm vui của sự lựa chọn. Bởi vì điều đó hay tương tự, bởi vì nó là niềm vui, anh ta tìm kiếm những gì anh ta mắc nợ. Không ai trong số những người có mặt này sẽ thấy việc mở đầu của mọi thứ trở nên khó khăn. </p>
        </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
        <div class="container" data-aos="fade-up">

            <div class="row">
                <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-left" data-aos-delay="100">
                    <img src="{{ asset('plugins/assets/img/about.jpg') }}" class="img-fluid" alt="">
                </div>
                <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content">
                    <h3>Họ cung cấp cho những thú vui xứng đáng nhất, như thể những thú vui của thể xác đã được giả định.</h3>
                    <p class="fst-italic">
                        Điều quan trọng là phải chăm sóc bệnh nhân, được bác sĩ theo dõi, nhưng đó là khoảng thời gian rất đau đớn và đau khổ.
                    </p>
                    <ul>
                        <li><i class="bi bi-check-circle"></i> Ullamco labris yêu cầu và aliquip ex và hậu quả thoải mái.</li>
                        <li><i class="bi bi-check-circle"></i> Nghi ngờ hoặc đau đớn khó chịu trong những lời khiển trách trong niềm vui mà anh ta muốn.</li>
                        <li><i class="bi bi-check-circle"></i> Tôi không làm việc gì cả ngoại trừ để có được một số lợi thế từ nó. Duis aureur irure đau trong sự trừng phạt trong niềm vui tridetas stracalaperda mastir đau eu fu no be sinh.</li>
                    </ul>
                    <p>
                        Tôi không làm việc gì cả ngoại trừ để có được một số lợi thế từ nó. Nghi ngờ hoặc đau đớn khó chịu khi khiển trách trong niềm vui
                    </p>

                </div>
            </div>

        </div>
    </section><!-- End About Section -->

    <!-- ======= Counts Section ======= -->
    <section id="counts" class="counts section-bg">
        <div class="container">

            <div class="row counters">

                <div class="col-lg-3 col-6 text-center">
                    <span data-purecounter-start="0" data-purecounter-end="1232" data-purecounter-duration="1" class="purecounter"></span>
                    <p>Sinh viên</p>
                </div>

                <div class="col-lg-3 col-6 text-center">
                    <span data-purecounter-start="0" data-purecounter-end="64" data-purecounter-duration="1" class="purecounter"></span>
                    <p>Các khóa học</p>
                </div>

                <div class="col-lg-3 col-6 text-center">
                    <span data-purecounter-start="0" data-purecounter-end="42" data-purecounter-duration="1" class="purecounter"></span>
                    <p>Sự kiện</p>
                </div>

                <div class="col-lg-3 col-6 text-center">
                    <span data-purecounter-start="0" data-purecounter-end="15" data-purecounter-duration="1" class="purecounter"></span>
                    <p>Giảng viên</p>
                </div>

            </div>

        </div>
    </section><!-- End Counts Section -->

    <!-- ======= Testimonials Section ======= -->
    <section id="testimonials" class="testimonials">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Lời chứng thực</h2>
                <p>Họ đang nói gì</p>
            </div>

            <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
                <div class="swiper-wrapper">

                    <div class="swiper-slide">
                        <div class="testimonial-wrap">
                            <div class="testimonial-item">
                                <img src="{{ asset('plugins/assets/img/testimonials/testimonials-1.jpg') }}" class="testimonial-img" alt="">
                                <h3>Saul Goodman</h3>
                                <h4>Ceo &amp; Founder</h4>
                                <p>
                                    <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                    Đối với nhóm đối tượng, kết quả là đáng quan tâm cho đến khi hãng hàng không tiếp quản. Những người tố cáo, tuy nhiên, cần điều đó, và cần một số kỷ luật. Một chút mờ nhạt, nhưng luôn là một nụ cười.
                                    <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                </p>
                            </div>
                        </div>
                    </div><!-- End testimonial item -->

                    <div class="swiper-slide">
                        <div class="testimonial-wrap">
                            <div class="testimonial-item">
                                <img src="{{ asset('plugins/assets/img/testimonials/testimonials-2.jpg') }}" class="testimonial-img" alt="">
                                <h3>Sara Wilsson</h3>
                                <h4>Nhà thiết kế</h4>
                                <p>
                                    <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                    Tuy nhiên, thời gian xuất ngoại, tôi đã vì những tệ nạn mà tôi sẽ tức giận với nỗ lực rằng tôi sẽ trở thành kẻ mà tôi đã phải đối mặt với những tệ nạn mà tôi mong muốn trở thành mà một số người của chúng ta nên làm. chạy trốn khỏi cơn giận.
                                    <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                </p>
                            </div>
                        </div>
                    </div><!-- End testimonial item -->

                    <div class="swiper-slide">
                        <div class="testimonial-wrap">
                            <div class="testimonial-item">
                                <img src="{{ asset('plugins/assets/img/testimonials/testimonials-3.jpg') }}" class="testimonial-img" alt="">
                                <h3>Jena Karlis</h3>
                                <h4>Chủ cửa hàng</h4>
                                <p>
                                    <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                    Vả, nếu ta không xuất một sợi tóc từ nhà ngươi, là điều tuyệt vời, trong đó không có một sợi tóc nào ta đem đến nhà ngươi, thì thời gian lao động ít nhất sẽ là ta ở trong nhà chúng ta.


                                    <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                </p>
                            </div>
                        </div>
                    </div><!-- End testimonial item -->

                    <div class="swiper-slide">
                        <div class="testimonial-wrap">
                            <div class="testimonial-item">
                                <img src="{{ asset('plugins/assets/img/testimonials/testimonials-4.jpg') }}" class="testimonial-img" alt="">
                                <h3>Matt Brandon</h3>
                                <h4>Freelancer</h4>
                                <p>
                                    <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                    Vì tôi đang trốn chạy khỏi nỗi đau đớn, không có lỗi gì trong việc xuất khẩu nhiều người.
                                    <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                </p>
                            </div>
                        </div>
                    </div><!-- End testimonial item -->

                    <div class="swiper-slide">
                        <div class="testimonial-wrap">
                            <div class="testimonial-item">
                                <img src="{{ asset('plugins/assets/img/testimonials/testimonials-5.jpg') }}" class="testimonial-img" alt="">
                                <h3>John Larson</h3>
                                <h4>Doanh nhân</h4>
                                <p>
                                    <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                    Tôi sẽ đọc ai trong số họ?
                                    <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                </p>
                            </div>
                        </div>
                    </div><!-- End testimonial item -->

                </div>
                <div class="swiper-pagination"></div>
            </div>

        </div>
    </section><!-- End Testimonials Section -->

</main><!-- End #main -->

@endsection
