@extends('app.layouts.default',["title" => "Gestion des adhésions"])

@section('content')
 <!-- Data table area Start-->
        <div class="admin-dashone-data-table-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="sparkline8-list shadow-reset">
                            <div class="sparkline8-hd">
                                <div class="main-sparkline8-hd">
                                    <h1>Gestion des adhésions</h1>
                                    <div class="sparkline8-outline-icon">
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#form" href="#form">
                                            Ajouter
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="sparkline8-graph">
                                <div class="datatable-dashv1-list custom-datatable-overright">
                                    <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true"
                                        data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                                        <thead>
                                            <tr>
                                                <th data-field="state" data-checkbox="true"></th>
                                                <th data-field="email" data-editable="true">Email</th>
                                                <th data-field="phone" data-editable="true">Contact</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($data as $admin)
                                                <tr>
                                                    <td></td>
                                                    <td>{{ $admin->email }}</td>
                                                    <td>{{ "+".$admin->residence->indicatif ." ".$admin->contact1 }}</td>
                                                    <td>
                                                        <a class="btn btn-info text-white" href="{{ route('master.link',$admin->lien_parainage) }}">Voir les filleules</a>
                                                        @if($admin->is_locked)
                                                            <button id="{{ $admin->id }}" data-toggle="modal" data-target="#lock" href="#lock" class="btn btn-success lock_id">Débloquer</button>
                                                        @else
                                                            <button id="{{ $admin->id }}" class="btn btn-warning lock_id" data-toggle="modal" data-target="#lock" href="#lock">Bloquer</button>
                                                        @endif
                                                        <button id="{{ $admin->id }}" class="btn btn-danger delete_id" data-toggle="modal" data-target="#delete" href="#delete">Supprimer</button>
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Data table area End-->
        <div class="modal" id="lock">
             <div class="modal-dialog modal-confirm">
                <div class="modal-content">
                    <div class="modal-header flex-column">
                        <h4 class="modal-title w-100">Etes vous sure?</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Voulez vous réelement effectuer cette action ? </p>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <button type="button" class="btn btn-danger ok">Valider</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal" id="delete">
             <div class="modal-dialog modal-confirm">
                <div class="modal-content">
                    <div class="modal-header flex-column">
                        <h4 class="modal-title w-100">Etes vous sure?</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Voulez vous réelement supprimer cet utilisateur ? </p>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <button type="button" class="btn btn-danger ok">Valider</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('form-modal')
    <form action="{{ route('administrator.add') }}" method="post" id="add-form">
        <div class="modal-header flex-column text-center bg-primary">
            <h4 class="modal-title w-100">Ajouter un nouveau master</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">
                 @csrf
                  <div class="form-group">
                    <label for="nom">Nom : </label>
                    <input type="text" name="nom" id="nom" class="form-control">
                    <span class="text-danger" id="nom-error"> </span>
                </div>
                <div class="form-group">
                    <label for="prenoms">Prénom(s) : </label>
                    <input type="text" name="prenoms" id="prenoms" class="form-control">
                    <span class="text-danger" id="prenoms-error"> </span>
                </div>
                <div class="form-group">
                    <label for="email">Email : </label>
                    <input type="email" name="email" id="email" class="form-control">
                    <span class="text-danger" id="email-error"> </span>
                </div>
                <div class="form-group">
                    <label for="contact">Contact : </label>
                    <input type="number" name="contact1" id="contact" class="form-control">
                    <span class="text-danger" id="contact-error"> </span>
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe : </label>
                    <input type="password" name="password" id="password" class="form-control">
                    <span class="text-danger" id="password-error"> </span>
                </div>
        </div>
        <div class="modal-footer justify-content-center">
            <button type="reset" class="btn btn-default btn-reset" data-dismiss="modal">Annuler</button>
            <button type="submit" class="btn btn-primary">Valider</button>
        </div>
    </form>
@endsection

@section('mesScripts')
    <script type="text/javascript">
        $(document).ready(function(){
            let user_id = "";
            $('#result-zone').hide();
            $('.btn-reset').click(function(e){
                e.preventDefault();
                $("#nom-error").text("");
                $("#prenoms-error").text("");
                $("#contact-error").text("");
                $("#password-error").text("");
                $("#form").hide();
            });

            //lock or unlock
            $('.lock_id').click(function(e){
                user_id = this.id;
            });

            $('#lock .ok').click(function(e){
                e.preventDefault();
                $.ajax({
                    url : "/administrateurs/lou/"+user_id,
                    type : "GET",
                    success : function()
                    {
                        location.reload()
                    }
                });
            });


            //delete
            $('.delete_id').click(function(e){
                user_id = this.id;
            });

            $('#delete .ok').click(function(e){
                e.preventDefault();
                $.ajax({
                    url : "/masters/deleteMasters/"+user_id,
                    type : "GET",
                    success : function()
                    {
                        location.reload()
                    }
                });
            });

            //submit form
            $('#add-form').on('submit',function(e){
                e.preventDefault();
                $.ajax({
                    url : "{{ route('master.add') }}",
                    type : "POST",
                    data : $('#add-form').serialize(),
                    success : function(data){
                        if(data.errors){
                            $("#nom-error").text(data.errors[0]);
                            $("#prenoms-error").text(data.errors[1]);
                            $("#contact-error").text(data.errors[2]);
                            $("#password-error").text(data.errors[3]);
                        }
                        if(data.error){
                            $('#result-zone').show();
                            $('error-disp strong').text(data.error);
                            $('success-disp').hide();

                        }
                        if(data.success)
                        {
                            $('error-disp').hide();
                            $("#nom-error").text("");
                            $("#prenoms-error").text("");
                            $("#contact-error").text("");
                            $("#password-error").text("");
                            $("#form").modal("hide");
                            $('error-disp strong').text("");
                            $('#result-zone').show();

                            $('success-disp strong').text(data.success);


                           setTimeout(function(){

                                $('#result-zone').hide();
                                $('success-disp strong').text("");
                                $('error-disp strong').text("");
                                location.reload();
                            }, 3000);
                        }
                    }
                })
            });
        })
    </script>
@endsection
