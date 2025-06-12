<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export Dashboard - Options</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <div class="min-h-screen py-8">
        <div class="max-w-4xl mx-auto px-4">
            <!-- Header -->
            <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">📊 Export Dashboard</h1>
                        <p class="text-gray-600 mt-1">Configurez votre rapport personnalisé</p>
                    </div>
                    <div class="text-right">
                        <div class="text-sm text-gray-500">Date d'export</div>
                        <div class="font-semibold" id="currentDateTime"></div>
                    </div>
                </div>
            </div>

            <form action="/admin/export/pdf" method="GET" id="exportForm">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Options principales -->
                    <div class="lg:col-span-2 space-y-6">
                        <!-- Période -->
                        <div class="bg-white rounded-lg shadow-sm p-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                <i class="fas fa-calendar-alt text-blue-500 mr-2"></i>
                                Période d'analyse
                            </h3>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                                <label class="filter-option">
                                    <input type="radio" name="filtre" value="jour" class="sr-only" checked>
                                    <div class="filter-card">
                                        <i class="fas fa-sun text-yellow-500"></i>
                                        <span>Aujourd'hui</span>
                                    </div>
                                </label>
                                <label class="filter-option">
                                    <input type="radio" name="filtre" value="semaine" class="sr-only">
                                    <div class="filter-card">
                                        <i class="fas fa-calendar-week text-green-500"></i>
                                        <span>Cette semaine</span>
                                    </div>
                                </label>
                                <label class="filter-option">
                                    <input type="radio" name="filtre" value="mois" class="sr-only">
                                    <div class="filter-card">
                                        <i class="fas fa-calendar text-blue-500"></i>
                                        <span>Ce mois</span>
                                    </div>
                                </label>
                                <label class="filter-option">
                                    <input type="radio" name="filtre" value="annee" class="sr-only">
                                    <div class="filter-card">
                                        <i class="fas fa-calendar-alt text-purple-500"></i>
                                        <span>Cette année</span>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Format -->
                        <div class="bg-white rounded-lg shadow-sm p-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                <i class="fas fa-file-pdf text-red-500 mr-2"></i>
                                Format du rapport
                            </h3>
                            <div class="space-y-3">
                                <label class="format-option">
                                    <input type="radio" name="format" value="complet" class="sr-only" checked>
                                    <div class="format-card">
                                        <div class="flex items-center">
                                            <i class="fas fa-file-alt text-blue-500 mr-3 text-xl"></i>
                                            <div>
                                                <div class="font-semibold">Rapport complet</div>
                                                <div class="text-sm text-gray-600">Toutes les statistiques et graphiques</div>
                                            </div>
                                        </div>
                                    </div>
                                </label>
                                <label class="format-option">
                                    <input type="radio" name="format" value="resume" class="sr-only">
                                    <div class="format-card">
                                        <div class="flex items-center">
                                            <i class="fas fa-file text-green-500 mr-3 text-xl"></i>
                                            <div>
                                                <div class="font-semibold">Résumé exécutif</div>
                                                <div class="text-sm text-gray-600">Indicateurs clés uniquement</div>
                                            </div>
                                        </div>
                                    </div>
                                </label>
                                <label class="format-option">
                                    <input type="radio" name="format" value="personnalise" class="sr-only">
                                    <div class="format-card">
                                        <div class="flex items-center">
                                            <i class="fas fa-cog text-purple-500 mr-3 text-xl"></i>
                                            <div>
                                                <div class="font-semibold">Personnalisé</div>
                                                <div class="text-sm text-gray-600">Choisissez vos sections</div>
                                            </div>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Sections personnalisées -->
                        <div class="bg-white rounded-lg shadow-sm p-6" id="customSections" style="display: none;">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                <i class="fas fa-list-check text-indigo-500 mr-2"></i>
                                Sections à inclure
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                <label class="section-option">
                                    <input type="checkbox" name="sections[]" value="utilisateurs" class="sr-only" checked>
                                    <div class="section-card">
                                        <i class="fas fa-users text-blue-500"></i>
                                        <span>Utilisateurs</span>
                                    </div>
                                </label>
                                <label class="section-option">
                                    <input type="checkbox" name="sections[]" value="revenus" class="sr-only" checked>
                                    <div class="section-card">
                                        <i class="fas fa-chart-line text-green-500"></i>
                                        <span>Revenus</span>
                                    </div>
                                </label>
                                <label class="section-option">
                                    <input type="checkbox" name="sections[]" value="abonnements" class="sr-only" checked>
                                    <div class="section-card">
                                        <i class="fas fa-credit-card text-yellow-500"></i>
                                        <span>Abonnements</span>
                                    </div>
                                </label>
                                <label class="section-option">
                                    <input type="checkbox" name="sections[]" value="rendezvous" class="sr-only" checked>
                                    <div class="section-card">
                                        <i class="fas fa-calendar text-purple-500"></i>
                                        <span>Rendez-vous</span>
                                    </div>
                                </label>
                                <label class="section-option">
                                    <input type="checkbox" name="sections[]" value="messages" class="sr-only" checked>
                                    <div class="section-card">
                                        <i class="fas fa-envelope text-red-500"></i>
                                        <span>Messages</span>
                                    </div>
                                </label>
                                <label class="section-option">
                                    <input type="checkbox" name="sections[]" value="graphiques" class="sr-only" checked>
                                    <div class="section-card">
                                        <i class="fas fa-chart-bar text-indigo-500"></i>
                                        <span>Graphiques</span>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Aperçu et actions -->
                    <div class="space-y-6">
                        <!-- Aperçu -->
                        <div class="bg-white rounded-lg shadow-sm p-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                <i class="fas fa-eye text-gray-500 mr-2"></i>
                                Aperçu
                            </h3>
                            <div class="space-y-3 text-sm">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Période:</span>
                                    <span id="previewPeriod" class="font-medium">Aujourd'hui</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Format:</span>
                                    <span id="previewFormat" class="font-medium">Complet</span>
                                </div>
                                <div class="border-t pt-3">
                                    <div class="text-gray-600 mb-2">Sections incluses:</div>
                                    <div id="previewSections" class="text-xs text-gray-500">
                                        • Toutes les sections
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Statistiques rapides -->
                        <div class="bg-gradient-to-br from-blue-50 to-indigo-100 rounded-lg p-6">
                            <h3 class="font-semibold text-gray-800 mb-3 flex items-center">
                                <i class="fas fa-tachometer-alt text-blue-600 mr-2"></i>
                                Aperçu des données
                            </h3>
                            <div class="space-y-2 text-sm">
                                <div class="flex justify-between">
                                    <span>Utilisateurs totaux:</span>
                                    <span class="font-bold text-blue-600">1,247</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Revenus ce mois:</span>
                                    <span class="font-bold text-green-600">15,430 MAD</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>RDV en attente:</span>
                                    <span class="font-bold text-yellow-600">23</span>
                                </div>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="space-y-3">
                            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded-lg transition duration-200 flex items-center justify-center">
                                <i class="fas fa-download mr-2"></i>
                                Télécharger PDF
                            </button>
                            <button type="button" id="previewBtn" class="w-full bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-3 px-4 rounded-lg transition duration-200 flex items-center justify-center">
                                <i class="fas fa-eye mr-2"></i>
                                Aperçu
                            </button>
                            <a href="/admin/dashboard" class="block w-full bg-white hover:bg-gray-50 text-gray-700 font-semibold py-3 px-4 rounded-lg border border-gray-300 transition duration-200 flex items-center justify-center">
                                <i class="fas fa-arrow-left mr-2"></i>
                                Retour au dashboard
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <style>
        .filter-option input:checked + .filter-card {
            @apply bg-blue-50 border-blue-300 text-blue-700;
        }
        
        .filter-card {
            @apply border-2 border-gray-200 rounded-lg p-4 text-center cursor-pointer transition-all duration-200 hover:border-gray-300;
        }
        
        .filter-card i {
            @apply block text-xl mb-2;
        }
        
        .format-option input:checked + .format-card {
            @apply bg-blue-50 border-blue-300;
        }
        
        .format-card {
            @apply border-2 border-gray-200 rounded-lg p-4 cursor-pointer transition-all duration-200 hover:border-gray-300;
        }
        
        .section-option input:checked + .section-card {
            @apply bg-green-50 border-green-300 text-green-700;
        }
        
        .section-card {
            @apply border-2 border-gray-200 rounded-lg p-3 text-center cursor-pointer transition-all duration-200 hover:border-gray-300 flex items-center;
        }
        
        .section-card i {
            @apply mr-2;
        }
    </style>

        <script>
        // Mise à jour de l'heure toutes les secondes
        function updateDateTime() {
            const now = new Date();
            const options = { 
                year: 'numeric', month: '2-digit', day: '2-digit',
                hour: '2-digit', minute: '2-digit', second: '2-digit',
                hour12: false
            };
            const formatted = now.toLocaleDateString('fr-FR', options).replace(',', ' à');
            document.getElementById('currentDateTime').textContent = formatted;
        }
        setInterval(updateDateTime, 1000);
        updateDateTime();

        // DOM Elements
        const formatRadios = document.querySelectorAll('input[name="format"]');
        const customSections = document.getElementById('customSections');

        const filtreRadios = document.querySelectorAll('input[name="filtre"]');
        const sectionsCheckboxes = document.querySelectorAll('input[name="sections[]"]');

        const previewPeriod = document.getElementById('previewPeriod');
        const previewFormat = document.getElementById('previewFormat');
        const previewSections = document.getElementById('previewSections');

        // Fonction pour afficher ou cacher la section "Sections personnalisées"
        function toggleCustomSections() {
            const selectedFormat = document.querySelector('input[name="format"]:checked').value;
            if (selectedFormat === 'personnalise') {
                customSections.style.display = 'block';
            } else {
                customSections.style.display = 'none';
            }
        }

        // Met à jour l'aperçu à chaque changement
        function updatePreview() {
            // Période sélectionnée (libellé du label)
            const selectedFiltre = document.querySelector('input[name="filtre"]:checked');
            const periodLabel = selectedFiltre ? selectedFiltre.parentElement.querySelector('span').textContent : '';
            previewPeriod.textContent = periodLabel;

            // Format sélectionné
            const selectedFormat = document.querySelector('input[name="format"]:checked');
            let formatLabel = '';
            if (selectedFormat) {
                switch(selectedFormat.value) {
                    case 'complet':
                        formatLabel = 'Complet';
                        break;
                    case 'resume':
                        formatLabel = 'Résumé exécutif';
                        break;
                    case 'personnalise':
                        formatLabel = 'Personnalisé';
                        break;
                }
            }
            previewFormat.textContent = formatLabel;

            // Sections sélectionnées (uniquement si format personnalisé)
            if (selectedFormat.value === 'personnalise') {
                const selectedSections = Array.from(sectionsCheckboxes)
                    .filter(cb => cb.checked)
                    .map(cb => cb.parentElement.querySelector('span').textContent);
                if (selectedSections.length > 0) {
                    previewSections.textContent = selectedSections.map(s => '• ' + s).join('\n');
                } else {
                    previewSections.textContent = '• Aucune section sélectionnée';
                }
            } else {
                previewSections.textContent = '• Toutes les sections';
            }
        }

        // Évènements
        formatRadios.forEach(radio => {
            radio.addEventListener('change', () => {
                toggleCustomSections();
                updatePreview();
            });
        });

        filtreRadios.forEach(radio => {
            radio.addEventListener('change', updatePreview);
        });

        sectionsCheckboxes.forEach(cb => {
            cb.addEventListener('change', updatePreview);
        });

        // Initialisation
        toggleCustomSections();
        updatePreview();

        // Bouton Aperçu : affiche une modale simple avec résumé des options
        document.getElementById('previewBtn').addEventListener('click', () => {
            const period = previewPeriod.textContent;
            const format = previewFormat.textContent;
            const sections = previewSections.textContent.replace(/\n/g, '<br>');

            const modalHtml = `
                <div id="modalOverlay" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
                    <div class="bg-white rounded-lg shadow-lg max-w-md w-full p-6 relative">
                        <h2 class="text-xl font-bold mb-4">Aperçu du rapport</h2>
                        <p><strong>Période :</strong> ${period}</p>
                        <p><strong>Format :</strong> ${format}</p>
                        <p class="mt-3"><strong>Sections incluses :</strong><br>${sections}</p>
                        <button id="closeModal" class="mt-6 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Fermer</button>
                    </div>
                </div>
            `;

            // Ajouter la modale au body
            const modalWrapper = document.createElement('div');
            modalWrapper.innerHTML = modalHtml;
            document.body.appendChild(modalWrapper);

            // Gestion fermeture modale
            document.getElementById('closeModal').addEventListener('click', () => {
                document.body.removeChild(modalWrapper);
            });
            // Fermeture modale au clic hors contenu
            modalWrapper.querySelector('#modalOverlay').addEventListener('click', (e) => {
                if (e.target.id === 'modalOverlay') {
                    document.body.removeChild(modalWrapper);
                }
            });
        });
    </script>
