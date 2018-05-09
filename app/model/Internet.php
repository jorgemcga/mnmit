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
            $speedtest = shell_exec("python C:\speedtest\speedtest --simple");
        else
            $speedtest = shell_exec("speedtest --simple");

        $speedtest = explode(" ", $speedtest);

        $data = [
            'ping' => $speedtest[1],
            'download' => $speedtest[3],
            'upload' => $speedtest[5]
        ];

        try
        {
            $this->create($data);
            return true;
        }
        catch (\Exception $exception)
        {
            return false;
        }
    }
}