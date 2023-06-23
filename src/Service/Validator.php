<?php

namespace App\Service;

class Validator
{

    private $rules = [];
    private $messages = [];

    public function __construct()
    {

    }

    public function setRule(string $name, $check, $message = null)
    {
        if( ! isset($this->rules[$name])){
            $this->rules[$name] = [];
        }

        $this->rules[$name][] = [
            'check' => $check,
            'message' =>$message
        ];

        return $this;
    }

    public function check($data)
    {
        //var_dump($this->rules);
        //var_dump($data);

        $this->message =[];

        foreach($this->rules as $name => $validators){
            $value = $data[$name] ?? null;
            foreach($validators as $validator){
                if( ! $validator['check']($value, $data)){
                    $this->messages[$name] = $validator['message'];
                    break;
                }
            }
        }

        return count($this->messages) == 0;
    }

    public function getMessages()
    {
        return $this->messages;
    }
}