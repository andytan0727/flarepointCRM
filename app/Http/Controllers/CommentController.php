<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use App\Models\Task;
use App\Models\Lead;
use App\Models\Comment;
use App\Events\NewComment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Create a comment for tasks and leads.
     *
     * @param Request $request
     * @param $id
     *
     * @return mixed
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'description' => 'required',
        ]);

        $source  = 'task' == $request->type ? Task::find($request->id) : Lead::find($request->id);
        $comment = $source->addComment(['description' => $request->description, 'user_id' => auth()->user()->id]);
        event(new NewComment($comment));
        Session::flash('flash_message', 'Comment successfully added!'); //Snippet in Master.blade.php
        return redirect()->back();
    }
}
