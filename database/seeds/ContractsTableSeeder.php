<?php

use Illuminate\Database\Seeder;

class ContractsTableSeeder extends Seeder
{

    private $companies;
    private $currCompany;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (\App\Models\Room::all() as $room)
        {
            if (!($company = $this->nextCompany()))
                break;

            if ($room->isFree())
                $room->companies()->attach($company);
        }
    }

    private function nextCompany()
    {
        if (!$this->companies)
            $this->initCompanies();

        if ($this->currCompany == last($this->companies))
            return null;

        $this->currCompany = current($this->companies);
        next($this->companies);

        return $this->currCompany;
    }

    private function initCompanies()
    {
        foreach (\App\Models\Company::all() as $company)
            $this->companies[$company->id] = $company;
        shuffle($this->companies);
    }


}
