@extends('layouts.app')
@section('header')
    <!-- Your header content goes here -->
@endsection

@section('content')
    <style>
        .price-tag {
            display: inline-flex;
            align-items: center;
            background: #007bff;
            color: #fff;
            padding: 0.5rem 1rem;
            border-radius: 1rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .old-price {
            text-decoration: line-through;
            margin-right: 0.5rem;
            font-size: 0.9rem;
            color: #ffc107;
        }
        .new-price {
            font-size: 1.2rem;
            font-weight: bold;
        }
        .why-us-section {
            max-width: 1200px;
            margin: auto;
            padding: 4rem 1rem;
            text-align: center;
            color: #666;
        }

        .why-us-heading {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 3rem;
            color: #333;
        }

        .why-us-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            list-style: none;
            padding: 0;
        }

        .why-us-item {
            width: 100%;
            max-width: 300px;
            padding: 1rem;
            margin-bottom: 2rem;
        }

        .why-us-icon {
            width: 48px;
            height: 48px;
            margin-bottom: 1rem;
        }

        .why-us-text {
            font-size: 1rem;
            line-height: 1.5;
        }

    </style>
    <!-- Improved Package Carousel -->
    <div class="container-fluid p-0 wow fadeIn" data-wow-delay="0.1s">
        <div id="package-carousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="{{ asset('img/carousel-1.jpg') }}" alt="State Package Image">
                    <div class="carousel-caption d-flex align-items-center justify-content-center">
                        <div class="p-4" style="max-width: 700px; background: rgba(255, 255, 255, 0.85); border-radius: 25px;">
                            <h2 class="text-primary mb-3">{{ $state->name }} Driving School Online</h2>
                            <p class="mb-4" style="color: #0b0b0b;">Limited Time Offer! 20% or more off Drivers Ed with 1 FREE month of Allstate® Roadside Services (optional)</p>
                            <p style="color: #0b0b0b;">Only $5.00 per month after offer ends. Cancel Anytime.</p>
                            <a class="btn btn-primary mt-3" href="#trending-courses">View Packages</a>                        </div>
                    </div>
                </div>
            </div>
            <!-- Carousel controls can be added here if needed -->
        </div>
    </div>
    <!-- Improved Package Carousel End -->

    <!-- Courses Start -->
    <div class="container-xxl courses my-6 py-6 pb-0" id="trending-courses">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <h6 class="text-primary text-uppercase mb-2">Trending Courses</h6>
                <h1 class="display-6 mb-4">Our Courses Upskill You With Driving Training</h1>
            </div>
            <div class="row g-4 justify-content-center">
                @foreach ($packages as $package)
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="courses-item d-flex flex-column bg-white overflow-hidden h-100">
                            <div class="text-center p-4 pt-0">
                                <div class="d-inline-block bg-primary text-white fs-5 py-1 px-4 mb-4">${{ $package->price }}</div>
                                <h5 class="mb-3">{{ $package->type }} Lessons</h5>
                                <p>Learn the essentials of driving with our {{ strtolower($package->type) }} package, tailored for {{ $package->state->name }}'s regulations.</p>
                                <ol class="breadcrumb justify-content-center mb-0">
                                    <li class="breadcrumb-item small"><i class="fa fa-signal text-primary me-2"></i>{{ $package->type }}</li>
                                    <li class="breadcrumb-item small"><i class="fa fa-map-marker-alt text-primary me-2"></i>{{ $package->state->name }}</li>
                                </ol>
                            </div>
                            <div class="position-relative mt-auto">
                                <!-- Update the image source here -->
                                <img class="img-fluid" src="{{ asset('img/courses-' . ($loop->index + 1) . '.jpg') }}" alt="">
                                <div class="courses-overlay">
                                    <a class="btn btn-outline-primary border-2" href="{{ route('stripe.payment.show', $package->id) }}">Get Pack</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Courses End -->



    <!-- About Start -->
    <div class="container-xxl py-6">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="position-relative overflow-hidden ps-5 pt-5 h-100" style="min-height: 400px;">
                        <img class="position-absolute w-100 h-100" src="{{ asset('img/about-1.jpg') }}" alt="" style="object-fit: cover;">
                        <img class="position-absolute top-0 start-0 bg-white pe-3 pb-3" src="{{ asset('img/about-2.jpg') }}" alt="" style="width: 200px; height: 200px;">
                    </div>
                </div>

                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="h-100">
                        <h6 class="text-primary text-uppercase mb-2">About Us</h6>
                        <h1 class="display-6 mb-4">We Help Students To Pass Test & Get A License On The First Try</h1>
                        <p>Embark on the journey to becoming a confident driver with our top-tier online driving courses. Our commitment is to deliver unparalleled instruction that equips you with the knowledge of your state's road regulations. Dive into an engaging, interactive curriculum that prepares you for your permit exam and sets the foundation for safe, assured driving. Unlock the door to driving success – all the tools you need are at your fingertips with our comprehensive online lessons.</p>
                        <div class="row g-2 mb-4 pb-2">
                            <div class="col-sm-6">
                                <i class="fa fa-check text-primary me-2"></i>Fully Licensed
                            </div>
                            <div class="col-sm-6">
                                <i class="fa fa-check text-primary me-2"></i>Online Tracking
                            </div>
                            <div class="col-sm-6">
                                <i class="fa fa-check text-primary me-2"></i>Afordable Fee
                            </div>
                            <div class="col-sm-6">
                                <i class="fa fa-check text-primary me-2"></i>Best Trainers
                            </div>
                        </div>
                        <div class="row g-4">
                            <div class="col-sm-6">
                                <a class="btn btn-primary py-3 px-5" href="">Read More</a>
                            </div>
                            <div class="col-sm-6">
                                <a class="d-inline-flex align-items-center btn btn-outline-primary border-2 p-2" href="tel:+0123456789">
                                    <span class="flex-shrink-0 btn-square bg-primary">
                                        <i class="fa fa-phone-alt text-white"></i>
                                    </span>
                                    <span class="px-3">+012 345 6789</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <div data-test="whySection" class="mx-auto px-2 pt-16 pb-12 text-center max-w-6xl text-dec-gray-500"><div class="wysiwyg why-us-state-heading-styles font-bold mb-12"><h2>So, Why Us?</h2></div><!----><ul class="flex justify-center flex-wrap"><li class="w-full md:w-1/3 pb-12 px-8"><div class="w-auto h-12"><div class="flex justify-center"><img img-lazy="" width="48" height="48" class="w-auto h-12 image-lazy-loaded" alt="White car icon" src="https://dec-mkt.imgix.net/font-awesome_4-7-0_car_256_0_ffffff_none.png?v=1595523505&amp;auto=format,compress"></div><!----></div><div class="wysiwyg why-us-styles"><p>Over 25 years of experience</p></div></li><li class="w-full md:w-1/3 pb-12 px-8"><div class="w-auto h-12"><div class="flex justify-center"><img img-lazy="" width="48" height="48" class="w-auto h-12 image-lazy-loaded" alt="White wheel icon" src="https://dec-mkt.imgix.net/wheel-img.png?v=1581640598&amp;auto=format,compress"></div><!----></div><div class="wysiwyg why-us-styles"><p>Over 3 million drivers trained</p></div></li><li class="w-full md:w-1/3 pb-12 px-8"><div class="w-auto h-12"><div class="flex justify-center"><img img-lazy="" width="48" height="48" class="w-auto h-12 image-lazy-loaded" alt="White DSAA logo icon" src="https://dec-mkt.imgix.net/dsaa-inverse.png?v=1581640581&amp;auto=format,compress"></div><!----></div><div class="wysiwyg why-us-styles"><p>Accredited by the Driving School Association of the Americas (DSAA)</p></div></li><li class="w-full md:w-1/3 pb-12 px-8"><div class="w-auto h-12"><div class="flex justify-center"><img img-lazy="" width="48" height="48" class="w-auto h-12 image-lazy-loaded" alt="White graduation cap icon" src="https://dec-mkt.imgix.net/font-awesome_4-7-0_graduation-cap_256_0_ffffff_none.png?v=1595523536&amp;auto=format,compress"></div><!----></div><div class="wysiwyg why-us-styles"><p>DriversEd.com is the #1 driving school in the US with 100+ state-approved courses across the nation</p></div></li><li class="w-full md:w-1/3 pb-12 px-8"><div class="w-auto h-12"><div class="flex justify-center"><img img-lazy="" width="48" height="48" class="w-auto h-12 image-lazy-loaded" alt="White laptop icon" src="https://dec-mkt.imgix.net/font-awesome_4-7-0_laptop_256_0_ffffff_none.png?v=1595523545&amp;auto=format,compress"></div><!----></div><div class="wysiwyg why-us-styles"><p>All-in-one source: online course, in-car driving lessons, traffic school programs, and more</p></div></li><li class="w-full md:w-1/3 pb-12 px-8"><div class="w-auto h-12"><div class="flex justify-center"><img img-lazy="" width="48" height="48" class="w-auto h-12 image-lazy-loaded" alt="White checkmark icon" src="https://dec-mkt.imgix.net/font-awesome_4-7-0_check-circle_256_0_ffffff_none.png?v=1595523547&amp;auto=format,compress"></div><!----></div><div class="wysiwyg why-us-styles"><p>Training for teens and adults of all skill levels</p></div></li><!----></ul></div>







    <!-- Testimonial Start -->
    <div class="container-xxl py-6">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <h6 class="text-primary text-uppercase mb-2">Testimonial</h6>
                <h1 class="display-6 mb-4">What Our Clients Say!</h1>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="owl-carousel testimonial-carousel">
                        <div class="testimonial-item text-center">
                            <div class="position-relative mb-5">
                                <img class="img-fluid rounded-circle mx-auto" src="img/testimonial-1.jpg" alt="">
                                <div class="position-absolute top-100 start-50 translate-middle d-flex align-items-center justify-content-center bg-white rounded-circle" style="width: 60px; height: 60px;">
                                    <i class="fa fa-quote-left fa-2x text-primary"></i>
                                </div>
                            </div>
                            <p class="fs-4">Dolores sed duo clita tempor justo dolor et stet lorem kasd labore dolore lorem ipsum. At lorem lorem magna ut et, nonumy et labore et tempor diam tempor erat.</p>
                            <hr class="w-25 mx-auto">
                            <h5>Client Name</h5>
                            <span>Profession</span>
                        </div>
                        <div class="testimonial-item text-center">
                            <div class="position-relative mb-5">
                                <img class="img-fluid rounded-circle mx-auto" src="img/testimonial-2.jpg" alt="">
                                <div class="position-absolute top-100 start-50 translate-middle d-flex align-items-center justify-content-center bg-white rounded-circle" style="width: 60px; height: 60px;">
                                    <i class="fa fa-quote-left fa-2x text-primary"></i>
                                </div>
                            </div>
                            <p class="fs-4">Dolores sed duo clita tempor justo dolor et stet lorem kasd labore dolore lorem ipsum. At lorem lorem magna ut et, nonumy et labore et tempor diam tempor erat.</p>
                            <hr class="w-25 mx-auto">
                            <h5>Client Name</h5>
                            <span>Profession</span>
                        </div>
                        <div class="testimonial-item text-center">
                            <div class="position-relative mb-5">
                                <img class="img-fluid rounded-circle mx-auto" src="img/testimonial-3.jpg" alt="">
                                <div class="position-absolute top-100 start-50 translate-middle d-flex align-items-center justify-content-center bg-white rounded-circle" style="width: 60px; height: 60px;">
                                    <i class="fa fa-quote-left fa-2x text-primary"></i>
                                </div>
                            </div>
                            <p class="fs-4">Dolores sed duo clita tempor justo dolor et stet lorem kasd labore dolore lorem ipsum. At lorem lorem magna ut et, nonumy et labore et tempor diam tempor erat.</p>
                            <hr class="w-25 mx-auto">
                            <h5>Client Name</h5>
                            <span>Profession</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->


@endsection

@section('footer')
    <!-- Your footer content goes here -->
@endsection
