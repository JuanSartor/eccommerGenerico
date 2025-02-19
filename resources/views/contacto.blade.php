<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <script src="{{ asset('js/mi.js') }}"></script>
    <style>


        input,textArea,select{
            width: 50% !important;
        }


        input[type="submit"]{
            width: 15% !important;
            margin:20px auto;
        }
    </style>



    @include('components.header')

    <main class="container-gestor">


        <br>
        <br>
        <h5> Dejanos tu mensaje</h5>

        <div class="form_container" style="width: 100%;">
            <form action="{{  route('enviarconsulta') }}" method="POST" enctype="multipart/form-data">
                @csrf


                <div style="display: flex;">
                    <div style="width: 50%;">


                        <label for="nombre">Nombre</label>
                        <input type="text" required name="nombre" />

                        <label for="telefono">Telefono</label>
                        <input required step="1" min="0" type="number" name="telefono"  />

                        <label for="email">Correo electronico</label>
                        <input  type="email" required name="email" />


                        <label for="mensaje">Mensaje</label>
                        <textarea rows="8" required name="mensaje"></textarea>

                        <br>

                        <input style="margin-left: 0px;" type="submit" value="Enviar" />


                        @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        <br>
                        @elseif(session('failed'))
                        <div class="alert alert-failed">
                            {{ session('failed') }}
                        </div>
                        <br>
                        @endif


                    </div>

                    <div style="width: 50%;">

                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3485.4377535205076!2d-59.63591692356858!3d-29.1222760891307!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x944eba5e274e326d%3A0x582aafd27bc00a4e!2sBOLSAR%20-%20F%C3%A1brica%20de%20Bolsas!5e0!3m2!1ses!2sar!4v1739967398139!5m2!1ses!2sar" width="95%" height="85%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

                    </div>

                </div>

            </form>
        </div>



    </main>


    @include('components.footer')



