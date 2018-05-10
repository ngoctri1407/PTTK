@extends('admin.sidebar')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>List Real Estate </h5>

                </div>
                <div class="ibox-content">

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th># </th>
                                <th>English Name</th>
                                <th>Vietnamese Name</th>
                                <th>Type</th>
                                <th>Code</th>
                                <th style="text-align: right"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if($lstrealestate != null)
                            {
                                $index = 1;
                                foreach ($lstrealestate as $realestate)
                                {
                                    echo "<tr data-id='".$realestate->id."'>";
                                    echo "<td style='vertical-align: middle;'>". $index++ ."</td>";
                                    echo "<td style='vertical-align: middle;'>". $realestate->name_en . "</td>";
                                    echo "<td style='vertical-align: middle;'>". $realestate->name_vi . "</td>";
                                    if($realestate->type== 1)
                                    {
                                        echo "<td style='vertical-align: middle;'>Rent</td>";
                                    }
                                    else
                                    {
                                        echo "<td style='vertical-align: middle;'>Sales</td>";
                                    }
                                    echo "<td style='vertical-align: middle;'>". $realestate->code . "</td>";
                                    echo "<td style='text-align: right'><a data-action='edit' style='margin-bottom: 0px' class='btn btn-warning btn-circle btn-outline manage'>
                                                                            <i class='fa fa-edit'></i></a>
                                                                            </a></td>";
                                    echo "</tr>";
                                }
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div id="myModal" class="modal inmodal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h6 style="font-size: 16px; font-weight: bold" class="modal-title">Manage Real Estate</h6>
                </div>
                <div class="modal-body">
                    <div class="form-group" style="margin-bottom: 50px;">
                        <div class="col-md-4">
                            English Name
                        </div>
                        <div class="col-md-8" >
                            <meta name="csrf-token" content="{{ csrf_token() }}" />
                            <input value="" id="idselected" type="text" name="id" hidden>
                            <input id="nameselected" type="text" name="name" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group" style="margin-bottom: 100px;">
                        <div class="col-md-4">
                            Vietnamese Name
                        </div>
                        <div class="col-md-8">
                            <input id="nameviselected" type="text" name="name" class="form-control" required="">
                        </div>
                    </div>
                    <div class="form-group" >
                        <div class="col-md-4">
                            Code
                        </div>
                        <div class="col-md-8">
                            <input id="codeselected" type="text" name="name" class="form-control" required="">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-success save" value="Save"/>
                </div>
            </div>

        </div>
    </div>
@stop
@section('page-script')
    <script src="{{ generateAsset('public/js/jquery-2.1.1.js') }}"></script>
    <script type="text/javascript">
        $(document).on('click', '.manage', function () {
            var action = $(this).data("action");
            if(action == "new")
            {
                $("#nameselected").val('');
                $("#nameviselected").val('');
                $("#idselected").val('');
                $("#codeselected").val('');
                $('#myModal').modal('show');
            }
            if(action == "edit")
            {
                var row = $(this).closest("tr");
                var id = row.data("id");
                var name = row.find('td:eq(1)').text();
                var namevi = row.find('td:eq(2)').text();
                var code = row.find('td:eq(4)').text();
                $("#idselected").val(id);
                $("#nameselected").val(name);
                $("#nameviselected").val(namevi);
                $("#codeselected").val(code);
                $('#myModal').modal('show');
            }

        });
        $(document).on('click', '.delete', function () {
            var question = confirm("Do you really want to delete ?");
            if (question == true) {
                return true;
            }
            else
                return false;
        });
        $(document).on('click', '.save', function () {
            var id = $("#idselected").val();
            if($("#nameselected").val() == "")
            {
                Command: toastr["error"]("The name real estate is a required !!!")

                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }
            }
            else
            {
                if(id == "")
                {
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        type: "POST",
                        url: './realestate/manage',
                        data: {
                            id : "",
                            _token: CSRF_TOKEN,
                            name : $('#nameselected').val(),
                            namevi: $("#nameviselected").val(),
                            code : $("#codeselected").val()
                        },
                        success: function(data) {
                            if(data == "ER")
                            {

                                Command: toastr["error"]("Real estate already exists !!!")

                                toastr.options = {
                                    "closeButton": false,
                                    "debug": false,
                                    "newestOnTop": false,
                                    "progressBar": false,
                                    "positionClass": "toast-top-right",
                                    "preventDuplicates": false,
                                    "onclick": null,
                                    "showDuration": "300",
                                    "hideDuration": "1000",
                                    "timeOut": "5000",
                                    "extendedTimeOut": "1000",
                                    "hideEasing": "linear",
                                    "showMethod": "fadeIn",
                                    "hideMethod": "fadeOut"
                                }

                            }
                            if(data == "OK")
                            {
                                Command: toastr["success"]("Add new real estate success !!!")

                                toastr.options = {
                                    "closeButton": false,
                                    "debug": false,
                                    "newestOnTop": false,
                                    "progressBar": false,
                                    "positionClass": "toast-top-right",
                                    "preventDuplicates": false,
                                    "onclick": null,
                                    "showDuration": "300",
                                    "hideDuration": "1000",
                                    "timeOut": "5000",
                                    "extendedTimeOut": "1000",
                                    "hideEasing": "linear",
                                    "showMethod": "fadeIn",
                                    "hideMethod": "fadeOut"
                                }
                                location.reload();
                            }
                        }
                    })
                }
                else
                {
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        type: "POST",
                        url: './realestate/manage',
                        data: {
                            id: id,
                            _token: CSRF_TOKEN,
                            name : $('#nameselected').val(),
                            namevi: $("#nameviselected").val(),
                            code : $('#codeselected').val(),
                        },
                        success: function(data) {
                            if(data == "ER")
                            {

                                Command: toastr["error"]("Real estate already exists !!!")

                                toastr.options = {
                                    "closeButton": false,
                                    "debug": false,
                                    "newestOnTop": false,
                                    "progressBar": false,
                                    "positionClass": "toast-top-right",
                                    "preventDuplicates": false,
                                    "onclick": null,
                                    "showDuration": "300",
                                    "hideDuration": "1000",
                                    "timeOut": "5000",
                                    "extendedTimeOut": "1000",
                                    "hideEasing": "linear",
                                    "showMethod": "fadeIn",
                                    "hideMethod": "fadeOut"
                                }

                            }
                            if(data == "OK")
                            {
                                Command: toastr["success"]("Update real estate success !!!")

                                toastr.options = {
                                    "closeButton": false,
                                    "debug": false,
                                    "newestOnTop": false,
                                    "progressBar": false,
                                    "positionClass": "toast-top-right",
                                    "preventDuplicates": false,
                                    "onclick": null,
                                    "showDuration": "300",
                                    "hideDuration": "1000",
                                    "timeOut": "5000",
                                    "extendedTimeOut": "1000",
                                    "hideEasing": "linear",
                                    "showMethod": "fadeIn",
                                    "hideMethod": "fadeOut"
                                }
                                location.reload();
                            }
                        }
                    })
                }
            }
        });
    </script>
@stop