@extends('layouts.main')

@section('container')

<!-- Masterhead -->
<header class="masthead">
    <div class="container position-relative">
        <div class="row justify-content-center">
            <div class="col-xl-12">
                <div class="text-center text-white">
                    <!-- Page heading-->
                    <h1 class="mb-5">PT. KITOSHINDO INTERNATIONAL BIOTECH</h1>
                    <a href="{{url('product-customer')}}" class="btn btn-primary">Show product</a>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Brand profile-->
<section class="features-icons bg-light ">
    <div class="container py-3">
        <h2 class="my-3 text-center">BRAND PROFILE :</h2>
        <h4 class="text-center text-secondary">KITODERM, DERMANEEVE, FULVIO</h4>
        <p>
            Based on extensive research by the Kitoshindo laboratories. we have developed a product assortment of high quality derma cosmmetic products for the needs of profesional aesthetic doctors and specialists to advise to their patients in the clinics
        </p>
        <p>
            KITODERM products expresses the highest standard of product development in order to serve as effective facial treatments advised by doctors and clinical specialists. from the facial cleaning as a start of the daily routine, to the light liquid foundation of the kitoderm BB creams for daytime use; all Kitoderm products are dermatological safe to use and guarantee the well-being and well feeling of the facial skin.
        </p>
        <p>
            KITODERM Laboratories have given special attention to the needs of indonesian women and men for the lightening and whitening process of the skin. Therefore the Kitoderm assortment of day-creams, niight creams and vitamin enhanced products. give perfect lightening and whitening result, with respect and care for the healthy and natural condition of the skin.
        </p>
        <p>
            In the KITODERM Acne product assortment, the use of special anti-bacteriological ingredients, will satisfy derma-specialists and their patiesnts for the effectiveness of the acne problem-solving needs. therefore KITODERM derma cosmetics excellents in all areas of the needs of professional doctors in aesthetic clinics to serve as the most advised and stisfied home-used products bya their patients
        </p>
    </div>
</section>

<!-- Image Showcases-->
<section class="showcase">
    <div class="container-fluid p-0 my-3">
        <div class="row g-0">
            <div class="col-lg-6 order-lg-2 text-white showcase-img" style="background-image: url('{{ asset('gambar/p2.jpg') }}')"></div>
            <div class="col-lg-6 order-lg-1 my-auto showcase-text">
                <h2>Fully Responsive Design</h2>
                <p class="lead mb-0">When you use a theme created by Start Bootstrap, you know that the theme will look great on any device, whether it's a phone, tablet, or desktop the page will behave responsively!</p>
            </div>
        </div>
        <div class="row g-0">
            <div class="col-lg-6 text-white showcase-img" style="background-image: url('{{ asset('gambar/p3.jpg') }}')"></div>
            <div class="col-lg-6 my-auto showcase-text">
                <h2>Updated For Bootstrap 5</h2>
                <p class="lead mb-0">Newly improved, and full of great utility classes, Bootstrap 5 is leading the way in mobile responsive web development! All of the themes on Start Bootstrap are now using Bootstrap 5!</p>
            </div>
        </div>
        <div class="row g-0">
            <div class="col-lg-6 order-lg-2 text-white showcase-img" style="background-image: url('{{ asset('gambar/p5.jpg') }}')"></div>
            <div class="col-lg-6 order-lg-1 my-auto showcase-text">
                <h2>Easy to Use & Customize</h2>
                <p class="lead mb-0">Landing Page is just HTML and CSS with a splash of SCSS for users who demand some deeper customization options. Out of the box, just add your content and images, and your new landing page will be ready to go!</p>
            </div>
        </div>
        <div class="row g-0">
            <div class="col-lg-6 text-white showcase-img" style="background-image: url('{{ asset('gambar/s3.jpg') }}')"></div>
            <div class="col-lg-6 my-auto showcase-text">
                <h2>Updated For Bootstrap 5</h2>
                <p class="lead mb-0">Newly improved, and full of great utility classes, Bootstrap 5 is leading the way in mobile responsive web development! All of the themes on Start Bootstrap are now using Bootstrap 5!</p>
            </div>
        </div>
    </div>
</section>

<!-- Footer-->
<footer class="page-footer font-small" style="background-color: #132646; padding-top: 20px;">
    <!-- Footer Links -->
    <div class="container text-md-left">
        <!-- Grid row -->
        <div class="row">
            <!-- Grid column -->
            <div class="col-md-4 col-sm-6 col-xs-12">
                <!-- Content -->
                <img src="{{asset('gambar/kitologo.png')}}" style="width:40%" alt="Image">
            </div>

            <div class="col-md-4 col-sm-6 col-xs-12">
                <!-- Contact details -->
                <h5 class="font-weight-bold text-uppercase mb-4">
                    <font style="font-size: 15px; line-height: 150%" color="#FFFFFF"><b><i class="fa fa-map-marker"></i> ADDRESS</b></font>
                </h5>
                <ul class="list-unstyled">
                    <li>
                        <p class="small">
                            <font color="#f2f2f2">
                                Jl. Raya Jetis Perning KM 43
                                Mojokerto,<br> East Java Indonesia 61352
                            </font>
                        </p>
                    </li>
                </ul>
            </div>

            <div class="col-md-4 col-sm-6 col-xs-12 text-md-left">
                <!-- Social buttons -->
                <h5 class="font-weight-bold text-uppercase mb-4">
                    <font style="font-size: 15px; line-height: 150%" color="#FFFFFF"><i class="fa fa-phone"></i> CONTACT</font>
                </h5>
                <ul class="list-unstyled">
                    <li>
                        <p class="small">
                            <font color="#f2f2f2">
                                +62 321 365788 <br>
                                +62 321 365789 <br>
                                +62 321 365790 <br>
                                +62 321 365787 (Fax)
                            </font>
                        </p>
                    </li>
                </ul>
            </div>


        </div>
        <!-- Grid row -->
    </div>
    <!-- Footer Links -->

    <!-- Copyright -->
    <div class="footer-copyright text-center py-3" style="background-color: #000000; padding:5px">
        <p class="small" style="color: #ffffff">© 2021 Copyright: Kitoshindo International Biotech </p>
    </div>
    <!-- Copyright -->

</footer>
@endsection