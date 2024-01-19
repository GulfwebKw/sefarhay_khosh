@extends('layouts.guest')
@section('content')
    <!--Contact Details Start-->
    <section id="contact" class="contact-details" style="margin-top: 230px;">
        <div class="container ">
            <div class="row">
                <div class="col-xl-6 col-lg-6">
                    <div class="contact-details__right">
                        <div class="sec-title">
                            <h2>{{ __('about_us') }}</h2>
                            <br/>
                            {!! \HackerESQ\Settings\Facades\Settings::get('about_us_'.app()->getLocale()) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Contact Details End-->

@endsection
