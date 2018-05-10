@extends('admin.sidebar')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>List News </h5>

                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-5 m-b-xs">
                        </div>
                        <div class="col-sm-4 m-b-xs">
                        </div>
                        <div class="col-sm-3">
                            <a style="float: right;" class="btn btn-success manage" href="news/index" type="button"><i class="fa fa-plus"></i>&nbsp;&nbsp;<span style="font-size: 13px">New Posts</span></a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>English Title</th>
                                <th>Vietnamese Title</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if($lstnew != null)
                            {
                                $index = 1;
                                foreach ($lstnew->reverse() as $new)
                                {
                                    echo "<tr data-id='".$new->id."'>";
                                    echo "<td style='vertical-align: middle;'>". $index++ ."</td>";
                                    echo "<td style='vertical-align: middle;'><a href='news/edit/$new->id'>". $new->title_en . "</a></td>";
                                    echo "<td style='vertical-align: middle;'><a href='news/edit/$new->id'>". $new->title_vi . "</a></td>";
                                    echo "<td style='text-align: right'>
                                             <a href='news/edit/$new->id' style='margin-bottom: 0px' class='btn btn-warning btn-circle btn-outline manage'>
                                             <i class='fa fa-edit'></i></a>
                                             <a href='news/delete/$new->id' style='margin-bottom: 0px' class='btn btn-danger btn-circle delete'>
                                             <i class='fa fa-times'></i></a>
                                          </td>";
                                    echo "</tr>";
                                }
                            }
                            ?>
                            </tbody>
                        </table>
                        <div id="paging" style="text-align:center;">
                            {!! $lstnew->render() !!}
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