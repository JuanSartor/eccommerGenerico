<!DOCTYPE HTML>
<html lang="es">
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
            </header>


            {{-- aca tenes q cargar todas las categorias que existen
            <!-- MENU -->
            <?php $categorias = Utils::showCategorias(); ?>
            <nav id="menu">
                <ul>
                    <li>
                                <a href="<?= base_url ?>">Ini                                cio</a>
                                        </li>
                                        <?php while ($cat = $categorias->fetch_object()): ?>
                                            <li>
                                                    <a href="<?= base_url ?>categoria/ver&id=<?= $cat->id ?>"><?= $cat->no mbre ?></a>
                                                        </li>
                                        <?php endwhile; ?>
                                    </ul>
                                </nav>
          --}}

