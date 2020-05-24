<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RelationSeeder extends Seeder
{
    protected function isRelationExist($relationsArray, $id1, $id2)
    {
        foreach ($relationsArray as $relation) {
            if ($relation[0] == $id1 && $relation[1] == $id2) {
                return true;
            }
        }
        return false;
    }

    protected function saveRelations(
        $relationsArray,
        $tableName,
        $relatedColumn1Name,
        $relatedColumn2Name
    ) {
        $length = count($relationsArray);

        for ($i = 1; $i < $length; $i++) {

            $dataToInsert = [
                'id' => $i,
                $relatedColumn1Name => $relationsArray[$i][0],
                $relatedColumn2Name => $relationsArray[$i][1]
            ];

            if (isset($relationsArray[$i][2])) {
                $dataToInsert['quantity'] = $relationsArray[$i][2];
            }

            DB::table($tableName)->insert($dataToInsert);
        }
    }

    protected function getRelationsArray($relationsCount, $table1Count, $table2Count, $quantity = false)
    {
        $relationsArray = [];

        for ($i = 0; $i < $relationsCount; $i++) {
            do {
                $id1 = rand(1, $table1Count);
                $id2 = rand(1, $table2Count);
            } while ($this->isRelationExist($relationsArray, $id1, $id2));
            if ($quantity) {
                $relationsArray[] = [$id1, $id2, rand(1, 10)];
            } else {
                $relationsArray[] = [$id1, $id2];
            }
        }
        return $relationsArray;
    }
}
