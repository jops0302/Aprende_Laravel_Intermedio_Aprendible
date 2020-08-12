@extends('plantilla')

@section('title', 'Crear proyecto')

@section('content')

<div class="container">

    <div class="row">
        <div class="col-12 col-sm-10 col-lg-6 mx-auto">


            @include('partials.validation-errors')

            <form class="bg-white py-3 px-4 shadow rounded" method="POST" enctype="multipart/form-data" action="{{  route('projects.update', $project) }}">
                @method('PATCH')

                <h1 class="display-4">Editar Proyecto</h1>
                <hr>

                @include('projects._form', ['btnText' => "Actualizar"])

            </form>
        </div>
    </div>
</div>

@endsection

