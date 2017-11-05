<?php

namespace App\Model;

use Core\ModeloEloquent;

class Http extends ModeloEloquent
{
    protected $table = "http";
    protected $site;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->site = new Site();
    }

    public $fillable = [
        'status',
        'descricao',
        'site_id',
    ];

    public function data($request){
        return [
            'status' => $request->status,
            'descricao' => $request->descricao,
            'site_id' => $request->site_id
        ];
    }

    public function rules(){
        return [
        ];
    }

    public function isUp()
    {
        $sites = $this->site->all();

        foreach ($sites as $site) {

            $curl = curl_init();

            curl_setopt($curl, CURLOPT_URL, $site->url);
            curl_setopt($curl, CURLOPT_FAILONERROR, true);
            curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_TIMEOUT, 15);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($curl, CURLOPT_CONNECT_ONLY, true);
            curl_setopt($curl, CURLOPT_USERPWD, "$site->usuario:$site->senha");
            curl_setopt($curl, CURLOPT_COOKIESESSION, true);
            curl_setopt($curl, CURLOPT_FORBID_REUSE, false);
            curl_setopt($curl, CURLOPT_FRESH_CONNECT, true);

            $result = curl_exec($curl);

            $erro = curl_error($curl);

            if (empty($erro)) {
                $status = 0;
                $erro = "Acessível";
            }
            else $status = 1;

            $data = ['status' => $status,
                'descricao' => $erro,
                'site_id' => $site->id
            ];

            try
            {
                $this->create($data);
            }
            catch (\Exception $exception)
            {
                echo $exception;
                return false;
            }
        }

        return true;
    }

    public function site()
    {
        return $this->belongsTo("App\Model\Site");
    }
}