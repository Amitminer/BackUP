# WorldBackupX Plugin

WorldBackupX is a Pocketmine mp plugin that allows you to automatically WorldBackupX your world and saved data/world to the cloud. It currently supports Dropbox as a cloud storage provider.

## Features

- Automatic WorldBackupX system that backs up your default world every 24 hours (configurable)
- Saves WorldBackupXs to Dropbox
- Easy to use and configure

## Installation

1. Download the plugin from [GitHub Releases](https://github.com/Amitminer/WorldBackupX/releases).
2. Place the downloaded `WorldBackupX.phar` file in your server's `plugins` directory.
3. Restart your server.

## Configuration *TODO

The configuration for WorldBackupX can be found in the `config.yml` file located in the `plugins/WorldBackupX` directory.

- [x] You can configure the WorldBackupX interval in seconds by setting the `WorldBackupX-time` option in the `config.yml` file. For example, to set the WorldBackupX interval to 5 days, you would set it to `432000` (5 * 24 * 60 * 60).

## Usage

Once installed and configured, WorldBackupX will automatically WorldBackupX your default world to Dropbox every 24 hours (or your configured interval).

## Support

If you encounter any issues with the plugin, feel free to create a new issue on the [GitHub repository](https://github.com/YOUR-USERNAME/WorldBackupX/issues).

## License

WorldBackupX is licensed under the [MIT License](https://github.com/YOUR-USERNAME/WorldBackupX/blob/master/LICENSE).
