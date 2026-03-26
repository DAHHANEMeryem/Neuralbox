@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Évaluations</h1>

    @if($rates->isEmpty())
        <p>Aucune évaluation pour le moment.</p>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Utilisateur</th>
                    <th>Ressource</th>
                    <th>Respect des étapes</th>
                    <th>Focus et mémoire</th>
                    <th>Implication familiale</th>
                    <th>Stabilité motrice et émotionnelle</th>
                    <th>Plaisir / Enjoyment</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rates as $rate)
                <tr>
                    <td>{{ $rate->user->name ?? 'N/A' }}</td>
                    <td>{{ $rate->ressource->title ?? 'N/A' }}</td>
                    <td>{{ $rate->manual_steps_respect }}</td>
                    <td>{{ $rate->focus_and_memory }}</td>
                    <td>{{ $rate->family_involvement }}</td>
                    <td>{{ $rate->motor_and_emotional_stability }}</td>
                    <td>{{ $rate->enjoyment }}</td>
                    <td>{{ $rate->created_at->format('d/m/Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection