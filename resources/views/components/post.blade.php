@props(['post' => $post])
    <div data-post-id="{{$post->id}}" class="post__item bg-white shadow-sm rounded mb-4">
            <div class="d-flex flex-row justify-content-between align-items-center p-2 border-bottom">
                <div class="d-flex flex-row align-items-center px-2">
                <img 
                    class="rounded-circle mr-2" 
                    src="{{ $post->user->profile->image ? 
                    asset('storage/' . $post->user->profile->image ) : 
                    asset('images/user.png') }}
                    " 
                    width="56" />
                <div class="d-flex flex-column flex-wrap ml-2">
                    <span class="font-weight-bold">
                    <a class="text-dark" href="{{route('profile.show', $post->user->username)}}">{{ Str::ucfirst($post->user->name) }}</a>
                    </span>
                    <span class="text-black-50">{{ $post->created_at->diffForHumans() }}</span>
                </div>
                </div>
                @if ($post->user_id == auth()->user()->id)
                <form class="px-2" method="POST" action="{{ route('posts.destroy', $post) }}">
                    @csrf
                    @method('DELETE')
                    <button class="post__delete border-0 bg-transparent" type="button">
                    <i class="fa fa-trash text-danger"></i>
                    </button>
                </form>
                @endif
            </div>

            <div class="p-2 px-3">
            <span>{{ $post->body }}</span>
            </div>

            <div class="comments-cont">
            <div class="d-flex">
                <div class="likes w-50 text-center">

                    @if ($post->likedBy(auth()->user()))
            
                        <form action="{{ route('posts.dislikes', $post) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="border-0 py-2 w-100 bg-light text-primary">
                                <span class="font-weight-bold mr-2">
                                {{$post->likes->count()}} {{ Str::plural('like', $post->likes->count()) }}
                                </span> <i class="fa fa-thumbs-up"></i>
                            </button>
                        </form>
                        
                    @else
            
                        <form action="{{ route('posts.likes', $post) }}" method="post">
                            @csrf
                            <button type="submit" class="border-0 py-2 w-100 bg-light">
                                <span class="font-weight-bold mr-2">
                                {{$post->likes->count()}} {{ Str::plural('like', $post->likes->count()) }}
                                </span> <i class="fa fa-thumbs-up"></i>
                            </button>
                        </form>
                    @endif
                </div>
                <button onclick="handleShowComments({{$post->id}})" type="button" class="show-comments w-50 text-center bg-light border-0 outline-0 py-2 mb-2">
                <i class="fa fa-comments @if ($post->commentedBy(auth()->user())) text-primary @endif"> {{$post->comments->count()}} {{ Str::plural('comment', $post->comments->count()) }}</i>
                </button>
            </div>
            <div class="comment-items pb-2 px-4">
                @foreach ($post->getCurPostsLatestComments() as $comment)
                    <x-comment :comment="$comment" /> 
                @endforeach
                <form class="mt-4" action="{{ route('posts.comments', $post) }}" method="POST">
                @csrf
                <div class="form-group">        
                    <textarea class="form-control @error('comment-' . $post->id) is-invalid @enderror" name="comment-{{$post->id}}">{{ old('comment-' . $post->id) }}</textarea>
                    @error('comment-' . $post->id)
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-info text-white px-4 py-1 rounded">Comment</button>
                </div>
                </form>
            </div>
            </div>
        </div>