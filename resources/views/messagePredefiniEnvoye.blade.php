@extends("layouts.default", ["title", "Message envoyé"])

@section("content")

    @if ($discord && $slack)
        <h1>Votre message prédéfini a été envoyé avec succès !</h1>
    @elseif (!$discord && $slack)
        <h1>Votre message prédéfini a été envoyé sur Slack mais pas sur Discord !</h1>
    @elseif ($discord && !$slack)
        <h1>Votre message prédéfini a été envoyé sur Discord mais pas sur Slack !</h1>
    @else 
        <h1>Votre message prédéfini n'a pas été envoyé !</h1>
    @endif
    

    <button>Retour au menu principal</button>

@endsection