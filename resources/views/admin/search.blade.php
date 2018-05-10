@extends('admin.sidebar')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>List Properties</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-5 m-b-xs">
                        </div>
                        <div class="col-sm-4 m-b-xs">
                        </div>

                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr style="text-align: center">
                                <th width="5%">HOT</th>
                                <th width="5%">ID</th>
                                <th width="35%">Property Title</th>
                                <th width="35%">Address</th>
                                <th width="5%">Price</th>
                                <th width="5%">Beds</th>
                                <th width="5%">Baths</th>
                                <th width="5%"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php

                            if($lstproperties != null)
                            {
                                $i = 0;
                                foreach ($lstproperties as $properties)
                                {
                                    echo "<tr data-id='".$properties->id_key."'>";
                                    if($lsthot[$i] == 0)

                                        echo "<td style='vertical-align: middle; text-align: center'><input id='check_hot' type='checkbox' class='toggle'> </td>";
                                    else
                                        echo "<td style='vertical-align: middle; text-align: center'><input id='check_hot' type='checkbox' class='toggle' checked> </td>";
                                    echo "<td style='vertical-align: middle;'>". $lstcode[$i] . "</td>";
                                    echo "<td style='vertical-align: middle;'><a href='../realestate/edit/$properties->id_key'>". $properties->title_en . "</a></td>";
                                    echo "<td style='vertical-align: middle;'>". $properties->address . "</td>";
                                    echo "<td style='vertical-align: middle;text-align:center'>". $properties->price . "</td>";
                                    echo "<td style='vertical-align: middle;text-align:center'>". $properties->bedroom . "</td>";
                                    echo "<td style='vertical-align: middle;text-align:center'>". $properties->bathroom . "</td>";
                                    echo "<td style='text-align: right'><a title='Delete' href='property/delete/$properties->id_key' style='margin-bottom: 0px' class='btn btn-danger btn-circle delete'>
                                                                            <i class='fa fa-times'></i>
                                                                            </a></td>";
                                    echo "</tr>";
                                    $i++;
                                }
                            }
                            if(count($lstproperties) == 0)
                            {
                                echo "<td></td>";
                                echo "<td></td>";
                                echo "<td>No data found</td>";
                                echo "<td></td>";
                                echo "<td></td>";
                                echo "<td></td>";
                                echo "<td></td>";
                                echo "<td></td>";
                            }
                            ?>
                            </tbody>
                        </table>

                    </div>

                </div>
            </div>
        </div>
    </div>
@stop
@section('page-script')
    <script src="{{ generateAsset('public/js/jquery-2.1.1.js') }}"></script>
    <script type="text/javascript">

        $(document).on('click', '.delete', function () {
            var question = confirm("Do you really want to delete ?");
            if (question == true) {
                return true;
            }
            else
                return false;
        });
        $('input[type=checkbox]').change(function () {
            var token = "{{ Session::getToken() }}";
            var row = $(this).closest("tr");
            var id = row.data("id");
            if ($(this).is(':checked')) {
                $.ajax({
                    url : "./hot/add",
                    data :
                    {
                        _token: token,
                        id : id
                    },
                    type: "POST",
                    success:function(data)
                    {
                        if(data == "OK")
                        {
                            Command: toastr["success"]("Set hot properties success !!!")

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
                    }
                });

            } else {
                $.ajax({
                    url : "./hot/remove",
                    data :
                    {
                        _token: token,
                        id : id
                    },
                    type: "POST",
                    success:function(data)
                    {
                        if(data == "OK")
                        {
                            Command: toastr["error"]("Unset hot properties !!!")

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
                    }
                });
            }
        });
    </script>
@stop