<?php

namespace Timer\tasks;

use pocketmine\scheduler\Task;
use pocketmine\Server;
use Timer\TimerLoader;

class TimerTask extends Task {

    public function onRun(int $currentTick) {
        $timer = TimerLoader::getInstance()->getTimer();
        if ($timer->isRunning()) {
            if (!$timer->isPaused()) {
                $timer->setSeconds($timer->getSeconds() + 1);

                if ($timer->getSeconds() == 60) {
                    $timer->setSeconds(0);
                    $timer->setMinutes($timer->getMinutes() + 1);
                }

                if ($timer->getMinutes() == 60) {
                    $timer->setMinutes(0);
                    $timer->setHours($timer->getHours() + 1);
                }

                if ($timer->getHours() == 60) {
                    $timer->setHours(0);
                    $timer->setDays($timer->getDays() + 1);
                }

                $time = [];
                if ($timer->getDays() !== 0) {
                    if ($timer->getDays() < 10) $time[] = "0" . $timer->getDays();
                    else $time[] = $timer->getDays();
                }

                if ($timer->getHours() !== 0) {
                    if ($timer->getHours() < 10) $time[] = "0" . $timer->getHours();
                    else $time[] = $timer->getHours();
                }

                if ($timer->getMinutes() < 10) $time[] = "0" . $timer->getMinutes();
                else $time[] = $timer->getMinutes();

                if ($timer->getSeconds() < 10) $time[] = "0" . $timer->getSeconds();
                else $time[] = $timer->getSeconds();

                foreach (Server::getInstance()->getOnlinePlayers() as $player) {
                    $player->sendPopup("§l§6" . implode("§8:§6", $time) . "§r");
                }
            } else {
                if ($timer->hasFirstStart() === null) return;
                foreach (Server::getInstance()->getOnlinePlayers() as $player) {
                    $player->sendPopup("§6Der Timer wurde §cpausiert§6.");
                }
            }
        } else {
            if ($timer->hasFirstStart() === null) return;
            foreach (Server::getInstance()->getOnlinePlayers() as $player) {
                $player->sendPopup("§6Der Timer wurde §cgestoppt§6.");
            }
        }
    }
}