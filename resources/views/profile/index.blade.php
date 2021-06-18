@extends('layouts.app')

@section('content')

<main class="dashboard container mt-5">
    @if (session('edit_success'))
        <div class="alert alert-success" role="alert">
            {{ session('edit_success') }}
        </div>
    @endif

    @if (!$user->profile)
        <section class="has-no-profile">
            <h1 class="mb-4">Create a profile with some details about yourself and start meeting other people!</h1>
            <div class="card">
                <div class="card-header">{{ __('Create Your Profile') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('profile.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}">

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                            <div class="col-md-6">
                                <textarea rows="6" id="description" class="form-control @error('description') is-invalid @enderror" name="description">{{ old('description') }}</textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Create') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    @else 
     
    <h1 class="mb-5">Your Profile</h1>

        @if ($user->id == auth()->user()->id)

            <section class="edit mb-3 text-right">
                <a class="shadow-sm px-3 btn btn-secondary ml-auto" href="{{ route('profile.edit') }}"><i class="fas fa-edit"></i> Edit</a>
            </section>
            
        @endif
        
        <section class="profile container">
            <div class="card shadow border-0 overflow-hidden">
                <div class="d-flex align-items-center">
                    <div class="col-sm-4 main-info align-self-stretch d-flex justify-content-center align-items-center">
                        <div class="text-center text-white py-2">
                            <div class="mb-3">
                                <img 
                                    class="profile__img rounded-circle" 
                                    src="{{ $user->profile->image ? 
                                        asset('storage/' . $user->profile->image) :
                                        asset('images/user.png') }}" 
                                    alt="User-Profile-Image" />
                            </div>
                            <h4>{{Str::ucfirst($user->name)}}</h4>
                            <p>
                                <a class="text-dark" href="{{route('profile.show', $user->username)}}">{{ '@'. $user->username }}</a>
                            </p>
                            <p>{{Str::ucfirst($user->profile->title)}}</p>
                            <p><img src="{{ asset('flags/' . str_replace(" ", '-',Str::lower($user->profile->country)) .'.png') }}" /> from {{ $user->profile->country }}</p>
                        </div>
                    </div>
                    <div class="col-sm-8 sub-info py-3">
                        <article class="description mb-4">
                            <h5 class="header font-weight-bold"><i class="fas fa-user"></i> About Me</h5>
                            <p>
                                {{ $user->profile->description }}
                            </p>
                        </article>
                        <hr />
                        <article class="languages mb-4">
                            <h5 class="header font-weight-bold"><i class="fas fa-language"></i> Languages</h5>
                            <p>
                                {{ $user->profile->languages }}
                            </p>
                        </article>
                        <hr />
                        <article class="travel_list mb-4">
                            <h5 class="header font-weight-bold"><i class="fas fa-globe-europe"></i> Travel List</h5>
                            <p>
                                {{ $user->profile->travel_list }}
                            </p>
                        </article>
                    </div>
                </div>
            </div>
        </section>
    @endif

</main>
    
@endsection