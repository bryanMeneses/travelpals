@props(['comment' => $comment])
<div class="comment p-2 rounded mb-2 bg-light">
    <div class="details">
    <img class="rounded-circle mr-2" src="{{ $comment->user->profile->image ? 
        asset('storage/' . $comment->user->profile->image) :
        asset('images/user.png') }}" width="32" />
    <h6 class="d-inline-block font-weight-bold">{{ucwords($comment->user->username)}}</h6>
    <span>{{ $comment->created_at->diffForHumans() }}</span>
    @if ($comment->user_id == auth()->user()->id)
        <form id="commentDelete" class="d-inline-block" method="POST" action="{{ route('posts.comments', $comment) }}">
        @csrf
        @method('DELETE')
        <button class="comment__delete border-0 bg-transparent" type="button">
            <i class="fa fa-trash text-danger"></i>
        </button>
        </form>
    @endif
    </div>
    <p class="px-2 mt-2 mb-0">
    {{$comment->comment}}
    </p>
</div>   