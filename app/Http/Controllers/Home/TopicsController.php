<?php

namespace App\Http\Controllers\Home;

use App\Models\Topic;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Home\TopicRequest;
use App\Http\Controllers\Home\Traits\Markdown;

class TopicsController extends Controller {

    use Markdown;

    /**
     * 用户授权
     * TopicsController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * 展示所有话题
     * @param Request $request
     * @param Topic $topic
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request, Topic $topic, User $user)
    {
        $topics = $topic->withOrder($request->order)->paginate(30);
        $active_users = $user->getActiveUsers();

        return view('home.topics.index', compact('topics', 'active_users'));
    }

    /**
     * 展示某个话题
     * @param Topic $topic
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Request $request, Topic $topic)
    {
        /**浏览一次.增加浏览总数*/
        $topic->increment('view_count');

        //URL 矫正
        if ( !empty($topic->slug) && $topic->slug != $request->slug) {
            return redirect($topic->link(), 301);
        }

        return view('home.topics.show', compact('topic'));
    }

    /**
     * 展示发布话题页面
     * @param Topic $topic
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Topic $topic)
    {
        $categories = Category::all();
        return view('home.topics.create_and_edit', compact('topic', 'categories'));
    }

    /**
     * 发布话题
     * @param TopicRequest $request
     * @param Topic $topic
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(TopicRequest $request, Topic $topic)
    {
        $topic->fill($request->all());
        $topic->body_original = remove_vue($request->get('body'));
        $topic->body = $this->convertMarkdownToHtml($request->get('body'));
        $topic->user_id = auth()->id();
        $topic->save();

        flash('发布话题成功')->success()->important();

        return redirect()->to($topic->link());
    }

    /**
     * 展示编辑页面
     * @param Topic $topic
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Topic $topic)
    {
        $this->authorize('update', $topic);
        $categories = Category::all();

        return view('home.topics.create_and_edit', compact('topic', 'categories'));
    }

    /**
     * 编辑话题
     * @param TopicRequest $request
     * @param Topic $topic
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(TopicRequest $request, Topic $topic)
    {
        $this->authorize('update', $topic);
        $topic->fill($request->all());
        $topic->body_original = remove_vue($request->get('body'));
        $topic->body = $this->convertMarkdownToHtml($request->get('body'));
        $topic->save();

        flash('编辑话题成功')->success()->important();

        return redirect()->to($topic->link());
    }

    /**
     * 删除话题
     * @param Topic $topic
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Topic $topic)
    {
        $this->authorize('destroy', $topic);
        $topic->delete();

        flash('删除话题成功')->success()->important();

        return redirect()->route('topics.index');
    }
}