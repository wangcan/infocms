<?php

namespace Larabase\Helpers;

/**
 * Class Controller
 *
 * @category Larabase
 * @package Larabase\Helpers
 * @license https://opensource.org/licenses/MIT MIT
 */
class Helper
{
    public function models()
    {
            'user' => $user,
            'posts_count' => $user->posts()->count(),
            'comments_count' => $user->comments()->count(),
            'likes_count' => $user->likes()->count(),
            'posts' => $user->posts()->withCount('likes', 'comments')->latest()->limit(5)->get(),
            'comments' => $user->comments()->with('post.author')->latest()->limit(5)->get()
            'comments' => Comment::with('post', 'author')->latest()->paginate(50)
            'users' => User::pluck('name', 'id')
            'media' => MediaLibrary::first()->media()->get()
            'posts' => Post::withCount('comments', 'likes')->with('author')->latest()->paginate(50)
            'users' => User::authors()->pluck('name', 'id'),
            'media' => MediaLibrary::first()->media()->get()->pluck('name', 'id')
            'users' => User::authors()->pluck('name', 'id'),
            'media' => MediaLibrary::first()->media()->get()->pluck('name', 'id')
            'comments' =>  Comment::lastWeek()->get(),
            'posts' => Post::lastWeek()->get(),
            'users' => User::lastWeek()->get(),
            'posts' => Post::search($request->input('q'))
                             ->with('author', 'likes')
                             ->withCount('comments', 'thumbnail', 'likes')
                             ->latest()
                             ->paginate(20)
        $post->comments_count = $post->comments()->count();
        $post->likes_count = $post->likes()->count();
    }
    public function unsubscribe(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:newsletter_subscriptions,email'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $route = 'login';

            if (Auth::check()) {
                $route = 'home';
            }

            return redirect()->route($route)->withErrors($errors);
        }

        UnsubscribeEmailNewsletter::dispatch($request->input('email'));

        Session::flash('success', __('newsletter.unsubscribed'));

        return view('newsletters.unsubscribed');
    }
    public function index()
    {
//use Illuminate\Support\Facades\Http;
        $popularTv = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/tv/popular')
            ->json()['results'];


        $viewModel = new TvViewModel(
            $popularTv,
            $topRatedTv,
            $genres,
        );

        return view('tv.index', $viewModel);
    }

    public function controllers()
    {
        $comment->update($request->validated());
        $comment->delete();
        return redirect()->route('admin.comments.edit', $comment)->withSuccess(__('comments.updated'));

        $image = $request->file('image');
        $name = $image->getClientOriginalName();

        MediaLibrary::first()
            ->addMedia($image)
            ->usingName($name)
            ->toMediaCollection();

        $post = Post::create($request->only(['title', 'content', 'posted_at', 'author_id', 'thumbnail_id']));

        return redirect()->route('admin.posts.edit', $post)->withSuccess(__('posts.created'));
        $post->update($request->only(['title', 'content', 'posted_at', 'author_id', 'thumbnail_id']));

        return redirect()->route('admin.posts.edit', $post)->withSuccess(__('posts.updated'));

        if ($request->filled('password')) {
            $request->merge([
            'users' => User::latest()->paginate(50)
            'roles' => Role::all()
//use Illuminate\Support\Facades\Hash;
                'password' => Hash::make($request->input('password'))
            ]);
        }

        $user->update(array_filter($request->only(['name', 'email', 'password'])));

        $role_ids = array_values($request->get('roles', []));
        $user->roles()->sync($role_ids);

        return redirect()->route('admin.users.edit', $user)->withSuccess(__('users.updated'));
//use Illuminate\Support\Facades\Cache;
        $posts = Cache::remember('feed-posts', now()->addHour(), fn () => Post::latest()->limit(20)->get());
    }
}

use App\Models\Token;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UserTokenController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(): View
    {
        $user = auth()->user();

        $this->authorize('api_token', $user);

        return view('users.token', ['user' => $user]);
    }

    /**
     * Generate a personnal access token for the specified resource in storage.
     */
    public function update(): RedirectResponse
    {
        $user = auth()->user();

        $this->authorize('api_token', $user);

        $user->update([
            'api_token' => Token::generate()
        ]);

        return redirect()->route('users.token')->withSuccess(__('tokens.updated'));
    }

    public function index(Request $request, User $user): ResourceCollection
    {
        return PostResource::collection(
            $user->posts()->latest()->paginate($request->input('limit', 20))
        );
    }
}
