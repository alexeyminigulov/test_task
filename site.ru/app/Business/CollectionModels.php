<?php

namespace App\Business;

use DB;

class CollectionModels
{
    public static function getArrayByKey($collection, $key ) {

        $result = [];
        foreach( $collection as $col ) {

            $result[] = $col->$key;
        }
        return $result;
    }

    public static function deleteDiff($colFirst, $colSecond) {
        foreach( $colFirst as $worker ) {

            $colSecond = self::destroyModel($worker->worker_id, $colSecond);
        }
        return $colSecond;
    }

    private static function destroyModel($id, $col) {

        foreach($col as $key=>$el) {
            if($el->id == $id) {
                $col->splice($key, 1);
            }
        }
        return $col;
    }

    public static function addField($collection, $field, $value) {
        foreach( $collection as &$col ) {

            $col->$field = $value;
        }
        return $collection;
    }

    public static function changeField($collection, $field, $method, $value) {
        
        if($method === 'add') {

            foreach( $collection as &$col ) {

                $col->$field = $col->$field + $value;
            }
        }
        
        return $collection;
    }

    public static function pushDBCollectionWithModel($model, $workers, $obj) {

        DB::beginTransaction();
        try {
            $status = true;

            foreach( $workers as $worker ) {
                $model::create([ 
                                    'worker_id' => $worker->id,
                                    'date'      => $obj->date,
                                    'premium'   => $obj->premium,
                                    'salary'    => $worker->salary,
                                ]);
            }
            DB::commit();
        }
        catch (ModelNotFoundException $e) {
            $status = false;
            DB::rollback();
        }
        finally {
            return $status;
        }
        
    }
}