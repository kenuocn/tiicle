<?php

namespace App\Http\Controllers\Home;

use App\Models\Topic;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\Home\TopicRequest;
use App\Http\Controllers\Controller;

class TopicsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }


	public function index(Request $request, Topic $topic)
	{
		$topics = $topic->withOrder($request->order)->paginate(30);
		return view('home.topics.index', compact('topics'));
	}


    public function show(Topic $topic)
    {
        return view('home.topics.show', compact('topic'));
    }


	public function create(Topic $topic)
	{
        $categories = Category::all();
        return view('home.topics.create_and_edit', compact('topic', 'categories'));
	}


	public function store(TopicRequest $request,Topic $topic)
	{
		$topic->fill($request->all());
        $topic->user_id = auth()->id();
        $topic->save();

        flash('发布话题成功')->success()->important();

		return redirect()->route('topics.show', $topic->id);
	}


	public function edit(Topic $topic)
	{
        $this->authorize('update', $topic);
		return view('home.topics.create_and_edit', compact('topic'));
	}


	public function update(TopicRequest $request, Topic $topic)
	{
		$this->authorize('update', $topic);
		$topic->update($request->all());

		return redirect()->route('topics.show', $topic->id)->with('message', 'Updated successfully.');
	}


	public function destroy(Topic $topic)
	{
		$this->authorize('destroy', $topic);
		$topic->delete();

		return redirect()->route('topics.index')->with('message', 'Deleted successfully.');
	}
}