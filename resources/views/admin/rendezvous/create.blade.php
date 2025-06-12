<form action="{{ route('rendezvous.store') }}" method="POST">
    @csrf

    <div class="mb-4">
        <label class="block text-sm font-medium mb-1">Email :</label>
        <input type="email" name="email" class="w-full border rounded p-2" required value="{{ old('email', auth()->user()->email) }}">
        @error('email') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>

    <div class="mb-4">
        <label class="block text-sm font-medium mb-1">Numéro de téléphone :</label>
        <input type="text" name="numero" class="w-full border rounded p-2" required>
        @error('numero') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>

    <div class="mb-4">
        <label class="block text-sm font-medium mb-1">Date et Heure :</label>
        <input type="datetime-local" name="date" class="w-full border rounded p-2" required>
        @error('date') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>

    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        Prendre rendez-vous
    </button>
</form>
