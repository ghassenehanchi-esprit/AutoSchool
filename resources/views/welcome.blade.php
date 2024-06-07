@extends('layouts.app')
@section('header')
    <!-- Your header content goes here -->
@endsection

@section('content')
    <!-- Carousel Start -->
    <div class="container-fluid p-0 wow fadeIn" data-wow-delay="0.1s">
        <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="img/carousel-1.jpg" alt="Image">
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-7">
                                    <h2 class="display-2 text-light mb-5 animated slideInDown" style="font-size: 40px">The Most Effective Online Driving Lessons</h2>

                                        <div class="dropdown">
                                            <button class="btn btn-light dropdown-toggle py-sm-3 px-sm-5 ms-3" type="button" id="stateDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                                Select State
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="stateDropdown" style="max-height: 200px; overflow-y: auto;">
                                                <!-- Add list items for each state -->
                                                @foreach ($states as $state)
                                                    <li><a class="dropdown-item" data-state-id="{{ $state->id }}">{{ $state->name }}</a></li>
                                                @endforeach
                                            </ul>
                                        </div>

                                        <div class="dropdown">
                                            <button class="btn btn-light dropdown-toggle py-sm-3 px-sm-5 ms-3" type="button" id="packageDropdown" data-bs-toggle="dropdown" aria-expanded="false" disabled>
                                                Select Package
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="packageDropdown">
                                                <!-- Add list items for each package -->
                                                <li><a class="dropdown-item" data-package-type="teen" data-state-id="">Teen Package</a></li>
                                                <li><a class="dropdown-item" data-package-type="adult" data-state-id="">Adult Package</a></li>
                                                <li><a class="dropdown-item" data-package-type="defensive" data-state-id="">Defensive Permit Test</a></li>
                                                <!-- Add other packages here -->
                                            </ul>
                                        </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel"
                    data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#header-carousel"
                    data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <!-- Carousel End -->




    <!-- About Start -->
    <div class="container-xxl py-6">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="position-relative overflow-hidden ps-5 pt-5 h-100" style="min-height: 400px;">
                        <img class="position-absolute w-100 h-100" src="img/about-1.jpg" alt="" style="object-fit: cover;">
                        <img class="position-absolute top-0 start-0 bg-white pe-3 pb-3" src="img/about-2.jpg" alt="" style="width: 200px; height: 200px;">
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


    <!-- Courses Start -->
    <div class="container-xxl courses my-6 py-6 pb-0">
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
                                <img class="img-fluid" src="img/courses-{{ $loop->index + 1 }}.jpg" alt="">
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


    <!-- Features Start -->
    <div class="container-xxl py-6">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <h6 class="text-primary text-uppercase mb-2">Why Choose Us!</h6>
                    <h1 class="display-6 mb-4">Best Driving Training Agency In Your City</h1>
                    <p class="mb-5">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo justo magna dolore erat amet</p>
                    <div class="row gy-5 gx-4">
                        <div class="col-sm-6 wow fadeIn" data-wow-delay="0.1s">
                            <div class="d-flex align-items-center mb-3">
                                <div class="flex-shrink-0 btn-square bg-primary me-3">
                                    <i class="fa fa-check text-white"></i>
                                </div>
                                <h5 class="mb-0">Fully Licensed</h5>
                            </div>
                            <span>Magna sea eos sit dolor, ipsum amet ipsum lorem diam eos</span>
                        </div>
                        <div class="col-sm-6 wow fadeIn" data-wow-delay="0.2s">
                            <div class="d-flex align-items-center mb-3">
                                <div class="flex-shrink-0 btn-square bg-primary me-3">
                                    <i class="fa fa-check text-white"></i>
                                </div>
                                <h5 class="mb-0">Online Tracking</h5>
                            </div>
                            <span>Magna sea eos sit dolor, ipsum amet ipsum lorem diam eos</span>
                        </div>
                        <div class="col-sm-6 wow fadeIn" data-wow-delay="0.3s">
                            <div class="d-flex align-items-center mb-3">
                                <div class="flex-shrink-0 btn-square bg-primary me-3">
                                    <i class="fa fa-check text-white"></i>
                                </div>
                                <h5 class="mb-0">Afordable Fee</h5>
                            </div>
                            <span>Magna sea eos sit dolor, ipsum amet ipsum lorem diam eos</span>
                        </div>
                        <div class="col-sm-6 wow fadeIn" data-wow-delay="0.4s">
                            <div class="d-flex align-items-center mb-3">
                                <div class="flex-shrink-0 btn-square bg-primary me-3">
                                    <i class="fa fa-check text-white"></i>
                                </div>
                                <h5 class="mb-0">Best Trainers</h5>
                            </div>
                            <span>Magna sea eos sit dolor, ipsum amet ipsum lorem diam eos</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="position-relative overflow-hidden pe-5 pt-5 h-100" style="min-height: 400px;">
                        <img class="position-absolute w-100 h-100" src="img/about-1.jpg" alt="" style="object-fit: cover;">
                        <img class="position-absolute top-0 end-0 bg-white ps-3 pb-3" src="img/about-2.jpg" alt="" style="width: 200px; height: 200px">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Features End -->


    <!-- Team Start -->
    <div class="container-xxl py-6">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <h6 class="text-primary text-uppercase mb-2">Meet The Team</h6>
                <h1 class="display-6 mb-4">We Have Great Experience Of Driving</h1>
            </div>
            <div class="row g-0 team-items">
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="team-item position-relative">
                        <div class="position-relative">
                            <img class="img-fluid" src="img/team-1.jpg" alt="">
                            <div class="team-social text-center">
                                <a class="btn btn-square btn-outline-primary border-2 m-1" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square btn-outline-primary border-2 m-1" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-square btn-outline-primary border-2 m-1" href=""><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                        <div class="bg-light text-center p-4">
                            <h5 class="mt-2">Full Name</h5>
                            <span>Trainer</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="team-item position-relative">
                        <div class="position-relative">
                            <img class="img-fluid" src="img/team-2.jpg" alt="">
                            <div class="team-social text-center">
                                <a class="btn btn-square btn-outline-primary border-2 m-1" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square btn-outline-primary border-2 m-1" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-square btn-outline-primary border-2 m-1" href=""><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                        <div class="bg-light text-center p-4">
                            <h5 class="mt-2">Full Name</h5>
                            <span>Trainer</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="team-item position-relative">
                        <div class="position-relative">
                            <img class="img-fluid" src="img/team-3.jpg" alt="">
                            <div class="team-social text-center">
                                <a class="btn btn-square btn-outline-primary border-2 m-1" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square btn-outline-primary border-2 m-1" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-square btn-outline-primary border-2 m-1" href=""><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                        <div class="bg-light text-center p-4">
                            <h5 class="mt-2">Full Name</h5>
                            <span>Trainer</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="team-item position-relative">
                        <div class="position-relative">
                            <img class="img-fluid" src="img/team-4.jpg" alt="">
                            <div class="team-social text-center">
                                <a class="btn btn-square btn-outline-primary border-2 m-1" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square btn-outline-primary border-2 m-1" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-square btn-outline-primary border-2 m-1" href=""><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                        <div class="bg-light text-center p-4">
                            <h5 class="mt-2">Full Name</h5>
                            <span>Trainer</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Team End -->


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

    <!-- Add this line to include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            // When a state is selected
            $('#stateDropdown').parent().on('click', '.dropdown-item', function () {
                // Get the state name and ID from the clicked item
                const stateName = $(this).text();
                const stateId = $(this).data('state-id');

                // Update the state dropdown button text and store the state ID
                $('#stateDropdown').text(stateName).append(' <span class="caret"></span>');
                $('#stateDropdown').data('state-id', stateId);

                // Enable the package dropdown
                $('#packageDropdown').prop('disabled', false);
            });

            // When a package type is selected
            $('#packageDropdown').parent().on('click', '.dropdown-item', function () {
                // Get the package type from the clicked item
                const packageType = $(this).data('package-type');
                // Retrieve the stored state ID from the state dropdown button
                const stateId = $('#stateDropdown').data('state-id');

                // Construct the URL with the selected state ID and package type
                const url = `/${stateId}/${packageType}`;

                // Redirect to the constructed URL
                window.location.href = url;
            });
        });
    </script>


@endsection

@section('footer')
    <!-- Your footer content goes here -->
@endsection
