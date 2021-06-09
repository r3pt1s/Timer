<?php

namespace Timer\commands;

use CortexPE\Commando\args\BaseArgument;
use CortexPE\Commando\BaseCommand;
use pocketmine\command\CommandSender;
use Timer\commands\subCommands\MenuSubCommand;
use Timer\commands\subCommands\PauseSubCommand;
use Timer\commands\subCommands\ResetSubCommand;
use Timer\commands\subCommands\ResumeSubCommand;
use Timer\commands\subCommands\StartSubCommand;
use Timer\commands\subCommands\StatusSubCommand;
use Timer\commands\subCommands\StopSubCommand;
use Timer\TimerLoader;

class TimerCommand extends BaseCommand {

    protected function prepare(): void {
        $this->setPermission("timer.command");

        $this->registerSubCommand(new StartSubCommand("start", "Starte den Timer"));
        $this->registerSubCommand(new StopSubCommand("stop", "Stoppe den Timer"));
        $this->registerSubCommand(new PauseSubCommand("pause", "Pausiere den Timer"));
        $this->registerSubCommand(new ResumeSubCommand("resume", "Setze den Timer fort"));
        $this->registerSubCommand(new ResetSubCommand("reset", "Setze den Timer zurück"));
        $this->registerSubCommand(new MenuSubCommand("menu", "Öffne das Timer-Menü"));
        $this->registerSubCommand(new StatusSubCommand("status", "Sehe den Status des Timers an"));
    }

    public function onRun(CommandSender $sender, string $aliasUsed, array $args): void {
        if ($sender->hasPermission($this->getPermission())) {
            $sender->sendMessage(TimerLoader::getPrefix() . "§c/timer start");
            $sender->sendMessage(TimerLoader::getPrefix() . "§c/timer stop");
            $sender->sendMessage(TimerLoader::getPrefix() . "§c/timer reset");
            $sender->sendMessage(TimerLoader::getPrefix() . "§c/timer pause");
            $sender->sendMessage(TimerLoader::getPrefix() . "§c/timer resume");
            $sender->sendMessage(TimerLoader::getPrefix() . "§c/timer menu");
        } else {
            $sender->sendMessage(TimerLoader::getPrefix() . "§cDafür hast du keine Rechte!");
        }
    }
}