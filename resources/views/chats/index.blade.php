@extends('layouts.app')

@section('content')
    <div class="container mx-auto h-screen flex flex-col">
        <chat-add></chat-add>
        <chat-list :user="{{auth()->user()}}"></chat-list>
    </div>
@endsection
