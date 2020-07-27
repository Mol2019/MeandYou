@extends('app.layouts.default',["title" => "Gestion des packs"])

@section('content')
 <!-- Data table area Start-->
        <div class="admin-dashone-data-table-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="sparkline8-list shadow-reset">
                            <div class="sparkline8-hd">
                                <div class="main-sparkline8-hd">
                                    <h1>Gestion des packs</h1>
                                    <div class="sparkline8-outline-icon">
                                        <button class="btn btn-primary add" data-toggle="modal" data-target="#form" href="#form">
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
                                                <th data-field="titre" data-editable="true">titre</th>
                                                <th data-field="montant" data-editable="true">Montant</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($data as $pack)
                                                <tr>
                                                    <td></td>
                                                    <td>{{ $pack->titre }}</td>
                                                    <td>{{ $pack->montant }}</td>
                                                    <td>
                                                        <button id="{{ $pack->id }}" class="btn btn-info edit_id" data-toggle="modal" data-target="#edit">Modifier</button>
                                                        <button id="{{ $pack->id }}" class="btn btn-danger delete_id" data-toggle="modal" data-target="#delete" href="#delete">Supprimer</button>
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
        <div class="modal" id="edit">
            <div class="modal-dialog modal-confirm">
                <div class="modal-content">
                    <form action="" method="post" id="update-form">
        <div class="modal-header flex-column text-center bg-primary">
            <h4 class="modal-title w-100">Modifier un pack</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">
                 @csrf
                  <div class="form-group">
                    <label for="titre">Titre : </label>
                    <input type="text" name="titre" id="titre" class="form-control">
                    <span class="text-danger" id="titre-error"> </span>
                </div>
                <div class="form-group">
                    <label for="montant">Montant : </label>
                    <input type="text" name="montant" id="montant" class="form-control">
                    <span class="text-danger" id="montant-error"> </span>
                </div>
                <input type="hidden" name="hidden_id" id="hidden_id" >
         </div>
        <div class="modal-footer justify-content-center">
            <button type="reset" class="btn btn-default btn-reset" data-dismiss="modal">Annuler</button>
            <button type="submit" class="btn btn-primary">Valider</button>
        </div>
    </form>
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
    <form action="{{ route('pack.create') }}" method="post" id="add-form">
        <div class="modal-header flex-column text-center bg-primary">
            <h4 class="modal-title w-100">Ajouter un nouveau pack</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">
                 @csrf
                  <div class="form-group">
                    <label for="titre">Titre : </label>
                    <input type="text" name="titre" id="titre" class="form-control">
                    <span class="text-danger" id="titre-error"> </span>
                </div>
                <div class="form-group">
                    <label for="montant">Montant : </label>
                    <input type="text" name="montant" id="montant" class="form-control">
                    <span class="text-danger" id="montant-error"> </span>
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
            let pack_id = "";
            $('#result-zone').hide();
            $('.btn-reset').click(function(e){
                e.preventDefault();
                $("#titre-error").text("");
                $("#montant-error").text("");
                $("#form").hide();
            });

            $('.add').click(function(e){
                $("#montant").val("");
                $("#titre").val("");

            })


            //edit or unedit
            $('.edit_id').click(function(e){
                e.preventDefault();
                pack_id = this.id;
                $.ajax({
                    url : "/packs/edit/"+pack_id,
                    type : "GET",
                    success : function(data)
                    {
                        $("#edit #montant").val(data.data.montant);
                        $("#edit #titre").val(data.data.titre);
                        $("#edit #hidden_id").val(data.data.id);
                    }
                });
            });


            //delete
            $('.delete_id').click(function(e){
                pack_id = this.id;
            });

            $('#delete .ok').click(function(e){
                e.preventDefault();
                $.ajax({
                    url : "/packs/delete/"+pack_id,
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
                    url : "{{ route('pack.create') }}",
                    type : "POST",
                    data : $('#add-form').serialize(),
                    success : function(data){
                        if(data.errors){
                            $("#titre-error").text(data.errors[0]);
                            $("#montant-error").text(data.errors[1]);
                        }
                        if(data.error){
                            $('#result-zone').show();
                            $('error-disp strong').text(data.error);
                            $('success-disp').hide();

                        }
                        if(data.success)
                        {
                            $('error-disp').hide();
                            $("#titre-error").text("");
                            $("#montant-error").text("");
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

            //submit form
            $('#update-form').on('submit',function(e){
                e.preventDefault();
                $.ajax({
                    url : "{{ route('pack.update') }}",
                    type : "POST",
                    data : $('#update-form').serialize(),
                    success : function(data){
                        if(data.errors){
                            $("#edit #titre-error").text(data.errors[0]);
                            $("#edit #montant-error").text(data.errors[1]);
                        }
                        if(data.error){
                            $('#result-zone').show();
                            $('error-disp strong').text(data.error);
                            $('success-disp').hide();

                        }
                        if(data.success)
                        {
                            $('error-disp').hide();
                            $("#edit #titre-error").text("");
                            $("#edit #montant-error").text("");
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
