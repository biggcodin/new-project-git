@extends('master')



@section('content')
    <!-- content begin -->
    <div class="no-bottom no-top" id="content">
        <div id="top"></div>

        <section class="v-center jarallax">
            <div class="de-gradient-edge-top"></div>
            <div class="de-gradient-edge-bottom"></div>
            <img src="images/background/5.webp" class="jarallax-img" alt="">
            <div class="container z-1000">
                <div class="row align-items-center">
                    <div class="col-lg-8 offset-lg-2">
                        <div class="p-5 rounded-10 shadow-soft bg-dark-1">
                            <form name="contactForm" id='contact_form' class="form-border" method="post"
                                action="{{ route('register.submit') }}">
                                @csrf
                                <h4>حساب کاربری ندارید؟ همین الان ثبت نام کنید.</h4>
                                <p>به پلی هاست خوش آمدید. ما از اینکه شما را در اینجا داریم هیجان زده ایم. با ایجاد
                                    یک حساب کاربری در سایت ما، به طیف وسیعی از مزایا و ویژگی‌های راحت دسترسی خواهید
                                    داشت که تجربه اجاره اتومبیل شما را افزایش می‌دهد.</p>
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="field-set">
                                            <label>نام:</label>
                                            <input type='text' name='name' id='name'
                                                class="form-control @error('name') is-invalid @enderror"
                                                value="{{ old('name') }}">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="field-set">
                                            <label>ایمیل:</label>
                                            <input type='text' name='email' id='email'
                                                class="form-control @error('email') is-invalid @enderror"
                                                value="{{ old('email') }}">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="field-set">
                                            <label>نام کاربری:</label>
                                            <input type='text' name='username' id='username'
                                                class="form-control @error('username') is-invalid @enderror"
                                                value="{{ old('username') }}">
                                            @error('username')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="field-set">
                                            <label>تلفن:</label>
                                            <input type='text' name='phone' id='phone'
                                                class="form-control @error('phone') is-invalid @enderror"
                                                value="{{ old('phone') }}">
                                            @error('phone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="field-set">
                                            <label>رمزعبور:</label>
                                            <input type='password' name='password' id='password'
                                                class="form-control @error('password') is-invalid @enderror">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="field-set">
                                            <label>تکرار رمزعبور:</label>
                                            <input id="password-confirm" type="password" name="password_confirmation"
                                                class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 offset-lg-3 text-center">
                                        <div id='submit'>
                                            <input type='submit' id='send_message' value='همین الان ثبت نام کنید'
                                                class="btn-main color-2">
                                        </div>
                                    </div>

                                    @if (session('success'))
                                        <div class="col-md-12">
                                            <div class="alert alert-success">
                                                {{ session('success') }}
                                            </div>
                                        </div>
                                    @endif

                                    @if ($errors->any())
                                        <div class="col-md-12">
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="col-lg-6 offset-lg-3">
                                        <div class="title-line">یا&nbsp;ثبتنام&nbsp;از&nbsp;طریق</div>
                                        <div class="row g-2">
                                            <div class="col-lg-6">
                                                <a class="btn-sc btn-fullwidth mb10" href="#"><img
                                                        src="{{ asset('images/svg/google_icon.svg') }}"
                                                        alt="">گوگل</a>
                                            </div>
                                            <div class="col-lg-6">
                                                <a class="btn-sc btn-fullwidth mb10" href="#"><img
                                                        src="{{ asset('images/svg/facebook_icon.svg') }}"
                                                        alt="">فیسبوک</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>



    </div>
    <!-- content close -->

    </div>
@endsection
