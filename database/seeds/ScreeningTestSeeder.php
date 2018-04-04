<?php

use Illuminate\Database\Seeder;

class ScreeningTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('screening_tests')->insert(
            [
                'name' => 'DAS21',
                'active' => '1',
                'created_at' => '2018-03-21 08:54:49',
                'updated_at' => '2018-03-21 08:54:49'
            ]
        );

        // questions seeder
        DB::table('questions')->insert([
            // English
            [
                'question' => 'I found it hard to wind down',
                'type' => '2',
                'screening_test_id' => '1',
                'language_id' => '1',
                'created_at' => '2018-03-21 08:54:49',
                'updated_at' => '2018-03-21 08:54:49'
            ],
            [
                'question' => 'I was aware of dryness of my mouth',
                'type' => '0',
                'screening_test_id' => '1',
                'language_id' => '1',
                'created_at' => '2018-03-21 08:54:49',
                'updated_at' => '2018-03-21 08:54:49'
            ],
            [
                'question' => "I couldn't seem to experience any positive feeling at all",
                'type' => '1',
                'screening_test_id' => '1',
                'language_id' => '1',
                'created_at' => '2018-03-21 08:54:49',
                'updated_at' => '2018-03-21 08:54:49'
            ],
            [
                'question' => 'I experienced breathing difficulty (eg: excessively rapid breathing, breathlessness in the absence of physical exertion)',
                'type' => '0',
                'screening_test_id' => '1',
                'language_id' => '1',
                'created_at' => '2018-03-21 08:54:49',
                'updated_at' => '2018-03-21 08:54:49'
            ],
            [
                'question' => 'I found it difficult to work up the initiative to do things',
                'type' => '1',
                'screening_test_id' => '1',
                'language_id' => '1',
                'created_at' => '2018-03-21 08:54:49',
                'updated_at' => '2018-03-21 08:54:49'
            ],
            [
                'question' => 'I tended to over-react to situations',
                'type' => '2',
                'screening_test_id' => '1',
                'language_id' => '1',
                'created_at' => '2018-03-21 08:54:49',
                'updated_at' => '2018-03-21 08:54:49'
            ],
            [
                'question' => 'I experienced trembling (eg: in the hands)',
                'type' => '0',
                'screening_test_id' => '1',
                'language_id' => '1',
                'created_at' => '2018-03-21 08:54:49',
                'updated_at' => '2018-03-21 08:54:49'
            ],
            [
                'question' => 'I felt that I was using a lot of nervous energy',
                'type' => '2',
                'screening_test_id' => '1',
                'language_id' => '1',
                'created_at' => '2018-03-21 08:54:49',
                'updated_at' => '2018-03-21 08:54:49'
            ],
            [
                'question' => 'I was worried about situations in which I might panic and make a fool of myself',
                'type' => '0',
                'screening_test_id' => '1',
                'language_id' => '1',
                'created_at' => '2018-03-21 08:54:49',
                'updated_at' => '2018-03-21 08:54:49'
            ],
            [
                'question' => 'I felt that I had nothing to look forward to',
                'type' => '1',
                'screening_test_id' => '1',
                'language_id' => '1',
                'created_at' => '2018-03-21 08:54:49',
                'updated_at' => '2018-03-21 08:54:49'
            ],
            [
                'question' => 'I found myself getting agitated',
                'type' => '2',
                'screening_test_id' => '1',
                'language_id' => '1',
                'created_at' => '2018-03-21 08:54:49',
                'updated_at' => '2018-03-21 08:54:49'
            ],
            [
                'question' => 'I found it difficult to relax',
                'type' => '2',
                'screening_test_id' => '1',
                'language_id' => '1',
                'created_at' => '2018-03-21 08:54:49',
                'updated_at' => '2018-03-21 08:54:49'
            ],
            [
                'question' => 'I felt down-hearted and blue',
                'type' => '1',
                'screening_test_id' => '1',
                'language_id' => '1',
                'created_at' => '2018-03-21 08:54:49',
                'updated_at' => '2018-03-21 08:54:49'
            ],
            [
                'question' => 'I was intolerant of anything that kept me from getting on with what I was doing',
                'type' => '2',
                'screening_test_id' => '1',
                'language_id' => '1',
                'created_at' => '2018-03-21 08:54:49',
                'updated_at' => '2018-03-21 08:54:49'
            ],
            [
                'question' => 'I felt I was close to panic',
                'type' => '0',
                'screening_test_id' => '1',
                'language_id' => '1',
                'created_at' => '2018-03-21 08:54:49',
                'updated_at' => '2018-03-21 08:54:49'
            ],
            [
                'question' => 'I was unable to become enthusiastic about anything',
                'type' => '1',
                'screening_test_id' => '1',
                'language_id' => '1',
                'created_at' => '2018-03-21 08:54:49',
                'updated_at' => '2018-03-21 08:54:49'
            ],
            [
                'question' => "I felt I wasn't worth much as a person",
                'type' => '1',
                'screening_test_id' => '1',
                'language_id' => '1',
                'created_at' => '2018-03-21 08:54:49',
                'updated_at' => '2018-03-21 08:54:49'
            ],
            [
                'question' => 'I felt that I was rather touchy',
                'type' => '2',
                'screening_test_id' => '1',
                'language_id' => '1',
                'created_at' => '2018-03-21 08:54:49',
                'updated_at' => '2018-03-21 08:54:49'
            ],
            [
                'question' => 'I was aware of the action of my heart in the absence of physical exertion (eg: sense of heart rate increase, heart missing a beat)',
                'type' => '0',
                'screening_test_id' => '1',
                'language_id' => '1',
                'created_at' => '2018-03-21 08:54:49',
                'updated_at' => '2018-03-21 08:54:49'
            ],
            [
                'question' => 'I felt scared without any good reason',
                'type' => '0',
                'screening_test_id' => '1',
                'language_id' => '1',
                'created_at' => '2018-03-21 08:54:49',
                'updated_at' => '2018-03-21 08:54:49'
            ],
            [
                'question' => 'I felt that life was meaningless',
                'type' => '1',
                'screening_test_id' => '1',
                'language_id' => '1',
                'created_at' => '2018-03-21 08:54:49',
                'updated_at' => '2018-03-21 08:54:49'
            ],
            // Malay
            [
                'question' => 'Saya dapati diri saya sukar ditenteramkan',
                'type' => '2',
                'screening_test_id' => '1',
                'language_id' => '2',
                'created_at' => '2018-03-21 08:54:49',
                'updated_at' => '2018-03-21 08:54:49'
            ],
            [
                'question' => 'Saya sedar mulut saya terasa kering',
                'type' => '0',
                'screening_test_id' => '1',
                'language_id' => '2',
                'created_at' => '2018-03-21 08:54:49',
                'updated_at' => '2018-03-21 08:54:49'
            ],
            [
                'question' => "Saya tidak dapat mengalami perasaan positif sama sekali",
                'type' => '1',
                'screening_test_id' => '1',
                'language_id' => '2',
                'created_at' => '2018-03-21 08:54:49',
                'updated_at' => '2018-03-21 08:54:49'
            ],
            [
                'question' => 'Saya mengalami kesukaran bernafas (contohnya pernafasan yang laju, tercungap-cungap walaupun tidak melakukan senaman fizikal)',
                'type' => '0',
                'screening_test_id' => '1',
                'language_id' => '2',
                'created_at' => '2018-03-21 08:54:49',
                'updated_at' => '2018-03-21 08:54:49'
            ],
            [
                'question' => 'Saya sukar untuk mendapatkan semangat bagi melakukan sesuatu perkara',
                'type' => '1',
                'screening_test_id' => '1',
                'language_id' => '2',
                'created_at' => '2018-03-21 08:54:49',
                'updated_at' => '2018-03-21 08:54:49'
            ],
            [
                'question' => 'Saya cenderung untuk bertindak keterlaluan dalam sesuatu keadaan',
                'type' => '2',
                'screening_test_id' => '1',
                'language_id' => '2',
                'created_at' => '2018-03-21 08:54:49',
                'updated_at' => '2018-03-21 08:54:49'
            ],
            [
                'question' => 'Saya rasa menggeletar (contohnya pada tangan)',
                'type' => '0',
                'screening_test_id' => '1',
                'language_id' => '2',
                'created_at' => '2018-03-21 08:54:49',
                'updated_at' => '2018-03-21 08:54:49'
            ],
            [
                'question' => 'Saya rasa saya menggunakan banyak tenaga dalam keadaan cemas',
                'type' => '2',
                'screening_test_id' => '1',
                'language_id' => '2',
                'created_at' => '2018-03-21 08:54:49',
                'updated_at' => '2018-03-21 08:54:49'
            ],
            [
                'question' => 'Saya bimbang keadaan di mana saya mungkin menjadi panik dan melakukan perkara yang membodohkan diri sendiri',
                'type' => '0',
                'screening_test_id' => '1',
                'language_id' => '2',
                'created_at' => '2018-03-21 08:54:49',
                'updated_at' => '2018-03-21 08:54:49'
            ],
            [
                'question' => 'Saya rasa saya tidak mempunyai apa-apa untuk diharapkan',
                'type' => '1',
                'screening_test_id' => '1',
                'language_id' => '2',
                'created_at' => '2018-03-21 08:54:49',
                'updated_at' => '2018-03-21 08:54:49'
            ],
            [
                'question' => 'Saya dapati diri saya semakin gelisah',
                'type' => '2',
                'screening_test_id' => '1',
                'language_id' => '2',
                'created_at' => '2018-03-21 08:54:49',
                'updated_at' => '2018-03-21 08:54:49'
            ],
            [
                'question' => 'Saya rasa sukar untuk relaks',
                'type' => '2',
                'screening_test_id' => '1',
                'language_id' => '2',
                'created_at' => '2018-03-21 08:54:49',
                'updated_at' => '2018-03-21 08:54:49'
            ],
            [
                'question' => 'Saya rasa sedih dan murung',
                'type' => '1',
                'screening_test_id' => '1',
                'language_id' => '2',
                'created_at' => '2018-03-21 08:54:49',
                'updated_at' => '2018-03-21 08:54:49'
            ],
            [
                'question' => 'Saya tidak dapat menahan sabar dengan perkara yang menghalang saya meneruskan apa yang saya lakukan',
                'type' => '2',
                'screening_test_id' => '1',
                'language_id' => '2',
                'created_at' => '2018-03-21 08:54:49',
                'updated_at' => '2018-03-21 08:54:49'
            ],
            [
                'question' => 'Saya rasa hampir-hampir menjadi panik/cemas',
                'type' => '0',
                'screening_test_id' => '1',
                'language_id' => '2',
                'created_at' => '2018-03-21 08:54:49',
                'updated_at' => '2018-03-21 08:54:49'
            ],
            [
                'question' => 'Saya tidak bersemangat dengan apa jua yang saya lakukan',
                'type' => '1',
                'screening_test_id' => '1',
                'language_id' => '2',
                'created_at' => '2018-03-21 08:54:49',
                'updated_at' => '2018-03-21 08:54:49'
            ],
            [
                'question' => "Saya tidak begitu berharga sebagai seorang individu",
                'type' => '1',
                'screening_test_id' => '1',
                'language_id' => '2',
                'created_at' => '2018-03-21 08:54:49',
                'updated_at' => '2018-03-21 08:54:49'
            ],
            [
                'question' => 'Saya rasa yang saya mudah tersentuh',
                'type' => '2',
                'screening_test_id' => '1',
                'language_id' => '2',
                'created_at' => '2018-03-21 08:54:49',
                'updated_at' => '2018-03-21 08:54:49'
            ],
            [
                'question' => 'Saya sedar tindakbalas jantung saya walaupun tidak melakukan aktiviti fizikal (contohnya kadar denyutan jantung bertambah, atau denyutan jantung berkurangan)',
                'type' => '0',
                'screening_test_id' => '1',
                'language_id' => '2',
                'created_at' => '2018-03-21 08:54:49',
                'updated_at' => '2018-03-21 08:54:49'
            ],
            [
                'question' => 'Saya berasa takut tanpa sebab yang munasabah',
                'type' => '0',
                'screening_test_id' => '1',
                'language_id' => '2',
                'created_at' => '2018-03-21 08:54:49',
                'updated_at' => '2018-03-21 08:54:49'
            ],
            [
                'question' => 'Saya rasa hidup ini tidak bermakna',
                'type' => '1',
                'screening_test_id' => '1',
                'language_id' => '2',
                'created_at' => '2018-03-21 08:54:49',
                'updated_at' => '2018-03-21 08:54:49'
            ]
        ]);
        // end of questions seeder

        // question_choices seeder
        $data = null;
        $i = 0;

        for ($qs_num = 1; $qs_num <= 21; $qs_num ++){
            for ($ans_num = 1; $ans_num <= 4; $ans_num ++){
                $data[$i] = [
                    'question_id' => $qs_num,
                    'choice_id' => $ans_num,
                    'created_at' => '2018-03-21 08:54:49',
                    'updated_at' => '2018-03-21 08:54:49'
                ];
                $i ++;
            }
        }
        for ($qs_num = 22; $qs_num <= 42; $qs_num ++){
            for ($ans_num = 5; $ans_num <= 8; $ans_num ++){
                $data[$i] = [
                    'question_id' => $qs_num,
                    'choice_id' => $ans_num,
                    'created_at' => '2018-03-21 08:54:49',
                    'updated_at' => '2018-03-21 08:54:49'
                ];
                $i ++;
            }
        }
        DB::table('question_choices')->insert($data);
        // end of question_choices seeder

        // choices seeder
        DB::table('choices')->insert([
            [
                'choice' => 'Did not apply to me at all',
                'marks' => '0',
                'language_id' => '1',
                'created_at' => '2018-03-21 08:54:49',
                'updated_at' => '2018-03-21 08:54:49'
            ],
            [
                'choice' => 'Applied to me to some degree, or some of the time',
                'marks' => '1',
                'language_id' => '1',
                'created_at' => '2018-03-21 08:54:49',
                'updated_at' => '2018-03-21 08:54:49'
            ],
            [
                'choice' => 'Applied to me to a considerable degree, or a good part of time',
                'marks' => '2',
                'language_id' => '1',
                'created_at' => '2018-03-21 08:54:49',
                'updated_at' => '2018-03-21 08:54:49'
            ],
            [
                'choice' => 'Applied to me very much, or most of the time',
                'marks' => '3',
                'language_id' => '1',
                'created_at' => '2018-03-21 08:54:49',
                'updated_at' => '2018-03-21 08:54:49'
            ],
            [
                'choice' => 'Tidak langsung menggambarkan keadaan saya',
                'marks' => '0',
                'language_id' => '2',
                'created_at' => '2018-03-21 08:54:49',
                'updated_at' => '2018-03-21 08:54:49'
            ],
            [
                'choice' => 'Sedikit atau jarang-jarang menggambarkan keadaan saya',
                'marks' => '1',
                'language_id' => '2',
                'created_at' => '2018-03-21 08:54:49',
                'updated_at' => '2018-03-21 08:54:49'
            ],
            [
                'choice' => 'Banyak atau kerapkali menggambarkan keadaan saya',
                'marks' => '2',
                'language_id' => '2',
                'created_at' => '2018-03-21 08:54:49',
                'updated_at' => '2018-03-21 08:54:49'
            ],
            [
                'choice' => 'Banyak atau kerapkali menggambarkan keadaan saya',
                'marks' => '3',
                'language_id' => '2',
                'created_at' => '2018-03-21 08:54:49',
                'updated_at' => '2018-03-21 08:54:49'
            ]
        ]);
        // end of choices seeder
    }
}
