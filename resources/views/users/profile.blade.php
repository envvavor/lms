@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <!-- Profile Card -->
            <div class="card shadow-lg border-0 rounded-3 bg-[#1e1b29]">
                <div class="card-header bg-[#1e1b29] text-black d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 text">
                        <i class="fas fa-user-circle me-2"></i> My Profile
                    </h4>
                </div>

                <div class="card-body p-4">
                    <!-- User Info -->
                    <div class="text-center mb-4">
                        <div class="user-avatar" style="width: 80px; height: 80px; border-radius: 50%; background: #1e1b29; color: #fff; display: flex; align-items: center; justify-content: center; font-size: 2.5rem; margin: 0 auto;">
                            @if(Auth::check() && Auth::user()->name)
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            @else
                                <i class="fas fa-user"></i>
                            @endif
                        </div>
                        <h3 class="mt-3 mb-0">{{ $user->name }}</h3>
                        @auth
                            @if (Auth::user()->isAdmin())
                                <span class="badge bg-danger text-capitalize">{{ Auth::user()->role }}</span>
                            @elseif (Auth::user()->isUser())
                                <span class="badge bg-primary text-capitalize">{{ Auth::user()->role }}</span>
                            @elseif (Auth::user()->isTeacher())
                                <span class="badge bg-warning text-capitalize">{{ Auth::user()->role }}</span>
                            @endif
                        @endauth
                    </div>

                    <hr>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="mb-1 text-muted"><i class="fas fa-envelope me-2"></i>Email</p>
                            <h6>{{ $user->email }}</h6>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-1 text-muted"><i class="fas fa-check-circle me-2"></i>Email Verified</p>
                            <h6>
                                @if($user->email_verified_at)
                                    <span class="text-success">{{ $user->email_verified_at->format('M d, Y H:i') }}</span>
                                @else
                                    <span class="text-danger">Not Verified</span>
                                @endif
                            </h6>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="mb-1 text-muted"><i class="fas fa-calendar-plus me-2"></i>Joined</p>
                            <h6>{{ $user->created_at->format('M d, Y') }}</h6>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-1 text-muted"><i class="fas fa-sync-alt me-2"></i>Last Updated</p>
                            <h6>{{ $user->updated_at->format('M d, Y') }}</h6>
                        </div>
                    </div>

                    @if($user->google_id)
                        <div class="mb-3">
                            <p class="mb-1 text-muted"><i class="fab fa-google me-2"></i>Google Account</p>
                            <h6>{{ $user->google_id }}</h6>
                        </div>
                    @endif


                </div>
            </div>
            <!-- End Profile Card -->

        </div>
    </div>
</div>
@endsection
