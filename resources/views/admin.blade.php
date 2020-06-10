@extends('layouts.app')
<script src="{{ asset('js/app.js') }}" defer></script>
@section('content')


    <!-- main table with all the info -->
    <div class="alert alert-primary my-4" role="alert">
        <input class="form-control mx-1 my-2" id="busca" type="text" placeholder="Busca tu partido. Prueba con día, hora, nombre, pista..."/>
    </div>
    <button id="btn-add" name="btn-add" class="btn btn-light">Añadir partido</button>
    <table class="table table-striped table-light">
        <thead class="thead-dark">
            <tr>
            <th scope="col">ID</th>
            <th scope="col">Nombre</th>
            <th scope="col">Fecha</th>
            <th scope="col">Hora</th>
            <th scope="col">Jugadores apuntados</th>
            <th scope="col">Pista</th>
            <th scope="col"></th>
            </tr>
        </thead>
        <tbody id="links-list" name="links-list">
        @foreach ($partidos as $partido)
            <tr id="link{{ $partido->idPartido }}" class="buscar">
                <th scope="row">{{ $partido->idPartido }}</th>
                <td>{{ $partido->nombre }}</td>
                <td value="{{ $partido->fecha }}">
                    <strong>{{ \Carbon\Carbon::parse($partido->fecha)->locale('es')->dayName }}, </strong>
                    {{ \Carbon\Carbon::parse($partido->fecha)->format('d/m/Y') }}
                </td>
                <td value="{{ $partido->hora }}">{{ \Carbon\Carbon::parse($partido->hora)->format('H:i') }}</td>
                <td>{{ $partido->limite }}</td>
                <td>{{ $partido->pista->nombreP }}</td>
                <td>
                    <button class="btn btn-info open-modal" value="{{$partido->idPartido}}">Editar</button>
                    <button class="btn btn-danger delete-link" value="{{$partido->idPartido}}">Borrar</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <!-- pagination -->
    <div id="paginacion">{{ $partidos->links() }}</div>

    <!-- modal to create and update -->
    <div class="modal fade" id="linkEditorModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="linkEditorModalLabel">Editar partido</h4>
                </div>
                <div class="modal-body">
                    <form id="modalFormData" name="modalFormData" class="form-horizontal" novalidate="">

                        <div class="form-group">
                            <label for="inputLink" class="col-sm-2 control-label">Nombre</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nombre" name="nombre"
                                        placeholder="Introduce el nombre del partido" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Fecha</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" id="fecha" name="fecha"
                                        placeholder="Enter link Description" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Hora</label>
                            <div class="col-sm-10">
                                <input type="time" class="form-control" id="hora" name="hora"
                                        placeholder="Enter Link Description" value="">
                            </div>
                        </div>

                        <input type="hidden" class="limite" id="limite" value="{{ $partido->limite }}">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Pista</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="idPista" name="idPista">
                                    <option selected>Elige una pista</option>
                                    @foreach ($pistas as $pista)
                                    <option value="{{ $pista->idPista }}">{{ $pista->nombreP }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="btn-save" value="add">Guardar
                    </button>
                    <input type="hidden" id="link_id" name="link_id" value="0">
                    <!-- <input type="hidden" id="limite" name="limite" value="0"> -->
                </div>
            </div>
        </div>
    </div>
@endsection