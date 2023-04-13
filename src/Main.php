<?php

declare(strict_types=1);

/**
 * BackUP plugin for PocketMine-MP.
 *
 * This plugin backs up the default world and saved data/world to Dropbox.
 *
 * @link      https://github.com/yourusername/backup
 * @author    Your Name
 * @version   1.0.0
 * @license   MIT License
 */
 
namespace BackUP;

use pocketmine\plugin\PluginBase;
use Kunnu\Dropbox\Dropbox;
use Kunnu\Dropbox\DropboxApp;
use Kunnu\Dropbox\DropboxFile;
use pocketmine\scheduler\task;
use pocketmine\Server;
use pocketmine\scheduler\ClosureTask;
use pocketmine\scheduler\TaskHandler;

// Include Dropbox SDK
require_once __DIR__ . '/../../vendor/autoload.php';

class Main extends PluginBase {

    /**
     * Plugin load event.
     */
    public function onLoad(): void {
        $this->getLogger()->info('BackUP enabled!');
    }
    /**
     * Called when the plugin is enabled.
     * This is where you can register event listeners and scheduled tasks.
     */
    public function onEnable(): void {
        // Set the backup time (in days)
        $backupTime = 1; // Change this to modify the backup interval
        
        // Schedule a repeating task to backup the world
        $this->getScheduler()->scheduleRepeatingTask(
            new ClosureTask(function(): void {
                $this->backupWorld();
            }), 3600 * 24 * $backupTime // Run every $backupTime days
        );
    }
    # BackupWorld Function;
public function backupWorld(): void {
    // Get the name of the default world
    $worldName = Server::getInstance()->getWorldManager()->getDefaultWorld()->getFolderName();

    // Construct the name and path of the backup file
    $backupName = 'world_backup_' . date('Y-m-d') . '.zip';
    $backupPath = $this->getServer()->getDataPath() . 'worlds/' . $worldName . '/' . $backupName;

    // Create backup zip file
    $zip = new \ZipArchive();
    if (!$zip->open($backupPath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE)) {
        $this->getLogger()->error('Failed to create backup zip file');
        return;
    }

    // Add all files in the world folder to the zip archive
    $worldPath = $this->getServer()->getDataPath() . 'worlds/' . $worldName . '/';
    $iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($worldPath));
    foreach ($iterator as $file) {
        if (!$file->isDir()) {
            $zip->addFile($file->getPathname(), str_replace($worldPath, '', $file->getPathname()));
        }
    }
    $zip->close();

    // Upload backup to Dropbox
    $app = new DropboxApp("YOUR_APP_KEY", "YOUR_APP_SECRET", "YOUR_ACCESS_TOKEN");
    $dropbox = new Dropbox($app);

    // Check if the backup file exists
    if (!file_exists($backupPath)) {
        $this->getLogger()->error('Backup file does not exist');
        return;
    }

    // Upload the backup file to Dropbox
    $dropboxFile = DropboxFile::createByStream('/' . $backupName, fopen($backupPath, 'rb'));
    try {
        $file = $dropbox->upload($dropboxFile, '/' . $backupName, ['autorename' => true]);
        $this->getLogger()->info('World backup created: ' . $backupName . ' (ID: ' . $file->getId() . ')');
    } catch (\Exception $e) {
        $this->getLogger()->error('Failed to upload backup file to Dropbox: ' . $e->getMessage());
    }
}
}