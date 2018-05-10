<?php

namespace App\Model;

use Core\ModeloEloquent;

class Internet extends ModeloEloquent
{
    protected $table = "internet";
    protected $monitor;

    public $fillable = [
        'ping',
        'download',
        'upload'
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->monitor = new Monitoramento();
    }

    public function data($request){
        return [
            'ping' => $request->ping,
            'download' => $request->download,
            'upload' => $request->upload
        ];
    }

    public function rules(){
        return [];
    }

    public function run()
    {
        if ($this->monitor->first()->plataforma == "Windows")
            $speedtest = explode(" ", shell_exec("python C:\speedtest\speedtest --simple"));
        else
            $speedtest = explode(" ", shell_exec("speedtest --simple"));

        try
        {
            $this->create([
                'ping' => $speedtest[1],
                'download' => $speedtest[3],
                'upload' => $speedtest[5]
            ]);
            return true;
        }
        catch (\Exception $exception)
        {
            return false;
        }
    }
}