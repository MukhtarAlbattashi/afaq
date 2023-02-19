<div>
    <div class="container-fluid box greadient">
        <div class="row">
            <div class="col-md-12 p-3 text-white d-flex justify-content-center align-items-center">
                <div class="white-logo p-3">
                    <img src="{{asset('images/logo.png')}}" class="logo d-block">
                </div>
            </div>
            <div class="col-md-12 text-white text-center mb-3">
                <div>
                    <h1>
                        {{ config('app.name', 'الآفاق للبرمجة والتصميم') }}
                    </h1>
                </div>
            </div>
            <div class="col-md-12 mb-4">
                <header>
                    <nav class="navbar navbar-expand p-0 navbar-light">
                        <div class="container">
                            <div class="collapse navbar-collapse fw-bold justify-content-center" id="navbarNavDropdown">
                                <ul class="navbar-nav">
                                    <li class="nav-item">
                                        <a class="nav-link text-white" href="{{route('posts')}}">المقالات</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-white" href="{{route('programs')}}">البرامج</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-white" href="{{route('about')}}">حول</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </header>
            </div>
        </div>
    </div>
    <div class="container p-5">
        <div class="row justify-content-between align-items-center g-2 text-center">
            <div class="col-md-6 mb-3 side-border">
                <h1 class="text-center text-gredient fw-bold fs-3">
                    تطبيقات الهاتف الذكي
                </h1>
                <br>
                <h5>
                    نساعدك في تطوير عملك التجاري من خلال تطوير التطبيقات الذكية التي تتناسب مع هويتك التجارية. ونصمم
                    تطبيقك على مختلف أنظمة التشغيل المختلفة بكل مهنية واحتراف.
                </h5>
                <br>
                <a href="#" class="text-decoration-none badge light-green btn-sm btn-rounded text-white b-0">تواصل
                    معنا</a>
            </div>
            <div class="col-md-6">
                <img src="{{asset('images/landing.png')}}" class="brand-img" alt="">
            </div>
        </div>
    </div>
    <div class=" box-top greadient">
        <div class="container p-5">
            <div class="row justify-content-between align-items-center text-center text-white">
                <div class="col-md-6 side-border-left">
                    <h1 class="text-center fw-bold fs-3">
                        المواقع الالكترونية
                    </h1>
                    <br>
                    <h5>
                        تبحث عن موقع متميز يمثل شركتك التجارية ؟ نصمم لك موقع الكتروني بأحدث الأنظمة والتقنيات الحديثة
                        وبتصميم مميز حسب اختيارك
                    </h5>
                    <br>
                    <a href="#" class="text-decoration-none badge btn-white btn-sm btn-rounded text-dark b-0">تواصل
                        معنا</a>
                </div>
                <div class="col-md-6 order-first">
                    <img src="{{asset('images/comput.png')}}" class="computer-img" alt="">
                </div>
            </div>
        </div>
    </div>
    <div class="container-fuild p-5">
        <div class="row justify-content-between g-2 text-center">
            <div class="col-md-3">
                <h1 class="text-center text-gredient fw-bold fs-3">
                    من نحن ؟
                </h1>
                <br>
                <h6>
                    شركة متخصصة بمجال البرمجيات والتقنيات الحديثة في مجالي تطبيقات الهاتف النقال والمواقع الالكترونية.
                    ونصمم البرمجيات على مختلف أنظمة التشغيل بكل مهنية واحتراف.
                </h6>
            </div>
            <div class="col-md-3">
                <h1 class="text-center text-gredient fw-bold fs-3">
                    حساباتنا
                </h1>
                <br>
                <div>
                    <span class="badge bg-info">
                        twitter
                        <i class="fab fa-twitter"></i>
                    </span>
                    <span class="badge bg-danger">
                        instgram
                        <i class="fab fa-instagram"></i>
                    </span>
                    <span class="badge bg-success">
                        whatsapp
                        <i class="fab fa-whatsapp"></i>
                    </span>
                </div>
            </div>
            <div class="col-md-3">
                <h1 class="text-center text-gredient fw-bold fs-3">
                    روابط مهمة
                </h1>
                <br>
                <div>
                    <a class="badge bg-success text-decoration-none" href="https://www.flaticon.com/" target="_blank"
                        title="Flaticon">
                        Flaticon
                    </a>
                    <a class="badge bg-primary text-decoration-none" href="https://www.freepik.com/" target="_blank"
                        title="Freepik">
                        Freepik
                    </a>
                    <a class="badge bg-danger text-decoration-none" href="https://flatuicolors.com/" target="_blank"
                        title="Flat colors ui">
                        Flat colors ui
                    </a>
                </div>
            </div>
            <div class="col-md-3">
                <h1 class="text-center text-gredient fw-bold fs-3">
                    حقوق النشر
                </h1>
                <br>
                <h6>
                    جميع محتويات الموقع غير قابلة للنشر الا باذن من صاحب الموقع أو سيتم متابعته قانونيا.
                </h6>
                <h6 class="text-success">
                    السجل التجاري 1469815 
                </h6>
                <h6>
                    {{$currentYear}} &#169;
                </h6>
            </div>
        </div>
    </div>

</div>