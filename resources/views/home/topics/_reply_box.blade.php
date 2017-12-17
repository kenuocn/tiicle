<div class="">
    @guest
        <h3 class="ui header">
            <img class="ui avatar image" src="/uploads/avatars/avatar_default.png" alt="游客">
            <span>游客</span>
        </h3>
        <div class="ui reply form">
            <div class="field">
                <textarea name="body_original"></textarea>
            </div>
            <button class="ui primary labeled icon button " type="submit" id="login">
                <i class="icon comment"></i>请先登录
            </button>
        </div>
    @else
        <h3 class="ui header">
            <img class="ui avatar image" src="{{Auth::user()->avatar}}" alt="{{ Auth::user()->name}}">
            <span>{{Auth::user()->name}}</span>
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
    @endguest
</div>