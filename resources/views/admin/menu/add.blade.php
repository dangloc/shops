@extends('admin.main')

@section('head')
    <script src="/ckeditor/ckeditor.js"></script>
@endsection

@section('content')
    <form action="" method="POST">
        @csrf
        <div class="card-body">

            <div class="form-group">
                <label for="menu">Category name</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Enter name">
            </div>


            <div class="form-group">
                <label>Category parent</label>
                <select class="form-control" id="" name="parent_id">
                    <option value="0">Category parent</option>
                    @foreach($menus as $key)
                    <option value="{{$key->id}}">{{$key->name}}</option>
                    @endforeach
                </select>
            </div>


            <div class="form-group">
                <label>Descripttion</label>
                <textarea name="description" id="" class="form-control"></textarea>
            </div>


            <div class="form-group">
                <label for="menu">Content</label>
                <textarea name="content" id="content" class="form-control"></textarea>
            </div>


            <div class="form-group">
                <label for="">Active</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="1" type="radio" id="active" name="active" checked="">
                    <label for="active" class="custom-control-label">Yes</label>
                </div>

                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="0" type="radio" id="no_active" name="active" >
                    <label for="no_active" class="custom-control-label">No</label>
                  </div>
            </div>

        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
@endsection


@section('footer')
    <script>
        CKEDITOR.replace('content');
    </script>
@endsection