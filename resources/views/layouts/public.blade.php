<!DOCTYPE html>
<html lang="ar" dir="rtl" id="no_right_click">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keywords" content="HTML, CSS, JavaScript, Mukhtar, Albattashi, Mukhtar Site">
    <meta name="keywords" content="موفع مختار">
    <meta name="author" content="Mukhtar Albattashi">
    <meta name="author" content="مختار البطاشي">
    <meta name="description" content="Free Web tutorials for HTML and CSS">
    <meta name="description" content=" موقع يحتوي على شرح دروس الصف العاشر لمادة تقنية المعلومات في سلطنة عمان">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="shortcut icon" href="{{asset('images/logo.ico')}}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.rtl.min.css" integrity="sha384-WJUUqfoMmnfkBLne5uxXj+na/c7sesSJ32gI7GfCk4zO4GthUKhSEGyvQ839BC51" crossorigin="anonymous">
    @livewireStyles
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <script defer src="https://unpkg.com/@alpinejs/persist@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body x-cloak x-data="{ databstheme: localStorage.theme == 'dark' ? 'dark' : 'light' }" x-bind:data-bs-theme="databstheme">
    <div class="greadient position-sticky top-0 ">
    </div>
    <section class="container-fluid p-0">
        <a href="" @click="switchTheme">
            <div class="floating fs-4" :class="localStorage.theme != 'dark' ? 'floating dark-card' : 'bg-light-green'">
                <span style="pointer-events:none" class="fas" :class="localStorage.theme != 'dark' ? 'text-pink fa-moon' : 'fa-sun text-white'">
                </span>
            </div>
        </a>
        <main>
            @yield('content')
        </main>
    </section>

    <footer>

    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    @yield('scripts')
    @livewireScripts
    <script>
        function switchTheme() {
            if (localStorage.theme === "dark") {
                localStorage.theme = "light";
                location.reload();
            } else {
                localStorage.theme = "dark";
                location.reload();
            }
        }
        // let ele = document.getElementById('no_right_click');
        // ele.addEventListener('contextmenu', (ev) => {
        //     console.log("Right click disabled");
        //     ev.preventDefault(); // this will prevent browser default behavior 
        // });
    </script>
</body>

</html>