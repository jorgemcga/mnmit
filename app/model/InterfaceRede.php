<?php
/**
 * Created by PhpStorm.
 * User: Jorge
 * Date: 31/08/2017
 * Time: 11:17
 */

namespace App\Model;


use Core\Model;

class InterfaceRede extends Model
{
    protected $table = "interface_rede";

    public $interface_rede_id = "";
    public $hostname = "";
    public $ip = "";
    public $mascara = "";
    public $gateway = "";
    public $dns1 = "";
    public $dns2 = "";
    public $macaddress = "";
    public $ativo_id = "";

}