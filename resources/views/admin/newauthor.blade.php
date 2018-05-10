@extends('admin.sidebar')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>New Author </h5>
                </div>
                <div class="ibox-content">
                    {!! Form::open(array('url' => generateUrl('admin') . '/author/manage', 'files'=>true)) !!}
                    <input name="id" type="text" value="0" hidden>
                    <div class="form-group">
                        <label>Name</label>
                        <input name="name" type="text" class="form-control" required="" aria-required="true">
                    </div>
                    <div class="form-group">
                        <label>Title</label>
                        <input name="title" type="text" class="form-control" required="" aria-required="true">
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <input name="phone" type="text" class="form-control" required="" aria-required="true">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input name="email" type="text" class="form-control" required="" aria-required="true">
                    </div>
                    <div class="form-group">
                        <label>Office</label>
                        <input name="office" type="text" class="form-control" required="" aria-required="true">
                    </div>
                    <div class="form-group">
                        <label>Avatar</label>
                        <input name="avatar" type="file" class="form-control" required="" aria-required="true">
                    </div>
                    <div class="form-group">
                        <a href="{{ generateUrl('/admin/author') }}" class="btn btn-white">Cancel</a>
                        <input type="submit" class="btn btn-primary" value="Save">
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop
