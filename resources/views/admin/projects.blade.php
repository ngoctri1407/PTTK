@extends('admin.sidebar')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>List Project</h5>

                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-5 m-b-xs">
                        </div>
                        <div class="col-sm-4 m-b-xs">
                        </div>
                        <div class="col-sm-3">
                            <a style="float: right;" href="project/new" class="btn btn-success manage" data-action="new" type="button"><i class="fa fa-plus"></i>&nbsp;&nbsp;<span style="font-size: 13px">New Project</span></a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr style="text-align: center">
                                <th width="40%">Name</th>
                                <th width="40%">Address</th>
                                <th width="5%"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if($lstproject != null)
                            {
                                foreach ($lstproject as $project)
                                {
                                    echo "<tr data-id='".$project->id."'>";
                                    echo "<td style='vertical-align: middle;'><a href='project/edit/$project->id'>". $project->name_en . "</a></td>";
                                    echo "<td style='vertical-align: middle;'>". $project->address . "</td>";
                                    echo "<td style='text-align: right'><a title='Delete' href='project/delete/$project->id' style='margin-bottom: 0px' class='btn btn-danger btn-circle delete'>
                                                                            <i class='fa fa-times'></i>
                                                                            </a></td>";
                                    echo "</tr>";
                                }
                            }
                            if(count($lstproject) == 0)
                            {
                                echo "<td>No data found</td>";
                                echo "<td></td>";
                                echo "<td></td>";
                            }
                            ?>
                            </tbody>
                        </table>
                        <div id="paging" style="text-align:center;">
                            {!! $lstproject->render() !!}
                        </div>
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
    </script>
@stop
