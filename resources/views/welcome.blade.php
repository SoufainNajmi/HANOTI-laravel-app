<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hanoti - Plateforme E-commerce</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-10px);
            }
        }

        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.7;
            }
        }

        .animate-fadeInUp {
            animation: fadeInUp 0.8s ease-out forwards;
        }

        .animate-slideInLeft {
            animation: slideInLeft 0.8s ease-out forwards;
        }

        .animate-slideInRight {
            animation: slideInRight 0.8s ease-out forwards;
        }

        .animate-float {
            animation: float 3s ease-in-out infinite;
        }

        .animate-pulse-slow {
            animation: pulse 2s ease-in-out infinite;
        }

        .delay-100 {
            animation-delay: 0.1s;
        }

        .delay-200 {
            animation-delay: 0.2s;
        }

        .delay-300 {
            animation-delay: 0.3s;
        }

        .hover-scale {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .hover-scale:hover {
            transform: scale(1.05);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }

        .hover-glow:hover {
            box-shadow: 0 0 20px rgba(99, 102, 241, 0.5);
        }

        .bg-gradient-custom {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-indigo-50 via-white to-purple-50 min-h-screen flex flex-col">

    <!-- Enhanced Navbar -->
    <nav class="bg-white/90 backdrop-blur-md shadow-lg sticky top-0 z-50 border-b border-gray-100">
        <div class="container mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <!-- Logo -->
                <div class="flex items-center space-x-2 animate-slideInLeft">
                    <i class="fas fa-crown text-3xl text-indigo-600 animate-float"></i>
                    <h1 class="text-2xl font-extrabold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                        HANOTI
                    </h1>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#home" class="text-gray-700 hover:text-indigo-600 font-medium transition-colors duration-300">
                        <i class="fas fa-home mr-2"></i>Accueil
                    </a>
                    <a href="#about" class="text-gray-700 hover:text-indigo-600 font-medium transition-colors duration-300">
                        <i class="fas fa-info-circle mr-2"></i>À propos
                    </a>
                    <a href="#features" class="text-gray-700 hover:text-indigo-600 font-medium transition-colors duration-300">
                        <i class="fas fa-star mr-2"></i>Fonctionnalités
                    </a>
                    <a href="#contact" class="text-gray-700 hover:text-indigo-600 font-medium transition-colors duration-300">
                        <i class="fas fa-envelope mr-2"></i>Contact
                    </a>
                </div>

                <!-- Auth Buttons -->
                <div class="flex items-center space-x-4 animate-slideInRight">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-5 py-2 rounded-full font-medium hover:shadow-lg transition-all duration-300 hover-scale">
                                <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-600 hover:text-indigo-600 font-medium transition-colors duration-300">
                                <i class="fas fa-sign-in-alt mr-2"></i>Connexion
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-5 py-2 rounded-full font-medium hover:shadow-lg transition-all duration-300 hover-scale">
                                    <i class="fas fa-user-plus mr-2"></i>Inscription
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>

                <!-- Mobile menu button -->
                <button class="md:hidden text-gray-600 focus:outline-none">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="relative overflow-hidden">
        <!-- Background decoration -->
        <div class="absolute inset-0 bg-gradient-to-br from-indigo-100 via-white to-purple-100 opacity-50"></div>
        <div class="absolute top-20 left-10 w-72 h-72 bg-indigo-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse-slow"></div>
        <div class="absolute bottom-20 right-10 w-72 h-72 bg-purple-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse-slow" style="animation-delay: 1s;"></div>

        <div class="container mx-auto px-6 py-20 md:py-32 relative z-10">
            <div class="flex flex-col lg:flex-row items-center justify-between gap-12">
                <!-- Left content -->
                <div class="flex-1 text-center lg:text-left">
                    <div class="animate-fadeInUp">
                        <span class="inline-block px-4 py-2 bg-indigo-100 text-indigo-600 rounded-full text-sm font-semibold mb-6">
                            <i class="fas fa-rocket mr-2"></i>Plateforme nouvelle génération
                        </span>
                        <h1 class="text-4xl md:text-6xl font-extrabold text-gray-900 mb-6 leading-tight">
                            Bienvenue sur
                            <span class="bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                                HANOTI
                            </span>
                            🚀
                        </h1>
                        <p class="text-xl text-gray-600 mb-8 leading-relaxed">
                            La plateforme e-commerce qui connecte
                            <span class="font-semibold text-indigo-600">Clients</span> et
                            <span class="font-semibold text-indigo-600">Fournisseurs</span>
                            dans un environnement sécurisé et innovant.
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                            @if (Route::has('login'))
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-8 py-3 rounded-full font-semibold hover:shadow-xl transition-all duration-300 hover-scale inline-flex items-center justify-center gap-2">
                                        Accéder au Dashboard <i class="fas fa-arrow-right"></i>
                                    </a>
                                @else
                                    <a href="{{ route('register') }}" class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-8 py-3 rounded-full font-semibold hover:shadow-xl transition-all duration-300 hover-scale inline-flex items-center justify-center gap-2">
                                        Commencer gratuitement <i class="fas fa-arrow-right"></i>
                                    </a>
                                    <a href="{{ route('login') }}" class="border-2 border-indigo-600 text-indigo-600 px-8 py-3 rounded-full font-semibold hover:bg-indigo-50 transition-all duration-300 inline-flex items-center justify-center gap-2">
                                        <i class="fas fa-sign-in-alt"></i> Se connecter
                                    </a>
                                @endauth
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Right Illustration -->
                <div class="flex-1 animate-float">
                    <div class="relative">
                        <div class="absolute inset-0 bg-gradient-to-r from-indigo-400 to-purple-400 rounded-full filter blur-2xl opacity-30"></div>
                        <img src="https://cdn-icons-png.flaticon.com/512/4347/4347629.png" alt="E-commerce illustration" class="relative z-10 w-full max-w-md mx-auto">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Fonctionnalités <span class="bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">exceptionnelles</span>
                </h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Découvrez tous les avantages de notre plateforme pour chaque type d'utilisateur
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Client Card -->
                <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-8 shadow-lg hover-scale transition-all duration-300 delay-100 animate-fadeInUp">
                    <div class="w-16 h-16 bg-indigo-600 rounded-full flex items-center justify-center mb-6 mx-auto">
                        <i class="fas fa-user text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4 text-center">Pour les Clients</h3>
                    <ul class="space-y-3 text-gray-600">
                        <li><i class="fas fa-check-circle text-indigo-600 mr-2"></i> Catalogue de produits variés</li>
                        <li><i class="fas fa-check-circle text-indigo-600 mr-2"></i> Paiements sécurisés</li>
                        <li><i class="fas fa-check-circle text-indigo-600 mr-2"></i> Suivi des commandes en temps réel</li>
                        <li><i class="fas fa-check-circle text-indigo-600 mr-2"></i> Support client 24/7</li>
                    </ul>
                </div>

                <!-- Supplier Card -->
                <div class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-2xl p-8 shadow-lg hover-scale transition-all duration-300 delay-200 animate-fadeInUp">
                    <div class="w-16 h-16 bg-purple-600 rounded-full flex items-center justify-center mb-6 mx-auto">
                        <i class="fas fa-store text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4 text-center">Pour les Fournisseurs</h3>
                    <ul class="space-y-3 text-gray-600">
                        <li><i class="fas fa-check-circle text-purple-600 mr-2"></i> Gestion simplifiée des stocks</li>
                        <li><i class="fas fa-check-circle text-purple-600 mr-2"></i> Analyses et statistiques avancées</li>
                        <li><i class="fas fa-check-circle text-purple-600 mr-2"></i> Outils marketing intégrés</li>
                        <li><i class="fas fa-check-circle text-purple-600 mr-2"></i> Interface intuitive</li>
                    </ul>
                </div>

                <!-- Admin Card -->
                <div class="bg-gradient-to-br from-green-50 to-teal-50 rounded-2xl p-8 shadow-lg hover-scale transition-all duration-300 delay-300 animate-fadeInUp">
                    <div class="w-16 h-16 bg-green-600 rounded-full flex items-center justify-center mb-6 mx-auto">
                        <i class="fas fa-shield-alt text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4 text-center">Pour les Admins</h3>
                    <ul class="space-y-3 text-gray-600">
                        <li><i class="fas fa-check-circle text-green-600 mr-2"></i> Supervision complète</li>
                        <li><i class="fas fa-check-circle text-green-600 mr-2"></i> Modération des utilisateurs</li>
                        <li><i class="fas fa-check-circle text-green-600 mr-2"></i> Rapports détaillés</li>
                        <li><i class="fas fa-check-circle text-green-600 mr-2"></i> Sécurité maximale</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-20 bg-gradient-to-br from-indigo-50 to-purple-50">
        <div class="container mx-auto px-6">
            <div class="flex flex-col lg:flex-row items-center gap-12">
                <div class="flex-1 animate-slideInLeft">
                    <img src="https://cdn-icons-png.flaticon.com/512/1012/1012677.png" alt="About illustration" class="w-full max-w-md mx-auto">
                </div>
                <div class="flex-1 animate-slideInRight">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">
                        À propos de <span class="bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">HANOTI</span>
                    </h2>
                    <p class="text-gray-600 mb-6 leading-relaxed text-lg">
                        HANOTI est une plateforme e-commerce innovante conçue pour faciliter les échanges entre clients et fournisseurs.
                        Notre mission est de créer un écosystème digital fiable, sécurisé et performant où chaque transaction est une réussite.
                    </p>
                    <p class="text-gray-600 mb-8 leading-relaxed">
                        Avec des années d'expérience dans le domaine du commerce électronique, notre équipe s'engage à fournir
                        des solutions de pointe qui répondent aux besoins évolutifs du marché moderne.
                    </p>
                    <div class="grid grid-cols-2 gap-6">
                        <div class="text-center">
                            <div class="text-3xl font-bold text-indigo-600">500+</div>
                            <div class="text-gray-500">Clients satisfaits</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-indigo-600">100+</div>
                            <div class="text-gray-500">Fournisseurs partenaires</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-16 bg-gradient-to-r from-indigo-600 to-purple-600 text-white">
        <div class="container mx-auto px-6">
            <div class="grid md:grid-cols-4 gap-8 text-center">
                <div class="animate-fadeInUp">
                    <i class="fas fa-shopping-cart text-4xl mb-4"></i>
                    <div class="text-3xl font-bold">10K+</div>
                    <div class="text-sm opacity-90">Commandes traitées</div>
                </div>
                <div class="animate-fadeInUp delay-100">
                    <i class="fas fa-users text-4xl mb-4"></i>
                    <div class="text-3xl font-bold">5K+</div>
                    <div class="text-sm opacity-90">Utilisateurs actifs</div>
                </div>
                <div class="animate-fadeInUp delay-200">
                    <i class="fas fa-truck text-4xl mb-4"></i>
                    <div class="text-3xl font-bold">99%</div>
                    <div class="text-sm opacity-90">Livraison à temps</div>
                </div>
                <div class="animate-fadeInUp delay-300">
                    <i class="fas fa-star text-4xl mb-4"></i>
                    <div class="text-3xl font-bold">4.9</div>
                    <div class="text-sm opacity-90">Note moyenne</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact / CTA Section -->
    <section id="contact" class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">
                    Prêt à rejoindre <span class="bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">l'aventure</span> ?
                </h2>
                <p class="text-gray-600 mb-8 text-lg">
                    Créez votre compte gratuitement et commencez à profiter de tous les avantages de notre plateforme dès aujourd'hui.
                </p>
                @if (Route::has('login') && !Auth::check())
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('register') }}" class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-8 py-3 rounded-full font-semibold hover:shadow-xl transition-all duration-300 hover-scale inline-flex items-center justify-center gap-2">
                            Créer un compte <i class="fas fa-arrow-right"></i>
                        </a>
                        <a href="{{ route('login') }}" class="border-2 border-gray-300 text-gray-700 px-8 py-3 rounded-full font-semibold hover:border-indigo-600 hover:text-indigo-600 transition-all duration-300 inline-flex items-center justify-center gap-2">
                            <i class="fas fa-sign-in-alt"></i> Connexion
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Enhanced Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="container mx-auto px-6">
            <div class="grid md:grid-cols-4 gap-8 mb-8">
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <i class="fas fa-crown text-2xl text-indigo-400"></i>
                        <h3 class="text-xl font-bold">HANOTI</h3>
                    </div>
                    <p class="text-gray-400 text-sm">
                        La plateforme e-commerce nouvelle génération pour connecter clients et fournisseurs dans un environnement sécurisé.
                    </p>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Liens rapides</h4>
                    <ul class="space-y-2 text-gray-400 text-sm">
                        <li><a href="#home" class="hover:text-indigo-400 transition-colors">Accueil</a></li>
                        <li><a href="#about" class="hover:text-indigo-400 transition-colors">À propos</a></li>
                        <li><a href="#features" class="hover:text-indigo-400 transition-colors">Fonctionnalités</a></li>
                        <li><a href="#contact" class="hover:text-indigo-400 transition-colors">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Légal</h4>
                    <ul class="space-y-2 text-gray-400 text-sm">
                        <li><a href="#" class="hover:text-indigo-400 transition-colors">Conditions générales</a></li>
                        <li><a href="#" class="hover:text-indigo-400 transition-colors">Politique de confidentialité</a></li>
                        <li><a href="#" class="hover:text-indigo-400 transition-colors">Mentions légales</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Suivez-nous</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-indigo-600 transition-colors">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-indigo-600 transition-colors">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-indigo-600 transition-colors">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-indigo-600 transition-colors">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-800 pt-8 text-center text-gray-500 text-sm">
                <p>&copy; {{ date('Y') }} HANOTI - Tous droits réservés. | Créé avec <i class="fas fa-heart text-red-500"></i> pour la communauté e-commerce</p>
            </div>
        </div>
    </footer>

    <!-- Smooth scroll script -->
    <script>
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
</body>
</html>
