@extends('master') {{-- اگر master layout داری --}}

@section('content')
    <div class="no-bottom no-top" id="content">
        <div id="top"></div>
        <section class="v-center jarallax">
            <img src="images/background/2.webp" class="jarallax-img" alt="">
            <div class="container z-1000">
                <div class="row align-items-center">
                    <div class="col-lg-4 offset-lg-4">
                        <div class="padding40 rounded-10 shadow-soft bg-dark-1">
                            <div class="text-center">
                                <h4>به حساب خود وارد شوید</h4>
                            </div>
                            <div class="spacer-10"></div>

                            <!-- نمایش خطاهای عمومی -->
                            @if ($errors->any())
                                <div class="alert alert-danger text-right">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('login.submit') }}" class="form-border">
                                @csrf

                                <div class="field-set">
                                    <label>نام کاربری یا ایمیل</label>
                                    <input type='text' name='login' id='name' value="{{ old('login') }}"
                                        class="form-control" required>
                                </div>

                                <div class="field-set">
                                    <label>رمزعبور</label>
                                    <input type='password' name='password' id='password' class="form-control" required>
                                </div>

                                <div class="field-set d-flex align-items-center">
                                    <input type="checkbox" id="remember" name="remember">
                                    <label for="remember"><span class="op-5">مرا به خاطر بسپار</span></label>
                                </div>

                                <div class="spacer-20"></div>

                                <div id="submit">
                                    <input type="submit" value="ورود" class="btn-main btn-fullwidth rounded-3" />
                                </div>
                            </form>

                            <div class="title-line mt-3">یا&nbsp;ورود&nbsp;از&nbsp;طریق</div>
                            <div class="row g-2">
                                <div class="col-lg-6">
                                    <a class="btn-sc btn-fullwidth mb10" href="#"><img
                                            src="images/svg/google_icon.svg" alt="">گوگل</a>
                                </div>
                                <div class="col-lg-6">
                                    <a class="btn-sc btn-fullwidth mb10" href="#"><img
                                            src="images/svg/facebook_icon.svg" alt="">فیسبوک</a>
                                </div>
                            </div>

                            <div class="mt-3 text-center">
                                <a href="{{ route('register') }}">حساب کاربری ندارید؟ ثبت نام کنید</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
