@extends('layouts.app')

@section('content')

<div class="posts container mx-auto">

  @if (session('success-msg'))
    <div class="alert alert-success" role="alert">
      {{ session('success-msg') }}
    </div>
  @endif

  @if (session('error-msg'))
    <div class="alert alert-danger" role="alert">
      {{ session('error-msg') }}
    </div>
  @endif

  @auth
    <form action="{{ route('posts.store') }}" method="post" class="mb-5">
      @csrf
      <div class="form-group">

        <label for="body" class="col-form-label text-md-right">{{ __('Write a post') }}</label>

        <div class="">
            <textarea rows="4" id="body" class="form-control @error('body') is-invalid @enderror" name="body">{{ old('body') }}</textarea>
            @error('body')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
        </div>
      </div>

      <div class="text-right">
        <button type="submit" class="btn btn-success text-white px-4 py-2 rounded font-medium">Post</button>
      </div>
      
    </form>
  @endauth

  <div class="post-items p-0 col-lg-8 mx-auto">
    @foreach ($posts as $post)
      <x-post :post="$post" />
    @endforeach

    <div class="d-flex justify-content-center">
      {{ $posts->links() }}
    </div>
  </div>

</div>

@endsection

@section('deletePostScript')
  <script src="{{ asset('js/deletePost.js') }}"></script>
@endsection