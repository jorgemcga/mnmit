<?php

namespace App\Model;

use Core\ModeloEloquent;
use PHPMailer\PHPMailer\Exception;

class Snmp extends ModeloEloquent
{
    protected $table = "snmp";
    protected $oidAtivo;

    public $fillable = [
        'valor',
        'oid_id',
        'ativo_id',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->oidAtivo = new OidAtivo();
    }

    public function data($request){
        return [
            'valor' => $request->valor,
            'oid_id' => $request->oid_id,
            'ativo_id' => $request->ativo_id
        ];
    }

    public function rules(){
        return [];
    }

    public function run()
    {
        $oidAtivos = $this->oidAtivo->all();

        foreach ($oidAtivos as $oidAtivo)
        {
            $session = new \SNMP((int)$oidAtivo->oid->versao, $oidAtivo->ip, $oidAtivo->oid->string);
            $results = $session->get($oidAtivo->oid->oid);
            $result = explode(": ", $results);
            $session->close();

            $data = [
                'valor' => $result[1],
                'oid_id' => $oidAtivo->oid_id,
                'ativo_id' => $oidAtivo->ativo_id
                ];

            try
            {
                $this->create($data);
            }
            catch (\Exception $exception)
            {
                return false;
            }
        }

        return true;
    }

    public function ativo()
    {
        return $this->belongsTo("App\Model\Ativo");
    }

    public function oid()
    {
        return $this->belongsTo("App\Model\Oid");
    }
}