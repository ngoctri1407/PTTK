@extends('admin.sidebar')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Setting background header Image</h5>
                </div>
                <div class="ibox-content">
                    {!! Form::open(array('url' => generateUrl('admin') . '/setting/manage', 'class'=>'search-form', 'files'=>true)) !!}
                    <div class="form-group">
                        <input type="text" name="id" value="" hidden>
                    </div>
                    <div class="col-lg-12">
           			<img class="fix-width col-md-6" src="{{ generateUrl('/public') }}/images/bg/banner-bg.jpg">
                    <div class="form-group col-md-6">
                        <label>Upload Image</label>
                        	<input id="image" name="image" type="file"/> 
                    </div>
                    <br/>

                
            
        </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Save">
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <div id="myModal" class="modal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h6 style="font-size: 16px; font-weight: bold" class="modal-title">Processing...</h6>
                </div>
                <div class="modal-body" style="min-height: 100px;">
                    <div class="col-md-4">

                    </div>
                    <div class="col-md-4">
                        <img style="margin-left: 35px;" src="{{generateAsset('public/images/loading.gif')}}" height="50px" width="50px">
                    </div>
                    <div class="col-md-4">

                    </div>

                </div>
            </div>

        </div>
    </div>
   
@stop
@section('page-script')

    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script src="{{ generateAsset('public/js/jquery-2.1.1.js') }}"></script>
    <link rel="stylesheet" href="{{ generateAsset('public/css/dropzone.css') }}">
    <script src="{{ generateAsset('public/js/dropzone.js') }}"></script>
    <script type="text/javascript">
        var baseUrl = "{{ generateUrl('/') }}";
        Dropzone.autoDiscover = false;
        var myDropzone = new Dropzone("div#dropzoneFileUpload", {
            url: baseUrl + "/admin/setting/manage",
            autoProcessQueue:false,
            addRemoveLinks: true,

            init: function () {
                this.on("queuecomplete", function (file) {

                    Command: toastr["success"]("Add new project success !!!")

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
                    window.location = document.referrer;
                });
            }

        });
        
        $("#submit").click(function (e) {
            $('#myModal').modal('show');
            var frm = $('#form');
            frm.submit(function (ev) {
                $.ajax({
                    type: frm.attr('method'),
                    url: frm.attr('action'),
                    data: frm.serialize(),
                    success: function (data) {
                        if (myDropzone.getQueuedFiles().length > 0) {
                            myDropzone.on("sending", function(file, xhr, formData){
                                formData.append("id", data);
                            });
                            myDropzone.processQueue();
                        }

                    }
                });

                ev.preventDefault();
            });

        });

    </script>
@stop
