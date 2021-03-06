@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Create a new Thread</div>

                    <div class="panel-body">
                        <form action="{{ route('threads.store') }}" method="post">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" id="title" name="title" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="body">Body</label>
                                <textarea name="body" id="body" cols="30" rows="10" class="form-control"></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary pull-right">Post</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
