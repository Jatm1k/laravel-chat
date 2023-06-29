@extends('layouts.app')

@section('content')
    <div class="container mx-auto h-screen flex flex-col">
        <div class="user text-accent text-center">{{ auth()->user()->name  }}</div>
        <chat-messages :user="{{auth()->user()}}"></chat-messages>
        <chat-form></chat-form>
    </div>
@endsection
