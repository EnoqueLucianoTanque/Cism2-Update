@extends('layout.template')
@section('page_title', translate('nova_proposta'))
@section('page_title_', translate('formulario_registo'))
@section('user_role', session('role_name'))
@section('user_name', session('user_name'))
@section('page_name', 'Pre award')
@section("scripts_head")
{{-- {!! RecaptchaV3::initJs() !!}  --}}
<script async custom-element="amp-recaptcha-input" src="https://cdn.ampproject.org/v0/amp-recaptcha-input-0.1.js"></script>
@endsection
@section("css") 
    <link rel="stylesheet" href="{{asset("assets/css/steper_form.style.css")}}">
    <style>
        #btn_loader {
        border: 16px solid #f3f3f3; /* Light grey */
        border-top: 16px solid #3498db; /* Blue */
        border-radius: 50%;
        margin: -76px 0 0 -76px;
        width: 120px;
        height: 120px;
        animation: spin 2s linear infinite;
        }

        @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
        }
    </style>
@endsection

{{-- {{dd(Session::get('locale'))}} --}}
@section('content')
<div class="row" style="float: right; margin-right: 3px; margin-bottom: 3px;">
    <button onclick="window.history.back();" class="btn btn-success"> <span class="fa fa-arrow-left"></span> {{translate('voltar')}}</button>
