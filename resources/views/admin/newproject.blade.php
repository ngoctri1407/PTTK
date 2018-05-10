@extends('admin.sidebar')
@section('content')
<div class="row">
  <div class="col-lg-12">
    <div class="ibox float-e-margins">
      <div class="ibox-title">
        <h5>New Project </h5>
      </div>
      <div class="ibox-content">
        {!! Form::open(array('url' => generateUrl('admin') . '/project/manage','files'=>true, 'id' =>'form')) !!}
        <div class="form-group">
          <input type="text" name="id" value="0" hidden>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="panel blank-panel">
              <div class="panel-heading" style="padding: 0px">
                <div class="panel-options">
                  <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#tab-1" aria-expanded="true">English</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-2" aria-expanded="false">Vietnamese</a></li>
                  </ul>
                </div>
              </div>
              <div class="panel-body">
                <div class="tab-content">
                  <div id="tab-1" class="tab-pane active">
                    <div class="row">
                      <label>English Name</label>
                      <input name="name" type="text" class="form-control" required="" aria-required="true">
                    </div>
                    <div class="row" style="margin-top: 15px">
                      <label>English Description</label>
                      <textarea name="description" id="content" class="form-control">
                                                </textarea>
                      <script src="{{ generateAsset('public/ckeditor/ckeditor.js') }}"></script>
                      <script>
                        CKEDITOR.replace('content');
                      </script>
                    </div>
                  </div>
                  <div id="tab-2" class="tab-pane">
                    <div class="row">
                      <label>Vietnamese Name</label>
                      <input name="namevi" type="text" class="form-control" required="" aria-required="true">
                    </div>
                    <div class="row" style="margin-top: 15px">
                      <label>Vietnamese Description</label>
                      <textarea name="descriptionvi" id="contentvi" class="form-control">
                                                </textarea>
                      <script src="{{ generateAsset('public/ckeditor/ckeditor.js') }}"></script>
                      <script>
                        CKEDITOR.replace('contentvi');
                      </script>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label>Investor</label>
          <input name="investor" type="text" class="form-control" required="" aria-required="true">
        </div>
        <div class="form-group">
          <label>Address</label>
          <input name="address" type="text" class="form-control" required="" aria-required="true" id="address">
        </div>
        <div class="form-group">
          <label>Sell Price</label>
          <input name="sellprice" type="text" class="form-control" required="" aria-required="true">
        </div>
        <div class="form-group">
          <label>Lease Price</label>
          <input name="leaseprice" type="text" class="form-control" required="" aria-required="true">
        </div>
        <div class="form-group">
          <label>Agent </label>
          <select name="author" class="form-control">
            <?php
            foreach ($lstagent as $agent) {
              echo "<option value='$agent->id'>$agent->name</option>";
            }
            ?>
          </select>
        </div>
        <div class="form-group">
          <label>Code</label>
          <select name="code" class="form-control">
            <?php
            echo "<option value='EP' >Existed Project (EP)</option>";
            echo "<option value='NP' >New Project (NP)</option>";
            echo "<option value='UP'>Upcoming Project (UP)</option>";
            ?>
          </select>
        </div>
        <div class="ibox float-e-margins">
          <div class="row">
            <div class="col-md-6">
              <label>Inside Facilities</label>
              <div class="select-checkbox"><a><span onclick="selectCheckbox('all', 'inside-amenities-checkbox');">Select All</span></a>
                / <a><span onclick="selectCheckbox('none', 'inside-amenities-checkbox');">Select None</span></a></div>
              <div class="amenities" style="overflow-y: scroll; max-height: 350px; border: 1px solid #e5e6e7">
                <div class="col-md-12">
                  <?php
                  foreach ($lstinsideamenities as $amenities) {
                    echo "<div class='col-md-6'><input type='checkbox' name='amenities[]' value='$amenities->id' class='inside-amenities-checkbox'> $amenities->name_en<br/></div>";
                  }
                  ?>
                </div>

              </div>
            </div>
            <div class="col-md-6">
              <label>Nearby Facilities</label>
              <div class="select-checkbox"><a><span onclick="selectCheckbox('all', 'nearby-amenities-checkbox');">Select All</span></a>
                / <a><span onclick="selectCheckbox('none', 'nearby-amenities-checkbox');">Select None</span></a></div>
              <div class="amenities" style="overflow-y: scroll; max-height: 350px; border: 1px solid #e5e6e7">
                <div class="col-md-12">
                  <?php
                  foreach ($lstnearbyamenities as $amenities) {
                    echo "<div class='col-md-6'><input type='checkbox' name='amenities[]' value='$amenities->id' class='nearby-amenities-checkbox'> $amenities->name_en<br/></div>";
                  }
                  ?>
                </div>

              </div>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label>Project Image</label>
          <div class="dropzone" id="dropzoneFileUpload">
            <div id="uploadme" class="fallback">
              <input id="image" name="image" type="file" multiple/>
            </div>
          </div>
        </div>
        <div class="form-group">
          <a href="{{ generateUrl('/admin/project') }}" class="btn btn-white">Cancel</a>
          <input id="submit" type="submit" class="btn btn-primary" value="Save">
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
          <img style="margin-left: 35px;" src="{{generateAsset('public/images/loading.gif')}}" height="50px"
               width="50px">
        </div>
        <div class="col-md-4">

        </div>

      </div>
    </div>

  </div>
</div>
<div id="myModalE" class="modal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h6 style="font-size: 16px; font-weight: bold" class="modal-title">Error</h6>
      </div>
      <div class="modal-body" style="min-height: 100px;">
        <div class="col-md-12">
          <div class="">
            <strong>
              Please check the inputs , maybe you miss filling something.
            </strong>

          </div>
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
  var valid = 0;
  var baseUrl = "{{ generateUrl('/') }}";
  var token = "{{ Session::getToken() }}";
  Dropzone.autoDiscover = false;
  var myDropzone = new Dropzone("div#dropzoneFileUpload", {
    url: baseUrl + "/admin/project/new/upload",
    params: {
      _token: token
    },
    autoProcessQueue: false,
    addRemoveLinks: true,
    uploadMultiple: true,
    parallelUploads: 100,
    maxFiles: 100,

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
  Dropzone.options.myAwesomeDropzone = {
    paramName: "file", // The name that will be used to transfer the file
    maxFilesize: 5, // MB
    acceptedFiles: ".jpeg,.jpg,.png,.gif,.JPEG,.JPG,.PNG,.GIF",

  };
  $("#submit").click(function (e) {
    var modal = $('#myModal');
    var modalE = $('#myModalE');
    modal.modal('show');
    var frm = $('#form');
    frm.submit(function (ev) {
      valid = 1;
      $.ajax({
        type: frm.attr('method'),
        url: frm.attr('action'),
        data: frm.serialize(),
        success: function (data) {
          if (myDropzone.getQueuedFiles().length > 0) {
            myDropzone.on("sending", function (file, xhr, formData) {
              formData.append("id", data);
            });
            myDropzone.processQueue();
          }

        }
      });
      ev.preventDefault();
    });
    setTimeout(function () {
      if (valid === 0) {
        modal.modal('hide');
        modalE.modal('show');
      }
    }, 1000);

  });

</script>
@stop
