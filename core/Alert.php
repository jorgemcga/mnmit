<?php
namespace Core;
/**
 * Description of Alert
 *
 * @author jorge
 */
class Alert
{
    private static $email;
    private static $telegram;

    public function __construct()
    {
        self::$email = new Email();
        self::$telegram = new TelegramBot();
        return self::$this;
    }

    public static function ping(\App\Model\Ativo $ativo)
    {
        $message = self::getMessage($ativo->nome, "Protocolo ICMP");
        $subject = self::getSubject($ativo->nome, "Protocolo ICMP");
        $recipients = self::getGroupEmails($ativo->categoria_ativo->id);

        foreach($recipients as $group)
        {
            self::sendMail($subject, $message, $group["email"], $group['cc']);
            self::sendPush($message, $group["telegram"]);
        }
        return true;
    }

    private static function getGroupEmails($categoria_id)
    {
        $emails = [];
        $groupCategoria = new \App\Model\GrupoAtivoCategoria();

        foreach ($groupCategoria->where("categoria_ativo_id", $categoria_id)->get() as $i => $groupCat)
        {
            $groupService = new \App\Model\Grupo();
            $group = $groupService->find($groupCat->grupo_id);
            $emails[$i]["email"] = $group->email;
            $emails[$i]["telegram"] = $group->telegram_group;
            $emails[$i]["cc"] = self::getUserEmails($group->id);
        }
        return $emails;
    }

    private static function getUserEmails($group_id)
    {
        $emails = [];
        $usuarioGrupo = new \App\Model\UsuarioGrupo();
        foreach($usuarioGrupo->where("grupo_id", $group_id)->get() as $i => $usuario)
        {
            $userService = \App\Model\Usuario();
            $user = $userService->find($usuario->usuario_id);
            $emails[$i]["name"] = $user->nome;
            $emails[$i]["email"] = $user->email;
        }
        return $emails;
    }

    private static function getMessage($name, $type)
    {
        return "Erro ao se comunicar com o {$name} através de {$type} em " . data("d/m/Y h:i:s");
    }

    private static function getSubject($name, $type)
    {
        return "{$type} :: Falha em {$name}";
    }

    public static function sendMail($subject, $message, $recipients, $cc = [])
    {
        return self::$email->setSender(Server::name(), Server::email())
                ->setSubject($subject)
                ->setMessage($message)
                ->setRecipient(Server::email())
                ->addRecipients($recipients)
                ->addCcs($cc)
                ->send();
    }

    public static function sendPush($message, $groupId)
    {
        return self::$telegram->setAPItoken(TELEGRAM_BOT_API_KEY)
                ->setGroupId($groupId)
                ->setMsg($message)
                ->send();
    }
}