</div>
<div class="block">

    <form id="regForm" method="post"
        action="{{route('pre_writing.store')}}"
        class="form-horizontal"
        enctype="multipart/form-data"
        >
        @csrf

        <div class="tab">
            <div class="form-group">
                <label class="col-md-2 control-label"><small style="color: red;">*</small> {{translate('formulario_input_1')}}</label>
                <div class="col-md-10">
                    <select class="form-control" name="consortium" id="consortium_id" title="{{translate('select_answer')}}">
                        <option selected>{{translate('select_answer')}}</option>
                        <option value="sim">{{translate('sim')}}</option>
                        <option value="nao">{{translate('nao')}}</option>
                    </select>
                </div>
            </div>
            <div class="form-group" hidden id="principal_rec">
                <label for="" class="col-md-2 control-label"> <small style="color: red;">*</small> Principal-Recipient</label>
                    <div class="col-md-10">
                        <input list="principal_recipient"
                        name="principal_recipient"
                        id="pi"
                        placeholder="Principal-Recipient"
                        class="form-control"
                        type="text"
                        value="{{!empty(old("principal_recipient"))}}"
                        >
                        <datalist id="principal_recipient" class="bs-select">
                            {{-- <option value="." selected>Nao definido.</option> --}}
                            @foreach ($recipients as $index => $recipient)
                                <option value="{{ $recipient->r_name }}">
                            @endforeach
                        </datalist>
                        @error('principal_recipient')
                            <span style="color: red"> {{ $message }}</span>
                        @enderror

                    </div>
                
            </div>
            <div class="form-group" hidden id="sub_rec">
                <label for="" class="col-md-2 control-label"><small style="color: red;">*</small>Sub-Recipient</label> 
                <div class="col-md-10">
                    <select name="sub_recipient[]" class="bs-select" title="Lista de Sub-recipients" multiple>
                        @foreach($recipients as $recipient) 
                            <option value="{{$recipient->r_name}}">{{$recipient->r_name}}</option>
                        @endforeach
                    </select>
                    @error('sub_recipient')
                    <span style="color: red"> {{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label"><small style="color: red;">*</small>{{translate('area_pesquisa')}} </label>
                    <div class="col-md-10">
                        <input list="area_pesquisa"
                        name="area_pesquisa"
                        placeholder="{{translate('area_pesquisa')}} "
                        class="form-control"
                        type="text"
                        value="{{old("area_pesquisa")}}"
                        >
                        <datalist id="area_pesquisa" class="bs-select">
                            @foreach ($search_project as $index => $search)
                                <option value="{{ $search->sa_name }}">
                            @endforeach
                        </datalist>
                        @error('area_pesquisa')
                            <span style="color: red"> {{ $message }}</span>
                        @enderror

                    </div>
            </div>
            @if($if_cism_collaborator != 1)
                <div class="form-group">
                    <label class="col-md-2 control-label"><small style="color: red;">*</small> {{translate('formulario_input_2')}}</label>
                        <div class="col-md-10">
                            <select class="form-control" name="colaborador" title="Selecione o colaborador">
                                <option value=""></option>
                                @foreach ($users as $users_staff)
                                    <option value="{{base64_encode($users_staff->u_id)}}">{{ !empty($users_staff->staff)?$users_staff->staff->s_name:translate('nao_definido') }}</option>
                                @endforeach
                            </select>
                        </div>
                </div>
            @endif
            <div class="form-group">
                <label class="col-md-2 control-label"><small style="color: red;">*</small>{{translate('formulario_input_3')}}</label>
                    <div class="col-md-10">
                        <input value="{{ old('project_name') }}" type="text" name="project_name" class="form-control" placeholder="{{translate('formulario_input_3')}}">
                        @error('project_name')
                            <span style="color: red"> {{ $message }}</span>
                        @enderror
                    </div>
            </div>

            <div class="form-group">
                <label class="col-md-2 control-label"><small style="color: red;">*</small> {{translate('acronimo')}}</label>
                    <div class="col-md-10">
                        <input value="{{ old('acronimo') }}" type="text" name="acronimo" class="form-control" placeholder="{{translate('acronimo')}}">
                        @error('acronimo')
                            <span style="color: red"> {{ $message }}</span>
                        @enderror
                    </div>
            </div>

            <div class="form-group">
                <label class="col-md-2 control-label"><small style="color: red;">*</small> {{translate('descricao')}}</label>
                <div class="col-md-10">
                    <textarea class="form-control" rows="4" name="project_description" id="descricao">{{old("project_description")}}</textarea>
                    @error('project_description')
                        <span style="color: red"> {{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-2 control-label" for="deadline"><small style="color: red;">*</small> {{translate('start_date')}}</label>
                    <div class="col-md-10">
                        <input value="{{ old('start_date') }}" type="date" id="start_date" min="{{date('Y-m-d')}}" name="start_date" class="form-control">
                        @error('start_date')
                            <span style="color: red"> {{ $message }}</span>
                        @enderror
                    </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label" for="deadline"><small style="color: red;">*</small> {{translate('data_termino')}}</label>
                    <div class="col-md-10">
                        <input value="{{ old('estimated_deadline') }}" type="date" id="deadline" name="estimated_deadline" class="form-control">
                        @error('estimated_deadline')
                            <span style="color: red"> {{ $message }}</span>
                        @enderror
                    </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label"><small style="color: red;">*</small> {{translate('proposta_financeira')}}</label>
                    <div class="col-md-8">
                    <input value="{{ old('project_budject') }}" type="text" name="project_budject" id="orcamento" class="form-control">
                        @error('project_budject')
                            <span style="color: red"> {{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-2">
                        <select class="form-control" name="moeda" id="">
                            <option value="">{{translate('selecione_moeda')}}</option>
                            <option value="MZN">MZN</option>
                            <option value="ZAR">ZAR</option>
                            <option value="EUR">EUR</option>
                            <option value="USD">USD</option>
                        </select>
                        @error('moeda')
                            <span style="color: red"> {{ $message }}</span>
                        @enderror
                    </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label"><small style="color: red;">*</small> {{translate('call_link')}}</label>
                    <div class="col-md-10">
                    <input value="{{ old('web_url') }}" id="link_call" type="url" name="web_url" class="form-control">
                    </div>
            </div>

            <div class="form-group">
                <label class="col-md-2 control-label"><small style="color: red;">*</small> {{translate('document_support')}}</label>
                    <div class="col-md-10">
                        <input class="form-control input-sm" name="document" type="file" id="documento_suporte"  accept="file_extension/.docx, .doc, .pdf" value="{{old("document")}}">
                    </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label"><small style="color: red;">*</small> {{translate('proposal_source')}}</label>
                    <div class="col-md-10">
                    <select class="form-control" name="p_source" id="" title="{{translate('financiandor')}}">
                        <option selected> {{translate('select_option')}}</option>
                        @foreach ($funders as $funder)
                            
                        <option value="{{$funder->f_name}}">{{$funder->f_name}}</option>
                        @endforeach
                    </select>
                    </div>
            </div>
        </div>


        <div class="tab">{{translate('video')}}
            <div class="title">
                <h5>{{translate('add_ficheiro_media')}} <small style="color: red"> ({{translate('add_video_describe')}})</small></h5>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">{{translate('title')}}</label>
                <div class="col-md-10">
                    <input type="text" name="title_video" class="form-control" id="input_video" placeholder="{{translate('title')}}" value="{{old("title_video")}}">
                    @error('title_video')
                        <span style="color: red"> {{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">{{translate('video')}}</label>
                <div class="col-md-10">
                    <input type="file" name="video" id="input_video_file" class="form-control" >
                    <span id="video_error" style="color: red"></span>
                    <span id="lblError" style="color: red;"></span>
                    @error('video')
                        <span style="color: red"> {{ $message }}</span>
                    @enderror
                </div>
            </div>
            {{-- <div class="form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                {{-- {!! RecaptchaV3::initJs() !!}  --}}
                {{-- {!! RecaptchaV3::field('register') !!}
                @if ($errors->has('g-recaptcha-response'))
                <span class="help-block">
                    <span style="color: red">{{ $errors->first('g-recaptcha-response') }}</strong>
                </span>
            @endif
            </div> --}}
        </div>
        
    

        <div class="tab">{{translate('quiz')}} <small style="color: red;" > {{translate('pfv_responda_quetoes')}}</small>
            @foreach ($project_question as $question)
                <div class="form-group">
                    <label for="" class="col-md-10 control-label">{{translate($question->pq_description)}}</label>
                    <div class="col-md-2">
                        <select name="resposta[]" title="{{translate('select_answer')}}" class="bs-select" required>
                            <option value="Sim">{{translate('sim')}}</option>
                            <option value="Não">{{translate('nao')}}</option>
                            <option value="Sem resposta">{{translate('no_answer')}}</option>
                        </select>
                        @error('resposta.*')
                            <span style="color: red" >{{$message}}</span>
                        @enderror
                    </div>
                </div>
            @endforeach

        </div>
        <div class="tab">
            <div class="row">
                <div class="col-sm-12">
                    {{-- <div id="btn_loader" class="img-responsive center-block d-block mx-auto" ></div> --}}
                    <img id="img_submitted"  src="{{asset('assets/css/vendor/tinymce/img/loading-buffering.gif')}}" style="visibility: hidden; width: 5vw;height: 10vh;" class="img-responsive center-block d-block mx-auto" alt="Sample Image">
                    <img id="img_success" src="{{asset('img/ilustrator/approved.png')}}" style="width: 90px;height: 90px;" class="img-responsive center-block d-block mx-auto" alt="Sample Image">
                    <button type="submit" class="btn btn-primary center-block" id="btn_submit">{{translate('submeter')}}</button>
                    <amp-recaptcha-input layout="nodisplay" name="recaptcha_token" data-sitekey="{{env("RECAPTCHAV3_SITEKEY")}}" data-action="recaptcha_example">
                    </amp-recaptcha-input>
                </div>
            </div> 
        </div>

                  <div class="row" style="float: left; margin-top:10px;">
                    <button type="button" id="prevBtn" class="btn btn-default" onclick="nextPrev(-1)"> {{translate('anterior')}}</button>

                  </div>
                  <div class="row" style="float: right;  margin-top:10px; margin-right: 30px;">
                    <button type="button" id="nextBtn" class="btn btn-default" onclick="nextPrev(1)"> {{translate('proximo')}}</button>
                  </div>

        <!-- Circles which indicates the steps of the form: -->
        <div class="form-group">
            <div style="text-align:center;margin-top:40px;">
              <span class="step"></span>
              <span class="step"></span>
              <span class="step"></span>
              <span class="step"></span>
            </div>
        </div>

    </form>
</div>

@endsection

@section('scripts')

<script src="{{asset("assets/js/cism/steper_form.js")}}" type="text/javascript"></script>
<script>

        $("#deadline").on("click", function(){
            endDate();
        });

    $(document).ready(function() {
        sessionStorage.setItem("language", "{{Session::get('locale')}}");
        // var href = sessionStorage.getItem("language");
        // alert(href);

        $("#input_video_file").on("change", function(e){
            e.preventDefault();
            var lblError = $("#lblError");
            lblError.html('');
            $("#video_error").html("");
            $("#video_error").html("");

            if(this.files[0].size > 2e+8){ //foi definido o tamanho máximo de 200Mb
                this.value = "";
                $("#video_error").html('{{translate("tamanho_video")}}');
                return false;
            }
            var allowedFiles = [".avi", ".mp4", ".ogg", ".ogv", ".mov", ".wmv", ".flv", ".3gp", ".mpg", ".webm"];
            var fileUpload = $("#input_video_file");

            var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles.join('|') + ")$");
            if (!regex.test(fileUpload.val().toLowerCase())) {
                lblError.html('{{translate("por_favor_adicione_video_valido")}} <br>' + allowedFiles.join(', ') + "</b> only.");
                this.value = "";
                return false;
            }
            return true;

        });
    });
    $("#regForm").submit(function(e){
        document.getElementById("img_success").style.visibility = "hidden";
        document.getElementById("img_submitted").style.visibility = "visible";
        $("#btn_submit").prop('disabled', true);
    });
    function endDate(){
        var start_date = $("#start_date").val();
        // console.log(start_date);
        $("#deadline").attr("min", start_date);
    }

    $("#consortium_id").on("change", function(e){
        var resposta = $(this).val();
        if(resposta == 'sim'){
            show_consortium_div();
        }else{
            close_consortium_div(); 
        }
    });

    function show_consortium_div(){
        $("#principal_rec").show();
        $("#sub_rec").show();
    }
    function close_consortium_div(){
        
        $("#principal_rec").hide();
        // alert('test');
        $("#pi").val("   ");
        $("#sub_rec").hide();
        $("#sub_recipient").val("`");
    }

    $("#orcamento").maskMoney();

</script>
@endsection
