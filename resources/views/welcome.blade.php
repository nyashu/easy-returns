@extends('layouts.frontend')

@section('content')
    <section class="py-xxl-10 pb-0" id="home">
        <div class="bg-holder bg-size"
            style="background-image:url({{ asset('frontend/img/gallery/hero-header-bg.png') }});background-position:top center;background-size:cover;">
        </div>
        <!--/.bg-holder-->

        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-5 col-xl-6 col-xxl-7 order-0 order-md-1 text-end"><img class="pt-7 pt-md-0 w-100"
                        src="{{ asset('frontend/img/illustrations/hero.png') }}" alt="hero-header" /></div>
                <div class="col-md-75 col-xl-6 col-xxl-5 text-md-start text-center py-8">
                    <h1 class="fw-normal fs-6 fs-xxl-7">A trusted provider of </h1>
                    <h1 class="fw-bolder fs-6 fs-xxl-7 mb-2">return services.</h1>
                    <p class="fs-1 mb-5">We deliver your products safely to <br />your home in a reasonable time. <br />
                      All time returns count : <span class="text-danger fw-bold">{{ $total_returns }}</span>
                     </p><a
                        class="btn btn-primary me-2" href="{{ route('easy-return.create') }}" role="button">Request for return<i class="fas fa-arrow-right ms-2"></i></a>
                </div>
            </div>
        </div>
    </section>


    <!-- ============================================-->
    <!-- <section> begin ============================-->
    <section class="py-7" id="services" container-xl="container-xl">

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-5 text-center mb-3">
                    <h5 class="text-danger">TOP CUSTOMER</h5>
                    <h2>Our top users</h2>
                </div>
            </div>
            <div class="row h-100 justify-content-center">
              @forelse ($users as $user)
              <div class="col-md-4 pt-4 px-md-2 px-lg-3">
                <div class="card h-100 px-lg-5 card-span">
                    <div class="card-body d-flex flex-column justify-content-around">
                        <div class="text-center pt-2"><img class="rounded" height="200" width="200"
                                src="{{ $user->getFirstMediaUrl('profile') }}" alt="..." />
                            <h5 class="my-4">{{ $user->name }}</h5>
                        </div>
                        <p>{{ $user->address }}</p>
                        <ul class="list-unstyled">
                            <li class="mb-2"><span class="me-2"><i class="fas fa-circle text-primary"
                                        style="font-size:.5rem"></i></span>{{ $user->phone }}
                            </li>
                            <li class="mb-2"><span class="me-2"><i class="fas fa-circle text-primary"
                                        style="font-size:.5rem"></i></span>{{ Str::limit($user->email, 20, '...') }}
                            </li>
                            <li class="mb-2"><span class="me-2"><i class="fas fa-circle text-primary"
                                        style="font-size:.5rem"></i></span>Likeliness :                                             @if (strtolower($user->user_return_likeliness) == 'low')
                                        <span class="text-danger">{{ $user->user_return_likeliness }}</span>
                                    @elseif(strtolower($user->user_return_likeliness) == 'moderate')
                                        <span class="text-primary">{{ $user->user_return_likeliness }}</span>
                                    @else
                                        <span class="text-success">{{ $user->user_return_likeliness }}</span>
                                    @endif
                            </li>
                        </ul>
                        <div class="text-center my-5">
                            <div class="d-grid">
                                <button class="btn btn-danger" type="submit">Total Returns : {{ $user->returns_count }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
              @empty
              <div class="col-md-8 col-lg-5 text-center mb-3">
                <h5 class="text-danger">NO TOP CUSTOMERS FOUND</h5>
            </div>
              @endforelse
            </div>
        </div>
        <!-- end of .container-->

    </section>
    <!-- <section> close ============================-->
    <!-- ============================================-->

        <!-- ============================================-->
    <!-- <section> begin ============================-->
      {{-- <section class="py-7" id="services" container-xl="container-xl">

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-5 text-center mb-3">
                    <h5 class="text-danger">SERVICES</h5>
                    <h2>Our services for you</h2>
                </div>
            </div>
            <div class="row h-100 justify-content-center">
                <div class="col-md-4 pt-4 px-md-2 px-lg-3">
                    <div class="card h-100 px-lg-5 card-span">
                        <div class="card-body d-flex flex-column justify-content-around">
                            <div class="text-center pt-5"><img class="img-fluid"
                                    src="{{ asset('frontend/img/icons/services-1.svg') }}" alt="..." />
                                <h5 class="my-4">Business Services</h5>
                            </div>
                            <p>Offering home delivery around the city, where your products will be at your doorstep within
                                48-72 hours.</p>
                            <ul class="list-unstyled">
                                <li class="mb-2"><span class="me-2"><i class="fas fa-circle text-primary"
                                            style="font-size:.5rem"></i></span>Corporate goods
                                </li>
                                <li class="mb-2"><span class="me-2"><i class="fas fa-circle text-primary"
                                            style="font-size:.5rem"></i></span>Shipment
                                </li>
                                <li class="mb-2"><span class="me-2"><i class="fas fa-circle text-primary"
                                            style="font-size:.5rem"></i></span>Accesories
                                </li>
                            </ul>
                            <div class="text-center my-5">
                                <div class="d-grid">
                                    <button class="btn btn-outline-danger" type="submit">Learn more </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 pt-4 px-md-2 px-lg-3">
                    <div class="card h-100 px-lg-5 card-span">
                        <div class="card-body d-flex flex-column justify-content-around">
                            <div class="text-center pt-5"><img class="img-fluid"
                                    src="{{ asset('frontend/img/icons/services-2.svg') }}" alt="..." />
                                <h5 class="my-4">Statewide Services</h5>
                            </div>
                            <p>Offering home delivery around the city, where your products will be at your doorstep within
                                48-72 hours.</p>
                            <ul class="list-unstyled">
                                <li class="mb-2"><span class="me-2"><i class="fas fa-circle text-primary"
                                            style="font-size:.5rem"></i></span>Unlimited Bandwidth
                                </li>
                                <li class="mb-2"><span class="me-2"><i class="fas fa-circle text-primary"
                                            style="font-size:.5rem"></i></span>Encrypted Connection
                                </li>
                                <li class="mb-2"><span class="me-2"><i class="fas fa-circle text-primary"
                                            style="font-size:.5rem"></i></span>Yes Traffic Logs
                                </li>
                            </ul>
                            <div class="text-center my-5">
                                <div class="d-grid">
                                    <button class="btn btn-danger hover-top btn-glow border-0" type="submit">Learn
                                        more</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 pt-4 px-md-2 px-lg-3">
                    <div class="card h-100 px-lg-5 card-span">
                        <div class="card-body d-flex flex-column justify-content-around">
                            <div class="text-center pt-5"><img class="img-fluid"
                                    src="{{ asset('frontend/img/icons/services-3.svg') }}" alt="..." />
                                <h5 class="my-4">Personal Services</h5>
                            </div>
                            <p>You can trust us to safely deliver your most sensitive documents to the specific area in a
                                short time.</p>
                            <ul class="list-unstyled">
                                <li class="mb-2"><span class="me-2"><i class="fas fa-circle text-primary"
                                            style="font-size:.5rem"></i></span>Unlimited Bandwidth
                                </li>
                                <li class="mb-2"><span class="me-2"><i class="fas fa-circle text-primary"
                                            style="font-size:.5rem"></i></span>Encrypted Connection
                                </li>
                                <li class="mb-2"><span class="me-2"><i class="fas fa-circle text-primary"
                                            style="font-size:.5rem"></i></span>Yes Traffic Logs
                                </li>
                            </ul>
                            <div class="text-center my-5">
                                <div class="d-grid">
                                    <button class="btn btn-outline-danger" type="submit">Learn more </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end of .container-->

    </section> --}}
    <!-- <section> close ============================-->
    <!-- ============================================-->




    <!-- ============================================-->
    <!-- <section> begin ============================-->
    {{-- <section class="pt-7 pb-0">

        <div class="container">
            <div class="row">
                <div class="col-6 col-lg mb-5">
                    <div class="text-center"><img src="{{ asset('frontend/img/icons/awards.png') }}" alt="..." />
                        <h1 class="text-primary mt-4">26+</h1>
                        <h5 class="text-800">Awards won</h5>
                    </div>
                </div>
                <div class="col-6 col-lg mb-5">
                    <div class="text-center"><img src="{{ asset('frontend/img/icons/states.png') }}" alt="..." />
                        <h1 class="text-primary mt-4">65+</h1>
                        <h5 class="text-800">States covered</h5>
                    </div>
                </div>
                <div class="col-6 col-lg mb-5">
                    <div class="text-center"><img src="{{ asset('frontend/img/icons/clients.png') }}" alt="..." />
                        <h1 class="text-primary mt-4">689K+</h1>
                        <h5 class="text-800">Happy clients</h5>
                    </div>
                </div>
                <div class="col-6 col-lg mb-5">
                    <div class="text-center"><img src="{{ asset('frontend/img/icons/goods.png') }}" alt="..." />
                        <h1 class="text-primary mt-4">130M+</h1>
                        <h5 class="text-800">Goods delivered</h5>
                    </div>
                </div>
                <div class="col-6 col-lg mb-5">
                    <div class="text-center"><img src="{{ asset('frontend/img/icons/business.png') }}" alt="..." />
                        <h1 class="text-primary mt-4">130M+</h1>
                        <h5 class="text-800">Business hours</h5>
                    </div>
                </div>
            </div>
        </div>
        <!-- end of .container-->

    </section> --}}
    <!-- <section> close ============================-->
    <!-- ============================================-->




    <!-- ============================================-->
    <!-- <section> begin ============================-->
    {{-- <section>

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card bg-dark text-white py-4 py-sm-0"><img class="w-100"
                            src="{{ asset('frontend/img/gallery/video.png') }}" alt="video" />
                        <div class="card-img-overlay bg-dark-gradient d-flex flex-column flex-center"><img
                                src="{{ asset('frontend/img/icons/play.png') }}" width="80" alt="play" />
                            <h5 class="text-primary">FASTEST DELIVERY</h5>
                            <p class="text-center">You can get your valuable item in the fastest period of<br
                                    class="d-none d-sm-block" />time with safety. Because your emergency<br
                                    class="d-none d-sm-block" />is our first priority.</p><a class="stretched-link"
                                href="#" data-bs-toggle="modal" data-bs-target="#exampleModal"></a>
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content overflow-hidden">
                                        <div class="modal-header p-0">
                                            <div class="ratio ratio-16x9" id="exampleModalLabel">
                                                <iframe src="https://www.youtube.com/embed/TlcP2aTOp-Q"
                                                    title="YouTube video" allowfullscreen="allowfullscreen"></iframe>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-primary" type="button"
                                                data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end of .container-->

    </section> --}}
    <!-- <section> close ============================-->
    <!-- ============================================-->




    <!-- ============================================-->
    <!-- <section> begin ============================-->
    {{-- <section class="py-7">

        <div class="container-fluid">
            <div class="row flex-center">
                <div class="bg-holder bg-size"
                    style="background-image:url({{ asset('frontend/img/gallery/quote.png') }});background-position:top;background-size:auto;margin-left:-270px;margin-top:-45px;">
                </div>
                <!--/.bg-holder-->

                <div class="col-md-8 col-lg-5 text-center">
                    <h5 class="text-danger">TESTIMONIAL</h5>
                    <h2>Our Awesome Clients</h2>
                </div>
            </div>
            <div class="carousel slide pt-6" id="carouselExampleDark" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active" data-bs-interval="10000">
                        <div class="row h-100">
                            <div class="col-md-4 mb-3 mb-md-0">
                                <div class="card h-100 card-span p-3">
                                    <div class="card-body">
                                        <h5 class="mb-0 text-primary">Fantastic service!</h5>
                                        <p class="card-text pt-3">I purchased a phone from an e-commerce site, and this
                                            courier service provider assisted me in getting it delivered to my home. I
                                            received my phone within one day, and I was really satisfied with their service
                                            when I received it. </p>
                                        <div class="d-xl-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center mb-3"><i
                                                    class="fas fa-star text-primary me-1"></i><i
                                                    class="fas fa-star text-primary me-1"></i><i
                                                    class="fas fa-star text-primary me-1"></i><i
                                                    class="fas fa-star text-primary me-1"></i><i
                                                    class="fas fa-star text-primary me-1"></i></div>
                                            <div class="d-flex align-items-center"><img class="img-fluid"
                                                    src="{{ asset('frontend/img/icons/avatar.png') }}" alt="" />
                                                <div class="flex-1 ms-3">
                                                    <h6 class="mb-0 fs--1 text-1000 fw-medium">Yves Tanguy</h6>
                                                    <p class="fs--2 fw-normal mb-0">Chief Executive, DLF</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3 mb-md-0">
                                <div class="card h-100 card-span p-3">
                                    <div class="card-body">
                                        <h5 class="mb-0 text-primary">Fantastic service!</h5>
                                        <p class="card-text pt-3">I purchased a phone from an e-commerce site, and this
                                            courier service provider assisted me in getting it delivered to my home. I
                                            received my phone within one day, and I was really satisfied with their service
                                            when I received it.</p>
                                        <div class="d-xl-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center mb-3"><i
                                                    class="fas fa-star text-primary me-1"></i><i
                                                    class="fas fa-star text-primary me-1"></i><i
                                                    class="fas fa-star text-primary me-1"></i><i
                                                    class="fas fa-star text-primary me-1"></i><i
                                                    class="fas fa-star text-primary me-1"></i></div>
                                            <div class="d-flex align-items-center"><img class="img-fluid"
                                                    src="{{ asset('frontend/img/icons/avatar.png') }}" alt="" />
                                                <div class="flex-1 ms-3">
                                                    <h6 class="mb-0 fs--1 text-1000 fw-medium">Kim Young Jou</h6>
                                                    <p class="fs--2 fw-normal mb-0">Chief Executive, DLF</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3 mb-md-0">
                                <div class="card h-100 card-span p-3">
                                    <div class="card-body">
                                        <h5 class="mb-0 text-primary">Fantastic service!</h5>
                                        <p class="card-text pt-3">I purchased a phone from an e-commerce site, and this
                                            courier service provider assisted me in getting it delivered to my home. I
                                            received my phone within one day, and I was really satisfied with their service
                                            when I received it. .</p>
                                        <div class="d-xl-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center mb-3"><i
                                                    class="fas fa-star text-primary me-1"></i><i
                                                    class="fas fa-star text-primary me-1"></i><i
                                                    class="fas fa-star text-primary me-1"></i><i
                                                    class="fas fa-star text-primary me-1"></i><i
                                                    class="fas fa-star text-primary me-1"></i></div>
                                            <div class="d-flex align-items-center"><img class="img-fluid"
                                                    src="{{ asset('frontend/img/icons/avatar.png') }}" alt="" />
                                                <div class="flex-1 ms-3">
                                                    <h6 class="mb-0 fs--1 text-1000 fw-medium">Yves Tanguy</h6>
                                                    <p class="fs--2 fw-normal mb-0">Chief Executive, DLF</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item" data-bs-interval="2000">
                        <div class="row h-100">
                            <div class="col-md-4 mb-3 mb-md-0">
                                <div class="card h-100 card-span p-3">
                                    <div class="card-body">
                                        <h5 class="mb-0 text-primary">Fantastic service!</h5>
                                        <p class="card-text pt-3">I purchased a phone from an e-commerce site, and this
                                            courier service provider assisted me in getting it delivered to my home. I
                                            received my phone within one day, and I was really satisfied with their service
                                            when I received it. </p>
                                        <div class="d-xl-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center mb-3"><i
                                                    class="fas fa-star text-primary me-1"></i><i
                                                    class="fas fa-star text-primary me-1"></i><i
                                                    class="fas fa-star text-primary me-1"></i><i
                                                    class="fas fa-star text-primary me-1"></i><i
                                                    class="fas fa-star text-primary me-1"></i></div>
                                            <div class="d-flex align-items-center"><img class="img-fluid"
                                                    src="{{ asset('frontend/img/icons/avatar.png') }}" alt="" />
                                                <div class="flex-1 ms-3">
                                                    <h6 class="mb-0 fs--1 text-1000 fw-medium">Yves Tanguy</h6>
                                                    <p class="fs--2 fw-normal mb-0">Chief Executive, DLF</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3 mb-md-0">
                                <div class="card h-100 card-span p-3">
                                    <div class="card-body">
                                        <h5 class="mb-0 text-primary">Fantastic service!</h5>
                                        <p class="card-text pt-3">I purchased a phone from an e-commerce site, and this
                                            courier service provider assisted me in getting it delivered to my home. I
                                            received my phone within one day, and I was really satisfied with their service
                                            when I received it. </p>
                                        <div class="d-xl-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center mb-3"><i
                                                    class="fas fa-star text-primary me-1"></i><i
                                                    class="fas fa-star text-primary me-1"></i><i
                                                    class="fas fa-star text-primary me-1"></i><i
                                                    class="fas fa-star text-primary me-1"></i><i
                                                    class="fas fa-star text-primary me-1"></i></div>
                                            <div class="d-flex align-items-center"><img class="img-fluid"
                                                    src="{{ asset('frontend/img/icons/avatar.png') }}" alt="" />
                                                <div class="flex-1 ms-3">
                                                    <h6 class="mb-0 fs--1 text-1000 fw-medium">Kim Young Jou</h6>
                                                    <p class="fs--2 fw-normal mb-0">Chief Executive, DLF</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3 mb-md-0">
                                <div class="card h-100 card-span p-3">
                                    <div class="card-body">
                                        <h5 class="mb-0 text-primary">Fantastic service!</h5>
                                        <p class="card-text pt-3">I purchased a phone from an e-commerce site, and this
                                            courier service provider assisted me in getting it delivered to my home. I
                                            received my phone within one day, and I was really satisfied with their service
                                            when I received it. .</p>
                                        <div class="d-xl-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center mb-3"><i
                                                    class="fas fa-star text-primary me-1"></i><i
                                                    class="fas fa-star text-primary me-1"></i><i
                                                    class="fas fa-star text-primary me-1"></i><i
                                                    class="fas fa-star text-primary me-1"></i><i
                                                    class="fas fa-star text-primary me-1"></i></div>
                                            <div class="d-flex align-items-center"><img class="img-fluid"
                                                    src="{{ asset('frontend/img/icons/avatar.png') }}" alt="" />
                                                <div class="flex-1 ms-3">
                                                    <h6 class="mb-0 fs--1 text-1000 fw-medium">Yves Tanguy</h6>
                                                    <p class="fs--2 fw-normal mb-0">Chief Executive, DLF</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="row h-100">
                            <div class="col-md-4 mb-3 mb-md-0">
                                <div class="card h-100 card-span p-3">
                                    <div class="card-body">
                                        <h5 class="mb-0 text-primary">Fantastic service!</h5>
                                        <p class="card-text pt-3">I purchased a phone from an e-commerce site, and this
                                            courier service provider assisted me in getting it delivered to my home. I
                                            received my phone within one day, and I was really satisfied with their service
                                            when I received it. </p>
                                        <div class="d-xl-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center mb-3"><i
                                                    class="fas fa-star text-primary me-1"></i><i
                                                    class="fas fa-star text-primary me-1"></i><i
                                                    class="fas fa-star text-primary me-1"></i><i
                                                    class="fas fa-star text-primary me-1"></i><i
                                                    class="fas fa-star text-primary me-1"></i></div>
                                            <div class="d-flex align-items-center"><img class="img-fluid"
                                                    src="{{ asset('frontend/img/icons/avatar.png') }}" alt="" />
                                                <div class="flex-1 ms-3">
                                                    <h6 class="mb-0 fs--1 text-1000 fw-medium">Yves Tanguy</h6>
                                                    <p class="fs--2 fw-normal mb-0">Chief Executive, DLF</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3 mb-md-0">
                                <div class="card h-100 card-span p-3">
                                    <div class="card-body">
                                        <h5 class="mb-0 text-primary">Fantastic service!</h5>
                                        <p class="card-text pt-3">“I purchased a phone from an e-commerce site, and this
                                            courier service provider assisted me in getting it delivered to my home. I
                                            received my phone within one day, and I was really satisfied with their service
                                            when I received it. </p>
                                        <div class="d-xl-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center mb-3"><i
                                                    class="fas fa-star text-primary me-1"></i><i
                                                    class="fas fa-star text-primary me-1"></i><i
                                                    class="fas fa-star text-primary me-1"></i><i
                                                    class="fas fa-star text-primary me-1"></i><i
                                                    class="fas fa-star text-primary me-1"></i></div>
                                            <div class="d-flex align-items-center"><img class="img-fluid"
                                                    src="{{ asset('frontend/img/icons/avatar.png') }}" alt="" />
                                                <div class="flex-1 ms-3">
                                                    <h6 class="mb-0 fs--1 text-1000 fw-medium">Kim Young Jou</h6>
                                                    <p class="fs--2 fw-normal mb-0">Chief Executive, DLF</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3 mb-md-0">
                                <div class="card h-100 card-span p-3">
                                    <div class="card-body">
                                        <h5 class="mb-0 text-primary">Fantastic service!</h5>
                                        <p class="card-text pt-3">I purchased a phone from an e-commerce site, and this
                                            courier service provider assisted me in getting it delivered to my home. I
                                            received my phone within one day, and I was really satisfied with their service
                                            when I received it. .</p>
                                        <div class="d-xl-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center mb-3"><i
                                                    class="fas fa-star text-primary me-1"></i><i
                                                    class="fas fa-star text-primary me-1"></i><i
                                                    class="fas fa-star text-primary me-1"></i><i
                                                    class="fas fa-star text-primary me-1"></i><i
                                                    class="fas fa-star text-primary me-1"></i></div>
                                            <div class="d-flex align-items-center"><img class="img-fluid"
                                                    src="{{ asset('frontend/img/icons/avatar.png') }}" alt="" />
                                                <div class="flex-1 ms-3">
                                                    <h6 class="mb-0 fs--1 text-1000 fw-medium">Yves Tanguy</h6>
                                                    <p class="fs--2 fw-normal mb-0">Chief Executive, DLF</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row px-3 px-md-0 mt-6">
                    <div class="col-12 position-relative">
                        <ol class="carousel-indicators">
                            <li class="active" data-bs-target="#carouselExampleDark" data-bs-slide-to="0"></li>
                            <li data-bs-target="#carouselExampleDark" data-bs-slide-to="1"></li>
                            <li data-bs-target="#carouselExampleDark" data-bs-slide-to="2"></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end of .container-->

    </section> --}}
    <!-- <section> close ============================-->
    <!-- ============================================-->




    <!-- ============================================-->
    <!-- <section> begin ============================-->
    <section>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5 col-xl-4"><img src="frontend/img/illustrations/callback.png"
                        alt="..." />
                    <h5 class="text-danger">REQUEST A CALLBACK</h5>
                    <h2>We will contact in the shortest time.</h2>
                    <p class="text-muted">Monday to Friday, 9am-5pm.</p>
                </div>
                <div class="col-md-6 col-lg-5 col-xl-4">
                    <form class="row">
                        <div class="mb-3">
                            <label class="form-label visually-hidden" for="inputName">Name</label>
                            <input class="form-control form-quriar-control" id="inputName" type="text"
                                placeholder="Name" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label visually-hidden" for="inputEmail">Another label</label>
                            <input class="form-control form-quriar-control" id="inputEmail" type="email"
                                placeholder="Email" />
                        </div>
                        <div class="mb-5">
                            <label class="form-label visually-hidden" for="validationTextarea">Message</label>
                            <textarea class="form-control form-quriar-control is-invalid border-400" id="validationTextarea"
                                placeholder="Message" style="height: 150px" required="required"></textarea>
                        </div>
                        <div class="d-grid">
                            <button class="btn btn-primary" type="submit">Send Message<i
                                    class="fas fa-paper-plane ms-2"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- end of .container-->

    </section>
    <!-- <section> close ============================-->
    <!-- ============================================-->




    <!-- ============================================-->
    <!-- <section> begin ============================-->
    <section id="findUs">

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-5 mb-6 text-center">
                    <h5 class="text-danger">FIND US</h5>
                    <h2>Access us easily</h2>
                </div>
                <div class="col-12">
                    <div class="card card-span rounded-2 mb-3">
                        <div class="row">
                            <div class="col-md-6 col-lg-7 d-flex"><img
                                    class="w-100 fit-cover rounded-md-start rounded-top rounded-md-top-0"
                                    src="frontend/img/gallery/map.svg" alt="map" /></div>
                            <div class="col-md-6 col-lg-5 d-flex flex-center">
                                <div class="card-body">
                                    <h5>Contact with us</h5>
                                    <p class="text-700 my-4"> <i
                                            class="fas fa-map-marker-alt text-warning me-3"></i><span>2277 Lorem Ave, San
                                            Diego, CA 22553</span></p>
                                    <p><i class="fas fa-phone-alt text-warning me-3"></i><span class="text-700">Monday -
                                            Friday: 10 am - 10pm<br /><span class="ps-4">Sunday: 11 am - 9pm
                                            </span></span></p>
                                    <p><i class="fas fa-envelope text-warning me-3"> </i><a class="text-700"
                                            href="mailto:vctung@outlook.com"> info@quriarbox.com</a></p>
                                    <ul class="list-unstyled list-inline mt-5">
                                        <li class="list-inline-item"><a class="text-decoration-none" href="#!"><i
                                                    class="fab fa-facebook-square fs-2"></i></a></li>
                                        <li class="list-inline-item"><a class="text-decoration-none" href="#!"><i
                                                    class="fab fa-instagram-square fs-2"></i></a></li>
                                        <li class="list-inline-item"><a class="text-decoration-none" href="#!"><i
                                                    class="fab fa-twitter-square fs-2"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button class="btn btn-primary px-5" type="submit"><i class="fas fa-phone-alt me-2"></i><a
                                class="text-light" href="tel:123-456789">Call us to delivery 123-456789</a></button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end of .container-->

    </section>
    <!-- <section> close ============================-->
    <!-- ============================================-->
@endsection
