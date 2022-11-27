# TaskCheckin Plugin

This Joomla task plugin allows to globally checkin all items.

## Update Server

Please note that my update server only supports the latest version running the latest version of Joomla and atleast PHP 7.2.5.
Any other plugin version I may have added to the download section don't get updates using the update server.

## Issues / Pull Requests

You have found an Issue, have a question or you would like to suggest changes regarding this extension?
[Open an issue in this repo](https://github.com/zero-24/plg_task_checkin/issues/new) or submit a pull request with the proposed changes.

## Translations

You want to translate this extension to your own language? Check out my [Crowdin Page for my Extensions](https://joomla.crowdin.com/zero-24) for more details. Feel free to [open an issue here](https://github.com/zero-24/plg_task_checkin/issues/new) on any question that comes up.

This plugin is translated into the following languages:
- de-DE by @zero-24
- en-GB by @brianteeman @zero-24

## Beyond this repo

This plugin has been proposed for the Joomla Core ([joomla/joomla-cms#39323](https://github.com/joomla/joomla-cms/pull/39323)) and could be part of the upcomming 4.3.0 release. Please note that the core the plugin has been renamed to plg_task_globalcheckin but the feature set is 1:1 the same as this here.

## Special Thanks

Markus Wortmann (@Worti2)

For giving me the inspiration for the plugin and the initial feedback. Thanks :+1:

## Joomla! Extensions Directory (JED)

This plugin can also been found in the Joomla! Extensions Directory: [TaskCheckin by zero24](https://extensions.joomla.org/extension/taskcheckin/)

## Release steps

- `build/build.sh`
- `git commit -am 'prepare release TaskCheckin 1.0.x'`
- `git tag -s '1.0.x' -m 'TaskCheckin 1.0.x'`
- `git push origin --tags`
- create the release on GitHub
- `git push origin master`

## Crowdin

### Upload new strings

`crowdin upload sources`

### Download translations

`crowdin download --skip-untranslated-files --ignore-match`
