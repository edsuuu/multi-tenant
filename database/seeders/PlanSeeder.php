<?php

namespace Database\Seeders;

use App\Models\Plans;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Plans::insert([
            [
                'name' => 'Básico',
                'description' => 'Saia do caderninho ou planilha e venha para o novo mundo digital.',
                'price_monthly' => 32.80,
                'price_quarterly' => 98.40,
                'price_yearly' => 393.00,
                'features' => json_encode([
                    '1 profissional cadastrado',
                    'Até 200 clientes cadastrados',
                    'Link de agendamento com logo Gendo',
                    'Ferramentas de gestão da agenda',
                    'Ferramentas de gestão básicas',
                    'Teste grátis por 7 dias sem cadastro de cartão de crédito antecipado'
                ]),
                'trial_days' => 7,
                'active' => true,
            ],
            [
                'name' => 'Essencial',
                'description' => 'Controle e gestão essencial para o dia a dia de sua empresa.',
                'price_monthly' => 57.35,
                'price_quarterly' => 172.05,
                'price_yearly' => 688.00,
                'features' => json_encode([
                    '2 profissionais cadastrados',
                    '100 notificações WhatsApp / mês',
                    'Até 2.000 clientes cadastrados',
                    'Link de agendamento com seu logo + Gendo',
                    'Ferramentas de gestão básicas',
                    'Teste grátis por 7 dias sem cadastro de cartão de crédito antecipado'
                ]),
                'trial_days' => 7,
                'active' => true,
            ],
            [
                'name' => 'Avançado',
                'description' => 'Agilize o crescimento de sua empresa com a Gendo.',
                'price_monthly' => 99.54,
                'price_quarterly' => 298.62,
                'price_yearly' => 1194.00,
                'features' => json_encode([
                    '6 profissionais cadastrados',
                    '200 notificações WhatsApp / mês',
                    'Até 5.000 clientes cadastrados',
                    'Link de agendamento com seu logo',
                    'Ferramentas de gestão avançadas',
                    'Teste grátis por 7 dias sem cadastro de cartão de crédito antecipado'
                ]),
                'trial_days' => 7,
                'active' => true,
            ],
            [
                'name' => 'Profissional',
                'description' => 'Total controle da sua empresa e produtividade.',
                'price_monthly' => 176.15,
                'price_quarterly' => 528.45,
                'price_yearly' => 2113.00,
                'features' => json_encode([
                    '15 profissionais cadastrados',
                    '400 notificações WhatsApp / mês',
                    'Clientes ilimitados',
                    'Link de agendamento com seu logo',
                    'Ferramentas de gestão completa',
                    'Teste grátis por 7 dias sem cadastro de cartão de crédito antecipado'
                ]),
                'trial_days' => 7,
                'active' => true,
            ],
        ]);
    }
}
