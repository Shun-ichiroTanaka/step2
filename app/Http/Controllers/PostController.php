<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post; // fillable使用
use App\Like; //いいね
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        return view('posts.new');
        // $steps = Post::all();
        // return view('posts.index', ['posts' => $posts]);
    }

    public function postStep(Request $request)
    {
        // バリデーション
        $request->validate([
            'title' => 'required|max:255',
            'subtitle1' => 'required|max:255',
            'subtitle2' => 'nullable|max:255',
            'subtitle3' => 'nullable|max:255',
            'subtitle4' => 'nullable|max:255',
            'tags' => 'required|max:255',
            'step1' => 'required|max:255',
            'step2' => 'nullable|max:255',
            'step3' => 'nullable|max:255',
            'step4' => 'nullable|max:255',
            'time' => 'required|integer',
        ]);

        // モデルを使って、DBに登録する値をセット
        // $posts = new Post;
        // fillを使って一気にいれる
        // $fillableを使っていないと変なデータが入り込んだ場合に勝手にDBが更新されてしまうので注意
        // $posts->fill($request->all())->save();

        $tags = explode(' ', $request->tags);
        $tag1 = $tags[0];
        $tag2 = (isset($tags[1])) ? $tags[1] : null;
        $tag3 = (isset($tags[2])) ? $tags[2] : null;
        $tag4 = (isset($tags[3])) ? $tags[3] : null;
        $tag5 = (isset($tags[4])) ? $tags[4] : null;


        $step = Post::create([
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'subtitle1' => $request->subtitle1,
            'subtitle2' => $request->subtitle2,
            'subtitle3' => $request->subtitle3,
            'subtitle4' => $request->subtitle4,
            'tag1' => $tag1,
            'tag2' => $tag2,
            'tag3' => $tag3,
            'tag4' => $tag4,
            'tag5' => $tag5,
            'step1' => $request->step1,
            'step2' => $request->step2,
            'step3' => $request->step3,
            'step4' => $request->step4,
            'time' => $request->time

        ]);

        return redirect('/');

        //「投稿する」をクリックしたら投稿情報表示ページへリダイレクト
        // その時にsessionフラッシュにメッセージを入れる
        return redirect("/post/{$step->id}")->with('flash_message', __('投稿しました!'));
        // return redirect("/")->with('flash_message', __('投稿しました!'));
    }



    public function showstep($id)
    {
        // $steps = Post::paginate(1);

        // IDの情報が飛んできて、$idでキャッチ
        // その記事IDを元に、データベースから記事を検索し、ビューに記事情報を返す
        $step = Post::where('id', $id)->first();
        return view('posts.show', compact('step'));
    }



    public function postLike(Request $request)
    {
        $step_id = $request['stepId'];
        $is_like = $request['isLike'] === 'true';
        $update = false;
        $step = Post::find($step_id);
        if (!$step) {
            return null;
        }
        $user = Auth::user();
        $like = $user->likes()->where('step_id', $step_id)->first();
        if ($like) {
            $already_like = $like->like;
            $update = true;
            if ($already_like == $is_like) {
                $like->delete();
                return null;
            }
        } else {
            $like = new Like();
        }
        $like->like = $is_like;
        $like->user_id = $user->id;
        $like->step_id = $step->id;
        if ($update) {
            $like->update();
        } else {
            $like->save();
        }
        return null;
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $userAuth = \Auth::user();

        $post->load('likes');

        $defaultCount = count($post->likes);

        $defaultLiked = $post->likes->where('user_id', $userAuth->id)->first();
        if(count($defaultLiked) == 0) {
            $defaultLiked == false;
        } else {
            $defaultLiked == true;
        }

        return view('posts.show', [
            'post' => $post,
            'userAuth' => $userAuth,
            'defaultLiked' => $defaultLiked,
            'defaultCount' => $defaultCount
        ]);
    }

    public function store(Request $request)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
        }
