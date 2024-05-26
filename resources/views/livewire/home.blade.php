<div>
    <style>
        /* webkit solution */
        ::-webkit-input-placeholder { text-align:{{ app()->getLocale() == "fa" ? 'right' :'left' }}; }
        /* mozilla solution */
        input:-moz-placeholder { text-align: {{ app()->getLocale() == "fa" ? 'right' :'left' }}; }
    </style>
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

                            <div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <input dir="auto" wire:model.lazy="form.name" class="form-control @error('form.name') is-invalid @enderror" type="text" placeholder="{{ __('full_name') }}">
                                            @error('form.name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <input dir="auto" wire:model.lazy="form.email" class="form-control required email @error('form.email') is-invalid @enderror" type="email" placeholder="{{ __('email') }}">
                                            @error('form.email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <input dir="auto" wire:model.lazy="form.phone" class="form-control @error('form.phone') is-invalid @enderror" type="text" placeholder="{{ __('telephone') }}">
                                            @error('form.phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <select dir="auto" wire:model.lazy="form.country_id" class="form-control required @error('form.country_id') is-invalid @enderror">
                                                <option>{{ __('country') }}</option>
                                                @foreach($countries as $country)
                                                    <option value="{{ $country['id'] }}">{{ $country['title'] }}</option>
                                                @endforeach
                                            </select>
                                            @error('form.country_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <input wire:model.lazy="passport" type="file" class="custom-file-input" id="passport" lang="es" onchange="$(this).parent().find('label').html( $(this)[0].files[0].name + ' <i class=\'fa-light fa-paperclip fa-lg attachment\'></i>');" style="display: none;">
                                            <label class="form-control line30x @error('passport') is-invalid @enderror" for="passport">{{ optional($passport)->getClientOriginalName() ?? __('passport') }} <i class="fa-light fa-paperclip fa-lg attachment"></i>
                                            </label>
                                            @error('passport')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <input wire:model.lazy="face" type="file" class="custom-file-input" id="face" lang="es" onchange="$(this).parent().find('label').html( $(this)[0].files[0].name + ' <i class=\'fa-light fa-paperclip fa-lg attachment\'></i>');" style="display: none;">
                                            <label class="form-control line30x @error('face') is-invalid @enderror" for="face">{{ optional($face)->getClientOriginalName() ?? __('face_id') }}	<i class="fa-light fa-paperclip fa-lg attachment"></i>
                                            </label>
                                            @error('face')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <input wire:model.lazy="national_id" type="file" class="custom-file-input" id="national_id" lang="es" onchange="$(this).parent().find('label').html( $(this)[0].files[0].name + ' <i class=\'fa-light fa-paperclip fa-lg attachment\'></i>');" style="display: none;">
                                            <label class="form-control line30x @error('national_id') is-invalid @enderror" for="national_id">{{ optional($national_id)->getClientOriginalName() ?? __('national_scan') }} <i class="fa-light fa-paperclip fa-lg attachment"></i>
                                            </label>
                                            @error('national_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <input wire:model.lazy="national_id2" onchange="$(this).parent().find('label').html( $(this)[0].files[0].name + ' <i class=\'fa-light fa-paperclip fa-lg attachment\'></i>');" type="file" class="custom-file-input" id="national_id2" lang="es" style="display: none;">
                                            <label class="form-control line30x @error('national_id2') is-invalid @enderror" for="national_id2">{{ optional($national_id2)->getClientOriginalName() ?? __('national2_scan') }} <i class="fa-light fa-paperclip fa-lg attachment"></i></label>
                                            @error('national_id2')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    @foreach($packages as $package)
                                        <div class="col-sm-4">
                                            <div class="mb-3">
                                                <label for="P{{ $package['id'] }}" style="width: 100%;">
                                                <div class="visa_bg" style="background: url({{ asset('/storage/'. $package['background_image']) }}) no-repeat !important;">
                                                    <input wire:model.lazy="form.package_id" type="radio" id="P{{ $package['id'] }}" name="fav_language" value="{{ $package['id'] }}"> &nbsp;&nbsp;
                                                    {{ $package['title'] }}
                                                    <h4 class="txt_white">{{ number_format($package['price']) }} {{__('Dinar')}}</h4>
                                                </div>
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                @error('form.package_id')
                                <div class="row">
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                </div>
                                @enderror

                                <div class="mb-3 text-center">
                                    <input type="radio" id="html3" wire:model.lazy="form.gateway" value="myfatourah">&nbsp;&nbsp;<img src="{{ asset('images/icons/creditcard.png') }}" alt="creditcard">
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    {{-- <input type="radio" id="html3" wire:model.lazy="form.gateway" value="knet">&nbsp;&nbsp; --}} <img src="{{ asset('images/icons/knet.png') }}" alt="knet">
                                </div>
                                @error('form.gateway')
                                <div class="mb-3 text-center">
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                </div>
                                @enderror

                                @if($messageAlert)
                                    <div class="mb-3">
                                        <div class="alert alert-danger">
                                            {{ $messageAlert }}
                                        </div>
                                    </div>
                                @endif

                                <div class="mb-3 text-center">
                                    <button type="submit"  wire:loading.attr="disabled"
                                            wire:click.prevent="save" class="theme-btn btn-style-one" data-loading-text="Please wait..." style="margin-top: 20px;"><span class="btn-title">{{ __('submit_and_pay') }} </span></button>
                                </div>
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
                                <li>{{ __('first_time_line') }}</li>
                                <li>{{ __('second_time_line') }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Contact Details End-->
</div>
