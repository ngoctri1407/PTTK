@extends('admin.sidebar')
@section('content')
<div class="row">
  <div class="col-lg-12">
    <div class="ibox float-e-margins">
      <div class="ibox-title">
        <h5>New Project </h5>
      </div>
      <div class="ibox-content">
        {!! Form::open(array('url' => generateUrl('admin') . '/project/manage')) !!}
        <div class="form-group">
          <input type="text" id="id" name="id" value="{{$project->id}}" hidden>
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
                      <input name="name" type="text" value="{{$project->name_en}}" class="form-control" required=""
                             aria-required="true">
                    </div>
                    <div class="row" style="margin-top: 15px">
                      <label>English Description</label>
                      <textarea name="description" id="content" class="form-control">
													{{$project->description_en}}
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
                      <input name="namevi" value="{{$project->name_vi}}" type="text" class="form-control" required=""
                             aria-required="true">
                    </div>
                    <div class="row" style="margin-top: 15px">
                      <label>Vietnamese Description</label>
                      <textarea name="descriptionvi" id="contentvi" class="form-control">
													{{$project->description_vi}}
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
          <input name="investor" type="text" value="{{$project->investor}}" class="form-control" required=""
                 aria-required="true">
        </div>
        <div class="form-group">
          <label>Address</label>
          <input name="address" value="{{$project->address}}" type="text" class="form-control" required=""
                 aria-required="true" id="address">
        </div>
        <div class="form-group">
          <label>Sell Price</label>
          <input name="sellprice" value="{{$project->sell_price}}" type="text" class="form-control" required=""
                 aria-required="true">
        </div>
        <div class="form-group">
          <label>Lease Price</label>
          <input name="leaseprice" value="{{$project->lease_price}}" type="text" class="form-control" required=""
                 aria-required="true">
        </div>
        <div class="form-group">
          <label>Agent </label>
          <select name="author" class="form-control">
            <?php
            foreach ($lstagent as $agent) {
              if ($agent->id == $project->id_author) {
                echo "<option value='$agent->id' selected>$agent->name</option>";
              } else {
                echo "<option value='$agent->id'>$agent->name</option>";
              }
              
            }
            ?>
          </select>
        </div>
        <div class="form-group">
          <label>Code</label>
          <select name="code" class="form-control">
            <?php
            if ($project->code == "EP")
              echo "<option value='EP' selected>Existed Project (EP)</option>";
            else
              echo "<option value='EP'>Existed Project (EP)</option>";
            if ($project->code == "NP")
              echo "<option value='NP' selected>New Project (NP)</option>";
            else
              echo "<option value='NP'>New Project (NP)</option>";
            if ($project->code == "UP")
              echo "<option value='UP' selected>Upcoming Project (UP)</option>";
            else
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
                    $check = false;
                    foreach ($lstamenitiesselected as $selected) {
                      if ($amenities->id == $selected->id_amenities) {
                        echo "<div class='col-md-6'><input type='checkbox' name='amenities[]' value='$amenities->id' checked class='inside-amenities-checkbox'> $amenities->name_en<br/></div>";
                        $check = true;
                        break;
                      }
                    }
                    if ($check == false)
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
                    $check = false;
                    foreach ($lstamenitiesselected as $selected) {
                      if ($amenities->id == $selected->id_amenities) {
                        echo "<div class='col-md-6'><input type='checkbox' name='amenities[]' value='$amenities->id' checked class='nearby-amenities-checkbox'> $amenities->name_en<br/></div>";
                        $check = true;
                        break;
                      }
                    }
                    if ($check == false)
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
          <input type="submit" class="btn btn-primary" value="Save">
        </div>
        {!! Form::close() !!}
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
  var token = "{{ Session::getToken() }}";
  Dropzone.autoDiscover = false;
  var myDropzone = new Dropzone("div#dropzoneFileUpload", {
    url: baseUrl + "/admin/project/edit/editupload",
    params: {
      _token: token,
      id: $("#id").val()
    },
    autoProcessQueue: true,
    addRemoveLinks: true,
    uploadMultiple: true,
    parallelUploads: 100,
    maxFiles: 100,
    init: function () {
      this.on("complete", function (file) {
        if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {
          Command: toastr["success"]("Update image property success !!!")

          toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": true,
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
      });
      this.on("removedfile", function (file) {
        var token = "{{ Session::getToken() }}";
        $.ajax({
          type: "POST",
          url: '././deleteimage',
          data: {
            _token: token,
            id: $("#id").val(),
            id_images: file.name,
          },
          success: function (data) {

          }
        });
      });

      var token = "{{ Session::getToken() }}";
      $.ajax({
        type: "POST",
        url: './listimage',
        data: {
          _token: token,
          id: $("#id").val(),
        },
        success: function (data) {
          $(data).each(function (key, value) {
            var mockFile = {
              name: value.id_images,
              size: 30165,
              type: 'image/jpeg',
              accepted: true,
              status: Dropzone.ADDED
            };
            myDropzone.emit("addedfile", mockFile);
            myDropzone.createThumbnailFromUrl(mockFile, "{{ generateUrl('/public') }}/images/projects/" + value.id_images);
            mockFile.previewElement.classList.add('dz-success');
            mockFile.previewElement.classList.add('dz-complete');
            myDropzone.files.push(mockFile);
          })

        }
      });
    }
  });
  Dropzone.options.myAwesomeDropzone = {
    paramName: "file", // The name that will be used to transfer the file
    maxFilesize: 5, // MB
    acceptedFiles: ".jpeg,.jpg,.png,.gif,.JPEG,.JPG,.PNG,.GIF",


  };
  var frm = $('#form');
  frm.submit(function (ev) {
    //$('#myModal').modal('show');
    $.ajax({
      type: frm.attr('method'),
      url: frm.attr('action'),
      data: frm.serialize(),
      success: function (data) {
        Command: toastr["success"]("Update image project success !!!")

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


      }
    });

    ev.preventDefault();
  });
</script>
@stop
