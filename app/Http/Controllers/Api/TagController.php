<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Tag as TagResoure;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
    //    if (request()->test)
    //    {
    //        $tags = Tag::where('title','like',"%" .request()->test."%")->get();
    //    }else{
    //        $tags = Tag::all();
    //    }
    //    return response()->json(['Tag'=>$tags]);
          $tags = Tag::paginate(5);
          return TagResoure::collection($tags);
    }

    public function store(Request $request)
    {
        return Tag::create($request->all());

    }

    public function show($id)
    {
        $tag = Tag::find($id);
        return new TagResoure($tag);
    }

    public function update(Request $request, $id)
    {
        Tag:: where('id', $id)->update($request-> all());
        {
            return (['success','data update success']);
        }
    }

    public function destroy($id)
    {
        Tag::destroy($id);
        return ['message' => "Record deleted."];
    }
}
