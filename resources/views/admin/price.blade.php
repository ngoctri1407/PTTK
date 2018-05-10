@extends('admin.sidebar')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>List Price </h5>

                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-5 m-b-xs">
                        </div>
                        <div class="col-sm-4 m-b-xs">
                        </div>
                        <div class="col-sm-3">
                            <a style="float: right;" class="btn btn-success manage" data-action="new" type="button"><i class="fa fa-plus"></i>&nbsp;&nbsp;<span style="font-size: 13px">New Price</span></a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th># </th>
                                <th>Name</th>
                                <th style="text-align: right"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if($lstprice != null)
                            {
                                $index = 1;
                                foreach ($lstprice->reverse() as $price)
                                {
                                    echo "<tr data-id='".$price->id."'>";
                                    echo "<td style='vertical-align: middle;'>". $index++ ."</td>";
                                    echo "<td style='vertical-align: middle;'>". $price->name . "</td>";
                                    echo "<td style='text-align: right'><a data-action='edit' style='margin-bottom: 0px' class='btn btn-warning btn-circle btn-outline manage'>
                                                                            <i class='fa fa-edit'></i></a>

                                                                            <a href='price/delete/$price->id' style='margin-bottom: 0px' class='btn btn-danger btn-circle delete'>
                                                                            <i class='fa fa-times'></i>
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
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Manage Price</h4>
                </div>
                <div class="modal-body">
                    <div class="col-md-3">
                        Name
                    </div>
                    <div class="col-md-9">
                        <meta name="csrf-token" content="{{ csrf_token() }}" />
                        <input value="" id="idselected" type="text" name="id" hidden>
                        <input id="nameselected" type="text" name="name" class="form-control" required>
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
                $('#myModal').modal('show');
            }
            if(action == "edit")
            {
                var row = $(this).closest("tr");
                var id = row.data("id");
                var name = row.find('td:eq(1)').text();
                $("#idselected").val(id);
                $("#nameselected").val(name);
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
                Command: toastr["error"]("The name price is a required !!!")

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
                        url: './price/manage',
                        data: {
                            _token: CSRF_TOKEN,
                            name : $('#nameselected').val()
                        },
                        success: function(data) {
                            console.log(data);
                            if(data == "ER")
                            {

                                Command: toastr["error"]("Price already exists !!!")

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
                                Command: toastr["success"]("Add new price success !!!")

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
                        url: './price/manage',
                        data: {
                            id: id,
                            _token: CSRF_TOKEN,
                            name : $('#nameselected').val()
                        },
                        success: function(data) {
                            if(data == "ER")
                            {

                                Command: toastr["error"]("Price already exists !!!")

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
                                Command: toastr["success"]("Update price success !!!")

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
