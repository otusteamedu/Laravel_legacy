<?php

namespace Gerfey\BattleNet\Request\GameData\Warcraft;

use Gerfey\BattleNet\Request\Request;

class Pets extends Request
{
    /**
     * Returns an index of pets.
     *
     * @return mixed
     */
    public function petsIndex()
    {
        $this->setNamespace('static');
        return $this->createRequest('GET',  '/data/wow/pet/index');
    }

    /**
     * Returns a pet by ID.
     *
     * @param int $petId
     * @return mixed
     */
    public function pet(int $petId = 39)
    {
        $this->setNamespace('static');
        return $this->createRequest('GET', '/data/wow/pet/' . $petId);
    }
}