@extends("layout.template")
@section('page_name', translate('logs'))
@section('page_title_', translate('historico_acesso'))
{{-- @section('page_title', translate('lista_usuarios')) --}}
{{-- @section('page_title_active', translate('lista_usuarios')) --}}
@section('user_role', session('role_name'))
@section('user_name', session('user_name'))

@section('content')
<div class="row">
    <div class="block block-condensed">
    <!-- START HEADING -->
        <div class="app-heading app-heading-small">
            <div class="title">
                <h5>{{translate('historico_acesso')}}</h5>
            </div>
            
        </div>
        <!-- END HEADING -->
        @if(count($logs)>0)
        {{-- {{ dd($users[0]->staff_contacts->sc_contact) }} --}}
            <div class="block-content">
                <div class="table-responsive">

                    <table class="table table-striped table-bordered datatable-extended">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{translate('estado')}}</th>
                                <th>{{translate('email')}}</th>
                                <th>{{translate('ip_addrress')}}</th>
                                <th>{{translate('data_registo')}}</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($logs as $key => $log)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{translate($log->status)}}</td>
                                    <td>{{$log->email}}</td>
                                    <td>{{$log->ip_address}}</td>
                                    <td>{{$log->last_login}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        @else
            <div class="row">
                <div class="col-sm-12">
                    <img src="{{asset('img/ilustrator/no_data.svg')}}"
                        class="img-responsive center-block d-block mx-auto"
                        height="90px"
                        width="90px"
                    >
                    <p class="text-center"> <strong> {{translate('no_record')}}</strong></p>
                </div>
            </div>
        @endif

    </div>

</div>


<!-- END MODAL DANGER -->
@endsection



