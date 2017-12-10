@extends('home.layouts.app')
@section('title', $topic->title)
@section('description', $topic->excerpt)
@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/social-share.js/1.0.16/css/share.min.css" rel="stylesheet">
@stop
@section('content')
    <div class="twelve wide column">
        <div class="ui segment article-content">
            <div class="extra-padding">
                <h1>
                    <i class="grey file text outline icon"></i>
                    <span style="line-height: 34px;">{{$topic->title}}</span>


                    @can('update', $topic)
                        <div class="ui right floated buttons">
                            <a class="ui basic label" href="{{ route('topics.edit', $topic->id) }}"><i class="grey edit icon"></i></a>
                            <a class="ui basic label" href="javascript:;" data-method="delete" data-url="{{ route('topics.destroy', $topic->id) }}" style="cursor:pointer;">
                                <i class="grey trash icon"></i>
                            </a>
                        </div>
                    @else
                        <div class="pull-right">
                            <div class="ui labeled button tiny">
                                <div class="ui compact button tiny kb-star basic " data-act="unstar" >
                                    <i class="thumbs up icon"></i> <span class="state">点赞</span>
                                </div>
                                <a class="ui basic label star_count">{{$topic->voted_count}}</a>
                            </div>
                        </div>
                    @endcan
                </h1>
                <p class="article-meta">
                    <a class="ui basic image small label" href="{{route('users.show',$topic->user_id)}}"><img src="{{$topic->user->avatar}}"> {{$topic->user->name}} </a>
                    <span class="ui label small basic"><i class="clock icon"></i> {{$topic->created_at->diffForHumans()}}</span>
                </p>
                <p class="item-tags">
                    <i class="icon grey tags " style="font-size: 1.2em"></i>
                    <a class="ui tag label small " href="{{route('categories.show',$topic->category_id)}}">
                        {{$topic->category->name}}
                        <img class="tagged" src="https://omu8v0x3b.qnssl.com/uploads/images/201703/15/1/hIYECohuQg.png?imageView2/1/w/200/h/200">
                    </a>
                </p>
                <div class="ui divider"></div>
                <div class="ui readme markdown-body">
                    {!! $topic->body !!}
                </div>
            </div>
        </div>
        <div class="ui message basic">
            <div class="social-share"></div>
            <div class="pull-right" style="margin-top: 5px;">
                <div class="ui labeled button ">
                    <div class="ui compact floating watch  button  kb-watch basic " data-act="watch" data-id="387">
                        <i class="eye icon"></i> <span class="state">关注</span>
                    </div>
                    <a class="ui basic label watch_count">0</a>
                </div>
                <span>
                    <a class="ui button teal small basic" href="https://tiicle.com/items/387/patches/create"><i class="icon send"></i> 我要改进</a>
                </span>
            </div>
            <div class="clearfix"></div>
        </div>
        <div id="app">
            <voted-topic-button topic="{{$topic->id}}"></voted-topic-button>
        </div>

        <div class="ui threaded comments comment-list ">

            <div id="comments"></div>

            <div class="ui divider horizontal grey"><i class="icon comments"></i> 评论数量: 1</div>

            <div class="comments-feed">
                <div class="comment">
                    <div id="comments-147"></div>
                    <a class="avatar" href="https://tiicle.com/dinghua">
                        <img src="https://omu8v0x3b.qnssl.com/uploads/avatars/95_1490751960.jpeg?imageView2/1/w/100/h/100">
                    </a>
                    <div class="content">
                        <div class="comment-header">
                            <div class="meta">
                                <a class="author" href="https://tiicle.com/dinghua">dinghua</a>
                                <div class="metadata">
                                    <span class="date">5个月前</span>
                                </div>
                            </div>

                            <div class="reaction">
                                <div class="ui floating basic icon dropdown button" tabindex="0">
                                    <a href="javascript:void(0)" onclick="replyOne('dinghua');" title="回复 dinghua" class="ui teal reply-btn" style="display: none;"><i class="icon reply"></i></a>

                                    <div class="menu" tabindex="-1"></div></div>
                            </div>

                        </div>

                        <div class="text comment-body markdown-reply">
                            <p>又发现一个</p>
                            <pre class=" language-php"><code class="  language-php"><span class="token keyword">function</span> <span class="token function">progress_bar</span><span class="token punctuation">(</span><span class="token variable">$done</span><span class="token punctuation">,</span> <span class="token variable">$total</span><span class="token punctuation">,</span> <span class="token variable">$info</span><span class="token operator">=</span><span class="token string">""</span><span class="token punctuation">,</span> <span class="token variable">$width</span><span class="token operator">=</span><span class="token number">50</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
    <span class="token variable">$perc</span> <span class="token operator">=</span> <span class="token function">round</span><span class="token punctuation">(</span><span class="token punctuation">(</span><span class="token variable">$done</span> <span class="token operator">*</span> <span class="token number">100</span><span class="token punctuation">)</span> <span class="token operator">/</span> <span class="token variable">$total</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
    <span class="token variable">$bar</span> <span class="token operator">=</span> <span class="token function">round</span><span class="token punctuation">(</span><span class="token punctuation">(</span><span class="token variable">$width</span> <span class="token operator">*</span> <span class="token variable">$perc</span><span class="token punctuation">)</span> <span class="token operator">/</span> <span class="token number">100</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
    <span class="token keyword">return</span> <span class="token function">sprintf</span><span class="token punctuation">(</span><span class="token string">"%s%%[%s&gt;%s]%s\r"</span><span class="token punctuation">,</span> <span class="token variable">$perc</span><span class="token punctuation">,</span> <span class="token function">str_repeat</span><span class="token punctuation">(</span><span class="token string">"="</span><span class="token punctuation">,</span> <span class="token variable">$bar</span><span class="token punctuation">)</span><span class="token punctuation">,</span> <span class="token function">str_repeat</span><span class="token punctuation">(</span><span class="token string">" "</span><span class="token punctuation">,</span> <span class="token variable">$width</span><span class="token operator">-</span><span class="token variable">$bar</span><span class="token punctuation">)</span><span class="token punctuation">,</span> <span class="token variable">$info</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token punctuation">}</span></code></pre>
                        </div>



                    </div>
                </div>            </div>
            <br>

            <div class="">

                <h3 class="ui header">
                    <img class="ui avatar image" src="https://omu8v0x3b.qnssl.com/uploads/avatars/505_1505353785.jpeg?imageView2/1/w/100/h/100">
                    <span>kenuocn</span>
                </h3>

                <form class="ui reply form" method="POST" action="https://tiicle.com/items/387/comments" accept-charset="UTF-8" id="comment-composing-form">



                    <input type="hidden" name="_token" value="sfjg80nMsyOtAi5WvhWnRRC9L7RoSy445bx7agtj">

                    <div class="field">
                        <textarea name="body_original" id="comment-composing-box" required="" class=""></textarea>
                    </div>
                    <button class="ui primary labeled icon button " type="submit" id="comment-composing-submit">
                        <i class="icon comment"></i> 评论
                    </button>
                </form>
            </div>
        </div>
    </div>

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/social-share.js/1.0.16/js/social-share.min.js"></script>
<script>
    $(document).ready(function()
    {
        var $config = {
            sites  : ['weibo','wechat',  'facebook', 'twitter', 'google','qzone', 'qq', 'douban']
        };

        socialShare('.social-share', $config);
    });
</script>
@stop
@stop