@extends('layouts.app')

@section('title', 'Website Performance - Creativy LMS')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>
@auth
    @if (Auth::user()->isAdmin())
        <div class="bg-white rounded-lg shadow mb-6 overflow-hidden">
            <h2 class="text-lg font-semibold text-gray-800 mb-4 px-4 pt-4">
                Website Performance
            </h2>

            <!-- Responsive iframe wrapper -->
            <div class="relative w-full" style="padding-top: 75%;"> {{-- 4:3 ratio, bisa ubah ke 56.25% untuk 16:9 --}}
                <iframe 
                    src="https://lookerstudio.google.com/embed/reporting/5f225e75-7f10-46c2-9932-6ef9dc58abf2/page/6zXD"
                    class="absolute top-0 left-0 w-full h-full border-0"
                    frameborder="0"
                    scrolling="no"
                    allowfullscreen
                    sandbox="allow-storage-access-by-user-activation allow-scripts allow-same-origin allow-popups allow-popups-to-escape-sandbox">
                </iframe>
            </div>
        </div>
    @endif
@endauth
@endsection
