@extends('admin.sidebar')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>List Agent </h5>

                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-5 m-b-xs">
                        </div>
                        <div class="col-sm-4 m-b-xs">
                        </div>
                        <div class="col-sm-3">
                            <a href=newauthor style="float: right;" class="btn btn-success manage" data-action="new" type="button"><i class="fa fa-plus"></i>&nbsp;&nbsp;<span style="font-size: 13px">New Agent</span></a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Office</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if($lstauthor != null)
                            {
                                $index = 1;
                                foreach ($lstauthor->reverse() as $author)
                                {
                                    echo "<tr data-id='".$author->id."'>";
                                    echo "<td style='vertical-align: middle;'>". $index++ ."</td>";
                                    echo "<td style='vertical-align: middle;'>". $author->name . "</td>";
                                    echo "<td style='vertical-align: middle;'>". $author->phone . "</td>";
                                    echo "<td style='vertical-align: middle;'>". $author->email . "</td>";
                                    echo "<td style='vertical-align: middle;'>". $author->office . "</td>";
                                    echo "<td style='text-align: right'><a href='author/edit/$author->id' data-action='edit' style='margin-bottom: 0px' class='btn btn-warning btn-circle btn-outline manage'>
                                                                            <i class='fa fa-edit'></i></a>

                                                                            <a href='author/delete/$author->id' style='margin-bottom: 0px' class='btn btn-danger btn-circle delete'>
                                                                            <i class='fa fa-times'></i>
                                                                            </a></td>";
                                    echo "</tr>";
                                }
                            }
                            ?>
                            </tbody>
                        </table>
                        <div id="paging" style="text-align:center;">
                            {!! $lstauthor->render() !!}
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