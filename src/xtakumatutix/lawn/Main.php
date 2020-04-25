<?php

namespace xtakumatutix\lawn;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\Config;


Class Main extends PluginBase implements Listener {
    
    //$this->なんとかを使うときは、これを書いておかないと面倒なことになる
    /** @var Config */
    private $Config;
    
    public function onEnable(){
        $this->getLogger()->notice("読み込み完了_ver.1.0.0");
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->Config = new Config($this->getDataFolder() . "lawn.yml", Config::YAML);
    }
    
    public function onCommand(CommandSender $sender, Command $command, string $label, array $args):bool
    {
        switch($command->getName()){
            case "lawn":
                $this->Config->set($args[0], $args[1]);
                $this->Config->save();
                $sender->sendMessage("{$args[0]}に{$args[1]}のローンを組ませました...あなたは最低です。");
                return true;//ここで処理を終了する
            case "repayment":
                $name = $sender->getName();//$senderはそのまま使える(getPlayer関数は存在しない)
                if($this->Config->exists($name)){
                    $lawn = $this->Config->get($name);
                    $sender->sendMessage("{$args[0]}を返済しました");
                    $repay = $lawn - $args[0];
                    $this->Config->set($name, $repay);
                }else{
                    $sender->sendMessage("あなたは大丈夫よ");
                }
                return true;//ここで処理を終了する
        }
        return false;//何にも引っかからなかった場合(途中で処理が終了していなかった場合)はfalseを返す
    }
}