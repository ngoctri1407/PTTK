@extends('admin.sidebar')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>List Inside Amenities </h5>

                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-5 m-b-xs">
                        </div>
                        <div class="col-sm-4 m-b-xs">
                        </div>
                        <div class="col-sm-3">
                            <a style="float: right;" class="btn btn-success manage" data-action="new" type="button"><i class="fa fa-plus"></i>&nbsp;&nbsp;<span style="font-size: 13px">New Inside Facilities</span></a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th># </th>
                                <th>English Name</th>
                                <th>Vietnameses Name</th>
                                <th style="text-align: right"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if($lstamenities != null)
                            {
                                $index = 1;
                                foreach ($lstamenities as $amenities)
                                {
                                    echo "<tr data-id='".$amenities->id."'>";
                                    echo "<td style='vertical-align: middle;'>". $index++ ."</td>";
                                    echo "<td style='vertical-align: middle;'>". $amenities->name_en . "</td>";
                                    echo "<td style='vertical-align: middle;'>". $amenities->name_vi . "</td>";
                                    echo "<td style='text-align: right'><a data-action='edit' style='margin-bottom: 0px' class='btn btn-warning btn-circle btn-outline manage'>
                                                                            <i class='fa fa-edit'></i></a>

                                                                            <a href='amenities/delete/$amenities->id' style='margin-bottom: 0px' class='btn btn-danger btn-circle delete'>
                                                                            <i class='fa fa-times'></i>
                                                                            </a></td>";
                                    echo "</tr>";
                                }
                            }
                            ?>
                            </tbody>
                        </table>
                        <div id="paging" style="text-align:center;">
                            {!! $lstamenities->render() !!}
                        </div>
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
                    <h6 style="font-size: 16px; font-weight: bold" class="modal-title">Manage Inside Facilities</h6>
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
                    <div class="form-group" >
                        <div class="col-md-4">
                            Vietnamese Name
                        </div>
                        <div class="col-md-8">
                            <input id="nameviselected" type="text" name="name" class="form-control" required="">
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
        $(function() {
            $("#nameselected").focus();
        });
        $(document).on('click', '.manage', function () {
            var action = $(this).data("action");
            if(action == "new")
            {
                $("#nameselected").val('');
                $("#idselected").val('');
                $("#nameviselected").val('');
                $('#myModal').modal('show');
            }
            if(action == "edit")
            {
                var row = $(this).closest("tr");
                var id = row.data("id");
                var name = row.find('td:eq(1)').text();
                var namevi = row.find('td:eq(2)').text();
                $("#idselected").val(id);
                $("#nameselected").val(name);
                $("#nameviselected").val(namevi);
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
                Command: toastr["error"]("The name amenities is a required !!!")

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
                        url: './inside/manage',
                        data: {
                            _token: CSRF_TOKEN,
                            name : $('#nameselected').val(),
                            namevi : $('#nameviselected').val(),
                        },
                        success: function(data) {
                            if(data == "ER")
                            {

                                Command: toastr["error"]("Amenities already exists !!!")

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
                                Command: toastr["success"]("Add new amenities success !!!")

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
                        url: './inside/manage',
                        data: {
                            id: id,
                            _token: CSRF_TOKEN,
                            name : $('#nameselected').val(),
                            namevi : $('#nameviselected').val(),
                        },
                        success: function(data) {
                            if(data == "ER")
                            {

                                Command: toastr["error"]("Amenities already exists !!!")

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
                                Command: toastr["success"]("Update amenities success !!!")

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
