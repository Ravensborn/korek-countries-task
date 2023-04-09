<!doctype html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Korek Countries Assignment</title>


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;600;800&display=swap" rel="stylesheet">

    <style>

        .homepage-font-14, .country-sub-text {
            font-size: 14px;
        }

        [data-bs-theme="dark"] {
            color-scheme: dark;

            --bs-body-color: #ffffff;
            --bs-body-color-rgb: 255, 255, 255;

            --bs-body-bg: #202c37;
            --bs-body-bg-rgb: 32, 44, 55;

            --bs-tertiary-color: #ffffff;
            --bs-tertiary-color-rgb: 255, 255, 255;

            --bs-tertiary-bg: #2b3945;
            --bs-tertiary-bg-rgb: 43, 57, 69;

            --bs-emphasis-color: #ffffff;
            --bs-emphasis-color-rgb: 255, 255, 255;

            --bs-secondary-color: #ffffff;
            --bs-secondary-color-rgb: 255, 255, 255;
        }


        [data-bs-theme="light"] {
            color-scheme: light;

            --bs-body-color: #111517;
            --bs-body-color-rgb: 17, 21, 23;

            --bs-body-bg: #fafafa;
            --bs-body-bg-rgb: 250, 250, 250;

            --bs-tertiary-color: #111517;
            --bs-tertiary-color-rgb: 17, 21, 23;

            --bs-tertiary-bg: #ffffff;
            --bs-tertiary-bg-rgb: 255, 255, 255;

            --bs-emphasis-color: #111517;
            --bs-emphasis-color-rgb: 17, 21, 23;

            --bs-secondary-color: #111517;
            --bs-secondary-color-rgb: 17, 21, 23;
        }
    </style>

    @livewireStyles
</head>
<body>


<nav class="navbar bg-body-tertiary shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ route('countries.index') }}">
            Where in the world?
        </a>
        <div class="ml-auto">
            <button class="btn" id="color-mode-switch">
                <i class="bi bi-moon" id="color-mode-icon"></i>
                Dark Mode
            </button>
        </div>
    </div>
</nav>

<div class="container">

    @yield('content')

    <footer class="text-body-secondary py-5">
        <div class="container border-top pt-3">
            <div class="row">
                <div class="col-12 col-md-6">
                    <h5>
                        Korek Countries Assignment
                    </h5>
                    <p class="mb-1">
                        This is a project that fetches countries from an API.
                    </p>
                    <p class="mb-1">
                        You have the ability to search for a country by
                        name or choose a region to show countries in that region.
                        and by clicking on a country, you can see view all the details of that country.
                    </p>
                </div>
            </div>
        </div>
    </footer>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('hilitor.js') }}"></script>
@livewireScripts

<script>
    const darkSwitch = document.getElementById('color-mode-switch');
    const currentTheme = localStorage.getItem('theme');
    const icon = document.getElementById('color-mode-icon');

    if (currentTheme) {
        document.documentElement.setAttribute('data-bs-theme', currentTheme);

        if (currentTheme === 'dark') {

            icon.classList.replace('bi-moon', 'bi-moon-fill');
        }
    }

    function switchTheme() {
        const theme = document.documentElement.getAttribute('data-bs-theme');
        if (theme === 'dark') {
            document.documentElement.setAttribute('data-bs-theme', 'light');
            darkSwitch.classList.remove('active');
            icon.classList.replace('bi-moon-fill', 'bi-moon');
            localStorage.setItem('theme', 'light');
        } else {
            document.documentElement.setAttribute('data-bs-theme', 'dark');

            icon.classList.replace('bi-moon', 'bi-moon-fill');
            localStorage.setItem('theme', 'dark');
        }
    }

    darkSwitch.addEventListener('click', switchTheme, false);

</script>


<script>

    function highlight(text) {

        let elements = document.getElementsByClassName('country-name');

        Array.from(elements).forEach((element) => {
            element.innerHTML = element.innerHTML.replace(
                new RegExp(text + '(?!([^<]+)?<)', 'gi'),
                '<mark>$&</mark>'
            );
        });

    }

    Livewire.on('highlightText', searchedText => {
        highlight(searchedText);
    })


</script>
<script>


</script>


</body>
</html>
