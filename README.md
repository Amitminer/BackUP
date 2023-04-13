# BackUP Plugin

BackUP is a Minecraft Pocket Edition plugin that allows you to automatically backup your world and saved data/world to the cloud. It currently supports Dropbox as a cloud storage provider.

## Features

- Automatic backup system that backs up your default world every 24 hours (configurable)
- Saves backups to Dropbox
- Easy to use and configure

## Installation

1. Download the plugin from [GitHub Releases](https://github.com/YOUR-USERNAME/BackUP/releases).
2. Place the downloaded `BackUP.phar` file in your server's `plugins` directory.
3. Restart your server.

## Configuration

The configuration for BackUP can be found in the `config.yml` file located in the `plugins/BackUP` directory.

You can configure the backup interval in seconds by setting the `backup-time` option in the `config.yml` file. For example, to set the backup interval to 5 days, you would set it to `432000` (5 * 24 * 60 * 60).

## Usage

Once installed and configured, BackUP will automatically backup your default world to Dropbox every 24 hours (or your configured interval).

## Support

If you encounter any issues with the plugin, feel free to create a new issue on the [GitHub repository](https://github.com/YOUR-USERNAME/BackUP/issues).

## License

BackUP is licensed under the [MIT License](https://github.com/YOUR-USERNAME/BackUP/blob/master/LICENSE).
