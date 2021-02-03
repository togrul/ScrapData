@extends('layouts.app')

@section('content')
    <!-- row -->
    <h1 class="text-3xl pb-8">Trendyol</h1>
    <!-- row -->

        <!-- row -->
        <div class="grid md:grid-cols-3 sm:grid-cols-1 gap-4">
        @forelse($data as $key => $item)
            <!-- Start div -->
                <div class="md:max-w-sm sm:w-full h-full flex flex-col rounded overflow-hidden bg-white shadow">
                    <div class="px-6 py-4">
                        <div class="font-bold text-lg mb-2">{!! $item->name !!}</div>
                        <div class="font-bold text-md mb-2">{{$item->price}}</div>
                    </div>
                </div>
                <!-- End div -->
            @empty
                <div class="w-full rounded bg-white shadow px-6 py-4">
                    <p>No product.</p>
                </div>
            @endforelse
        </div>

    @if(!empty($data))
        <div class="mt-3">
            {{$data->links()}}
        </div>
    @endif
        <!-- end of row -->

@endsection
