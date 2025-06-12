@extends('layouts.app')

@section('content')
<div class="container">

    <h4>Conversation avec {{ $user->name }}</h4>

    <div class="mb-3" style="max-height:400px; overflow-y:auto;">
        @foreach($messages as $msg)
            <div class="mb-2 p-2 @if($msg->sender_id == auth()->id()) bg-light @else bg-secondary text-white @endif rounded">
                <small>{{ $msg->created_at->format('d/m/Y H:i') }}</small><br>
                {{ $msg->message }}
            </div>
        @endforeach
    </div>

    <form action="{{ route('contact.sendMessageToUser', $user->id) }}" method="POST">
        @csrf
        <textarea name="message" rows="3" class="form-control mb-2" placeholder="Répondre à l'utilisateur..." required></textarea>
        <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>

    <a href="{{ route('contact.index') }}" class="btn btn-link mt-3">Retour à la liste</a>

</div>
@endsection
