<x-app-layout>
    <div class="fundo px-5 py-5"> 
        <div class="py-3 px-4 row ms-0 justify-content-between">
            <div class="col-md-3 shadow p-3 caixa">
                <div class="col-md-12 data">
                    Datas Importantes
                    <a data-bs-toggle="modal" data-bs-target="#modalStaticCriarData_{{$chamada->id}}" style="float: right;"><img src="{{ asset('img/icon_adicionar.png') }}" alt="Inserir nova data" width="50.5px" style="width: 25px;"></a>
                </div>
                <div div class="form-row">
                    @if(session('success_data'))
                        <div class="col-md-12" style="margin-top: 5px;">
                            <div class="alert alert-success" role="alert">
                                <p>{{session('success_data')}}</p>
                            </div>
                        </div>
                    @endif
                </div>
                @if ($datas->first() != null)
                    @foreach ($datas as $data)
                        <div class="container" style="margin: 0px; padding: 0px;">
                            <div class="card" style="margin-bottom: 10px;">
                                <div class="card-body">
                                    <div div class="row" data-bs-toggle="modal" data-bs-target="#modalStaticEditarData_{{$data->id}}">
                                        <div class="col-md-3">
                                            @if ($data->tipo == $tipos['convocacao'])
                                                <a ><img class="img-card-data" src="{{asset('img/icon_convocacao.png')}}" alt="" width="40px"></a>
                                            @elseif($data->tipo == $tipos['envio'])
                                                <img class="img-card-data" src="{{asset('img/icon_envio.png')}}" alt="" width="40px">
                                            @elseif($data->tipo == $tipos['resultado'])
                                                <img class="img-card-data" src="{{asset('img/icon_resultado.png')}}" alt="" width="40px">
                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                            <div><h5 style=" font-size:17px; font-weight: bold;">{{$data->titulo}}</h5></div>
                                            <div><h6 style="font-size:15px; font-weight: normal; color:#909090">{{date('d/m/Y',strtotime($data->data_inicio))}}</h6></div>
                                            <div><h6 style="font-size:15px; font-weight: normal; color:#909090">{{date('d/m/Y',strtotime($data->data_fim))}}</h6></div>
                                        </div>
                                        <div class="col-md-3">
                                            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalStaticDeletarData_{{$data->id}}">x</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-md-12 text-center">
                        <img class="img-fluid py-4" width="270" src="{{asset('img/Grupo 1652.svg')}}">
                    </div>
                    <div class="col-md-12 text-center legenda">
                        Nenhuma data foi adicionada
                        <p><a class="redirecionamento" data-bs-toggle="modal" data-bs-target="#modalStaticCriarData_{{$chamada->id}}" style="cursor: pointer;">clique aqui</a> <span class="legenda">para adicionar</span></p>
                    </div>
                @endif
            </div>
  
            <div class="col-md-8 pt-0">
                <div class="col-md-12 tituloBorda">
                    <span class="titulo pt-0">Listagens</span>
                    <a data-bs-toggle="modal" data-bs-target="#modalStaticCriarListagem" style="float: right; margin-top: 20px;"><img src="{{ asset('img/icon_adicionar.png') }}" alt="Inserir nova listagem" width="25px" ></a>
                </div>
                <div class="col-md-12 mt-4 p-2 caixa shadow">
                    @if(session('success_listagem'))
                        <div class="col-md-12" style="margin-top: 5px;">
                            <div class="alert alert-success" role="alert">
                                <p>{{session('success_listagem')}}</p>
                            </div>
                        </div>
                    @endif
                    @if ($listagens->first() != null)
                        @foreach ($listagens as $listagem)
                        <div class="container" style="margin: 0px; padding: 0px;">
                            <div class="card" style="margin-bottom: 10px;">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <h5>{{$listagem->titulo}}</h5>
                                        </div>
                                         <div class="col-md-5">
                                            <h5 style="color:#909090">{{date('d/m/Y',strtotime($data->data_inicio))}} - {{date('d/m/Y',strtotime($data->data_fim))}}</h5>
                                        </div>
                                        <div class="col-md-5" style="float: right;">
                                            <a class="btn btn-primary" href="{{asset('storage/' . $listagem->caminho_listagem)}}" target="blanck">Arquivo</a>
                                            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalStaticDeletarListagem_{{$listagem->id}}">x</button>
                                        </div>
                                    </div>                                    
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="text-center" style="margin-bottom: 10px;">
                            <img class="img-fluid py-4" width="270" src="{{asset('img/Grupo 1654.svg')}}">
                            <div class="col-md-12 text-center legenda">
                                    Nenhuma listagem foi adicionada
                                <p><a class="redirecionamento" data-bs-toggle="modal" data-bs-target="#modalStaticCriarListagem" style="cursor: pointer;" >clique aqui</a> <span class="legenda">para adicionar</span></p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
      </div>

    <!-- Modal criar data -->
    <div class="modal fade" id="modalStaticCriarData_{{$chamada->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Insira uma nova data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="criar-data-form" method="POST" action="{{route('datas.store')}}">
                        @csrf
                        <input type="hidden" name="chamada" value="{{$chamada->id}}">
                        <div class="form-row">
                            <div class="col-sm-12 form-group">
                                <label for="titulo">{{__('Título da data')}}</label>
                                <input type="text" id="titulo" name="titulo" class="form-control @error('titulo') is-invalid @enderror" value="{{old('titulo')}}" autofocus required>

                                @error('titulo')
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-sm-8 form-group">
                                <label for="tipo">{{__('Tipo da data')}}</label>
                                <select name="tipo" id="tipo" class="form-control @error('tipo') is-invalid @enderror" required>
                                    <option value="" selected disabled>-- Selecione o tipo da data --</option>
                                    <option @if(old('tipo') == $tipos['convocacao']) selected @endif value="{{$tipos['convocacao']}}">Convocação</option>
                                    <option @if(old('tipo') == $tipos['envio']) selected @endif value="{{$tipos['envio']}}">Envio de documentos</option>
                                    <option @if(old('tipo') == $tipos['resultado']) selected @endif value="{{$tipos['resultado']}}">Resultado</option>
                                </select>

                                @error('tipo')
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-sm-6 form-group">
                                <label for="data_inicio">{{ __('Data de início') }} </label>
                                <input type="date" @error('data_inicio') is-invalid @enderror id="data_inicio" name="data_inicio" required autofocus autocomplete="data_inicio">

                                @error('data_inicio')
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-sm-6 form-group">
                                <label for="data_fim">{{ __('Data de fim') }} </label>
                                <input type="date" @error('data_fim') is-invalid @enderror id="data_fim" name="data_fim" required autofocus autocomplete="data_fim">

                                @error('data_fim')
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Voltar</button>
                    <button type="submit" class="btn btn-success" form="criar-data-form">Publicar</button>
                </div>
            </div>
        </div>
    </div>

    @foreach ($datas as $data)
        <!-- Modal deletar data -->
        <div class="modal fade" id="modalStaticDeletarData_{{$data->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #dc3545;">
                        <h5 class="modal-title" id="staticBackdropLabel" style="color: white;">Confirmação</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="deletar-data-form-{{$data->id}}" method="POST" action="{{route('datas.destroy', ['data' => $data])}}">
                            @csrf
                            <input type="hidden" name="_method" value="DELETE">
                            Tem certeza que deseja deletar a data {{$data->titulo}}?
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger" form="deletar-data-form-{{$data->id}}">Sim</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal editar data -->
        <div class="modal fade" id="modalStaticEditarData_{{$data->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #3591dc;">
                        <h5 class="modal-title" id="staticBackdropLabel" style="color: white;">Editar data</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="editar-data-form-{{$data->id}}" method="POST" action="{{route('datas.update', ['data' => $data])}}">
                            @csrf
                            <input type="hidden" name="_method" value="PUT">
                            <div class="form-row">
                                <div class="col-sm-12 form-group">
                                    <label for="titulo">{{__('Título da data')}}</label>
                                    <input type="text" id="titulo" name="titulo" class="form-control @error('titulo') is-invalid @enderror" value="{{old('titulo')!=null ? old('titulo') : $data->titulo}}" required autofocus autocomplete="titulo">

                                    @error('titulo')
                                        <div id="validationServer03Feedback" class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-sm-8 form-group">
                                    <label for="tipo">{{__('Tipo da data')}}</label>
                                    <select name="tipo" id="tipo" class="form-control @error('tipo') is-invalid @enderror" required>
                                        <option value="{{$data->id}}" selected >@if ($data->tipo == $tipos['convocacao']) Convocação @elseif($data->tipo == $tipos['envio']) Envio de documentos @elseif($data->tipo == $tipos['resultado']) Resultado @endif</option>
                                        @if ($data->tipo != $tipos['convocacao'])
                                            <option @if(old('tipo') == $tipos['convocacao']) selected @endif value="{{$tipos['convocacao']}}">Convocação</option>

                                        @endif
                                        @if ($data->tipo != $tipos['envio'])
                                            <option @if(old('tipo') == $tipos['envio']) selected @endif value="{{$tipos['envio']}}">Envio de documentos</option>
                                        @endif
                                        @if ($data->tipo != $tipos['resultado'])
                                            <option @if(old('tipo') == $tipos['resultado']) selected @endif value="{{$tipos['resultado']}}">Resultado</option>
                                        @endif
                                    </select>

                                    @error('tipo')
                                        <div id="validationServer03Feedback" class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-sm-6 form-group">
                                    <label for="data_inicio">{{ __('Data de início') }} </label>
                                    <input type="date" @error('data_inicio') is-invalid @enderror id="data_inicio" name="data_inicio" value="{{old('data_inicio')!=null ? old('data_inicio') : $data->data_inicio}}" required autofocus autocomplete="data_inicio">

                                    @error('data_inicio')
                                        <div id="validationServer03Feedback" class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label for="data_fim">{{ __('Data de fim') }} </label>
                                    <input type="date" @error('data_fim') is-invalid @enderror id="data_fim" name="data_fim" required autofocus autocomplete="data_fim" value="{{old('data_fim')!=null ? old('data_fim') : $data->data_fim}}" required autofocus autocomplete="data_fim">

                                    @error('data_fim')
                                        <div id="validationServer03Feedback" class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success" form="editar-data-form-{{$data->id}}">Editar</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

   <!-- Modal criar listagem -->
   <div class="modal fade" id="modalStaticCriarListagem" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #ffffff00;">
                    <h5 class="modal-title" id="staticBackdropLabel" style="color: rgb(0, 142, 185);">Insira uma nova listagem</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="criar-listagem-form" method="POST" action="{{route('listagems.store')}}">
                        @csrf
                        <input type="hidden" name="chamada" value="{{$chamada->id}}">
                        <div class="form-row">
                            <div class="col-sm-12 form-group">
                                <label for="titulo">{{__('Título da listagem')}}</label>
                                <input type="text" id="titulo" name="titulo" class="form-control @error('titulo') is-invalid @enderror" value="{{old('titulo')}}" autofocus required>

                                @error('titulo')
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <label for="tipo">{{__('Selecione o tipo')}}</label>
                            <select name="tipo" id="tipo" class="form-control @error('tipo') is-invalid @enderror" required>
                                <option value="" selected disabled>-- Selecione o tipo da listagem --</option>
                                <option @if(old('tipo') == $tipos['convocacao']) selected @endif value="{{$tipos['convocacao']}}">Convocação</option>
                                <option @if(old('tipo') == $tipos['resultado']) selected @endif value="{{$tipos['resultado']}}">Resultado</option>
                            </select>

                            @error('tipo')
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <br>

                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Cursos
                                    </button>
                                </h2>
                            </div>
                            
                            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#cursosHeading">
                                <div class="card-body">
                                    <div class="form-row">
                                        <label for="curso">{{__('Selecione o(s) curso(s)')}}</label>
                                        <div class="col-sm-12 form-group">
                                            <div class="form-check">
                                                <input type="checkbox" id="chk_marcar_desmarcar_todos_cursos" onclick="marcar_desmarcar_todos_checkbox_por_classe(this, 'checkbox_curso')">
                                                <label for="btn_marcar_desmarcar_todos_cursos"><b>Selecionar todos</b></label>
                                            </div>
                                        </div>
                                        @foreach ($cursos as $curso)
                                            <div class="col-sm-12 form-group">
                                                <div class="form-check">
                                                    <input class="checkbox_curso" type="checkbox" name="cursos[]" value="{{$curso->id}}" id="curso_{{$curso->id}}">
                                                    <label class="form-check-label" for="curso_{{$curso->id}}">
                                                        {{$curso->nome}}
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Cotas
                                  </button>
                                </h2>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#cotasHeading">
                                    <div class="card-body">
                                        <div class="form-row">
                                            <label for="cota">{{__('Selecione a(s) cota(s)')}}</label>
                                            <div class="col-sm-12 form-group">
                                                <div class="form-check">
                                                    <input type="checkbox" id="chk_marcar_desmarcar_todas_cotas" onclick="marcar_desmarcar_todos_checkbox_por_classe(this, 'checkbox_cota')">
                                                    <label for="btn_marcar_desmarcar_todas_cotas"><b>Selecionar todas</b></label>
                                                </div>
                                            </div>
                                            @foreach ($cotas as $cota)
                                                <div class="col-sm-12 form-group">
                                                    <div class="form-check">
                                                        <input class="checkbox_cota" type="checkbox" name="cotas[]" value="{{$cota->id}}" id="cota_{{$cota->id}}">
                                                        <label class="form-check-label" for="cota_{{$cota->id}}">
                                                            {{$cota->nome}}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Voltar</button>
                    <button type="submit" class="btn btn-success" form="criar-listagem-form">Publicar</button>
                </div>
            </div>
        </div>
    </div>
    @foreach ($listagens as $listagem)
        <!-- Modal deletar listagem -->
        <div class="modal fade" id="modalStaticDeletarListagem_{{$listagem->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #dc3545;">
                        <h5 class="modal-title" id="staticBackdropLabel" style="color: white;">Confirmação</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="deletar-listagem-form-{{$listagem->id}}" method="POST" action="{{route('listagems.destroy', ['listagem' => $listagem])}}">
                            @csrf
                            <input type="hidden" name="_method" value="DELETE">
                            Tem certeza que deseja deletar a listagem {{$listagem->titulo}}?
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger" form="deletar-listagem-form-{{$listagem->id}}">Sim</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</x-app-layout>
<script src="{{ asset('js/checkbox_marcar_todos.js') }}" defer></script>