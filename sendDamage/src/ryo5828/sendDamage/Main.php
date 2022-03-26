<?php

namespace ryo5828\sendDamage;

use pocketmine\item\VanillaItems;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;

use pocketmine\event\Listener;
use pocketmine\event\entity\EntityDamageByEntityEvent;

class Main extends PluginBase implements Listener {
    /** Plugin有効時 */
    public function onEnable(): void {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }
    /** Damageを受けた時 */
    public function onDamage(EntityDamageByEntityEvent $event) {
        $killed = $event->getEntity();
        $cause = $killed->getLastDamageCause();
        if($cause instanceof EntityDamageByEntityEvent and ($killer = $cause->getDamager()) instanceof Player) {
            if($killed instanceof Player and $killer instanceof Player) {
                if($killer->getInventory()->getItemInHand()->getId() == (int)261) {
                    $name = $killed->getName();
                    $health = $killed->getHealth();
                    $maxHealth = $killed->getMaxHealth();
                    $killer->sendMessage("§e".$name."§fにヒット！"."\n"."残りの体力[§c♡§f".$health."/".$maxHealth."]");
                }
            }
        }
    }
}