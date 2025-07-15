<x-app-layout>
    <div class="p-4 w-full mx-auto">
        <!-- Stats Cards Compactas -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-gray-600">Tenants</p>
                        <p class="text-xl font-bold text-gray-900">1,234</p>
                        <p class="text-xs text-green-600">+12%</p>
                    </div>
                    <div class="bg-blue-100 p-2 rounded-full">
                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-gray-600">Usuários</p>
                        <p class="text-xl font-bold text-gray-900">5,678</p>
                        <p class="text-xs text-green-600">+8%</p>
                    </div>
                    <div class="bg-green-100 p-2 rounded-full">
                        <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-gray-600">Planos</p>
                        <p class="text-xl font-bold text-gray-900">892</p>
                        <p class="text-xs text-red-600">-3%</p>
                    </div>
                    <div class="bg-yellow-100 p-2 rounded-full">
                        <svg class="w-4 h-4 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-gray-600">Receita</p>
                        <p class="text-xl font-bold text-gray-900">R$ 45.2K</p>
                        <p class="text-xs text-green-600">+15%</p>
                    </div>
                    <div class="bg-purple-100 p-2 rounded-full">
                        <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Seção Principal Agrupada -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Gráfico de Uso -->
            <div class="lg:col-span-2 bg-white rounded-lg shadow-sm border border-gray-200 p-4">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Uso da Plataforma</h3>
                    <select class="border border-gray-300 rounded-md px-2 py-1 text-sm">
                        <option>7 dias</option>
                        <option>30 dias</option>
                        <option>90 dias</option>
                    </select>
                </div>
                <div class="h-48 w-full relative">
                    <canvas id="usageChart"></canvas>
                </div>
            </div>

            <!-- Distribuição de Planos -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Planos</h3>
                <div class="h-48 w-full relative">
                    <canvas id="planChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Seção Inferior -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">
            <!-- Tenants Recentes -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="px-4 py-3 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-900">Tenants Recentes</h3>
                        <a href="#" class="text-sm text-blue-600 hover:text-blue-800">Ver todos</a>
                    </div>
                </div>
                <div class="p-0">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Nome</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Plano</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="px-4 py-3 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-6 h-6 bg-blue-500 rounded-full flex items-center justify-center text-white text-xs font-medium">T</div>
                                        <div class="ml-2">
                                            <div class="text-sm font-medium text-gray-900">Tech Solutions</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap">
                                    <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">Plus</span>
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap">
                                    <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">Ativo</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-4 py-3 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-6 h-6 bg-green-500 rounded-full flex items-center justify-center text-white text-xs font-medium">I</div>
                                        <div class="ml-2">
                                            <div class="text-sm font-medium text-gray-900">Inovação Corp</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap">
                                    <span class="px-2 py-1 text-xs font-medium bg-purple-100 text-purple-800 rounded-full">Premium</span>
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap">
                                    <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">Ativo</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-4 py-3 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-6 h-6 bg-yellow-500 rounded-full flex items-center justify-center text-white text-xs font-medium">D</div>
                                        <div class="ml-2">
                                            <div class="text-sm font-medium text-gray-900">Digital Agency</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap">
                                    <span class="px-2 py-1 text-xs font-medium bg-gray-100 text-gray-800 rounded-full">Básico</span>
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap">
                                    <span class="px-2 py-1 text-xs font-medium bg-gray-100 text-gray-800 rounded-full">Inativo</span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Atividade do Sistema -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="px-4 py-3 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Atividade Recente</h3>
                </div>
                <div class="p-4">
                    <div class="space-y-3">
                        <div class="flex items-start gap-3">
                            <div class="w-2 h-2 bg-blue-500 rounded-full mt-1.5"></div>
                            <div class="flex-1">
                                <p class="text-sm text-gray-900">Novo tenant: <span class="font-medium">Tech Solutions</span></p>
                                <p class="text-xs text-gray-500">2 min atrás</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-2 h-2 bg-green-500 rounded-full mt-1.5"></div>
                            <div class="flex-1">
                                <p class="text-sm text-gray-900">Login: <span class="font-medium">João Silva</span></p>
                                <p class="text-xs text-gray-500">5 min atrás</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-2 h-2 bg-yellow-500 rounded-full mt-1.5"></div>
                            <div class="flex-1">
                                <p class="text-sm text-gray-900">Plano atualizado: <span class="font-medium">Inovação Corp</span></p>
                                <p class="text-xs text-gray-500">15 min atrás</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-2 h-2 bg-red-500 rounded-full mt-1.5"></div>
                            <div class="flex-1">
                                <p class="text-sm text-gray-900">Tenant desativado: <span class="font-medium">Old Company</span></p>
                                <p class="text-xs text-gray-500">30 min atrás</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-2 h-2 bg-purple-500 rounded-full mt-1.5"></div>
                            <div class="flex-1">
                                <p class="text-sm text-gray-900">Backup realizado</p>
                                <p class="text-xs text-gray-500">1h atrás</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <script>
        // Gráfico de Uso
        const usageCtx = document.getElementById('usageChart').getContext('2d');
        new Chart(usageCtx, {
            type: 'line',
            data: {
                labels: ['Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
                datasets: [{
                    label: 'Usuários Ativos',
                    data: [1200, 1900, 3000, 2500, 2200, 1800, 2400],
                    borderColor: 'rgb(59, 130, 246)',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.1)'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        // Gráfico de Planos
        const planCtx = document.getElementById('planChart').getContext('2d');
        new Chart(planCtx, {
            type: 'doughnut',
            data: {
                labels: ['Básico', 'Plus', 'Premium'],
                datasets: [{
                    data: [45, 35, 20],
                    backgroundColor: [
                        'rgba(156, 163, 175, 0.8)',
                        'rgba(59, 130, 246, 0.8)',
                        'rgba(147, 51, 234, 0.8)'
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 10,
                            usePointStyle: true,
                            font: {
                                size: 12
                            }
                        }
                    }
                }
            }
        });
    </script>
</x-app-layout>
