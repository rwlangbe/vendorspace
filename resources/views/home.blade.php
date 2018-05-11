@extends('templates.default')
@section('content')
    <div class="main">    
        <div class="top_border">
            <h2 class="jumbo__header">
                VendorSpace
            </h2>
            <h3 class="jumbo__subheader">
                Vendors, Entertainers, Event Planners, and more.
            </h3>    
        </div>
        <div class="row col-lg-16">
            <div class="left column col-lg-8">
                <div class="viewport">
                    <a href="{{ route('guest.vendorarea') }}"><h4 class="center">Vendors</h4></a>
                    <hr>
                    <p>Connect with other vendors and find events.  Use our tool section to 
                        calculate travel cost.</p>
                </div>        
                <div class="viewport">
                    <a href="{{ route('guest.plannerarea') }}"><h4 class="center">Event Planners</h4></a>
                    <hr>
                    <p>Compare site costs and ammenities.  Sign up food and merchandise vendors
                        See attendance estimates and get weather reports in one place.</p>
                </div>
                <div class="viewport">
                    <a href="{{ route('guest.entertainerarea') }}"><h4 class="center">Entertainers</h4></a>
                    <hr>
                    <p>Create a profile page and list your talents.  </p>
                </div>
            </div>
        	<div class="middle column col-lg-8">
                <div>
                    <ul>
                        <h3>Create a profile to showcase your talents.</h3>
                        <h3>Create an event and sign up vendors in one place.</h3>
                        <h3>Find events and connect with other performers.</h3>
                    </ul>
                </div>
            </div>
        </div>    
    </div>
    <div class="border"></div>
    <video class="video_background"  autoplay muted loop >  
        <source src="{{ URL::asset('video\rain.mp4') }}" type="video/mp4">
    </video> 
@stop