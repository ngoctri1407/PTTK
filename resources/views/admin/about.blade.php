@extends('admin.sidebar')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>New Posts </h5>
                </div>
                <div class="ibox-content">
                    {!! Form::open(array('url' => generateUrl('admin') . '/about/manage', 'class'=>'search-form', 'files'=>true)) !!}
                    <div class="form-group">
                        <input type="text" name="id" value="{{ $about->id }}" hidden>
                    </div>


                    <div class="form-group">
                        <label>English Content</label>
                            <textarea name="content" id="content" class="form-control">
                                {{ $about->content_en }}
                            </textarea >
                        <script src="{{ generateAsset('public/ckeditor/ckeditor.js') }}"></script>
                        <script>
                            CKEDITOR.replace( 'content' );
                        </script>
                    </div>
                    <div class="form-group">
                        <label>Vietnamese Content</label>
                            <textarea name="contentvi" id="contentvi" class="form-control">
                                {{ $about->content_vi }}
                            </textarea >
                        <script src="{{ generateAsset('public/ckeditor/ckeditor.js') }}"></script>
                        <script>
                            CKEDITOR.replace( 'contentvi' );
                        </script>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Save">
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop
