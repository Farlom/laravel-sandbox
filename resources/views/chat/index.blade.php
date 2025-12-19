<x-app-layout>
    <form action="{{ route('chats.store') }}" method="POST">
        @csrf
        <input type="text">
        <input type="submit">
    </form>
</x-app-layout>
