<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mes commandes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if($commandes->isEmpty())
                        <p>Vous n'avez encore passé aucune commande.</p>
                    @else
                        <div class="space-y-6">
                            @foreach($commandes as $commande)
                                <div class="border rounded-lg p-4">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <p class="font-semibold">Commande #{{ $commande->id }}</p>
                                            <p class="text-sm text-gray-500">Fournisseur : {{ $commande->fournisseur->nom_entreprise ?? $commande->fournisseur->user->name }}</p>
                                            <p class="text-sm text-gray-500">Date : {{ $commande->created_at->format('d/m/Y H:i') }}</p>
                                        </div>
                                        <span class="px-2 py-1 text-xs rounded-full {{ $commande->statut == 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                                            {{ $commande->statut == 'pending' ? 'En attente' : 'Traitée' }}
                                        </span>
                                    </div>
                                    <div class="mt-3">
                                        <h4 class="font-medium">Détails :</h4>
                                        <ul class="list-disc list-inside">
                                            @foreach($commande->produits as $produit)
                                                <li>{{ $produit->nom }} x {{ $produit->pivot->quantite }} = {{ number_format($produit->prix * $produit->pivot->quantite, 2) }} €</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
