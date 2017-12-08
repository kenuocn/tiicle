@foreach (session('flash_notification', collect())->toArray() as $message)
    @if ($message['overlay'])
        @include('flash::modal', [
            'modalClass' => 'flash-modal',
            'title'      => $message['title'],
            'level'      => $message['level'],
            'important'  => $message['important'],
            'body'       => $message['message']
        ])
    @else
        <div class="ui centered grid container message-container">
            <div class="twelve column">
                <div class="ui message
                        @switch($message['level'])
                            @case('success')
                                olive
                            @break

                            @case('error')
                                negative
                            @break

                            @case('warning')
                                warning
                            @break
                            @default
                                info
                        @endswitch
            ">
                    @if ($message['important'])
                        <i class="close icon"></i>
                    @endif
                    @if ($message['level'] == 'warning' || $message['level'] == 'info')
                        <i class="icon info"></i>
                    @endif
                    {!! $message['message'] !!}
                </div>
            </div>
        </div>
    @endif
@endforeach
{{ session()->forget('flash_notification') }}
