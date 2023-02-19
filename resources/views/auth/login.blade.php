@extends('layouts.public')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center vh-100">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center fw-bolder text-main" :class="localStorage.theme == 'dark' ? 'dark-card' : ''">
                    ادخل معلوماتك للوصول للوحة التحكم
                </div>
                <div class="card-body" :class="localStorage.theme == 'dark' ? 'dark-card' : ''">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label">
                                البريد الالكتروني
                            </label>

                            <div class="col-md-8">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label">
                                كلمة المرور
                            </label>

                            <div class="col-md-8">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row justify-content-center align-items-center text-center mt-3">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-success px-5">
                                        تسجيل الدخول
                                    </button>
                                    <a href="{{route('home')}}" class="btn btn-primary px-5">
                                        الرئيسية
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection