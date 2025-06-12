<table class="w-full table-auto border shadow-sm rounded-md overflow-hidden">
    <thead class="bg-gray-100 text-sm">
        <tr>
            <th class="px-4 py-2">Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Téléphone</th>
            <th>Message</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($messages as $msg)
            <tr class="border-b hover:bg-gray-50 text-sm">
                <td class="px-4 py-2">{{ $msg->nom }}</td>
                <td>{{ $msg->prenom }}</td>
                <td>{{ $msg->email }}</td>
                <td>{{ $msg->telephone }}</td>
                <td>{{ Str::limit($msg->message, 40) }}</td>
                <td>{{ $msg->created_at->format('d/m/Y H:i') }}</td>
                <td class="flex gap-2 items-center">
                    <!-- Détail -->
                    <a href="{{ route('admin.messages.show', $msg->id) }}" class="text-blue-500 hover:underline text-xs">Détails</a>

                    <!-- Marquer comme lu -->
                    @if(!$msg->is_read)
                    <form action="{{ route('admin.messages.markAsRead', $msg->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="text-green-500 hover:underline text-xs">Lire</button>
                    </form>
                    @endif

                    <!-- Supprimer -->
                    <!-- <form action="{{ route('admin.messages.destroy', $msg->id) }}" method="POST" onsubmit="return confirm('Supprimer ce message ?')" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:underline text-xs">Supprimer</button>
                    </form> -->
                      <button onclick="confirmDelete({{ $msg->id }})" class="text-red-500 hover:underline text-xs">Supprimer</button>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center text-gray-500 py-4">Aucun message trouvé.</td>
            </tr>
        @endforelse
    </tbody>
</table>
