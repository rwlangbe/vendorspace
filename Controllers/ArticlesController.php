<?php

namespace vendorspace\Http\Controllers;

use Auth;
use vendorspace\models\Article;
use vendorspace\models\User;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    public function index()
    {   
        $articles = Article::orderBy('created_at', 'desc')->get();
    	return $articles;
    }

    public function store(Request $request) 
    {

        $exploded = explode(',', $request->image);
        $decoded_image = base64_decode($exploded[1]);

        if (str_contains($exploded[0], 'jpeg'))
            $extension = 'jpg';
        else
            $extension = "png";

        $fileName = str_random().'.'.$extension;
        $path = public_path().'/'.$fileName;

        file_put_contents($path, $decoded_image);

    	$article = Article::create($request->except('image') + [
            'user_id' => Auth::id(),
            'image' => $fileName,

        ]);

    	return $article;
    }

    public function destroy ($id)
    {
    	try {
    		Article::destroy($id);

    		return response([], 204);
    	} catch (\Exception $e) {
    		return response(['Problem deleting the article.', 500]);
    	}
    }

    public function show ($id)
    {
        $article = Article::find($id);

        if ($article)
            return response()->json($article);

        return response()->json(['error' => 'Resource not found!'], 404);
    }

    public function update (Request $request, $id)
    {
        $article = Article::find($id);
        $article->update($request->all());

        return response()->json($article);
    }

    public function getName($user)
    {
        if ($user->first_name && $user->last_name) {
            return "{$user->first_name} {$user->last_name}";
        }
        if ($user->first_name) {
            return "{$user->first_name}";
        }
        return null;
    }

    public function getNameOrUsername($id)
    {
        $user = User::where('id', $id)->first();
        return $user->getName($user) ?: $user->username;
    }
}
