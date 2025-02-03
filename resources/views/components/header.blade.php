

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
                    {{ __('Tienda de camisetas') }}
                </a>
            </div>
            @if (Route::has('login'))
            <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                @auth
                <div>{{ Auth::user()->name }} {{ Auth::user()->surname }}</div>
                <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
                <div id="carrito" class="block_aside">

                    <ul>

                        <li><a href="{{ url('/carrito/index') }}">Productos (12231321)</a></li>
                        <li><a href="{{ url('/carrito/index') }}">Ver el carrito</a></li>
                    </ul>
                </div>
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-dropdown-link :href="route('logout')"
                                     onclick="event.preventDefault();
                                             this.closest('form').submit();">
                        {{ __('Cerrar sesion') }}
                    </x-dropdown-link>
                </form>
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
        <nav id=            "menu">
                             <ul>
                            <li>
                    <a href="<?= base_url ?>">Ini                                                                                        cio</a>
                            </li>
                                    <?php while ($cat = $categorias->fetch_object()): ?>
                                        <                                        li>
                                            <a href="<?= base_url ?>categoria/ver&id=<?= $cat->id ?>"><?= $cat->no mbre ?></a>
                                                </li>
                                    <?php endwhile; ?>
                        </ul>
                        </na                    v>
                         --}}

