@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white rounded shadow">

    <h1 class="text-2xl font-bold mb-4">➕ Ajouter une Category</h1>
    <form id="uploadForm" method="POST" action="{{route('categories.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label for="name" class="block font-semibold">Name</label>
            <input type="text" name="name" id="name" class="w-full border rounded px-3 py-2" required>
            @error('name')
            <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>


        <button type="submit" id="submitBtn" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
            Ajouter la Category
        </button>
    </form>
</div>
@endsection