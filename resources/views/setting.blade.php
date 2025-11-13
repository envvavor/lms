@extends('layouts.app')

@section('title', 'Settings')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white">
                    <h4 class="mb-0">Settings</h4>
                    <p class="text-muted mb-0">Manage your account and preferences</p>
                </div>
                <div class="card-body">
                    <div class="d-flex flex-column flex-sm-row align-items-center gap-3 mb-4 text-center text-sm-start">
                        <div class="rounded-circle d-flex align-items-center justify-content-center shadow mx-auto mx-sm-0"
                             style="width:90px;height:90px;font-size:2rem;background:#2b2738;color:#fff;overflow:hidden;">
                            {{ strtoupper(substr(optional(auth()->user())->name ?? 'U', 0, 1)) }}
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="mb-0">{{ optional(auth()->user())->name ?? 'Your Name' }}</h5>
                            <p class="text-muted mb-0">{{ optional(auth()->user())->email ?? 'you@example.com' }}</p>
                        </div>
                        <div class="mt-3 mt-sm-0">
                            <a href="{{ route('profile.edit') }}" class="btn btn-sm btn-outline-primary w-100 w-sm-auto">Edit Profile</a>
                        </div>
                    </div>

                    <hr>

                    <h6 class="mb-3">Account</h6>
                    <div class="row mb-3">
                        <div class="col-12 col-md-6 mb-2">
                            <label class="form-label">Language</label>
                            <select class="form-select">
                                <option>English</option>
                                <option>Bahasa Indonesia</option>
                                <option value="">日本語</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-6 mb-2">
                            <label class="form-label">Time zone</label>
                            <select class="form-select">
                                <option>Asia/Jakarta</option>
                                <option>UTC</option>
                            </select>
                        </div>
                    </div>

                    <h6 class="mb-3">Preferences</h6>
                    <div class="mb-3 form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="notifyEmails" checked>
                        <label class="form-check-label" for="notifyEmails">Email Notifications</label>
                    </div>
                    <div class="mb-3 form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="darkMode">
                        <label class="form-check-label" for="darkMode">Enable Dark Mode (preview)</label>
                    </div>

                    <div class="mt-4 d-flex flex-column flex-sm-row justify-content-between align-items-stretch align-items-sm-center gap-2">
                        <div>
                            <button class="btn btn-outline-secondary me-2 w-100 w-sm-auto" type="button">Save changes</button>
                        </div>
                        <div>
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-danger w-100 w-sm-auto">Logout</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
