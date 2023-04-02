    @extends('layouts.admin')
    @section('title', 'ニュースの新規作成')
    
    @section('content')
        <div class="container">
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <h2>ニュース新規作成</h2>
                    <form action='#' method="post" enctype="multipart/form-data">
                    
                        @if (count($errors) > 0)
                            <ul>
                                @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                                @endforeach
                            </ul>
                        @endif
                        </div>
                            <div class="col-md-10">
                                @foreach($categories as $category)
                                <input type="radio" name="category" id={{$category->name}} value={{$category->id}} {{ old('category') == 'dog' ? 'checked' : '' }}>{{$category->name}}
                                @endforeach
                            </div>
                                                <div class="form-group row">
                            <label class="col-md-2">タイトル</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                            </div>
                        </div>
                        <div class="form-group-row">
                            <label class="col-md-2">本文</label>
                            <div class="col-md-10">
                                <textarea class="form-control" name="body" rows="20">{{ old('body') }}</textarea>
                            </div>
                        <div class="form-group row">
                            <label class="col-md-2">画像</label>
                            <div class="col-md-10">
                                <input type="file" class="form-control-file" name="image">
                            </div>
                        </div>
                        @csrf
                        <input type="submit" class="btn btn-primary" value="登録">
                    </form>
                </div>
            </div>
        </div>
    @endsection
    