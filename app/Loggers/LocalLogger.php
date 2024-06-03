<?php

namespace App\Loggers;

use Monolog\Formatter\LineFormatter;
use App\Models\Core\User;

class LocalLogger
{
    private $request;

    public function __construct(\Illuminate\Http\Request $request)
    {
        $this->request = $request;
    }

    public function __invoke($logger)
    {
        foreach ($logger->getHandlers() as $handler) {
            $handler->setFormatter($this->getLogFormatter());
        }
    }

    protected function getLogFormatter()
    {
        $uniqueClientId = $this->getUniqueClientId();

        $format = str_replace(
            '[%datetime%] ',
            sprintf('[%%datetime%%] %s ', $uniqueClientId),
            LineFormatter::SIMPLE_FORMAT
        );

        return new LineFormatter($format, null, true, true);
    }

    protected function getUniqueClientId()
    {
        $ip = $this->request->ip();
        $username="guest";
        $sesi = \DB::table('sessions')
            ->where('id', \Session::getId())->first();
        if($sesi){
            $user = User::where('id',$sesi->user_id)->first();
            if($user){
                $username=$user->username;
            }
        }
        
        //dd(\Session::all());
        

        return "[{$ip}:{$username}]";
    }
}