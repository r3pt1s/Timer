<?php

namespace Timer\forms;

use dktapps\pmforms\MenuForm;
use dktapps\pmforms\MenuOption;
use pocketmine\Player;
use Timer\commands\subCommands\StopSubCommand;
use Timer\TimerLoader;

class TimerForm extends MenuForm {

    private $options = [];

    public function __construct() {
        $timer = TimerLoader::getInstance()->getTimer();
        $title = "§6Timer";
        $content = "§7Wähle eine Option aus!\n\nStatus: §r" . (TimerLoader::getInstance()->getTimer()->isRunning() ? "§aLäuft" : "§cGestoppt") . (TimerLoader::getInstance()->getTimer()->isPaused() ? "§8(§cPausiert§8)" : "");
        if ($timer->isRunning()) {
            $this->options[] = new MenuOption("§6Timer §cStoppen");
            $this->options[] = new MenuOption("§6Timer §4Zurücksetzen");
            if ($timer->isPaused()) {
                $this->options[] = new MenuOption("§6Timer §aFortfahren");
            } else {
                $this->options[] = new MenuOption("§6Timer §cPausieren");
            }
        } else {
            $this->options[] = new MenuOption("§6Timer §aStarten");
        }
        $this->options[] = new MenuOption("§4Schließen");

        parent::__construct($title, $content, $this->options, function (Player $player, int $data): void {
            $option = $this->getOption($data);
            if ($option !== null) {
                if ($option->getText() == "§6Timer §cStoppen") {
                    TimerLoader::getInstance()->getTimer()->stopTimer($error);
                    if ($error == null) {
                        $player->sendMessage(TimerLoader::getPrefix() . "§6Der Timer wurde §cgestoppt§6!");
                    } else {
                        $player->sendMessage(TimerLoader::getPrefix() . "§c" . $error);
                    }
                } else if ($option->getText() == "§6Timer §4Zurücksetzen") {
                    TimerLoader::getInstance()->getTimer()->resetTimer($error);
                    if ($error == null) {
                        $player->sendMessage(TimerLoader::getPrefix() . "§6Der Timer wurde §czurückgesetzt§6!");
                    } else {
                        $player->sendMessage(TimerLoader::getPrefix() . "§c" . $error);
                    }
                } else if ($option->getText() == "§6Timer §aFortfahren") {
                    TimerLoader::getInstance()->getTimer()->resumeTimer($error);
                    if ($error == null) {
                        $player->sendMessage(TimerLoader::getPrefix() . "§6Der Timer wurde §afortgesetzt§6!");
                    } else {
                        $player->sendMessage(TimerLoader::getPrefix() . "§c" . $error);
                    }
                } else if ($option->getText() == "§6Timer §cPausieren") {
                    TimerLoader::getInstance()->getTimer()->pauseTimer($error);
                    if ($error == null) {
                        $player->sendMessage(TimerLoader::getPrefix() . "§6Der Timer wurde §cpausiert§6!");
                    } else {
                        $player->sendMessage(TimerLoader::getPrefix() . "§c" . $error);
                    }
                } else if ($option->getText() == "§6Timer §aStarten") {
                    TimerLoader::getInstance()->getTimer()->startTimer($error);
                    if ($error == null) {
                        $player->sendMessage(TimerLoader::getPrefix() . "§6Der Timer wurde §agestartet§6!");
                    } else {
                        $player->sendMessage(TimerLoader::getPrefix() . "§c" . $error);
                    }
                }
            }
        });
    }
}