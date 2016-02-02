<?php

  namespace ReportHacker;

  use pocketmine\plugin\PluginBase;
  use pocketmine\event\Listener;
  use pocketmine\utils\TextFormat as TF;
  use pocketmine\Player;
  use pocketmine\command\Command;
  use pocketmine\command\CommandSender;

  class Main extends PluginBase implements Listener {

    public function onEnable() {

      $this->getServer()->getPluginManager()->registerEvents($this, $this);

    }

    public function onCommand(CommandSender $sender, Command $cmd, $label, array $args) {

      if(strtolower($cmd->getName()) === "reporthacker") {

        if(!(isset($args[0]))) {

          $sender->sendMessage(TF::RED . "Error: not enough args. Usage: /reporthacker <player>");

          return true;

        } else {

          $sender_name = $sender->getName();

          $sender_display_name = $sender->getDisplayName();

          $name = $args[0];

          $player = $this->getServer()->getPlayer($name);

          if($player === null) {

            foreach($this->getServer()->getOnlinePlayers() as $p) {

              if($p->isOp()) {

                $p->sendMessage(TF::YELLOW . $sender_name . " reported " . $name . " for using hacks/mods!");

              }

            }

            $sender->sendMessage(TF::GREEN . "Sent report to all op(s).");

            return true;

          } else {

            foreach($this->getServer()->getOnlinePlayers() as $p) {

              if($p->isOp()) {

                $p->sendMessage(TF::YELLOW . $sender_name . " reported " . $name . " for using hacks/mods!");

              }

            }

            $player->sendMessage(TF::YELLOW . $sender_name . " has reported you for using hacks/mods!");

            $sender->sendMessage(TF::GREEN . "Sent report to all op(s).");

            return true;

          }

        }

      }

    }

  }

?>
