<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::all();
        $totalComment = $comments->count();
        return response()->json([
            'comments' => $comments,
            'totalComments' => $totalComment
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment  $comment)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
    }

    public function getData()
    {
        $response = Http::get('https://jsonplaceholder.typicode.com/comments');

        $response = json_decode($response);

        foreach ($response as $data) {
            $comment = new Comment();
            $comment->post_id = $data->postId;
            $comment->name = $data->name;
            $comment->email = $data->email;
            $comment->body = $data->body;
            $comment->save();
        }

        return true;
    }

    /**
     * Display the resource using keyword searching.
     *
     * @param  \App\Models\Request $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function getComment(Request $request,Comment $comment)
    {
        $comment = $comment->newQuery();

        // Search for a user comment based on their name.
        if ($request->has('name')) {
            $comment->where('name','LIKE', "%{$request->input('name')}%");
        }

        // Search for a user based on their email.
        if ($request->has('email')) {
            $comment->where('email','LIKE', "%{$request->input('email')}%");
        }

        // Search for a user based on their body.
        if ($request->has('body')) {
            $comment->where('body','LIKE', "%{$request->input('body')}%");
        }

        // Get the results and return them.
        return $comment->get();
    }
}
