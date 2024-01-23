@extends('layouts.guest')
@section('content')
    <!-- FAQ Section -->
    <section class="faqs-section pull-up" id="about">
        <div class="bg bg-pattern-9"></div>
        <div class="auto-container">
            <div class="row">
                <!-- Image Column -->
                <div class="image-column col-lg-4 col-md-12 col-sm-12">
                    <div class="image-box">
                        <figure class="image-1"><img src="{{ asset(app()->getLocale() == 'fa' ? 'images/resource/uae.png' : 'images/resource/image-3.png') }}" alt=""></figure>
                        <!-- <figure class="image-2">&nbsp;</figure> -->
                        <figure class="plane-icon"><img src="{{ asset( 'images/resource/plane-2.png') }}" alt=""></figure>
                    </div>
                </div>

                <!-- FAQ Column -->
                <div class="faq-column col-lg-8 col-md-12 col-sm-12">
                    <div class="inner-column">
                        <div class="sec-title">
                            <span class="sub-title">{{ __('about') }} {{ \HackerESQ\Settings\Facades\Settings::get('site_title_'.app()->getLocale(), 'Site title') }}</span>
                            <h2><span class="color3">{{ __('sub_title') }}</span> {{ __('sub_title_black') }}</h2>
                            <div class="text">{{ \HackerESQ\Settings\Facades\Settings::get('sub_title_'.app()->getLocale(), 'Site title') }}</div>
                            <div class="mt-3">

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <input dir="auto" value="{{ $application->status['title_'.app()->getLocale()] }}" readonly class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <input dir="auto" value="{{ $application->paid_at }}" readonly class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <input dir="auto" value="{{ $application->name }}" readonly class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <input dir="auto" value="{{ $application->phone }}" readonly class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <input dir="auto" value="{{ $application->email }}" readonly class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <input dir="auto" value="{{ $application->country['title_'.app()->getLocale()] }}" readonly class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <img src="{{ asset('storage/'.$application->passport) }}"  style="width: 100%; border-radius: 15px;">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <img src="{{ asset('storage/'.$application->face) }}" style="width: 100%; border-radius: 15px;">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <img src="{{ asset('storage/'.$application->national_id) }}" style="width: 100%; border-radius: 15px;">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <img src="{{ asset('storage/'.$application->national_id2) }}" style="width: 100%; border-radius: 15px;">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label for="P{{ $application->package->id }}" style="width: 100%;">
                                                <div class="visa_bg" style="background: url({{ asset('/storage/'. $application->package->background_image ) }}) no-repeat !important;">
                                                    {{ $application->package['title_'.app()->getLocale()] }}
                                                    <h4 class="txt_white">{{ number_format($application->package->price) }} {{__('Dinar')}}</h4>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                @if( ! $application->paid)
                                    @if($msg)
                                        <div class="mb-3">
                                            <div class="alert alert-danger">
                                                {{ $msg }}
                                            </div>
                                        </div>
                                    @endif
                                    <div class="mb-3 text-center">
                                        <a href="{{ route('application.pay' , [ 'uuid' => $application->uuid , 'gateway'=> 'myfatourah']) }}"><img src="{{ asset('images/icons/creditcard.png') }}" alt="creditcard"></a>
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                        <a href="{{ route('application.pay' , [ 'uuid' => $application->uuid , 'gateway'=> 'knet']) }}"><img src="{{ asset('images/icons/knet.png') }}" alt="knet"></a>
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End FAQ Section -->

    <!--Contact Details Start-->
    <section id="contact" class="contact-details">
        <div class="container ">
            <div class="row">
                <div class="col-xl-8 col-lg-8">
                    <div class="contact-details__right">
                        <div class="sec-title">
                            <h2>{{ __('step_get_visa') }}</h2>
                        </div>
                        <ul class="list-unstyled contact-details__info">
                            @foreach($statuses as $status)
                                <li>
                                    <div class="icon bg-theme-color2">
                                        <i class="fa-light {{ $status['icon'] }} fa-2x" style="color: #fff;"></i>
                                    </div>
                                    <div class="text">
                                        <h6>{{ $status['title'] }}</h6>
                                        {{ $status['description'] }}
                                    </div>
                                </li>
                            @endforeach
                        </ul>

                        <div class="mt-40 note">
                            <h6>{{ __('time_get_visa') }}:</h6>
                            <ul>
                                <li>پروسه صدور ویزا بصورت عادی 1 تا 3روز کاری زمان میبرد. ولی چنانچه برای بررسی بیشتر روند ممکن است ۷ تا ۱۰ روز کاری زمان می‌برد.</li>
                                <li>مبنای محاسبه، یک روز پس از ارائه و ارسال مدارک است (بدون احتساب تعطیلات رسمی کشور و تعطیلات سفارت)</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Contact Details End-->
@endsection

