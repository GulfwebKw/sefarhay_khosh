<div>
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

                            <p>&nbsp;</p>

                            <form  name="contact_form" class="" action="#" method="post">

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <input name="form_name" class="form-control" type="text" placeholder="{{ __('full_name') }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <input name="form_email" class="form-control required email" type="email" placeholder="{{ __('email') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <input name="form_phone" class="form-control" type="text" placeholder="{{ __('telephone') }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <select class="form-control required">
                                                <option>{{ __('country') }}</option>
                                                @foreach($countries as $country)
                                                    <option value="{{ $country['id'] }}">{{ $country['title'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <input type="file" class="custom-file-input" id="customFileLang" lang="es" style="display: none;">
                                            <label class="form-control line30x" for="customFileLang">{{ __('passport') }} <i class="fa-light fa-paperclip fa-lg attachment"></i>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <input type="file" class="custom-file-input" id="customFileLang" lang="es" style="display: none;">
                                            <label class="form-control line30x" for="customFileLang">{{ __('face_id') }}	<i class="fa-light fa-paperclip fa-lg attachment"></i>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <input type="file" class="custom-file-input" id="customFileLang" lang="es" style="display: none;">
                                            <label class="form-control line30x" for="customFileLang">{{ __('national_scan') }} <i class="fa-light fa-paperclip fa-lg attachment"></i>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <input type="file" class="custom-file-input" id="customFileLang" lang="es" style="display: none;">
                                            <label class="form-control line30x" for="customFileLang">{{ __('national2_scan') }} <i class="fa-light fa-paperclip fa-lg attachment"></i></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    @foreach($packages as $package)
                                        <div class="col-sm-4">
                                            <div class="mb-3">
                                                <label for="P{{ $package['id'] }}" style="width: 100%;">
                                                <div class="visa_bg">
                                                    <input type="radio" id="P{{ $package['id'] }}" name="fav_language" value="{{ $package['id'] }}"> &nbsp;&nbsp;
                                                    {{ $package['title'] }}
                                                    <h4 class="txt_white">{{ number_format($package['price']) }} {{__('Dinar')}}</h4>
                                                </div>
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="mb-3 text-center">
                                    <input type="radio" id="html3" name="fav_language" value="">&nbsp;&nbsp;<img src="{{ asset('images/icons/creditcard.png') }}" alt="creditcard">
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="radio" id="html3" name="fav_language" value="">&nbsp;&nbsp;<img src="{{ asset('images/icons/knet.png') }}" alt="knet">
                                </div>

                                <div class="mb-3 text-center">
                                    <button type="submit" class="theme-btn btn-style-one" data-loading-text="Please wait..." style="margin-top: 20px;"><span class="btn-title">{{ __('submit_and_pay') }} </span></button>
                                </div>
                            </form>
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
</div>
