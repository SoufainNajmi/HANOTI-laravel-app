<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Tableau de bord Fournisseur') }}
            </h2>
            <button onclick="openProductModal()" class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm">+ Ajouter un produit</button>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6">{{ session('success') }}</div>
            @endif

            <!-- Liste des produits -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
                <div class="p-6">
                    <h3 class="text-lg font-bold mb-4">Mes produits</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($produits as $produit)
                            <div class="border rounded-lg p-4">
                                <h4 class="font-bold">{{ $produit->nom }}</h4>
                                <p class="text-gray-600">{{ $produit->description ?? '' }}</p>
                                <p class="text-indigo-600 font-semibold">{{ number_format($produit->prix, 2) }} €</p>
                                <div class="mt-2 flex gap-2">
                                    <button onclick="editProduct({{ $produit->id }}, '{{ $produit->nom }}', {{ $produit->prix }}, '{{ addslashes($produit->description) }}')" class="text-blue-600">Modifier</button>
                                    <form method="POST" action="{{ route('supplier.produit.supprimer', $produit->id) }}" onsubmit="return confirm('Supprimer ce produit ?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-600">Supprimer</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Commandes reçues -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-bold mb-4">Commandes reçues</h3>
                    @if($commandes->isEmpty())
                        <p>Aucune commande pour le moment.</p>
                    @else
                        <div class="space-y-4">
                            @foreach($commandes as $commande)
                                <div class="border rounded-lg p-4">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <p class="font-semibold">Commande #{{ $commande->id }}</p>
                                            <p>Client : {{ $commande->client->user->name }}</p>
                                            <p>Date : {{ $commande->created_at->format('d/m/Y H:i') }}</p>
                                        </div>
                                        <div>
                                            @if($commande->statut == 'pending')
                                                <form method="POST" action="{{ route('supplier.commande.traiter', $commande->id) }}">
                                                    @csrf
                                                    <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded text-sm">Marquer traitée</button>
                                                </form>
                                            @else
                                                <span class="px-2 py-1 bg-green-100 text-green-800 rounded text-sm">Traitée</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        <h4>Détails commande :</h4>
                                        <ul>
                                            @foreach($commande->produits as $produit)
                                                <li>{{ $produit->nom }} - Quantité : {{ $produit->pivot->quantite }} - Prix unitaire : {{ number_format($produit->prix, 2) }} €</li>
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

    <!-- Modal ajout/modification produit -->
    <div id="productModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 w-96">
            <h3 id="modalTitle" class="text-lg font-bold mb-4">Ajouter un produit</h3>
            <form id="productForm" method="POST" action="{{ route('supplier.produit.ajouter') }}">
                @csrf
                <input type="hidden" id="product_id" name="product_id">
                <div class="mb-4">
                    <label class="block text-sm font-medium">Nom</label>
                    <input type="text" name="nom" id="product_name" required class="w-full border rounded px-2 py-1">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium">Prix (€)</label>
                    <input type="number" step="0.01" name="prix" id="product_price" required class="w-full border rounded px-2 py-1">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium">Description</label>
                    <textarea name="description" id="product_description" rows="2" class="w-full border rounded px-2 py-1"></textarea>
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeModal()" class="bg-gray-300 px-4 py-1 rounded">Annuler</button>
                    <button type="submit" class="bg-indigo-600 text-white px-4 py-1 rounded">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openProductModal() {
            document.getElementById('productModal').style.display = 'flex';
            document.getElementById('modalTitle').innerText = 'Ajouter un produit';
            document.getElementById('productForm').reset();
            document.getElementById('product_id').value = '';
        }
        function closeModal() {
            document.getElementById('productModal').style.display = 'none';
        }
        function editProduct(id, name, price, description) {
            openProductModal();
            document.getElementById('modalTitle').innerText = 'Modifier le produit';
            document.getElementById('product_id').value = id;
            document.getElementById('product_name').value = name;
            document.getElementById('product_price').value = price;
            document.getElementById('product_description').value = description;
            // Changer l'action du formulaire
            document.getElementById('productForm').action = `/supplier/produit/modifier/${id}`;
            // Ajouter la méthode PUT via un champ caché
            let methodField = document.querySelector('input[name="_method"]');
            if(!methodField) {
                methodField = document.createElement('input');
                methodField.type = 'hidden';
                methodField.name = '_method';
                document.getElementById('productForm').appendChild(methodField);
            }
            methodField.value = 'PUT';
        }
    </script>
</x-app-layout>
