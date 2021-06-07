<?php

namespace refaltor\obsidianDurability;

use pocketmine\block\BlockFactory;
use pocketmine\event\entity\EntityExplodeEvent;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase implements Listener
{
    public static ?Main $instance = null;

    public function onEnable()
    {
        self::$instance = $this;
        $this->saveResource('config.yml');
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        if (!BlockFactory::isRegistered(49)) BlockFactory::registerBlock(new obsidian(49));
    }

    public static function getInstance(): Main{
        return self::$instance;
    }

    public function onExplode(EntityExplodeEvent $event){
        $list = [];
        foreach($event->getBlockList() as $block){
            if($block instanceof obsidian){
                $block->onExplode();
            }else{
                $list[] = $block;
            }
        }
        $event->setBlockList($list);
    }
}
