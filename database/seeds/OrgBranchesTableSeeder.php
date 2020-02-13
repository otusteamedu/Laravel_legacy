<?php

use Illuminate\Database\Seeder;

class OrgBranchesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('org_branches')->insert(
            array(
                array('id' => '2','name' => 'Энергетика','name_eng' => 'Power','created_at' => '2020-02-13 00:06:04'),
                array('id' => '3','name' => 'Нефтегазовая отрасль','name_eng' => 'Oil and gas','created_at' => '2020-02-13 00:06:04'),
                array('id' => '4','name' => 'Черная металлургия','name_eng' => 'Ferrous metals','created_at' => '2020-02-13 00:06:04'),
                array('id' => '5','name' => 'Цветная металлургия','name_eng' => 'Non-ferrous metals','created_at' => '2020-02-13 00:06:04'),
                array('id' => '6','name' => 'Пищевая промышленность','name_eng' => 'Food industry','created_at' => '2020-02-13 00:06:04'),
                array('id' => '7','name' => 'Химическая и нефтехимическая промышленность','name_eng' => 'Chemical and petrochemical industry','created_at' => '2020-02-13 00:06:04'),
                array('id' => '8','name' => 'Машиностроение','name_eng' => 'Engineering industry','created_at' => '2020-02-13 00:06:04'),
                array('id' => '10','name' => 'Строительство и девелопмент','name_eng' => 'Construction and development','created_at' => '2020-02-13 00:06:04'),
                array('id' => '11','name' => 'Целлюлозно-бумажная и деревообрабатывающая','name_eng' => 'Timber and paper&pulp industry','created_at' => '2020-02-13 00:06:04'),
                array('id' => '12','name' => 'Легкая промышленность','name_eng' => 'Light industry','created_at' => '2020-02-13 00:06:04'),
                array('id' => '14','name' => 'АПК и сельское хозяйство','name_eng' => 'Agriculture','created_at' => '2020-02-13 00:06:04'),
                array('id' => '15','name' => 'Транспорт','name_eng' => 'Transportation','created_at' => '2020-02-13 00:06:04'),
                array('id' => '16','name' => 'Связь и телекоммуникация','name_eng' => 'Communication','created_at' => '2020-02-13 00:06:04'),
                array('id' => '17','name' => 'Финансовые институты','name_eng' => 'Financial institutions','created_at' => '2020-02-13 00:06:04'),
                array('id' => '18','name' => 'Торговля и ритэйл','name_eng' => 'Trade and retail','created_at' => '2020-02-13 00:06:04'),
                array('id' => '19','name' => 'Другие отрасли','name_eng' => 'Other sectors','created_at' => '2020-02-13 00:06:04'),
                array('id' => '20','name' => 'Горнодобывающая промышленность','name_eng' => 'Mining industry','created_at' => '2020-02-13 00:06:04'),
                array('id' => '23','name' => 'Медицина и здравоохранение','name_eng' => 'Healthсare','created_at' => '2020-02-13 00:06:04'),
                array('id' => '25','name' => 'Информационные и высокие технологии','name_eng' => 'Information and High Technologies','created_at' => '2020-02-13 00:06:04'),
                array('id' => '27','name' => 'Банки','name_eng' => 'Banks','created_at' => '2020-02-13 00:06:04'),
                array('id' => '29','name' => 'СМИ и индустрия развлечений','name_eng' => 'Media and Entertainment','created_at' => '2020-02-13 00:06:04'),
                array('id' => '31','name' => 'Государственные агентства','name_eng' => 'Government Agencies','created_at' => '2020-02-13 00:06:04'),
                array('id' => '33','name' => 'Коммунальные услуги','name_eng' => 'Public utilities','created_at' => '2020-02-13 00:06:04')
            )
        );
    }
}
