@extends('home.layouts.app')
@section('title', isset($topic->id) ? '编辑话题'  : ' 新建话题')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/simditor.css') }}">
@stop
@section('content')
    <div class="fourteen wide column">
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
                    <span class="duke-pulse editor-fullscreen"></span>

                    <div class="field">
                        <textarea rows="15" id="editor" name="body_original" placeholder="请使用 Markdown 编写" required="" style="display: none;">{{ old('body', $topic->body ) }}</textarea>
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
        var editor = new Simditor({
            textarea: $('#editor'),
            upload: {
                url: '{{ route('topics.upload_image') }}',
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
