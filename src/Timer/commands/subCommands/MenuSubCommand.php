<?php

namespace Timer\commands\subCommands;

use CortexPE\Commando\BaseSubCommand;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use Timer\forms\TimerForm;
use Timer\TimerLoader;

class MenuSubCommand extends BaseSubCommand {

    protected function prepare(): void {
        $this->setPermission("timer.command");
    }

    public function onRun(CommandSender $sender, string $aliasUsed, array $args): void {
        if ($sender instanceof Player) {
            if ($sender->hasPermission($this->getPermission())) {
                $sender->sendForm(new TimerForm());
        } else {
                $sender->sendMessage(TimerLoader::getPrefix() . "§cDafür hast du keine Rechte!");
            }
        }
    }
}