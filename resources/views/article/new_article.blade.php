@extends('layout.template')
@section('page_title', 'Registo do artigo')
@section('page_title_', 'Novo artigo')
@section('user_role', session('role_name'))
@section('user_name', session('user_name'))
@section('page_name', 'Gestão de artigos')
@section('content')

    <div class="block">

        <div class="app-heading app-heading-small">
            <div class="title">
                <h2>{{translate('novo_artigo')}}</h2>
                <p>{{translate('formulario_registo')}}</p>
            </div>
            <div class="text-right">
                <a href="{{route('article_post_award.index')}}" class="btn btn-primary" > <span class="fa fa-arrow-left"></span> {{translate('voltar')}}</a>
                
            </div>
        </div>

        <form
            method="post"
            action="{{route('article.store_new_article')}}"
            class="form-horizontal"
            enctype="multipart/form-data"
        >
        @csrf

            <div class="form-group">
                <label class="col-md-2 control-label">{{translate('area_pesquisa')}}</label>
                    <div class="col-md-10">
                        <input list="categoria_artigo"
                        name="categoria_artigo"
                        placeholder="{{translate('area_pesquisa')}}"
                        class="form-control"
                        type="text"
                        >
                        <datalist id="categoria_artigo" class="bs-select">
                            {{-- <option value="{{ $categories->ac_id }}">A</option> --}}
                            @foreach ($categories as $category)
                                <option value="{{ $category->ac_description }}">
                            @endforeach
                        </datalist>
                        @error('categoria_artigo')
                            <span style="color: red"> {{ $message }}</span>
                        @enderror

                    </div>
            </div>

            <div class="form-group">
                <label class="col-md-2 control-label">{{translate('title')}}</label>
                    <div class="col-md-10">
                        <input value="{{ old('title') }}" type="text" name="title" class="form-control" required placeholder="{{translate('title')}}">
                        @error('title')
                            <span style="color: red"> {{ $message }}</span>
                        @enderror
                    </div>
            </div>

            <div class="form-group">
                <label class="col-md-2 control-label">{{translate('autores')}}</label>
                    <div class="col-md-10">
                        <select name="autores[]" class="bs-select" title="{{translate('selecione_autor_artigo')}}" required multiple>
                            @foreach ($authors as $index => $author)
                                <option value="{{ base64_encode($author->ca_id) }}">{{ $author->ca_name }} </option>
                            @endforeach
                        </select>
                    </div>
            </div>

            <div class="form-group" hidden>
                <label class="col-md-2 control-label">{{translate('descricao')}}</label>
                <div class="col-md-10">
                    <textarea name="content" rows="10" cols="20" id="editor"></textarea>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-2 control-label">Link</label>
                <div class="col-md-10">
                    <input type="url" class="form-control input-sm" name="link_artigo" placeholder="Link" required>
                    @error("link_artigo")
                    <span style="color: red"> {{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-2 control-label">{{translate('documento_descritivo')}}</label>
                <div class="col-md-10">
                    <input class="form-control input-sm" name="document" type="file"  accept="file_extension/.docx, .doc, .pdf">
                    @error('document')
                    <span style="color: red"> {{ $message }}</span>
                @enderror
                </div>
            </div>

            <div class="form-group">
              <div class="col-sm-12">
                <div class="col col-sm-3"></div>
                <div class="col-md-3 col-xs-3">
                 <button type="submit" class="btn btn-primary btn-block">{{translate('registar')}}</button>
                </div>
                <div class="col-md-3 col-xs-3">
                    <button type="button" onclick="window.history.back();" class="btn btn-warning btn-block">{{translate('cancelar')}}</button>
                </div>
               <div class="col col-sm-3"></div>
              </div>
            </div>
        </form>

    </div>
@endsection

