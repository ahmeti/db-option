<?php

namespace Ahmeti\DBOption\Services;

use Illuminate\Support\Facades\DB;

class DBOption {

    private $options = [];

    public function all()
    {
        if(collect($this->options)->isNotEmpty()){
            return $this->options;
        }

        $options = DB::table('options')->select(['name', 'type','value'])->get();

        if($options->isEmpty()){
            return $this->options;
        }

        foreach ($options as $option){

            if ($option->type === 'int'){
                $this->options[$option->name] = (int)$option->value;

            }elseif ($option->type === 'float'){
                $this->options[$option->name] = (float)$option->value;

            }elseif ($option->type === 'json'){
                $this->options[$option->name] = json_decode($option->value);
            }else{
                $this->options[$option->name] = $option->value;
            }

        }

        return $this->options;
    }

    public function get($name)
    {
        $this->all();

        if(isset($this->options[$name])){
            return $this->options[$name];
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