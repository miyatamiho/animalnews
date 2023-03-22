    @extends('layouts.admin')
    @section('title', '動物ニュースの新規作成')
    
    @section('content')
        <div class="container">
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <h2>動物ニュース新規作成</h2>
                    <form action={{route('admin.animalnews.create') }} method="post" enctype="multipart/form-data">
                    
                        @if (count($errors) > 0)
                            <ul>
                                @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <div class="form-group row">
                            <label class="col-md-2">タイトル</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2">コンテンツ</label>
                            <div class="col-md-10">
                                <input type="radio" name="content" id="dog" value="dog" {{ old('content') == 'dog' ? 'checked' : '' }}>犬
                                <input type="radio" name="content" id="cat" value="cat" {{ old('content') == 'cat' ? 'checked' : '' }}>猫
                                <input type="radio" name="content" id="bird" value="bird" {{ old('content') == 'bird' ? 'checked' : '' }}>鳥
                            </div>
                        </div>
                        <div class="form-group-row">
                            <label class="col-md-2">本文</label>
                            <div class="col-md-10">
                                <textarea class="form-control" name="body" rows="20">{{ old('body') }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2">画像</label>
                            <div class="col-md-10">
                                <input type="file" class="form-control-file" name="image">
                            </div>
                        </div>
                        @csrf
                        <input type="submit" class="btn btn-primary" value="更新">
                    </form>
                </div>
            </div>
        </div>
    @endsection
    