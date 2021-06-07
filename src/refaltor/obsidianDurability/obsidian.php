<?php

namespace refaltor\obsidianDurability;

use pocketmine\block\Block;
use pocketmine\block\Solid;

class obsidian extends Solid
{
	public function getBlastResistance(): float
	{
		return 30.00;
	}

	public function onExplode(){
	    $durability = Main::getInstance()->getConfig()->getAll()['durability'];
        if(($this->meta + 1) >= $durability){
            $this->getLevel()->setBlock($this, new Block(0));
        }else{
            $this->meta += 1;
            $this->getLevel()->setBlock($this, $this);
        }
    }
}