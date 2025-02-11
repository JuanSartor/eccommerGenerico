
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
            <div style="text-align: right;" class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                @auth






                <div class="dropdown">
                    <button class="dropdown-btn">
                        <div> <x-heroicon-o-user-circle style="width: 30px; margin-right: 5px; position: relative; top: 5px;"/>
                            {{ Auth::user()->name }} {{ Auth::user()->surname }}
                        </div>
                    </button>
                    <div class="dropdown-content">

                        @if( Auth::user()->rol === 'admin')
                        <a href="{{ url('/supercategorias') }}">Gestionar supercategorias</a>
                        <a href="{{ url('/categorias') }}">Gestionar categorias</a>
                        <a href="{{ url('/productos')}}">Gestionar productos</a>
                        <a href="{{ url('/pedidos')}}">Gestionar pedidos</a>

                        @endif
                        <a href="{{ url('/carrito') }}">Productos (12231321)</a>
                        <a href="{{ url('/carrito') }}">Ver el carrito</a>
                        <a href="{{ url('/pedidos/mispedidos') }}">Mis pedidos</a>
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                             onclick="event.preventDefault();
                                                     this.closest('form').submit();">
                                {{ __('Cerrar sesion') }}
                            </x-dropdown-link>
                        </form>
                    </div>
                </div>  

                @else
                <a style="color: white; text-decoration: none; position: relative; top: 15px;" href="{{ route('login') }}" class="dropdown-btn">{{ __('Ingresar') }}</a>

                @if (Route::has('register'))
                <a style="color: white; text-decoration: none; position: relative; top: 15px;" href="{{ route('register') }}" class="dropdown-btn">{{ __('Registrarse') }}</a>
                @endif
                @endauth
            </div>
            @endif
        </header>



        {{-- Menu de supercategorias--}}
        <nav id="menu">
            <ul>
                <li>
                    <a href="{{ route('home') }}">Inicio</a>
                </li>
                @foreach ($supercategorias as $supercategoria)

                <div class="dropdown">

                    <li style="line-height: 35px;">
                        <a style="background-color: #222;" class="dropdown-btn">
                            {{ $supercategoria->nombre }}
                        </a>

                        <div class="dropdown-content">

                            @foreach ($supercategoria->categorias as $categoria)
                            <a style="color: #227591; font-weight: bold;" href="{{ url('categoria/ver', ['id' => $categoria->id]) }}">
                                {{ $categoria->nombre }}
                            </a>
                            @endforeach

                        </div>
                    </li>
                </div> 


                @endforeach


            </ul>
        </nav>  

