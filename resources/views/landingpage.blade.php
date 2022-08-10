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
                <h2>CERTIFIED</h2>
                <p class="lead mb-0">Aside from the advanced technology and facilities, PT.Kitoshindo International Biotech is GMP and (ISO 9001:2015) certified, which assures customers and business partners with our efficient production and quality management system. Our company also Halal certified, which ensure all of our ingredients and processes are halal, giving guarantee to our customers that our products meet standard halal requirements.</p>
            </div>
        </div>
        <div class="row g-0">
            <div class="col-lg-6 text-white showcase-img" style="background-image: url('{{ asset('gambar/p3.jpg') }}')"></div>
            <div class="col-lg-6 my-auto showcase-text">
                <h2>OUR TCHNOLOGY</h2>
                <p class="lead mb-0">Supported by advanced technology, our microbiology laboratory facility maintains the quality of each and every products produced within the premises to the microscopic level.</p>
            </div>
        </div>
        <div class="row g-0">
            <div class="col-lg-6 order-lg-2 text-white showcase-img" style="background-image: url('{{ asset('gambar/p5.jpg') }}')"></div>
            <div class="col-lg-6 order-lg-1 my-auto showcase-text">
                <h2>TO YOUR DOORSTEP</h2>
                <p class="lead mb-0">We are able to deliver the best of our products and services to various places, right on to your doorstep. Be it in domestic or international, we are ready to deliver and export our goods worldwide according to our client’s needs and requests.</p>
            </div>
        </div>
        <div class="row g-0">
            <div class="col-lg-6 text-white showcase-img" style="background-image: url('{{ asset('gambar/s3.jpg') }}')"></div>
            <div class="col-lg-6 my-auto showcase-text">
                <h2>HEALTHY GROW</h2>
                <p class="lead mb-0">In the midst of a global crisis economy and the competitiveness of business world, PT. Kitoshindo International Biotech is still potentially growing. We keep thriving in various economical condition and tackle all different obstacles.</p>
            </div>
        </div>
    </div>
</section>


@endsection