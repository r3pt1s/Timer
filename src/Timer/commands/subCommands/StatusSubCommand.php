<?php

namespace Timer\commands\subCommands;

use CortexPE\Commando\BaseSubCommand;
use pocketmine\command\CommandSender;
use Timer\TimerLoader;

class StatusSubCommand extends BaseSubCommand {

    protected function prepare(): void {
        $this->setPermission("timer.command");
    }

    public function onRun(CommandSender $sender, string $aliasUsed, array $args): void {
        if ($sender->hasPermission($this->getPermission())) {
            $sender->sendMessage(TimerLoader::getPrefix() . "Status: §r" . (TimerLoader::getInstance()->getTimer()->isRunning() ? "§aLäuft" : "§cGestoppt") . (TimerLoader::getInstance()->getTimer()->isPaused() ? "§8(§cPausiert§8)" : ""));
        } else {
            $sender->sendMessage(TimerLoader::getPrefix() . "§cDafür hast du keine Rechte!");
        }
    }
}