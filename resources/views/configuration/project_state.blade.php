@extends('layout.template')
@section('page_title_', 'Pre Award')
@section('page_title_active', translate('alterar_estado_proposta'))
@section('user_role', session('role_name'))
@section('user_name', session('user_name'))

@section('content')
<div class="row" style="float: right; margin-right: 3px; margin-bottom: 3px;">
    <button onclick="window.history.back();" class="btn btn-success"> <span class="fa fa-arrow-left"></span> {{translate('voltar')}}</button>
</div>
<div class="block block-condesend">
    <div class="app-heading app-heading-small">
        <div class="title">
            <h2>{{translate('alterar_estado_proposta')}} <span class="label label-primary label-bordered">{{$project}}</span> </h2>
            <h3>{{translate('actual_state')}}: <span class="label label-success label-bordered">{{!empty($project_state->project_state)?translate($project_state->project_state->s_description):translate('nao_definido') }}</span></h3>
        </div>
    </div>
    {{-- <div class="block block-content"> --}}
        <div class="row">
            {{-- {{dd(base64_decode($project_state) )}} --}}
            @if(!empty($project_state))
            @if($project_state->s_id != 5)
            {{-- {{ dd($states[0]->s_description) }} --}}
            <div class="col-sm-9" style="">
                <form action="{{route('configuration.project_state_store')}}" id="form" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="col-md-3 control-label"><small style="color: red;">*</small> {{translate('novo_estado')}}</label>
                        <div class="col-md-6">
                            <select class="form-control" name="s_id"  title="{{translate('select_option')}}">
                                <option selected>{{translate('select_option')}}.</option>
                                @if($project_state->s_id < 2)
                                    @for ($i=0;$i < $project_state->s_id; $i++ )
                                        <option value="{{base64_encode($states[$i]->s_id)}}">{{translate($states[$i]->s_description)}}</option>
                                    @endfor

                                @else
                                    @foreach($states as $state)
                                        {{-- @if($state->s_id != 5) --}}

                                        @if($project_stage_micro >= 5)
                                            @if($project_state->s_id !=5)
                                                <option value="{{base64_encode($state->s_id)}}">{{translate($state->s_description)}}</option>
                                            @endif
                                        @endif
                                        {{-- @endif --}}
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="" style="float: right;">
                        <input type="hidden" name="p_id" value="{{base64_encode($project_state->p_id)}}" class="col-md-3">
                        <button type="submit" id="" class="btn btn-primary" style="margin-right: 15.5vw"  >{{translate('submeter')}}</button>

                    </div>
                </form>
            </div>
            @else
            <div class="row">
                <div class="text-center">
                    <span>{{translate('a_fase_pre_award_completa')}} <a href="{{route('post_award.project_charter_create', base64_encode($project_state->p_id))}}">{{translate('clique_aqui')}}</a> {{translate('para_actualizar_informacao_registada_anterior')}}</span>

                </div>
            </div>
            @endif
            @endif
        </div>

</div>
@endsection

