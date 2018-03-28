<?php

namespace Ahmeti\DBOption\Services;

use Illuminate\Support\Facades\DB;

class DBOption {

    public function get($name)
    {
        $option = DB::table('options')
            ->where('name', $name)
            ->first();

        if($option){

            if ($option->type === 'int'){
                return (int)$option->value;

            }elseif ($option->type === 'float'){
                return (float)$option->value;

            }elseif ($option->type === 'json'){
                return json_decode($option->value);
            }

            return (string)$option->value;
        }

        return null;
    }

    public function set($name, $value, $type='string', $description=null)
    {
        $option = DB::table('options')
            ->where('name', $name)
            ->first();

        if($option){

            $data = [];
            
            // Value
            $data['value'] = $value;

            // Type
            if(in_array($type, ['string','int','float','json'], true)){
                $data['type'] = $type;
            }
            
            // Description
            if(!is_null($description)){
                $data['description'] = $description;
            }

            return DB::table('options')
                ->where('name', $name)
                ->update($data);
        }

        return DB::table('options')->insert([
            'name' => $name,
            'type' => $type,
            'value' => $value,
            'description' => $description
        ]);
    }
}