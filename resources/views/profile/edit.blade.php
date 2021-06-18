@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
          <a class="px-3 btn btn-secondary mb-2" href="{{ url()->previous() }}">Go Back</a>
            <div class="card">
                <div class="card-header">{{ __('Edit Your Profile') }}</div>

                <div class="card-body">
                    <form enctype="multipart/form-data" method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('put')
                        <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                            <div class="col-md-8">
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') ?? auth()->user()->username }}" autofocus>

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

                            <div class="col-md-8">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') ?? auth()->user()->profile->title }}">

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="country" class="col-md-4 col-form-label text-md-right">{{ __('Home Country') }}</label>

                            <div class="col-md-8">
                                <select id="country" class="form-control @error('country') is-invalid @enderror" name="country">
                                    <option value="">Choose One</option>
                                    @foreach ($countries as $country)
                                        <option
                                            @if (auth()->user()->profile->country == $country)
                                                selected
                                            @endif
                                            value="{{ $country }}"
                                        >
                                            {{$country}}
                                        </option>
                                    @endforeach
                                </select>

                                @error('country')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                            <div class="col-md-8">
                                <textarea rows="6" id="description" class="form-control @error('description') is-invalid @enderror" name="description">{{ old('description') ?? auth()->user()->profile->description }}</textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="languages" class="col-md-4 col-form-label text-md-right">{{ __('Languages') }}</label>

                            <div class="col-md-8">
                                <textarea rows="4" id="languages" class="form-control @error('languages') is-invalid @enderror" name="languages">{{ old('languages') ?? auth()->user()->profile->languages }}</textarea>
                                @error('languages')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="travel_list" class="col-md-4 col-form-label text-md-right">{{ __('Travel List') }}</label>

                            <div class="col-md-8">
                                <textarea rows="4" id="travel_list" class="form-control @error('travel_list') is-invalid @enderror" name="travel_list">{{ old('travel_list') ?? auth()->user()->profile->travel_list }}</textarea>
                                @error('travel_list')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                          <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Image') }}</label>

                          <div class="col-md-8">
                              <input id="image" type="file" class="@error('image') is-invalid @enderror" name="image" value="{{ old('image') ?? auth()->user()->profile->image }}">

                              @error('image')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>
                      </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save Changes') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
