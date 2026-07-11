@extends('layouts.app')

@section('content')

    <div id='portfolioCarousel' class='carousel slide' data-bs-ride='carousel'>
        <div class='carousel-indicators'>
            <button data-bs-target='#portfolioCarousel' data-bs-slide-to='0' class='active'></button>
            <button data-bs-target='#portfolioCarousel' data-bs-slide-to='1'></button>
            <button data-bs-target='#portfolioCarousel' data-bs-slide-to='2'></button>
        </div>
        <div class='carousel-inner'>
            <div class='carousel-item active'>
                <img src='img/slide1.jpg' class='d-block w-100' style='height:500px;object-fit:cover'>
                <div class='carousel-caption d-none d-md-block'>
                    <h2>Fresh & Delicious</h2>
                    <p>Order from 50+ restaurants in Lahore</p>
                </div>
            </div>
            </div>
        <button class='carousel-control-prev' data-bs-target='#portfolioCarousel' data-bs-slide='prev'>
            <span class='carousel-control-prev-icon'></span>
        </button>
        <button class='carousel-control-next' data-bs-target='#portfolioCarousel' data-bs-slide='next'>
            <span class='carousel-control-next-icon'></span>
        </button>
    </div>

    <div class="container py-5 text-center">
        <h1 class="display-4 fw-bold">Welcome to FoodExpress</h1>
        <p class="lead mb-4">Quality food delivered to your door.</p>
        
        <button type="button" class="btn btn-danger btn-lg shadow" data-bs-toggle="modal" data-bs-target="#contactModal">
            Contact Us
        </button>
    </div>

    <div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="contactModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="contactModalLabel">Contact Us</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-start">
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Your Name</label>
                            <input type="text" class="form-control" placeholder="Enter name">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" placeholder="Enter email">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Message</label>
                            <textarea class="form-control" rows="3" placeholder="How can we help?"></textarea>
                        </div>
                        <button type="submit" class="btn btn-danger w-100">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection