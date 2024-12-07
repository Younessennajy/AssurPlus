<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bienvenue - Gestion B2B & B2C</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">

    <!-- Navigation -->
    <nav class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="text-lg font-semibold text-orange-600">
                    <img src="<?php echo e(asset('assets/logo.png')); ?>" alt="logo" width="50px" height="50px">
                </div>
                <div class="flex items-center space-x-4">
                    <a href="#" class="text-gray-700 hover:text-gray-900">Fonctionnalités</a>
                    <a href="#" class="text-gray-700 hover:text-gray-900">Tarification</a>
                    <a href="#" class="text-gray-700 hover:text-gray-900">Support</a>
                    <a href="<?php echo e(route('login')); ?>" class="bg-orange-500 text-white px-6 py-2 rounded-md hover:bg-orange-600 transition duration-200">Se connecter</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Section Héro -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <!-- Colonne de gauche -->
            <div>
                <h1 class="text-4xl font-bold mb-6">
                    Centralisez et Gérez<br>
                    <span class="text-orange-500">Vos Données</span>
                </h1>
                <p class="text-lg text-gray-600 mb-8">
                    Optimisez vos processus B2B et B2C avec des outils puissants pour l'importation, le filtrage et l'analyse des données. Concentrez-vous sur votre entreprise pendant que nous simplifions vos données.
                </p>
                <div class="flex gap-4">
                    <a href="<?php echo e(route('login')); ?>" class="bg-orange-500 text-white px-8 py-3 rounded-md hover:bg-orange-600 transition duration-200">
                        Commencer
                    </a>
                    <button class="flex items-center gap-2 text-gray-700 hover:text-gray-900">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z"></path>
                        </svg>
                        Regarder la démo
                    </button>
                </div>
            </div>

            <!-- Colonne de droite : Image -->
            <div class="relative">
                <img src="<?php echo e(asset('assets/b2b.jpg')); ?>" alt="Illustration de la gestion des données" class="rounded-lg shadow-lg">
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-white py-6 border-t">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-sm text-gray-500">
            © <?php echo e(now()->year); ?> Gestion B2B & B2C. Tous droits réservés.
        </div>
    </footer>

</body>
</html>
<?php /**PATH C:\xampp\htdocs\justets\AssurPlus\resources\views/welcome.blade.php ENDPATH**/ ?>