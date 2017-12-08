<div class="ui centered grid container message-container">
    <div class="twelve wide column">
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
            @if ($important)
                <i class="close icon"></i>
            @endif
            @if ($level == 'warning' || $level == 'info')
                <i class="icon info"></i>
            @endif
            <div class="header">{{$title}}</div>
            <p>{!! $body !!}</p>
        </div>
    </div>
</div>

