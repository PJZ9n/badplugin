<?php

namespace xtakumatutix\lawn;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\level\Level;

Class Main extends PluginBase implements Listener {

    public function onEnable(){
        $this->getLogger()->notice("読み込み完了_ver.1.0.0");
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

	public function onChat(PlayerChatEvent $event)
	{
		$player = $event->getPlayer();
		$message = $event->getMessage();
		$world = $player->getLevel()->getName();
		$event->setMessage($message .' §7(from ' .$world. ')');
	}
}