<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Espace Client - Choisissez un produit') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            @foreach($fournisseurs as $fournisseur)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h3 class="text-xl font-bold text-indigo-600 mb-2">{{ $fournisseur->nom_entreprise ?? $fournisseur->user->name }}</h3>
                        <form method="POST" action="{{ route('client.commande.passer') }}" class="mt-4">
                            @csrf
                            <input type="hidden" name="fournisseur_id" value="{{ $fournisseur->id }}">
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                @foreach($fournisseur->produits as $produit)
                                    <div class="border rounded-lg p-4 hover:shadow-lg transition">
                                        <h4 class="font-bold text-lg">{{ $produit->nom }}</h4>
                                        <p class="text-gray-600">{{ $produit->description ?? 'Aucune description' }}</p>
                                        <p class="text-indigo-600 font-semibold mt-2">{{ number_format($produit->prix, 2) }} €</p>
                                        <div class="mt-3">
                                            <label class="block text-sm font-medium text-gray-700">Quantité</label>
                                            <input type="number" name="produits[{{ $loop->index }}][quantite]" value="1" min="1" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                            <input type="hidden" name="produits[{{ $loop->index }}][id]" value="{{ $produit->id }}">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="mt-6 text-right">
                                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded-lg">
                                    Passer commande
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
