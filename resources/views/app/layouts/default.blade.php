@extends('base.index')

@section('styles')
    @include('app.layouts.assets.styles')
@endsection

@section('app')

    <div class="wrapper-pro">
        <div class="left-sidebar-pro">
            @include('app.layouts.partials._side')
        </div>
        <div class="content-inner-all">
            @include('app.layouts.partials._mobile')
            @include('app.layouts.partials._nav')
            @include('app.layouts.partials._bread')

            <div id="result-zone">
                <div class="alert alert-danger alert-block p-3" id="error-disp">
                </div>
                <div class="alert alert-success alert-block p-3" id="success-disp">
                </div>
            </div>

            @yield('content')
        </div>
    </div>
        <div class="modal" id="form">
            <div class="modal-dialog">
                <div class="modal-content">
                   @yield('form-modal')
                </div>
            </div>
        </div>
     <div class="modal" id="logout">
        <div class="modal-dialog modal-confirm">
            <div class="modal-content">
                <div class="modal-header flex-column">
                    <h4 class="modal-title w-100">Etes vous sure?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Voulez vous réelement vous déconnectez du sytème ? .</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-danger ok">Déconnexion</button>
                </div>
            </div>
        </div>
    </div>
    @include('app.layouts.partials._footer')

@endsection

@section('scripts')
    @include('app.layouts.assets.scripts')
    <script type="text/javascript">
          $('#logout .ok').click(function(event){
                event.preventDefault();
                document.getElementById('logout-form').submit();
           })
           $(document).ready(function(){
               $('#result-zone').hide();
           })
    </script>
    @yield('mesScripts')
@endsection
