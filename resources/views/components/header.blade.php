

<head>
    <meta charset="utf-8" />
    <title>Tienda de Camisetas</title>

    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

</head>
<body>
    <div id="container">
        <!-- CABECERA -->
        <header id="header">
            <div id="logo">
                <img src="{{asset('img/camiseta.png')}}" alt="Camiseta Logo" />
                <a href="{{ route('home') }}">
                    Tienda de camisetas
                </a>
            </div>
            @if (Route::has('login'))
            <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                @auth
                <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
                @else
                <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                @if (Route::has('register'))
                <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                @endif
                @endauth
            </div>
            @endif
        </header>


        {{-- aca tenes q cargar todas las categorias que existen
            <!-- MENU -->
        <?php $categorias = Utils::showCategorias(); ?>
            <nav id="menu">
                <ul>
                    <li>
                            <a href="<?= base_url ?>">Ini                                                            cio</a>
                                    </li>
                                    <?php while ($cat = $categorias->fetch_object()): ?>
                                        <li>
                                                <a href="<?= base_url ?>categoria/ver&id=<?= $cat->id ?>"><?= $cat->no mbre ?></a>
                                                    </li>
                                    <?php endwhile; ?>
                        </ul>
                    </nav>
          --}}

