<?php

namespace Database\Seeders;

use App\Models\Segments;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreateSegment extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Criando os segmentos
        $seg_beleza = Segments::create([
            'name' => 'Beleza e Cuidados Pessoais',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $seg_bemestar = Segments::create([
            'name' => 'Serviços de Saúde e Bem-Estar',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $seg_saude = Segments::create([
            'name' => 'Saúde Animal',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $seg_servicos = Segments::create([
            'name' => 'Serviços Automotivos',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $seg_tech = Segments::create([
            'name' => 'Tecnologia e Consultoria',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $seg_education = Segments::create([
            'name' => 'Educação e Treinamentos',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $seg_fit = Segments::create([
            'name' => 'Fitness e Esportes',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $seg_tatto = Segments::create([
            'name' => 'Tatto & Body Art',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $seg_outros = Segments::create([
            'name' => 'Outros',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Preenchendo as categorias para cada segmento
//        DB::table('segment_types')->insert([
//            // Segmento Beleza
//            [
//                'segments_id' => $seg_beleza->id,
//                'name' => 'Clínica de Estética',
//                'created_at' => now(),
//                'updated_at' => now(),
//            ],
//            [
//                'segments_id' => $seg_beleza->id,
//                'name' => 'Esmalteria e manicure',
//                'created_at' => now(),
//                'updated_at' => now(),
//            ],
//            [
//                'segments_id' => $seg_beleza->id,
//                'name' => 'Salão de beleza',
//                'created_at' => now(),
//                'updated_at' => now(),
//            ],
//            [
//                'segments_id' => $seg_beleza->id,
//                'name' => 'Barbearia',
//                'created_at' => now(),
//                'updated_at' => now(),
//            ],
//            [
//                'segments_id' => $seg_beleza->id,
//                'name' => 'Maquiagem',
//                'created_at' => now(),
//                'updated_at' => now(),
//            ],
//            [
//                'segments_id' => $seg_beleza->id,
//                'name' => 'Sobrancelhas e Cílios',
//                'created_at' => now(),
//                'updated_at' => now(),
//            ],
//            [
//                'segments_id' => $seg_beleza->id,
//                'name' => 'Depilação',
//                'created_at' => now(),
//                'updated_at' => now(),
//            ],
//            [
//                'segments_id' => $seg_beleza->id,
//                'name' => 'Cabeleireiro',
//                'created_at' => now(),
//                'updated_at' => now(),
//            ],
//
//            // Segmento Bem Estar
//            [
//                'segments_id' => $seg_bemestar->id,
//                'name' => 'Acupuntura',
//                'created_at' => now(),
//                'updated_at' => now(),
//            ],
//            [
//                'segments_id' => $seg_bemestar->id,
//                'name' => 'Massagem',
//                'created_at' => now(),
//                'updated_at' => now(),
//            ],
//            [
//                'segments_id' => $seg_bemestar->id,
//                'name' => 'Yoga e Pilates',
//                'created_at' => now(),
//                'updated_at' => now(),
//            ],
//            [
//                'segments_id' => $seg_bemestar->id,
//                'name' => 'SPA',
//                'created_at' => now(),
//                'updated_at' => now(),
//            ],
//            [
//                'segments_id' => $seg_bemestar->id,
//                'name' => 'Psicologia e Pedagogia',
//                'created_at' => now(),
//                'updated_at' => now(),
//            ],
//            [
//                'segments_id' => $seg_bemestar->id,
//                'name' => 'Quiropraxia',
//                'created_at' => now(),
//                'updated_at' => now(),
//            ],
//            [
//                'segments_id' => $seg_bemestar->id,
//                'name' => 'Personal e Fitness',
//                'created_at' => now(),
//                'updated_at' => now(),
//            ],
//            [
//                'segments_id' => $seg_bemestar->id,
//                'name' => 'Terapias Holísticas',
//                'created_at' => now(),
//                'updated_at' => now(),
//            ],
//
//            // Segmento Saúde
//            [
//                'segments_id' => $seg_saude->id,
//                'name' => 'Psiquiatra',
//                'created_at' => now(),
//                'updated_at' => now(),
//            ],
//            [
//                'segments_id' => $seg_saude->id,
//                'name' => 'Endocrinologista',
//                'created_at' => now(),
//                'updated_at' => now(),
//            ],
//            [
//                'segments_id' => $seg_saude->id,
//                'name' => 'Podologia',
//                'created_at' => now(),
//                'updated_at' => now(),
//            ],
//            [
//                'segments_id' => $seg_saude->id,
//                'name' => 'Cardiologista',
//                'created_at' => now(),
//                'updated_at' => now(),
//            ],
//            [
//                'segments_id' => $seg_saude->id,
//                'name' => 'Fisioterapia',
//                'created_at' => now(),
//                'updated_at' => now(),
//            ],
//            [
//                'segments_id' => $seg_saude->id,
//                'name' => 'Neurologista',
//                'created_at' => now(),
//                'updated_at' => now(),
//            ],
//            [
//                'segments_id' => $seg_saude->id,
//                'name' => 'Dermatologia',
//                'created_at' => now(),
//                'updated_at' => now(),
//            ],
//            [
//                'segments_id' => $seg_saude->id,
//                'name' => 'Clínica Odontológica',
//                'created_at' => now(),
//                'updated_at' => now(),
//            ],
//            [
//                'segments_id' => $seg_saude->id,
//                'name' => 'Pediatra',
//                'created_at' => now(),
//                'updated_at' => now(),
//            ],
//            [
//                'segments_id' => $seg_saude->id,
//                'name' => 'Consultório Médico',
//                'created_at' => now(),
//                'updated_at' => now(),
//            ],
//
//            [
//                'segments_id' => $seg_saude->id,
//                'name' => 'Clínica Oftalmológica',
//                'created_at' => now(),
//                'updated_at' => now(),
//            ],
//
//            [
//                'segments_id' => $seg_saude->id,
//                'name' => 'Geriatra',
//                'created_at' => now(),
//                'updated_at' => now(),
//            ],
//
//            // Segmento Serviços
//            [
//                'segments_id' => $seg_servicos->id,
//                'name' => 'Pet Shop',
//                'created_at' => now(),
//                'updated_at' => now(),
//            ],
//            [
//                'segments_id' => $seg_servicos->id,
//                'name' => 'Oficina Mecânica',
//                'created_at' => now(),
//                'updated_at' => now(),
//            ],
//            [
//                'segments_id' => $seg_servicos->id,
//                'name' => 'Coloração Pessoal',
//                'created_at' => now(),
//                'updated_at' => now(),
//            ],
//            [
//                'segments_id' => $seg_servicos->id,
//                'name' => 'Serviços Automotivos',
//                'created_at' => now(),
//                'updated_at' => now(),
//            ],
//            [
//                'segments_id' => $seg_servicos->id,
//                'name' => 'Tatuagem e Piercing',
//                'created_at' => now(),
//                'updated_at' => now(),
//            ],
//            [
//                'segments_id' => $seg_servicos->id,
//                'name' => 'Consultoria de Estilo',
//                'created_at' => now(),
//                'updated_at' => now(),
//            ],
//            [
//                'segments_id' => $seg_servicos->id,
//                'name' => 'Clínica Veterinária',
//                'created_at' => now(),
//                'updated_at' => now(),
//            ],
//            [
//                'segments_id' => $seg_servicos->id,
//                'name' => 'Tecnologia e Informática',
//                'created_at' => now(),
//                'updated_at' => now(),
//            ],
//
//            // Segmento Agenda Inteligente
//            [
//                'segments_id' => $seg_agenda->id,
//                'name' => 'Consultas',
//                'created_at' => now(),
//                'updated_at' => now(),
//            ],
//            [
//                'segments_id' => $seg_agenda->id,
//                'name' => 'Mentorias',
//                'created_at' => now(),
//                'updated_at' => now(),
//            ],
//            [
//                'segments_id' => $seg_agenda->id,
//                'name' => 'Locação de Quadras',
//                'created_at' => now(),
//                'updated_at' => now(),
//            ],
//            [
//                'segments_id' => $seg_agenda->id,
//                'name' => 'Coworking',
//                'created_at' => now(),
//                'updated_at' => now(),
//            ],
//            [
//                'segments_id' => $seg_agenda->id,
//                'name' => 'Professores',
//                'created_at' => now(),
//                'updated_at' => now(),
//            ],
//            [
//                'segments_id' => $seg_agenda->id,
//                'name' => 'Reuniões',
//                'created_at' => now(),
//                'updated_at' => now(),
//            ],
//        ]);
    }
}
