@extends('layout.template')
@section('page_title', 'Project Charter')
@section('page_title_', translate('actualizar_info_fase_anterior'))
@section('page_title_active', $project->p_name)
@section('user_role', session('role_name'))
@section('user_name', session('user_name'))
@section('page_name', 'Post award')
@section('content')
<div class="row" style="float: right; margin-right: 3px; margin-bottom: 3px;">
    <button onclick="window.history.back();" class="btn btn-success"> <span class="fa fa-arrow-left"></span> {{translate('voltar')}}</button>
</div>
<div class="block">
    <div class="app-heading app-heading-small">
        <div class="title">
            <h3>{{translate('projecto')}}: <span class="label label-primary label-bordered">{{$project->p_name}}</span> </h3>
            <h3>{{translate('acronimo')}}: <span class="label label-primary label-bordered">{{$project->p_acronym}}</span> </h3>
        </div>
    </div>
    <div class="row">

        <form action="{{route("post_award.project_charter_store")}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="p_id" value="{{base64_encode($project->p_id)}}">
            <div class="form-group">
                <label class="col-md-3 control-label"><small style="color: red;">*</small>{{translate('acronimo')}}</label>
                <div class="col-md-9">
                    <input value="{{ empty(old('pc_acronym'))?$project->p_acronym:old('pc_acronym') }}" required type="text" name="pc_acronym" class="form-control" placeholder="{{translate('acronimo')}}">
                        @error('pc_acronym')
                            <span style="color: red"> {{ $message }}</span>
                        @enderror
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label"><small style="color: red;">*</small>{{translate('objectivos')}}</label>
                <div class="col-md-9">
                    <textarea class="form-control" rows="4" name="pc_objective" >{{old("pc_objective")}}</textarea>
                    @error('pc_objective')
                        <span style="color: red"> {{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-md-3 control-label"> <small style="color: red;">*</small> Principal-Recipient</label>
                <div class="col-md-9">
                    <input value="{{ empty(old('pc_pi'))?$project->user_project->staff->s_name:old('pc_pi') }}" type="text" required name="pc_pi" class="form-control" placeholder="Principal-recipient">
                    @error('pc_pi')
                        <span style="color: red"> {{ $message }}</span>
                    @enderror 
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-md-3 control-label"><small style="color: red;">*</small>Sub-Recipient</label> 
                <div class="col-md-9">
                    <select name="sub_recipient[]" class="bs-select" title="Sub-recipients" multiple> 
                        @foreach ($consortium_member as $member)
                            <option value="{{$member->cmp_name}}" selected> {{$member->cmp_name}} </option>
                        @endforeach
                        @foreach($recipients as $recipient) 
                            <option value="{{$recipient->r_name}}">{{$recipient->r_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label" for="deadline"><small style="color: red;">*</small> {{translate('data_inicial_')}}</label>
                    <div class="col-md-9">
                        <input value="{{ $project->p_end_date}}" type="date" id="start_date" required name="pc_start_date" class="form-control">
                        @error('start_date')
                            <span style="color: red"> {{ $message }}</span>
                        @enderror
                    </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label" for="deadline"><small style="color: red;">*</small> {{translate('data_final')}}</label>
                    <div class="col-md-9">
                        <input value="{{ empty(old('pc_end_date'))?$project->p_deadline:old('pc_end_date') }}" type="date" id="end_date" name="pc_end_date" required class="form-control">
                        @error('end_date')
                            <span style="color: red"> {{ $message }}</span>
                        @enderror
                    </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label" for="deadline"><small style="color: red;">*</small> {{translate('local_implementacao')}}</label>
                    <div class="col-md-9">
                        <input value="{{ old('p_data_collection_location') }}" type="text"  name="p_data_collection_location" class="form-control" required>
                        @error('p_data_collection_location')
                            <span style="color: red"> {{ $message }}</span>
                        @enderror
                    </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label" for="deadline"><small style="color: red;">*</small> {{translate('pop_alvo')}}</label>
                    <div class="col-md-9">
                        <input value="{{ old('p_target_population') }}" type="text"  name="p_target_population" class="form-control" required>
                        @error('p_target_population')
                            <span style="color: red"> {{ $message }}</span>
                        @enderror
                    </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label" for="deadline"><small style="color: red;">*</small> {{translate('procedimento_principal')}}</label>
                    <div class="col-md-9">
                        <input value="{{ old('p_main_procedure') }}" type="text" maxlength="200" name="p_main_procedure" class="form-control" required>
                        @error('p_main_procedure')
                            <span style="color: red"> {{ $message }}</span>
                        @enderror
                    </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label" for="deadline"><small style="color: red;">*</small> {{translate('ponto_situacao')}}</label>
                    <div class="col-md-9">
                        <input value="{{ old('p_actual_state') }}" type="text" maxlength="99"  name="p_actual_state" class="form-control" required>
                        @error('p_actual_state')
                            <span style="color: red"> {{ $message }}</span>
                        @enderror
                    </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label" for="deadline"><small style="color: red;">*</small> {{translate('documento_descritivo')}}
                </label>
                    <div class="col-md-9">
                        <input value="{{ old('document') }}" type="file" required accept="file_extension/.docx, .doc, .pdf" name="document" class="form-control">
                        @error('document')
                            <span style="color: red"> {{ $message }}</span>
                        @enderror
                    </div>
            </div>
            <div class="form-group" >
                <div class="col-sm-12 text-right">
                  <div class="col col-sm-3"></div>
                  <div class="col-sm-3 col-xs-3">
                   <button type="submit" class="btn btn-primary"><span class="fa fa-floppy-o"></span> {{translate('registar')}}</button>
                  </div>
                 <div class="col-md-3 col-xs-3">
                  <button type="reset" class="btn btn-default">{{translate('cancelar')}}</a>
                 </div>
                 <div class="col col-sm-3"></div>

                </div>
              </div>
        </form>
    </div>
</div>
@endsection

@section("scripts")
<script>
    $(document).ready(function(){
        $("#end_date").on("click", function(){
            endDate();
        })
    })
    function endDate(){
        var start_date = $("#start_date").val();
        $("#end_date").attr("min", start_date);
    }
</script>
@endsection
