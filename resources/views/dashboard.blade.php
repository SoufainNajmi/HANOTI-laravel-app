<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Tableau de bord Fournisseur') }}
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Gérez vos produits, commandes et performances
                </p>
            </div>
            <div class="text-sm text-gray-500">
                <i class="fas fa-calendar-alt mr-1"></i> {{ now()->format('l d F Y') }}
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Banner -->
            <div class="bg-gradient-to-r from-indigo-500 to-purple-600 rounded-2xl shadow-lg mb-8 overflow-hidden">
                <div class="px-6 py-8 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-2xl font-bold mb-2">
                                Bonjour, {{ Auth::user()->name }} ! 👋
                            </h3>
                            <p class="text-indigo-100">
                                Bienvenue sur votre espace fournisseur. Voici un résumé de votre activité.
                            </p>
                        </div>
                        <div class="hidden md:block">
                            <i class="fas fa-store text-5xl text-white opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-indigo-500 hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm">Produits en stock</p>
                            <p class="text-3xl font-bold text-gray-800" id="totalProducts">0</p>
                            <p class="text-green-500 text-xs mt-1">
                                <i class="fas fa-boxes"></i> En catalogue
                            </p>
                        </div>
                        <div class="w-12 h-12 bg-indigo-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-box text-indigo-600 text-xl"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-green-500 hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm">Commandes reçues</p>
                            <p class="text-3xl font-bold text-gray-800" id="totalOrders">0</p>
                            <p class="text-green-500 text-xs mt-1">
                                <i class="fas fa-arrow-up"></i> +12% ce mois
                            </p>
                        </div>
                        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-shopping-cart text-green-600 text-xl"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-yellow-500 hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm">Chiffre d'affaires</p>
                            <p class="text-3xl font-bold text-gray-800" id="totalRevenue">€0</p>
                            <p class="text-green-500 text-xs mt-1">
                                <i class="fas fa-chart-line"></i> Ce mois
                            </p>
                        </div>
                        <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-euro-sign text-yellow-600 text-xl"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-purple-500 hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm">Notes moyennes</p>
                            <p class="text-3xl font-bold text-gray-800">4.8 ★</p>
                            <p class="text-green-500 text-xs mt-1">
                                <i class="fas fa-star"></i> 156 avis
                            </p>
                        </div>
                        <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-thumbs-up text-purple-600 text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Products Management Section -->
                <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-white">
                        <div class="flex justify-between items-center">
                            <h3 class="text-lg font-semibold text-gray-800">
                                <i class="fas fa-boxes text-indigo-600 mr-2"></i>
                                Gestion des produits
                            </h3>
                            <button onclick="openProductModal()"
                                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300 flex items-center gap-2">
                                <i class="fas fa-plus"></i> Ajouter un produit
                            </button>
                        </div>
                    </div>

                    <div class="p-6">
                        <!-- Search Bar -->
                        <div class="mb-4">
                            <div class="relative">
                                <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                <input type="text"
                                       id="searchProduct"
                                       placeholder="Rechercher un produit..."
                                       class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            </div>
                        </div>

                        <!-- Products Table -->
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Produit</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Prix</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Stock</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Statut</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="productsTableBody" class="bg-white divide-y divide-gray-200">
                                    <!-- Products will be loaded here dynamically -->
                                </tbody>
                            </table>
                        </div>

                        <!-- Empty State -->
                        <div id="emptyState" class="text-center py-12 hidden">
                            <i class="fas fa-box-open text-6xl text-gray-300 mb-4"></i>
                            <p class="text-gray-500">Aucun produit trouvé</p>
                            <button onclick="openProductModal()" class="mt-4 text-indigo-600 hover:text-indigo-700">
                                Ajouter votre premier produit
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Right Sidebar -->
                <div class="space-y-6">
                    <!-- Recent Orders -->
                    <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
                        <div class="p-6 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-800">
                                <i class="fas fa-clock text-indigo-600 mr-2"></i>
                                Commandes récentes
                            </h3>
                        </div>
                        <div class="divide-y divide-gray-100" id="recentOrders">
                            <!-- Orders will be loaded here -->
                        </div>
                    </div>

                    <!-- Sales Chart -->
                    <div class="bg-white rounded-2xl shadow-sm p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">
                            <i class="fas fa-chart-line text-indigo-600 mr-2"></i>
                            Ventes mensuelles
                        </h3>
                        <canvas id="salesChart" class="w-full h-48"></canvas>
                    </div>

                    <!-- Stock Alert -->
                    <div class="bg-yellow-50 rounded-2xl p-6 border border-yellow-200">
                        <div class="flex items-start gap-3">
                            <i class="fas fa-exclamation-triangle text-yellow-600 text-xl"></i>
                            <div>
                                <h4 class="font-semibold text-yellow-800 mb-1">Stock faible</h4>
                                <p class="text-sm text-yellow-700" id="stockAlert">
                                    Chargement...
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Product Modal -->
    <div id="productModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-xl bg-white">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-900" id="modalTitle">Ajouter un produit</h3>
                <button onclick="closeProductModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="productForm">
                <input type="hidden" id="productId">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nom du produit</label>
                    <input type="text" id="productName" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Prix (€)</label>
                    <input type="number" id="productPrice" step="0.01" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Quantité en stock</label>
                    <input type="number" id="productStock" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <textarea id="productDescription" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500"></textarea>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Catégorie</label>
                    <select id="productCategory" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                        <option value="">Sélectionner une catégorie</option>
                        <option value="electronics">Électronique</option>
                        <option value="clothing">Vêtements</option>
                        <option value="food">Alimentation</option>
                        <option value="furniture">Meubles</option>
                    </select>
                </div>
                <div class="flex gap-3">
                    <button type="submit" class="flex-1 bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 transition">
                        Enregistrer
                    </button>
                    <button type="button" onclick="closeProductModal()" class="flex-1 bg-gray-300 text-gray-700 py-2 rounded-lg hover:bg-gray-400 transition">
                        Annuler
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // État local des produits (à remplacer par des appels API vers votre backend)
        let products = [];
        let salesChart = null;

        // Charger les données depuis le backend
        async function loadProducts() {
            try {
                // Exemple d'appel API - à adapter selon votre routes/api.php
                // const response = await fetch('/api/supplier/products');
                // const data = await response.json();
                // products = data;

                // Simulation de données pour la démonstration
                const storedProducts = localStorage.getItem('supplier_products');
                if(storedProducts) {
                    products = JSON.parse(storedProducts);
                } else {
                    products = [
                        { id: 1, name: 'iPhone 14 Pro', price: 1099, stock: 15, description: 'Smartphone haut de gamme', category: 'electronics' },
                        { id: 2, name: 'MacBook Air M2', price: 1299, stock: 8, description: 'Ordinateur portable', category: 'electronics' },
                        { id: 3, name: 'Casque Sony', price: 299, stock: 25, description: 'Casque audio sans fil', category: 'electronics' }
                    ];
                    saveProducts();
                }
                displayProducts();
                updateStatistics();
            } catch (error) {
                console.error('Erreur lors du chargement des produits:', error);
                Swal.fire('Erreur', 'Impossible de charger les produits', 'error');
            }
        }

        function saveProducts() {
            localStorage.setItem('supplier_products', JSON.stringify(products));
            // Appel API pour synchroniser avec le backend
            // fetch('/api/supplier/products', { method: 'POST', body: JSON.stringify(products), headers: {...} });
        }

        function displayProducts() {
            const searchTerm = document.getElementById('searchProduct')?.value.toLowerCase() || '';
            const filteredProducts = products.filter(p =>
                p.name.toLowerCase().includes(searchTerm)
            );

            const tbody = document.getElementById('productsTableBody');
            const emptyState = document.getElementById('emptyState');

            if(filteredProducts.length === 0) {
                tbody.innerHTML = '';
                emptyState.classList.remove('hidden');
                return;
            }

            emptyState.classList.add('hidden');
            tbody.innerHTML = filteredProducts.map(product => `
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-4 py-3">
                        <div class="font-medium text-gray-900">${escapeHtml(product.name)}</div>
                        <div class="text-xs text-gray-500">${product.category || 'Non catégorisé'}</div>
                    </td>
                    <td class="px-4 py-3 text-gray-900">€${product.price.toFixed(2)}</td>
                    <td class="px-4 py-3">
                        <span class="${product.stock < 10 ? 'text-red-600 font-semibold' : 'text-gray-600'}">
                            ${product.stock}
                        </span>
                    </td>
                    <td class="px-4 py-3">
                        <span class="px-2 py-1 text-xs rounded-full ${product.stock > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'}">
                            ${product.stock > 0 ? 'En stock' : 'Rupture'}
                        </span>
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex gap-2">
                            <button onclick="editProduct(${product.id})" class="text-blue-600 hover:text-blue-800">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button onclick="deleteProduct(${product.id})" class="text-red-600 hover:text-red-800">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            `).join('');
        }

        // Helper pour échapper le HTML
        function escapeHtml(str) {
            if (!str) return '';
            return str.replace(/[&<>]/g, function(m) {
                if (m === '&') return '&amp;';
                if (m === '<') return '&lt;';
                if (m === '>') return '&gt;';
                return m;
            });
        }

        // Recherche en temps réel
        document.getElementById('searchProduct')?.addEventListener('input', displayProducts);

        // Modal functions
        function openProductModal(productId = null) {
            const modal = document.getElementById('productModal');
            const modalTitle = document.getElementById('modalTitle');

            if(productId) {
                const product = products.find(p => p.id === productId);
                if(product) {
                    modalTitle.textContent = 'Modifier le produit';
                    document.getElementById('productId').value = product.id;
                    document.getElementById('productName').value = product.name;
                    document.getElementById('productPrice').value = product.price;
                    document.getElementById('productStock').value = product.stock;
                    document.getElementById('productDescription').value = product.description || '';
                    document.getElementById('productCategory').value = product.category || '';
                }
            } else {
                modalTitle.textContent = 'Ajouter un produit';
                document.getElementById('productForm').reset();
                document.getElementById('productId').value = '';
            }
            modal.classList.remove('hidden');
        }

        function closeProductModal() {
            document.getElementById('productModal').classList.add('hidden');
        }

        // Soumission du formulaire (CRUD)
        document.getElementById('productForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            const productId = document.getElementById('productId').value;
            const productData = {
                name: document.getElementById('productName').value,
                price: parseFloat(document.getElementById('productPrice').value),
                stock: parseInt(document.getElementById('productStock').value),
                description: document.getElementById('productDescription').value,
                category: document.getElementById('productCategory').value
            };

            try {
                if(productId) {
                    // Mise à jour
                    const index = products.findIndex(p => p.id == productId);
                    if(index !== -1) {
                        products[index] = { ...products[index], ...productData };
                        // Appel API de mise à jour
                        // await fetch(`/api/supplier/products/${productId}`, { method: 'PUT', body: JSON.stringify(productData), headers: {...} });
                        Swal.fire('Succès!', 'Produit modifié avec succès', 'success');
                    }
                } else {
                    // Création
                    const newId = products.length > 0 ? Math.max(...products.map(p => p.id)) + 1 : 1;
                    products.push({ id: newId, ...productData });
                    // Appel API de création
                    // await fetch('/api/supplier/products', { method: 'POST', body: JSON.stringify(productData), headers: {...} });
                    Swal.fire('Succès!', 'Produit ajouté avec succès', 'success');
                }

                saveProducts();
                displayProducts();
                updateStatistics();
                closeProductModal();
            } catch (error) {
                Swal.fire('Erreur', 'Une erreur est survenue', 'error');
            }
        });

        function editProduct(id) {
            openProductModal(id);
        }

        async function deleteProduct(id) {
            const result = await Swal.fire({
                title: 'Êtes-vous sûr?',
                text: "Cette action est irréversible!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Oui, supprimer!',
                cancelButtonText: 'Annuler'
            });

            if (result.isConfirmed) {
                try {
                    products = products.filter(p => p.id !== id);
                    saveProducts();
                    // Appel API de suppression
                    // await fetch(`/api/supplier/products/${id}`, { method: 'DELETE' });
                    displayProducts();
                    updateStatistics();
                    Swal.fire('Supprimé!', 'Produit supprimé avec succès.', 'success');
                } catch (error) {
                    Swal.fire('Erreur', 'Impossible de supprimer le produit', 'error');
                }
            }
        }

        // Mettre à jour les statistiques (produits, commandes, CA)
        function updateStatistics() {
            const totalProducts = products.length;
            const totalStock = products.reduce((sum, p) => sum + p.stock, 0);
            const totalValue = products.reduce((sum, p) => sum + (p.price * p.stock), 0);

            document.getElementById('totalProducts').textContent = totalProducts;

            // Commandes : ici il faudrait les charger depuis le backend
            // Simulation
            const simulatedOrders = Math.floor(Math.random() * 50) + 10;
            document.getElementById('totalOrders').textContent = simulatedOrders;
            document.getElementById('totalRevenue').textContent = `€${totalValue.toFixed(0)}`;

            // Alerte stock faible
            const lowStock = products.filter(p => p.stock < 10);
            const stockAlertMsg = lowStock.length > 0
                ? `${lowStock.length} produit(s) avec stock faible (${lowStock.map(p => p.name).join(', ')})`
                : 'Tous les stocks sont suffisants ✓';
            document.getElementById('stockAlert').textContent = stockAlertMsg;
        }

        // Charger les commandes récentes (à connecter à votre backend)
        async function loadRecentOrders() {
            try {
                // Exemple d'appel API
                // const response = await fetch('/api/supplier/orders/recent');
                // const orders = await response.json();

                // Données simulées
                const orders = [
                    { id: '#1001', customer: 'Jean Dupont', total: 245, status: 'completed', date: '2024-01-15' },
                    { id: '#1002', customer: 'Marie Martin', total: 567, status: 'pending', date: '2024-01-14' },
                    { id: '#1003', customer: 'Pierre Durant', total: 89, status: 'processing', date: '2024-01-13' }
                ];

                const ordersHtml = orders.map(order => `
                    <div class="p-4 hover:bg-gray-50 transition-colors">
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <p class="font-semibold text-gray-800">${order.id}</p>
                                <p class="text-sm text-gray-500">${order.customer}</p>
                            </div>
                            <span class="px-2 py-1 text-xs rounded-full ${order.status === 'completed' ? 'bg-green-100 text-green-800' : order.status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-blue-100 text-blue-800'}">
                                ${order.status === 'completed' ? 'Livré' : order.status === 'pending' ? 'En attente' : 'En cours'}
                            </span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm font-semibold text-indigo-600">€${order.total}</span>
                            <span class="text-xs text-gray-400">${order.date}</span>
                        </div>
                    </div>
                `).join('');

                document.getElementById('recentOrders').innerHTML = ordersHtml;
            } catch (error) {
                console.error('Erreur chargement commandes:', error);
            }
        }

        // Initialiser le graphique des ventes
        function initChart() {
            const ctx = document.getElementById('salesChart').getContext('2d');
            salesChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jun'],
                    datasets: [{
                        label: 'Ventes (€)',
                        data: [1200, 1900, 1500, 2100, 1800, 2400],
                        borderColor: 'rgb(99, 102, 241)',
                        backgroundColor: 'rgba(99, 102, 241, 0.1)',
                        tension: 0.4,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });
        }

        // Chargement initial
        document.addEventListener('DOMContentLoaded', function() {
            loadProducts();
            loadRecentOrders();
            initChart();
        });
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</x-app-layout>
