@extends('layout.template')

@section('content')
    <div class="block">                        
                            
        <div class="app-heading app-heading-small">                                
            <div class="title">
                <h2>Basic Inputs</h2>
                <p>Ultra Crisp Line Icons with Integrity</p>
            </div>                                
        </div>
                                  
        <form class="form-horizontal">
            <div class="form-group">
                <label class="col-md-2 control-label">Input text</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control">
                    </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Password</label>
                    <div class="col-md-10">
                        <input type="password" class="form-control">
                    </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Placeholder</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" placeholder="placeholder">
                    </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Predefined value</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" value="Predefined value">
                    </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Readonly</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" value="Field value" readonly>
                    </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Disabled</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" value="Field value" disabled>
                    </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Textarea</label>
                    <div class="col-md-10">
                        <textarea class="form-control" rows="5"></textarea>
                    </div>
             </div>
        </form>
                            
    </div>
                        <!-- END BASIC INPUTS -->
@endsection
