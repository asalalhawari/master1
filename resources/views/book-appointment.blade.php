@extends('public.masterpage')

@section('content')

<div class="slider-area2">
    <div class="slider-height2 d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="text-center hero-cap hero-cap2 pt-70">
                        <h2>Booking</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container15">
    <h2>Appointment Details</h2>
    <form action="{{ route('book-appointment-store') }}" method="POST" class="booking-form">
        @csrf
        <div class="input-field">
            <label for="name">Your Name</label>
            <input type="text" id="name" name="name" required placeholder="Enter your full name">
        </div>

        <div class="input-field">
            <label for="email">Your Email</label>
            <input type="email" id="email" name="email" required placeholder="Enter your email">
        </div>

        <div class="input-field">
            <label for="phone">Phone Number</label>
            <input type="text" id="phone" name="phone" required placeholder="Enter your phone number">
        </div>

        <div class="input-field">
            <label for="service">Select Service</label>
            <select id="service" name="service_id" required>
                @foreach ($services as $service )
                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="input-field">
            <label for="date">Preferred Date</label>
            <input type="date" id="date" name="date" required>
        </div>

        <div class="input-field">
            <label for="time">Preferred Time</label>
            <input type="time" id="time" name="time" required>
        </div>

        <button type="submit" class="button">Book Appointment</button>
    </form>
</div>

@endsection
