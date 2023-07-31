@extends('crmpages.layouts.app')

@section('title','CRM Login')
@section('content')
<main id="main">
    <!-- ======= Login Section ======= -->
    <section id="contact" class="contact" style="margin-top: 150px;">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                @if(Session::get('data') == 'error')
                    @if(Session::get('count') > 2)
                    <h2>Fuck you <span style="color: red;">{{ Session::get('name') }} !</span></h2>
                    <h2>Your're not our member</h2>
                    @elseif(Session::get('count') == 2)
                    <h2>Don't mess with me!, this is your last chance</h2>
                    <h2>Tell me, who are you?!</h2>
                    @else
                    <h2>Your're not our member, go fuck your self!</h2>
                    <h2>Tell me, who are you?!</h2>
                    @endif
                @else
                <h2>Who are you?</h2>
                @endif
            </div>


            <div class="row justify-content-center mt-1">
                <div class="col-lg-8 mt-5 mt-lg-0">
                    <form action="{{ route('activity.login') }}" method="post" class="form-style">
                        @csrf
                        <div class="form-group mt-3">
                            <input type="text" class="form-control text-center" name="name" id="name"
                                placeholder="Type your name..." required autofocus autocomplete="off" {{ Session::get('count') > 2 ? 'disabled' : '' }}>
                        </div>
                        <input type="hidden" value="{{ Session::get('count') }}" name="count">
                        <div class="text-center">
                            @if(Session::get('count') > 2)
                            <a href="{{ route('crm.landing') }}" class="mt-1" style="
                                background: #0563bb;
                                border: 0;
                                padding: 10px 35px;
                                color: #fff;
                                transition: 0.4s;
                                border-radius: 50px;
                                display: inline-block;
                            ">
                                Go Fuck Your Self!
                            </a>
                            @else
                            <button type="submit">
                                Verify
                            </button>
                            @endif
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section><!-- End Login Section -->
</main>
@endsection
