@extends('layouts.app')

@section('content')
    <div class="container mx-auto h-screen flex flex-col">
        <div class="user text-accent relative flex py-4 justify-center items-center">
            <a href="{{url()->previous()}}" class="btn absolute left-0 top-2">Назад</a>
            <span class="">{{ auth()->id() !== $chat->first_user->id ? $chat->first_user->name : $chat->second_user->name }}</span>
        </div>
        <chat-messages :user="{{auth()->user()}}" :chat="{{ $chat }}"></chat-messages>
        <chat-form :chat="{{$chat}}"></chat-form>
    </div>
@endsection
