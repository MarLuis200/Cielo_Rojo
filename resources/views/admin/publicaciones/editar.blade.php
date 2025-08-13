@extends('layouts.dash2')

@section('content')
    <div class="container mt-5 mb-5">
        <div class="col-md-12">
            <div class="header">
                <div class="container">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="logo">
                                <h1>Actualizar Publicación</h1>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="navbar navbar-inverse" role="banner">
                                <nav class="collapse navbar-collapse bs-navbar-collapse navbar-right" role="navigation">
                                    <ul class="nav navbar-nav">
                                        <li><a href="{{ route('admin.publicaciones') }}">Actualizar Publicación</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="page-content">
                <div class="row">
                    <div class="col-md-10">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.publicaciones') }}">Publicaciones</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Actualizar</li>
                            </ol>
                        </nav>

                        <div class="content-box-large">
                            <div class="panel-heading">
                                <div class="panel-title"><h2>Actualizar</h2></div>
                            </div>

                            <div class="panel-body">
                                <section class="example mt-4">
                                    <form method="POST" action="{{ route('admin.publicaciones.update', $publicaciones->id) }}" role="form" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        @include('admin.publicaciones.frm.prt')

                                        <button type="submit" class="btn btn-info">Guardar</button>
                                        <a href="{{ route('admin.publicaciones') }}" class="btn btn-warning">Cancelar</a>
                                    </form>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <hr>
            <footer class="text-muted mt-3 mb-3">
                <div align="center">
                    Desarrollado Por <a href="http://www.nubecolectiva.com" target="_blank">Equipo Net Team</a>
                </div>
            </footer>
        </div>
    </div>
@endsection
