<?php

namespace xtakumatutix\lawn;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\Config;


Class Main extends PluginBase implements Listener {

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
		}
		return true;

		case "repayment":
		    $name = $sender->getPlayer()->getName();
		        if($this->c->exists($name)){
			    $lawn = $this->Config->get($name);
			    $sender->sendMessage("{$args[0]}を返済しました");
			    $repay = $lawn - $args[0];
				$this->Config->set($name, $repay);
		    }else{
				$sender->sendMessage("あなたは大丈夫よ");
			}
		}
		return true;
	}
	return true;
}