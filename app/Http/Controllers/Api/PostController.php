<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;

use App\Models\postsHasCategories;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Http\Requests\Api\PostRequest;

class PostController extends Controller
{
    public function index()
    {
      $posts = Post::paginate(4);
      return PostResource::collection($posts);
    }

    public function store(PostRequest $request)
    {
        $data = Post::create($request->all());
        dd($request->category_id);
        foreach($request->category_id ?? [] as $item) {
            postsHasCategories::create([
                'post_id' => $data->id,
                'category_id'=> $item
            ]);
        }
        return response()->json($data);
        // return Post::create($request->all());
    }
     public function show($id)
    {
        $post = Post::find($id);
        return new PostResource($post);
    }
    public function update(Request $request, $id)
    {
        Post::find($id)->update( $request->all());
        return (['success','data update success']);
    }
    public function destroy( $id)
    {
        Post::destroy($id);
        return ['message' => "Record deleted."];
    }
}
