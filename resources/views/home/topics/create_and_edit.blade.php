@extends('home.layouts.app')
@section('title', isset($topic->id) ? '编辑话题'  : ' 新建话题')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/simditor.css') }}">
@stop
@section('content')
    <div class="fourteen column">
        <div class="ui segment">
            <div class="content extra-padding">
                @include('home.common.error')
                <form @if($topic->id) action="{{ route('topics.update', $topic->id) }}" @else action="{{ route('topics.store') }}" @endif method="POST" class="ui form item-form" accept-charset="UTF-8">
                    @if($topic->id)
                        <input type="hidden" name="_method" value="PUT">
                    @endif
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="field">
                        <input class="form-control" type="text" name="title" id="title-field" value="{{ old('title', $topic->title ) }}" required="" placeholder="标题">
                    </div>
                    <div class="field">
                        <select name="category_id" class="ui dropdown" >
                            @foreach ($categories as $categorie)
                                <option value="{{ $categorie->id }}" {{ $topic->category_id == $categorie->id ? 'selected' : '' }}>{{ $categorie->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <span class="duke-pulse editor-fullscreen"></span>
                    <div class="field">
                        <textarea rows="15" id="editor" name="body" placeholder="请使用 Markdown 编写" required="">{{ old('body', $topic->body ) }}</textarea>
                    </div>
                    <div class="ui message">
                        <button type="submit" class="ui button teal publish-btn"><i class="icon send"></i> 发布</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@section('scripts')
<script type="text/javascript"  src="{{ asset('js/module.js') }}"></script>
<script type="text/javascript"  src="{{ asset('js/hotkeys.js') }}"></script>
<script type="text/javascript"  src="{{ asset('js/uploader.js') }}"></script>
<script type="text/javascript"  src="{{ asset('js/simditor.js') }}"></script>
<script>
    $(document).ready(function(){

        toolbar = ['title', 'bold', 'italic', 'underline', 'strikethrough', 'fontScale', 'color', '|', 'ol', 'ul', 'blockquote', 'code', 'table', '|', 'link', 'image', 'hr', '|', 'indent', 'outdent', 'alignment'];

        var editor = new Simditor({
            textarea: $('#editor'),

            defaultImage: '../images/image.png',
            toolbar: toolbar,
            upload: {
                url: '{{ route('uploads.topics_upload_image') }}',
                params: { _token: '{{ csrf_token() }}' },
                fileKey: 'upload_file',
                connectionCount: 3,
                leaveConfirm: '文件上传中，关闭此页面将取消上传。'
            },
            pasteImage: true,
        });
    });
</script>
@stop
@endsection
