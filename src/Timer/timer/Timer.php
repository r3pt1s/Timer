<?php

namespace Timer\timer;

use pocketmine\Server;

class Timer {

    private $days = 0;
    private $hours = 0;
    private $minutes = 0;
    private $seconds = 0;

    private $paused = false;
    private $running = false;
    private $firstStart = null;

    public function startTimer(&$error) {
        if (!$this->running) {
            $this->running = true;
            $error = null;

            if ($this->firstStart === null) {
                $this->firstStart = true;
            } else if ($this->firstStart === true) {
                $this->firstStart = false;
            }

            foreach (Server::getInstance()->getOnlinePlayers() as $player) {
                $player->sendTitle("§6Der Timer wurde §agestartet§6.", "", 1, 60, 1);
            }
        } else {
            $error = "Der Timer läuft bereits!";
        }
    }

    public function stopTimer(&$error) {
        if ($this->running) {
            $this->running = false;
            $this->paused = false;
            $this->resetTimer($e);
            $error = null;

            foreach (Server::getInstance()->getOnlinePlayers() as $player) {
                $player->sendTitle("§6Der Timer wurde §cgestoppt§6.", "", 1, 60, 1);
            }
        } else {
            $error = "Der Timer läuft nicht!";
        }
    }

    public function resetTimer(&$error) {
        if ($this->firstStart !== null) {
            $this->days = 0;
            $this->hours = 0;
            $this->minutes = 0;
            $this->seconds = 0;
            $error = null;
        } else {
            $error = "Der Timer wurde noch nicht einmal gestartet!";
        }
    }

    public function pauseTimer(&$error) {
        if ($this->running) {
            if (!$this->paused) {
                $this->paused = true;
                $error = null;

                foreach (Server::getInstance()->getOnlinePlayers() as $player) {
                    $player->sendTitle("§6Der Timer wurde §cpausiert§6.", "", 1, 60, 1);
                }
            } else {
                $error = "Der Timer ist bereits pausiert!";
            }
        } else {
            $error = "Der Timer läuft nicht!";
        }
    }

    public function resumeTimer(&$error) {
        if ($this->running) {
            if ($this->paused) {
                $this->paused = false;
                $error = null;
                foreach (Server::getInstance()->getOnlinePlayers() as $player) {
                    $player->sendTitle("§6Der Timer wurde §afortgesetzt§6.", "", 1, 60, 1);
                }
            } else {
                $error = "Der Timer wurde nicht pausiert!";
            }
        } else {
            $error = "Der Timer läuft nicht!";
        }
    }

    public function hasFirstStart() {
        return $this->firstStart;
    }

    public function isRunning(): bool {
        return $this->running;
    }

    public function isPaused(): bool {
        return $this->paused;
    }

    public function getDays(): int {
        return $this->days;
    }

    public function getHours(): int {
        return $this->hours;
    }

    public function getMinutes(): int {
        return $this->minutes;
    }

    public function getSeconds(): int {
        return $this->seconds;
    }

    public function setDays(int $days): void {
        $this->days = $days;
    }

    public function setHours(int $hours): void {
        $this->hours = $hours;
    }

    public function setMinutes(int $minutes): void {
        $this->minutes = $minutes;
    }

    public function setSeconds(int $seconds): void {
        $this->seconds = $seconds;
    }
}