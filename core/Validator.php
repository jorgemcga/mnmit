<?php

namespace Core;

class Validator
{
    public static function make(array $data, array $rules){

        $errors = null;

        foreach ($rules as $ruleKey => $ruleValue) {

            foreach ($data as $dataKey => $dataValue) {

                if ($ruleKey == $dataKey) {

                    $itensValue = [];

                    if (strpos($ruleValue, "|")) {

                        $itensValue = explode("|", $ruleValue);

                        foreach ($itensValue as $itemValue) {

                            $subItens = [];

                            if (strpos($itemValue, ":")){

                                $subItens = explode(":", $itemValue);

                                switch ($subItens[0]) {
                                    case 'min':
                                        if (strlen($dataValue) < $subItens[1]) $errors["$ruleKey"] = "Campo {$dataKey} deve ter no mínimo {$subItens[1]} caracteres!";
                                        break;
                                    case 'max':
                                        if (strlen($dataValue) > $subItens[1]) $errors["$ruleKey"] = "Campo {$dataKey} deve ter no maximo {$subItens[1]} caracteres!";
                                        break;
                                    case 'unique':
                                        $objModel = "\\App\\Model\\" . $subItens[1];
                                        $model = new $objModel;
                                        $find = $model->where($subItens[2], $dataValue)->first();
                                        if ($find->subItens[2]) {
                                            if (isset($subItens[3]) && $find->id == $subItens[3]){
                                                break;
                                            }
                                            else {
                                                $errors["$ruleKey"] = "Campo {$dataKey} deve ser único! {$subItens[1]} já cadastrado!";

                                            }
                                        }
                                        break;
                                }
                            }
                            else {
                                switch ($itemValue) {
                                    case 'requerid':
                                        if ($dataValue == " " || empty($dataValue)) $errors["$ruleKey"] = "Campo {$dataKey} não pode ser vazio";
                                        break;
                                    case 'email':
                                        if (!filter_var($dataValue, FILTER_VALIDATE_EMAIL)) $errors["$ruleKey"] = "Campo {$dataKey} não é um e-mail";
                                        break;
                                    case 'int':
                                        if (!filter_var($dataValue, FILTER_VALIDATE_INT)) $errors["$ruleKey"] = "Campo {$dataKey} precisa ser numero inteiro";
                                        break;
                                    case 'float':
                                        if (!filter_var($dataValue, FILTER_VALIDATE_FLOAT)) $errors["$ruleKey"] = "Campo {$dataKey} precisa ser número decimal";
                                        break;
                                    default:
                                        break;
                                }
                            }
                        }

                    }
                    elseif (strpos($ruleValue, ":")) {

                        $itens = explode(":", $ruleValue);

                        switch ($itens[0]) {
                            case 'min':
                                if (strlen($dataValue) < $itens[1]) $errors["$ruleKey"] = "Campo {$dataKey} deve ter no mínimo {$itens[1]} caracteres!";
                                break;
                            case 'max':
                                if (strlen($dataValue) > $itens[1]) $errors["$ruleKey"] = "Campo {$dataKey} deve ter no maximo {$itens[1]} caracteres!";
                                break;
                            case 'unique':
                                $objModel = "\\App\\Model\\" . $subItens[1];
                                $model = new $objModel;
                                $find = $model->where($subItens[2], $dataValue)->first();
                                if ($find->subItens[2]) {
                                    if (isset($subItens[3]) && $find->id == $subItens[3]){
                                        break;
                                    }
                                    else {
                                        $errors["$ruleKey"] = "Campo {$dataKey} deve ser único! {$subItens[1]} já cadastrado!";

                                    }
                                }
                                break;
                        }
                    }
                    else {
                        switch ($ruleValue) {
                            case 'requerid':
                                if ($dataValue == " " || empty($dataValue)) $errors["$ruleKey"] = "Campo {$dataKey} não pode ser vazio";
                                break;
                            case 'email':
                                if (!filter_var($dataValue, FILTER_VALIDATE_EMAIL)) $errors["$ruleKey"] = "Campo {$dataKey} não é um e-mail";
                                break;
                            case 'int':
                                if (!filter_var($dataValue, FILTER_VALIDATE_INT)) $errors["$ruleKey"] = "Campo {$dataKey} precisa ser numero inteiro";
                                break;
                            case 'float':
                                if (!filter_var($dataValue, FILTER_VALIDATE_FLOAT)) $errors["$ruleKey"] = "Campo {$dataKey} precisa ser número decimal";
                                break;
                            default:
                                break;
                        }
                    }
                }
            }
        }


        if ($errors){
            Session::set('error', $errors);
            Session::set('inputs', $data);
            return true;
        }
        else {
            Session::destroy(['error','inputs']);
            return false;
        }

    }

}