<?php

namespace Timer;

use CortexPE\Commando\PacketHooker;
use pocketmine\plugin\PluginBase;
use Timer\commands\TimerCommand;
use Timer\tasks\TimerTask;
use Timer\timer\Timer;

class TimerLoader extends PluginBase {

    public static function getPrefix(): string {
        return "§l§6Timer §r§8» §7";
    }

    /** @var TimerLoader */
    private static $instance;
    /** @var Timer */
    private $timer;

    public function onEnable() {
        if (!PacketHooker::isRegistered()) PacketHooker::register($this);
        self::$instance = $this;
        $this->timer = new Timer();

        $this->getServer()->getCommandMap()->registerAll("timer", [
            new TimerCommand($this, "timer", "Timer Command")
        ]);

        $this->getScheduler()->scheduleRepeatingTask(new TimerTask(), 20);
    }

    public function onDisable() {
        $this->timer->resetTimer($error);
        $this->timer->stopTimer($error);
    }

    public function getTimer(): Timer {
        return $this->timer;
    }

    public static function getInstance(): self {
        return self::$instance;
    }
}