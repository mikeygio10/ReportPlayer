<?php

namespace ReportPlayer;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\CommandExecutor;
use pocketmine\event\Listener;
use pocketmine\Player;
use pocketmine\plugin\PluginDescription;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use pocketmine\utils\TextFormat;
use pocketmine\utils\Config;
use pocketmine\permission\ServerOperator;

class Main extends PluginBase implements Listener{
	
    public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->saveDefaultConfig();
        $this->getServer()->getLogger()->notice("§eReport§aPlayer §rplugin by §7MasApip");
    }
    
    public function onDisable(){
        $this->getServer()->getLogger()->notice("§cReportPlayer plugin is disable");
    }
	
    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool{
        switch($command->getName()){
			
            case "report":
		 $name = \strtolower(\array_shift($args));
                    $player = $sender->getServer()->getPlayer($name);
                if(!(isset($args[0]))){
                    $sender->sendMessage("§7(§eR§aP§7) §cUsage: /report <Player> <Reason>");
                    return true;
              }
              if (!($sender instanceof Player)){ 
                $sender->sendMessage("§7(§eR§aP§7) §cYou can only use this command in the game");
                    return true;
                 }
		if(count($args) < 1){                   
				foreach($this->getServer()->getOnlinePlayers() as $p){
					if($p->isOnline() && $p->hasPermission("rp.report.view")){
						if($player instanceof Player){
					$p->sendMessage("§7(§eR§aP§7) §r".$sender->getName()." §areported §c".$player->getDisplayName()." §aReason: §c".implode("", $args));
						
						$sender->sendMessage("§7(§eR§aP§7) §aThank you for reporting!");
						return true;
					}else{
						$sender->sendMessage("§7(§eR§aP§7) §cThere are no staff online, report on the discord / Whatsapp group!");
						return true;
                                        }
                                        }else{ 
                                            $sender->sendMessage(" ");
					}
				}
		 	
			}else if($sender->hasPermission("rp.report")){
                             
				foreach($this->getServer()->getOnlinePlayers() as $p){
					if($p->isOnline() && $p->hasPermission("rp.report.view")){
                                            if($player instanceof Player){
							$p->sendMessage("§7(§eR§aP§7) §r".$sender->getName()." §areported §c".$player->getDisplayName()." §aReason: §c".implode("", $args));
                                                        
							$sender->sendMessage("§7(§eR§aP§7) §aThank you for reporting!");
							return true;
					}else{
						$sender->sendMessage("§7(§eR§aP§7) §cThere are no staff online, report on the discord / Whatsapp group!");
						return true;
					}
                                        }else{ 
                                            $sender->sendMessage(" ");
					}
				}
			}else{
				$sender->sendMessage("§7(§eR§aP§7) §cNo Permissions!");
			            return true;
		}
			
            case "rplayer":
                $sender->sendMessage("§7------------");
                $sender->sendMessage("§aReportPlayer by §7MasApip");
                $sender->sendMessage("§cYou§rtube §7: §aMasApip");
                $sender->sendMessage("§7------------");
				return true;
			}
		}
	}
