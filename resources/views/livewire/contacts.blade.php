<div>
    <!--Contact Details Start-->
    <section id="contact" class="contact-details" style="margin-top: 230px;">
        <div class="container ">
            <div class="row">
                <div class="col-xl-6 col-lg-6">
                    <div class="sec-title">
                        <span class="sub-title">{{ __('Send_Email') }}</span>
                        <h2>{{ __('Send_Email2') }}</h2>
                    </div>
                    <!-- Contact Form -->
                    <div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <input dir="auto" name="name" wire:model.lazy="form.name" class="form-control @error('form.name') is-invalid @enderror" type="text" placeholder="{{ __('full_name') }}">
                                    @error('form.name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <input dir="ltr" name="email" wire:model.lazy="form.email" class="form-control @error('form.email') is-invalid @enderror required email" type="email" placeholder="{{ __('email') }}">
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
                                    <input dir="auto" name="subject" wire:model.lazy="form.subject" class="form-control @error('form.subject') is-invalid @enderror required" type="text" placeholder="{{ __('subject') }}">
                                    @error('form.subject')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <input dir="ltr" name="phone" wire:model.lazy="form.phone" class="form-control @error('form.phone') is-invalid @enderror" type="text" placeholder="{{ __('telephone') }}">
                                    @error('form.phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <textarea dir="auto" name="message" wire:model.lazy="form.message" class="form-control @error('form.message') is-invalid @enderror required" rows="7" placeholder="{{ __('message') }}"></textarea>
                            @error('form.message')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        @if($messageAlert)
                            <div class="mb-3">
                                <div class="alert alert-success">
                                    {{ $messageAlert }}
                                </div>
                            </div>
                        @endif
                        <div class="mb-3">
                            <input name="form_botcheck" class="form-control" type="hidden" value="" />
                            <button type="button" wire:loading.attr="disabled"
                                    wire:click.prevent="save" class="theme-btn btn-style-one" data-loading-text="Please wait..." style="margin-left: 20px;margin-right: 20px;">
                                <span class="btn-title">{{ __('send_message') }}</span></button>
                            <button type="button" wire:loading.attr="disabled"
                                    wire:click.prevent="resetForm"  class="theme-btn btn-style-one bg-theme-color5"><span class="btn-title">{{ __('reset') }}</span></button>
                        </div>
                    </div>
                    <!-- Contact Form Validation-->
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="contact-details__right">
                        <div class="sec-title">
                            <span class="sub-title">{{ __('need_help') }}</span>
                            <h2>{{ __('contact_us') }}</h2>
                        </div>
                        <ul class="list-unstyled contact-details__info">
                            <li>
                                <div class="icon bg-theme-color2">
                                    <span class="lnr-icon-phone-plus"></span>
                                </div>
                                <div class="text">
                                    <h6>{{ __('telephone') }}</h6>
                                    <a dir="ltr" href="tel:{{ str_replace(' ' ,'' , \HackerESQ\Settings\Facades\Settings::get('telephone')) }}">
                                        {{ \HackerESQ\Settings\Facades\Settings::get('telephone') }}</a>
                                </div>
                            </li>
                            <li>
                                <div class="icon">
                                    <span class="lnr-icon-envelope1"></span>
                                </div>
                                <div class="text">
                                    <h6>{{ __('email') }}</h6>
                                    <a href="mailto:{{ \HackerESQ\Settings\Facades\Settings::get('email') }}">{{ \HackerESQ\Settings\Facades\Settings::get('email') }}</a>
                                </div>
                            </li>
                            <li>
                                <div class="icon">
                                    <span class="lnr-icon-location"></span>
                                </div>
                                <div class="text">
                                    <h6>{{ __('address') }}</h6>
                                    <span>{{ \HackerESQ\Settings\Facades\Settings::get('address_'.app()->getLocale()) }}</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Contact Details End-->
</div>
