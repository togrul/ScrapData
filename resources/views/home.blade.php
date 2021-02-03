@extends('layouts.app')

@section('content')
    <!-- row -->
    <div class="grid md:grid-cols-3 sm:grid-cols-1 gap-4">
        <!-- Start div -->
        <div class="md:max-w-sm sm:w-full h-full flex flex-col rounded overflow-hidden bg-white shadow">
            <a href="/trendyol">
                <div class="px-6 py-4">
                    <div class="font-bold text-lg mb-2">Trendyol</div>
                </div>
            </a>
        </div>

        <div class="md:max-w-sm sm:w-full h-full flex flex-col rounded overflow-hidden bg-white shadow">
            <a href="/defacto">
                <div class="px-6 py-4">
                    <div class="font-bold text-lg mb-2">DeFacto</div>
                </div>
            </a>
        </div>

    </div>
    <!-- end of row -->
@endsection
