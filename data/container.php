<?php
/**
 * 2014 - 2023 Watt Is It
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the MIT License X11
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/mit-license.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to contact@paygreen.fr so we can send you a copy immediately.
 *
 * @author    PayGreen <contact@paygreen.fr>
 * @copyright 2014 - 2023 Watt Is It
 * @license   https://opensource.org/licenses/mit-license.php MIT License X11
 * @version   1.3.7
 *
 */

return array (
'kernel' =>
array (
'fixed' => true,
),
'container' =>
array (
'fixed' => true,
),
'bootstrap' =>
array (
'fixed' => true,
),
'autoloader' =>
array (
'fixed' => true,
),
'pathfinder' =>
array (
'fixed' => true,
),
'service.library' =>
array (
'fixed' => true,
),
'service.builder' =>
array (
'fixed' => true,
),
'parameters' =>
array (
'fixed' => true,
),
'parser' =>
array (
'fixed' => true,
),
'officer.setup' =>
array (
'class' => 'PGI\\Impact\\PGModule\\Services\\Officers\\SetupOfficer',
),
'dumper' =>
array (
'class' => 'PGI\\Impact\\PGFramework\\Services\\Dumper',
),
'notifier' =>
array (
'class' => 'PGI\\Impact\\PGFramework\\Services\\Notifier',
'arguments' =>
array (
0 => '@handler.session',
),
),
'upgrader' =>
array (
'class' => 'PGI\\Impact\\PGModule\\Services\\Upgrader',
'arguments' =>
array (
0 => '@aggregator.upgrade',
1 => '@logger',
2 => '%upgrades',
3 => '@aggregator.upgrade',
4 => '@logger',
5 => '%upgrades',
),
),
'behavior.detailed_logs' =>
array (
'class' => 'PGI\\Impact\\PGFramework\\Services\\Behaviors\\DetailedLogsBehavior',
'arguments' =>
array (
0 => '@settings',
),
),
'diagnostic.media_files_chmod' =>
array (
'abstract' => false,
'tags' =>
array (
0 =>
array (
'name' => 'diagnostic',
),
),
'class' => 'PGI\\Impact\\PGFramework\\Services\\Diagnostics\\MediaFilesChmodDiagnostic',
'extends' => 'diagnostic.abstract',
'arguments' =>
array (
0 => '@pathfinder',
),
),
'diagnostic.media_folder_chmod' =>
array (
'abstract' => false,
'tags' =>
array (
0 =>
array (
'name' => 'diagnostic',
),
),
'class' => 'PGI\\Impact\\PGFramework\\Services\\Diagnostics\\MediaFolderChmodDiagnostic',
'extends' => 'diagnostic.abstract',
'arguments' =>
array (
0 => '@pathfinder',
),
),
'diagnostic.var_folder_chmod' =>
array (
'abstract' => false,
'tags' =>
array (
0 =>
array (
'name' => 'diagnostic',
),
),
'class' => 'PGI\\Impact\\PGFramework\\Services\\Diagnostics\\VarFolderChmodDiagnostic',
'extends' => 'diagnostic.abstract',
'arguments' =>
array (
0 => '@pathfinder',
),
),
'listener.setup.static_files' =>
array (
'class' => 'PGI\\Impact\\PGFramework\\Services\\Listeners\\InstallStaticFilesListener',
'arguments' =>
array (
0 => '@handler.static_file',
1 => '@logger',
),
),
'superglobal.get' =>
array (
'abstract' => false,
'class' => 'PGI\\Impact\\PGFramework\\Services\\Superglobals\\GetSuperglobal',
'extends' => 'superglobal.abstract',
),
'superglobal.post' =>
array (
'abstract' => false,
'class' => 'PGI\\Impact\\PGFramework\\Services\\Superglobals\\PostSuperglobal',
'extends' => 'superglobal.abstract',
),
'superglobal.cookie' =>
array (
'abstract' => false,
'class' => 'PGI\\Impact\\PGFramework\\Services\\Superglobals\\CookieSuperglobal',
'extends' => 'superglobal.abstract',
),
'superglobal.session' =>
array (
'class' => 'PGI\\Impact\\PGFramework\\Services\\Superglobals\\SessionSuperglobal',
'arguments' =>
array (
0 => '@logger',
),
),
'generator.csv' =>
array (
'class' => 'PGI\\Impact\\PGFramework\\Services\\Generators\\CSVGenerator',
),
'handler.picture' =>
array (
'class' => 'PGI\\Impact\\PGFramework\\Services\\Handlers\\PictureHandler',
'arguments' =>
array (
0 => '${PGIMPACT_MEDIA_DIR}',
1 => '%{media.baseurl}',
),
),
'handler.cache' =>
array (
'class' => 'PGI\\Impact\\PGFramework\\Services\\Handlers\\CacheHandler',
'arguments' =>
array (
0 => '%cache',
1 => '@pathfinder',
2 => '@settings',
3 => '@logger',
),
),
'handler.select' =>
array (
'class' => 'PGI\\Impact\\PGFramework\\Services\\Handlers\\SelectHandler',
'arguments' =>
array (
0 => '@aggregator.selector',
),
),
'handler.mime_type' =>
array (
'class' => 'PGI\\Impact\\PGFramework\\Services\\Handlers\\MimeTypeHandler',
'arguments' =>
array (
0 => '@logger',
1 => '%mime_types',
),
),
'handler.session' =>
array (
'class' => 'PGI\\Impact\\PGFramework\\Services\\Handlers\\SessionHandler',
'arguments' =>
array (
0 => '@superglobal.session',
),
),
'handler.upload' =>
array (
'class' => 'PGI\\Impact\\PGFramework\\Services\\Handlers\\UploadHandler',
'arguments' =>
array (
0 => '@logger',
),
),
'handler.output' =>
array (
'class' => 'PGI\\Impact\\PGFramework\\Services\\Handlers\\OutputHandler',
),
'handler.cookie' =>
array (
'class' => 'PGI\\Impact\\PGFramework\\Services\\Handlers\\CookieHandler',
'arguments' =>
array (
0 => '@superglobal.cookie',
1 => '@logger',
),
),
'handler.requirement' =>
array (
'class' => 'PGI\\Impact\\PGFramework\\Services\\Handlers\\RequirementHandler',
'arguments' =>
array (
0 => '@aggregator.requirement',
1 => '@parser',
2 => '%requirements',
3 => '@logger',
),
),
'handler.hook' =>
array (
'class' => 'PGI\\Impact\\PGFramework\\Services\\Handlers\\HookHandler',
'arguments' =>
array (
0 => '@aggregator.hook',
1 => '@logger',
),
),
'handler.http' =>
array (
'class' => 'PGI\\Impact\\PGFramework\\Services\\Handlers\\HTTPHandler',
),
'aggregator.requirement' =>
array (
'abstract' => false,
'class' => 'PGI\\Impact\\PGFramework\\Components\\Aggregator',
'arguments' =>
array (
0 => '@container',
),
'extends' => 'aggregator.abstract',
'config' =>
array (
'type' => 'requirement',
'interface' => 'PGI\\Impact\\PGFramework\\Interfaces\\RequirementInterface',
),
'catch' => 'requirement',
),
'aggregator.selector' =>
array (
'abstract' => false,
'class' => 'PGI\\Impact\\PGFramework\\Components\\Aggregator',
'arguments' =>
array (
0 => '@container',
),
'extends' => 'aggregator.abstract',
'config' =>
array (
'type' => 'selector',
'interface' => 'PGI\\Impact\\PGFramework\\Interfaces\\SelectorInterface',
),
'catch' => 'selector',
),
'aggregator.hook' =>
array (
'abstract' => false,
'class' => 'PGI\\Impact\\PGFramework\\Components\\Aggregator',
'arguments' =>
array (
0 => '@container',
),
'extends' => 'aggregator.abstract',
'config' =>
array (
'type' => 'hook',
),
'catch' => 'hook',
),
'logger' =>
array (
'abstract' => false,
'class' => 'PGI\\Impact\\PGLog\\Services\\Logger',
'calls' =>
array (
0 =>
array (
'method' => 'setBehaviorHandler',
'arguments' =>
array (
0 => '@handler.behavior',
),
),
),
'extends' => 'logger.abstract',
'arguments' =>
array (
0 => '@log.writer.default',
),
),
'storage.crontab.global' =>
array (
'abstract' => false,
'class' => 'PGI\\Impact\\PGModule\\Components\\Storages\\Setting',
'arguments' =>
array (
0 => '@settings',
1 => 'crontab_global',
),
'extends' => 'storage.setting.abstract',
),
'storage.crontab.shop' =>
array (
'abstract' => false,
'class' => 'PGI\\Impact\\PGModule\\Components\\Storages\\Setting',
'arguments' =>
array (
0 => '@settings',
1 => 'crontab_shop',
),
'extends' => 'storage.setting.abstract',
),
'officer.settings.database.basic' =>
array (
'class' => 'PGI\\Impact\\PGModule\\Services\\Officers\\SettingsDatabaseOfficer',
'arguments' =>
array (
0 => '@manager.setting',
1 => '@handler.shop',
),
),
'officer.settings.database.global' =>
array (
'class' => 'PGI\\Impact\\PGModule\\Services\\Officers\\SettingsDatabaseOfficer',
'arguments' =>
array (
0 => '@manager.setting',
),
),
'officer.settings.storage.basic' =>
array (
'class' => 'PGI\\Impact\\PGModule\\Services\\Officers\\SettingsStorageOfficer',
'arguments' =>
array (
0 => '@pathfinder',
1 => '@handler.shop',
),
),
'officer.settings.storage.global' =>
array (
'class' => 'PGI\\Impact\\PGModule\\Services\\Officers\\SettingsStorageOfficer',
'arguments' =>
array (
0 => '@pathfinder',
),
),
'upgrade.update_settings_values' =>
array (
'abstract' => false,
'tags' =>
array (
0 =>
array (
'name' => 'upgrade',
),
),
'class' => 'PGI\\Impact\\PGModule\\Services\\Upgrades\\UpdateSettingsValuesUpgrade',
'extends' => 'upgrade.abstract',
'arguments' =>
array (
0 => '@settings',
),
),
'upgrade.rename_settings' =>
array (
'abstract' => false,
'tags' =>
array (
0 =>
array (
'name' => 'upgrade',
),
),
'class' => 'PGI\\Impact\\PGModule\\Services\\Upgrades\\RenameSettingsUpgrade',
'extends' => 'upgrade.abstract',
'arguments' =>
array (
0 => '@manager.setting',
1 => '@manager.shop',
),
),
'upgrade.retrieve_setting_global_value' =>
array (
'abstract' => false,
'tags' =>
array (
0 =>
array (
'name' => 'upgrade',
),
),
'class' => 'PGI\\Impact\\PGModule\\Services\\Upgrades\\RetrieveSettingGlobalValueUpgrade',
'extends' => 'upgrade.abstract',
'arguments' =>
array (
0 => '@manager.setting',
1 => '@manager.shop',
2 => '@logger',
),
),
'upgrade.remove_settings' =>
array (
'abstract' => false,
'tags' =>
array (
0 =>
array (
'name' => 'upgrade',
),
),
'class' => 'PGI\\Impact\\PGModule\\Services\\Upgrades\\RemoveSettingsUpgrade',
'extends' => 'upgrade.abstract',
'arguments' =>
array (
0 => '@manager.setting',
1 => '@manager.shop',
),
),
'requirement.generic.setting' =>
array (
'abstract' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setLogger',
'arguments' =>
array (
0 => '@logger',
),
),
),
'extends' => 'requirement.abstract',
'shared' => false,
'tags' =>
array (
0 =>
array (
'name' => 'requirement',
),
),
'class' => 'PGI\\Impact\\PGModule\\Services\\Requirements\\GenericSettingRequirement',
'arguments' =>
array (
0 => '@settings',
),
),
'requirement.generic.bridge' =>
array (
'abstract' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setLogger',
'arguments' =>
array (
0 => '@logger',
),
),
),
'extends' => 'requirement.abstract',
'shared' => false,
'tags' =>
array (
0 =>
array (
'name' => 'requirement',
),
),
'class' => 'PGI\\Impact\\PGModule\\Services\\Requirements\\GenericBridgeRequirement',
'arguments' =>
array (
0 => '@container',
),
),
'settings' =>
array (
'class' => 'PGI\\Impact\\PGModule\\Services\\Settings',
'arguments' =>
array (
0 => '@container',
1 => '@parameters',
2 => '%settings',
),
),
'broadcaster' =>
array (
'class' => 'PGI\\Impact\\PGModule\\Services\\Broadcaster',
'arguments' =>
array (
0 => '@container',
1 => '@handler.requirement',
2 => '@parser',
3 => '@logger',
4 => '%listeners',
),
'catch' =>
array (
'tag' => 'listener',
'method' => 'addListener',
'built' => false,
),
),
'provider.output' =>
array (
'class' => 'PGI\\Impact\\PGModule\\Services\\Providers\\OutputProvider',
'arguments' =>
array (
0 => '@aggregator.builder.output',
1 => '@handler.requirement',
2 => '%outputs',
3 => '@logger',
),
),
'facade.application' =>
array (
'class' => 'PGI\\Impact\\PGWordPress\\Services\\Facades\\ApplicationFacade',
),
'facade.module' =>
array (
'class' => 'PGI\\Impact\\PGWordPress\\Services\\Facades\\ModuleFacade',
),
'listener.settings.install_default' =>
array (
'class' => 'PGI\\Impact\\PGModule\\Services\\Listeners\\InstallDefaultSettingsListener',
'arguments' =>
array (
0 => '@settings',
1 => '@logger',
),
),
'listener.settings.uninstall' =>
array (
'class' => 'PGI\\Impact\\PGModule\\Services\\Listeners\\UninstallSettingsListener',
'arguments' =>
array (
0 => '@settings',
1 => '@logger',
),
),
'listener.upgrade' =>
array (
'class' => 'PGI\\Impact\\PGModule\\Services\\Listeners\\UpgradeListener',
'arguments' =>
array (
0 => '@upgrader',
1 => '@logger',
),
),
'handler.setup' =>
array (
'class' => 'PGI\\Impact\\PGModule\\Services\\Handlers\\SetupHandler',
'arguments' =>
array (
0 => '@broadcaster',
1 => '@officer.setup',
2 => '@settings',
3 => '@logger',
),
),
'handler.behavior' =>
array (
'class' => 'PGI\\Impact\\PGModule\\Services\\Handlers\\BehaviorHandler',
'arguments' =>
array (
0 => '@handler.requirement',
1 => '%behaviors',
),
),
'handler.diagnostic' =>
array (
'class' => 'PGI\\Impact\\PGModule\\Services\\Handlers\\DiagnosticHandler',
'arguments' =>
array (
0 => '@aggregator.diagnostic',
1 => '@logger',
),
),
'handler.static_file' =>
array (
'class' => 'PGI\\Impact\\PGModule\\Services\\Handlers\\StaticFileHandler',
'arguments' =>
array (
0 => '@logger',
1 => '@pathfinder',
2 => '%static',
),
),
'repository.setting' =>
array (
'abstract' => false,
'arguments' =>
array (
0 => '@handler.database',
1 => '%database.entities.setting',
),
'extends' => 'repository.abstract',
'class' => 'PGI\\Impact\\PGModule\\Services\\Repositories\\SettingRepository',
),
'cron.tab.global' =>
array (
'abstract' => false,
'factory' => 'factory.cron.tab',
'tags' =>
array (
0 =>
array (
'name' => 'cron.tab',
),
),
'extends' => 'cron.tab.abstract',
'arguments' =>
array (
0 => '@storage.crontab.global',
1 => 'global',
),
),
'cron.tab.shop' =>
array (
'abstract' => false,
'factory' => 'factory.cron.tab',
'tags' =>
array (
0 =>
array (
'name' => 'cron.tab',
),
),
'extends' => 'cron.tab.abstract',
'arguments' =>
array (
0 => '@storage.crontab.shop',
1 => 'shop',
),
),
'manager.setting' =>
array (
'class' => 'PGI\\Impact\\PGModule\\Services\\Managers\\SettingManager',
'arguments' =>
array (
0 => '@repository.setting',
),
),
'aggregator.upgrade' =>
array (
'abstract' => false,
'class' => 'PGI\\Impact\\PGFramework\\Components\\Aggregator',
'arguments' =>
array (
0 => '@container',
),
'extends' => 'aggregator.abstract',
'config' =>
array (
'type' => 'upgrade',
'interface' => 'PGI\\Impact\\PGModule\\Interfaces\\UpgradeInterface',
),
'catch' => 'upgrade',
),
'aggregator.builder.output' =>
array (
'abstract' => false,
'class' => 'PGI\\Impact\\PGFramework\\Components\\Aggregator',
'arguments' =>
array (
0 => '@container',
),
'extends' => 'aggregator.abstract',
'config' =>
array (
'type' => 'builder.output',
'interface' => 'PGI\\Impact\\PGModule\\Interfaces\\Builders\\OutputBuilderInterface',
),
'catch' => 'builder.output',
),
'aggregator.diagnostic' =>
array (
'abstract' => false,
'class' => 'PGI\\Impact\\PGFramework\\Components\\Aggregator',
'arguments' =>
array (
0 => '@container',
),
'extends' => 'aggregator.abstract',
'config' =>
array (
'type' => 'diagnostic',
),
'catch' => 'diagnostic',
),
'upgrade.database' =>
array (
'abstract' => false,
'tags' =>
array (
0 =>
array (
'name' => 'upgrade',
),
),
'class' => 'PGI\\Impact\\PGDatabase\\Services\\Upgrades\\DatabaseUpgrade',
'extends' => 'upgrade.abstract',
'arguments' =>
array (
0 => '@handler.database',
),
),
'listener.database.runner' =>
array (
'class' => 'PGI\\Impact\\PGDatabase\\Services\\Listeners\\GenericDatabaseRunnerListener',
'shared' => false,
'arguments' =>
array (
0 => '@handler.database',
),
),
'handler.database' =>
array (
'class' => 'PGI\\Impact\\PGDatabase\\Services\\Handlers\\DatabaseHandler',
'arguments' =>
array (
0 => '@officer.database',
1 => '@parser',
2 => '@pathfinder',
3 => '@logger',
),
),
'acceptor.class' =>
array (
'class' => 'PGI\\Impact\\PGServer\\Services\\Acceptors\\ModelAcceptor',
'tags' =>
array (
0 =>
array (
'name' => 'acceptor',
'options' =>
array (
0 => 'class',
),
),
),
),
'acceptor.instance' =>
array (
'class' => 'PGI\\Impact\\PGServer\\Services\\Acceptors\\InstanceAcceptor',
'tags' =>
array (
0 =>
array (
'name' => 'acceptor',
'options' =>
array (
0 => 'instance',
),
),
),
),
'acceptor.tag' =>
array (
'class' => 'PGI\\Impact\\PGServer\\Services\\Acceptors\\TagAcceptor',
'tags' =>
array (
0 =>
array (
'name' => 'acceptor',
'options' =>
array (
0 => 'tag',
),
),
),
),
'acceptor.action' =>
array (
'class' => 'PGI\\Impact\\PGServer\\Services\\Acceptors\\ActionAcceptor',
'tags' =>
array (
0 =>
array (
'name' => 'acceptor',
'options' =>
array (
0 => 'action',
),
),
),
),
'dispatcher' =>
array (
'class' => 'PGI\\Impact\\PGServer\\Services\\Dispatcher',
'arguments' =>
array (
0 => '@logger',
1 => '@broadcaster',
2 => '@aggregator.controller',
3 => '@aggregator.action',
),
),
'builder.request.default' =>
array (
'class' => 'PGI\\Impact\\PGWordPress\\Services\\Builders\\RequestBuilder',
'arguments' =>
array (
0 => '@superglobal.get',
1 => '@superglobal.post',
2 => '%request_builder.default',
),
),
'router' =>
array (
'class' => 'PGI\\Impact\\PGServer\\Services\\Router',
'arguments' =>
array (
0 => '@handler.area',
1 => '@handler.route',
),
),
'derouter' =>
array (
'class' => 'PGI\\Impact\\PGServer\\Services\\Derouter',
'arguments' =>
array (
0 => '@aggregator.deflector',
1 => '@logger',
),
),
'factory.trigger' =>
array (
'class' => 'PGI\\Impact\\PGServer\\Services\\Factories\\TriggerFactory',
'arguments' =>
array (
0 => '@aggregator.acceptor',
1 => '@logger',
),
),
'factory.stage' =>
array (
'class' => 'PGI\\Impact\\PGServer\\Services\\Factories\\StageFactory',
'arguments' =>
array (
0 => '@factory.trigger',
1 => '@logger',
),
),
'handler.route' =>
array (
'class' => 'PGI\\Impact\\PGServer\\Services\\Handlers\\RouteHandler',
'arguments' =>
array (
0 => '%routing.routes',
),
'calls' =>
array (
0 =>
array (
'method' => 'setRequirementHandler',
'arguments' =>
array (
0 => '@handler.requirement',
),
),
),
),
'handler.area' =>
array (
'class' => 'PGI\\Impact\\PGServer\\Services\\Handlers\\AreaHandler',
'arguments' =>
array (
0 => '%routing.areas',
),
),
'handler.link' =>
array (
'class' => 'PGI\\Impact\\PGServer\\Services\\Handlers\\LinkHandler',
'arguments' =>
array (
0 => '@aggregator.linker',
1 => '@logger',
2 => '@facade.module',
),
),
'cleaner.basic_http.not_found' =>
array (
'class' => 'PGI\\Impact\\PGServer\\Services\\Cleaners\\BasicHTTPCleaner',
'arguments' =>
array (
0 => 404,
),
),
'cleaner.basic_http.unauthorized_access' =>
array (
'class' => 'PGI\\Impact\\PGServer\\Services\\Cleaners\\BasicHTTPCleaner',
'arguments' =>
array (
0 => 401,
),
),
'cleaner.basic_http.server_error' =>
array (
'class' => 'PGI\\Impact\\PGServer\\Services\\Cleaners\\BasicHTTPCleaner',
'arguments' =>
array (
0 => 500,
),
),
'cleaner.basic_http.bad_request' =>
array (
'class' => 'PGI\\Impact\\PGServer\\Services\\Cleaners\\BasicHTTPCleaner',
'arguments' =>
array (
0 => 400,
),
),
'cleaner.basic_throw' =>
array (
'class' => 'PGI\\Impact\\PGServer\\Services\\Cleaners\\BasicThrowCleaner',
),
'renderer.transformer.paygreen_module_2_array' =>
array (
'class' => 'PGI\\Impact\\PGServer\\Services\\Renderers\\Transformers\\PaygreenModuleToArrayTransformerRenderer',
'arguments' =>
array (
0 => '@notifier',
),
),
'renderer.transformer.file_2_http' =>
array (
'class' => 'PGI\\Impact\\PGServer\\Services\\Renderers\\Transformers\\FileToHttpTransformerRenderer',
'arguments' =>
array (
0 => '@handler.mime_type',
),
),
'renderer.transformer.array_2_http' =>
array (
'class' => 'PGI\\Impact\\PGServer\\Services\\Renderers\\Transformers\\ArrayToHttpTransformerRenderer',
),
'renderer.transformer.string_2_http' =>
array (
'class' => 'PGI\\Impact\\PGServer\\Services\\Renderers\\Transformers\\StringToHttpTransformerRenderer',
),
'renderer.transformer.redirection_2_http' =>
array (
'class' => 'PGI\\Impact\\PGServer\\Services\\Renderers\\Transformers\\RedirectionToHttpTransformerRenderer',
),
'renderer.processor.write_http' =>
array (
'class' => 'PGI\\Impact\\PGServer\\Services\\Renderers\\Processors\\WriteHTTPRendererProcessor',
'arguments' =>
array (
0 => '1.1',
1 => '%http_codes',
),
),
'renderer.processor.output_template' =>
array (
'class' => 'PGI\\Impact\\PGServer\\Services\\Renderers\\Processors\\OutputTemplateRendererProcessor',
'arguments' =>
array (
0 => '@handler.view',
1 => '@handler.output',
),
),
'aggregator.deflector' =>
array (
'abstract' => false,
'class' => 'PGI\\Impact\\PGFramework\\Components\\Aggregator',
'arguments' =>
array (
0 => '@container',
),
'extends' => 'aggregator.abstract',
'config' =>
array (
'type' => 'deflector',
'interface' => 'PGI\\Impact\\PGServer\\Interfaces\\DeflectorInterface',
),
'catch' => 'deflector',
),
'aggregator.linker' =>
array (
'abstract' => false,
'class' => 'PGI\\Impact\\PGFramework\\Components\\Aggregator',
'arguments' =>
array (
0 => '@container',
),
'extends' => 'aggregator.abstract',
'config' =>
array (
'type' => 'linker',
'interface' => 'PGI\\Impact\\PGServer\\Interfaces\\LinkerInterface',
),
'catch' => 'linker',
),
'aggregator.acceptor' =>
array (
'abstract' => false,
'class' => 'PGI\\Impact\\PGFramework\\Components\\Aggregator',
'arguments' =>
array (
0 => '@container',
),
'extends' => 'aggregator.abstract',
'config' =>
array (
'type' => 'acceptor',
),
'catch' => 'acceptor',
),
'aggregator.controller' =>
array (
'abstract' => false,
'class' => 'PGI\\Impact\\PGFramework\\Components\\Aggregator',
'arguments' =>
array (
0 => '@container',
),
'extends' => 'aggregator.abstract',
'config' =>
array (
'type' => 'controller',
),
'catch' => 'controller',
),
'aggregator.action' =>
array (
'abstract' => false,
'class' => 'PGI\\Impact\\PGFramework\\Components\\Aggregator',
'arguments' =>
array (
0 => '@container',
),
'extends' => 'aggregator.abstract',
'config' =>
array (
'type' => 'action',
'interface' => 'PGI\\Impact\\PGServer\\Interfaces\\ActionInterface',
),
'catch' => 'action',
),
'plugin.smarty.translator' =>
array (
'class' => 'PGI\\Impact\\PGIntl\\Services\\Plugins\\SmartyTranslatorPlugin',
'arguments' =>
array (
0 => '@translator',
),
'tags' =>
array (
0 =>
array (
'name' => 'plugin.smarty',
'options' =>
array (
0 => 'pgtrans',
1 => 'translateExpression',
),
),
1 =>
array (
'name' => 'plugin.smarty',
'options' =>
array (
0 => 'pgtranslines',
1 => 'translateParagraph',
),
),
),
),
'officer.locale' =>
array (
'class' => 'PGI\\Impact\\PGWordPress\\Services\\Officers\\LocaleOfficer',
),
'upgrade.translations.install_default_values' =>
array (
'abstract' => false,
'tags' =>
array (
0 =>
array (
'name' => 'upgrade',
),
),
'class' => 'PGI\\Impact\\PGIntl\\Services\\Upgrades\\InsertDefaultTranslationsHandler',
'extends' => 'upgrade.abstract',
'arguments' =>
array (
0 => '@handler.translation',
1 => '@manager.shop',
),
),
'upgrade.translations.restore' =>
array (
'abstract' => false,
'tags' =>
array (
0 =>
array (
'name' => 'upgrade',
),
),
'class' => 'PGI\\Impact\\PGIntl\\Services\\Upgrades\\RestoreTranslationsHandler',
'extends' => 'upgrade.abstract',
'arguments' =>
array (
0 => '@manager.translation',
1 => '@manager.shop',
2 => '@repository.setting',
3 => '@settings',
),
),
'upgrade.button_labels.restore' =>
array (
'abstract' => false,
'tags' =>
array (
0 =>
array (
'name' => 'upgrade',
),
),
'class' => 'PGI\\Impact\\PGIntl\\Services\\Upgrades\\RestoreButtonLabelsHandler',
'extends' => 'upgrade.abstract',
'arguments' =>
array (
0 => '@manager.translation',
1 => '@manager.shop',
2 => '@handler.database',
),
),
'translator' =>
array (
'class' => 'PGI\\Impact\\PGIntl\\Services\\Translator',
'arguments' =>
array (
0 => '@handler.cache.translation',
1 => '@pathfinder',
2 => '@handler.locale',
3 => '@logger',
4 => '%intl',
),
),
'selector.language' =>
array (
'arguments' =>
array (
0 => '@logger',
1 => '%languages',
),
'abstract' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setTranslator',
'arguments' =>
array (
0 => '@translator',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'selector',
),
),
'extends' => 'selector.abstract',
'class' => 'PGI\\Impact\\PGIntl\\Services\\Selectors\\LanguageSelector',
),
'selector.countries' =>
array (
'arguments' =>
array (
0 => '@logger',
1 => '%countries',
),
'abstract' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setTranslator',
'arguments' =>
array (
0 => '@translator',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'selector',
),
),
'extends' => 'selector.abstract',
'class' => 'PGI\\Impact\\PGIntl\\Services\\Selectors\\CountrySelector',
),
'listener.setup.install_default_translations' =>
array (
'class' => 'PGI\\Impact\\PGIntl\\Services\\Listeners\\InsertDefaultTranslationsListener',
'arguments' =>
array (
0 => '@handler.translation',
1 => '@manager.shop',
),
),
'listener.setup.reset_translation_cache' =>
array (
'class' => 'PGI\\Impact\\PGIntl\\Services\\Listeners\\ResetTranslationCacheListener',
'arguments' =>
array (
0 => '@handler.cache.translation',
1 => '@logger',
),
),
'handler.translation' =>
array (
'class' => 'PGI\\Impact\\PGIntl\\Services\\Handlers\\TranslationHandler',
'arguments' =>
array (
0 => '@manager.translation',
1 => '@handler.locale',
2 => '@logger',
3 => '%translations',
),
),
'handler.locale' =>
array (
'class' => 'PGI\\Impact\\PGIntl\\Services\\Handlers\\LocaleHandler',
'arguments' =>
array (
0 => '@officer.locale',
),
),
'handler.cache.translation' =>
array (
'class' => 'PGI\\Impact\\PGIntl\\Services\\Handlers\\CacheTranslationHandler',
'arguments' =>
array (
0 => '@pathfinder',
1 => '@settings',
2 => '@logger',
),
),
'repository.translation' =>
array (
'abstract' => false,
'arguments' =>
array (
0 => '@handler.database',
1 => '%database.entities.translation',
2 => '@handler.shop',
),
'extends' => 'repository.abstract',
'class' => 'PGI\\Impact\\PGIntl\\Services\\Repositories\\TranslationRepository',
),
'manager.translation' =>
array (
'class' => 'PGI\\Impact\\PGIntl\\Services\\Managers\\TranslationManager',
'arguments' =>
array (
0 => '@repository.translation',
),
),
'logger.view' =>
array (
'abstract' => false,
'class' => 'PGI\\Impact\\PGLog\\Services\\Logger',
'calls' =>
array (
0 =>
array (
'method' => 'setBehaviorHandler',
'arguments' =>
array (
0 => '@handler.behavior',
),
),
),
'extends' => 'logger.abstract',
'arguments' =>
array (
0 => '@log.writer.view',
),
),
'plugin.smarty.view_injecter' =>
array (
'class' => 'PGI\\Impact\\PGView\\Services\\Plugins\\SmartyViewInjecterPlugin',
'arguments' =>
array (
0 => '@handler.view',
),
'tags' =>
array (
0 =>
array (
'name' => 'plugin.smarty',
'options' =>
array (
0 => 'view',
1 => 'insertView',
2 => 'function',
),
),
1 =>
array (
'name' => 'plugin.smarty',
'options' =>
array (
0 => 'template',
1 => 'insertTemplate',
2 => 'function',
),
),
),
),
'plugin.smarty.linker' =>
array (
'class' => 'PGI\\Impact\\PGView\\Services\\Plugins\\SmartyLinkerPlugin',
'arguments' =>
array (
0 => '@handler.link',
),
'tags' =>
array (
0 =>
array (
'name' => 'plugin.smarty',
'options' =>
array (
0 => 'toback',
1 => 'buildBackOfficeUrl',
),
),
1 =>
array (
'name' => 'plugin.smarty',
'options' =>
array (
0 => 'tofront',
1 => 'buildFrontOfficeUrl',
),
),
),
),
'plugin.smarty.picture' =>
array (
'class' => 'PGI\\Impact\\PGView\\Services\\Plugins\\SmartyPicturePlugin',
'arguments' =>
array (
0 => '@handler.static_file',
),
'tags' =>
array (
0 =>
array (
'name' => 'plugin.smarty',
'options' =>
array (
0 => 'picture',
1 => 'buildPictureUrl',
),
),
),
),
'plugin.smarty.clip' =>
array (
'class' => 'PGI\\Impact\\PGView\\Services\\Plugins\\SmartyClipPlugin',
'tags' =>
array (
0 =>
array (
'name' => 'plugin.smarty',
'options' =>
array (
0 => 'clip',
1 => 'clip',
),
),
),
),
'handler.view' =>
array (
'class' => 'PGI\\Impact\\PGView\\Services\\Handlers\\ViewHandler',
'arguments' =>
array (
0 => '@aggregator.view',
1 => '@handler.smarty',
2 => '@pathfinder',
),
),
'view.basic' =>
array (
'class' => 'PGI\\Impact\\PGView\\Services\\View',
'shared' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setViewHandler',
'arguments' =>
array (
0 => '@handler.view',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'view',
),
),
),
'handler.smarty' =>
array (
'class' => 'PGI\\Impact\\PGView\\Services\\Handlers\\SmartyHandler',
'arguments' =>
array (
0 => '@%{smarty.builder.service}',
1 => '@pathfinder',
2 => '@logger.view',
3 => '%smarty',
),
'catch' =>
array (
'tag' => 'plugin.smarty',
'method' => 'installPlugin',
'built' => true,
),
),
'handler.block' =>
array (
'class' => 'PGI\\Impact\\PGView\\Services\\Handlers\\BlockHandler',
'arguments' =>
array (
0 => '@handler.view',
1 => '@handler.requirement',
2 => '@dispatcher',
3 => '%blocks',
),
),
'builder.smarty' =>
array (
'class' => 'PGI\\Impact\\PGView\\Services\\Builders\\SmartyBuilder',
'arguments' =>
array (
0 => '@pathfinder',
1 => '%smarty.builder',
),
),
'listener.upgrade.clear_smarty_cache' =>
array (
'class' => 'PGI\\Impact\\PGView\\Services\\Listeners\\ClearSmartyCacheListener',
'arguments' =>
array (
0 => '@handler.smarty',
1 => '@logger',
),
),
'log.writer.view' =>
array (
'abstract' => false,
'tags' =>
array (
0 =>
array (
'name' => 'log.writer',
),
1 =>
array (
'name' => 'log.writer.file',
),
),
'extends' => 'log.writer.file.abstract',
'class' => 'PGI\\Impact\\PGLog\\Services\\LogWriters\\FileLogWriter',
'arguments' =>
array (
0 => '@dumper',
1 => '@pathfinder',
),
'config' => '%log.outputs.view.config',
),
'aggregator.view' =>
array (
'abstract' => false,
'class' => 'PGI\\Impact\\PGFramework\\Components\\Aggregator',
'arguments' =>
array (
0 => '@container',
),
'extends' => 'aggregator.abstract',
'config' =>
array (
'type' => 'view',
'interface' => 'PGI\\Impact\\PGView\\Interfaces\\ViewInterface',
),
'catch' => 'view',
),
'view.form' =>
array (
'class' => 'PGI\\Impact\\PGForm\\Services\\Views\\FormView',
'shared' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setViewHandler',
'arguments' =>
array (
0 => '@handler.view',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'view',
),
),
'abstract' => false,
'extends' => 'view.basic',
),
'view.field' =>
array (
'class' => 'PGI\\Impact\\PGForm\\Services\\Views\\Fields\\BasicFieldView',
'shared' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setViewHandler',
'arguments' =>
array (
0 => '@handler.view',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'view',
),
),
'abstract' => false,
'extends' => 'view.basic',
),
'view.field.bool.checkbox' =>
array (
'class' => 'PGI\\Impact\\PGForm\\Services\\Views\\Fields\\BoolCheckboxFieldView',
'shared' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setViewHandler',
'arguments' =>
array (
0 => '@handler.view',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'view',
),
),
'abstract' => false,
'extends' => 'view.basic',
),
'view.field.choice.expanded' =>
array (
'class' => 'PGI\\Impact\\PGForm\\Services\\Views\\Fields\\ChoiceExpandedFieldView',
'shared' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setViewHandler',
'arguments' =>
array (
0 => '@handler.view',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'view',
),
),
'abstract' => false,
'extends' => 'view.field.choice.abstract',
'arguments' =>
array (
0 => '@handler.select',
1 => '@translator',
2 => '@logger',
),
),
'view.field.choice.contracted' =>
array (
'class' => 'PGI\\Impact\\PGForm\\Services\\Views\\Fields\\ChoiceContractedFieldView',
'shared' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setViewHandler',
'arguments' =>
array (
0 => '@handler.view',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'view',
),
),
'abstract' => false,
'extends' => 'view.field.choice.abstract',
'arguments' =>
array (
0 => '@handler.select',
1 => '@translator',
2 => '@logger',
),
),
'view.field.picture' =>
array (
'class' => 'PGI\\Impact\\PGForm\\Services\\Views\\Fields\\PictureFieldView',
'shared' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setViewHandler',
'arguments' =>
array (
0 => '@handler.view',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'view',
),
),
'abstract' => false,
'extends' => 'view.basic',
),
'view.field.object' =>
array (
'class' => 'PGI\\Impact\\PGForm\\Services\\Views\\Fields\\CompositeFieldView',
'shared' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setViewHandler',
'arguments' =>
array (
0 => '@handler.view',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'view',
),
),
'abstract' => false,
'extends' => 'view.basic',
),
'view.field.collection' =>
array (
'class' => 'PGI\\Impact\\PGForm\\Services\\Views\\Fields\\CollectionFieldView',
'shared' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setViewHandler',
'arguments' =>
array (
0 => '@handler.view',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'view',
),
),
'abstract' => false,
'extends' => 'view.basic',
),
'view.field.choice.double.bool' =>
array (
'class' => 'PGI\\Impact\\PGForm\\Services\\Views\\Fields\\DoubleChoiceBooleanFieldView',
'shared' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setViewHandler',
'arguments' =>
array (
0 => '@handler.view',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'view',
),
),
'abstract' => false,
'extends' => 'view.field.choice.abstract',
'arguments' =>
array (
0 => '@handler.select',
1 => '@translator',
2 => '@logger',
),
),
'view.field.choice.filtered' =>
array (
'class' => 'PGFormServicesViewsFieldChoiceFilteredView',
'shared' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setViewHandler',
'arguments' =>
array (
0 => '@handler.view',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'view',
),
),
'abstract' => false,
'extends' => 'view.field.choice.abstract',
'arguments' =>
array (
0 => '@handler.select',
1 => '@translator',
2 => '@logger',
),
),
'view.field.colorpicker' =>
array (
'class' => 'PGFormServicesViewsFieldColorPickerView',
'shared' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setViewHandler',
'arguments' =>
array (
0 => '@handler.view',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'view',
),
),
'abstract' => false,
'extends' => 'view.basic',
),
'formatter.string' =>
array (
'abstract' => false,
'shared' => false,
'tags' =>
array (
0 =>
array (
'name' => 'formatter',
),
),
'extends' => 'formatter.abstract',
'class' => 'PGI\\Impact\\PGForm\\Services\\Formatters\\StringFormatter',
),
'formatter.int' =>
array (
'abstract' => false,
'shared' => false,
'tags' =>
array (
0 =>
array (
'name' => 'formatter',
),
),
'extends' => 'formatter.abstract',
'class' => 'PGI\\Impact\\PGForm\\Services\\Formatters\\IntegerFormatter',
),
'formatter.float' =>
array (
'abstract' => false,
'shared' => false,
'tags' =>
array (
0 =>
array (
'name' => 'formatter',
),
),
'extends' => 'formatter.abstract',
'class' => 'PGI\\Impact\\PGForm\\Services\\Formatters\\FloatFormatter',
),
'formatter.array' =>
array (
'abstract' => false,
'shared' => false,
'tags' =>
array (
0 =>
array (
'name' => 'formatter',
),
),
'extends' => 'formatter.abstract',
'class' => 'PGI\\Impact\\PGForm\\Services\\Formatters\\ArrayFormatter',
),
'formatter.object' =>
array (
'abstract' => false,
'shared' => false,
'tags' =>
array (
0 =>
array (
'name' => 'formatter',
),
),
'extends' => 'formatter.abstract',
'class' => 'PGI\\Impact\\PGForm\\Services\\Formatters\\ObjectFormatter',
),
'formatter.bool' =>
array (
'abstract' => false,
'shared' => false,
'tags' =>
array (
0 =>
array (
'name' => 'formatter',
),
),
'extends' => 'formatter.abstract',
'class' => 'PGI\\Impact\\PGForm\\Services\\Formatters\\BooleanFormatter',
),
'validator.length.min' =>
array (
'abstract' => false,
'shared' => false,
'tags' =>
array (
0 =>
array (
'name' => 'validator',
),
),
'extends' => 'validator.abstract',
'class' => 'PGI\\Impact\\PGForm\\Services\\Validators\\LengthMinValidator',
),
'validator.length.max' =>
array (
'abstract' => false,
'shared' => false,
'tags' =>
array (
0 =>
array (
'name' => 'validator',
),
),
'extends' => 'validator.abstract',
'class' => 'PGI\\Impact\\PGForm\\Services\\Validators\\LengthMaxValidator',
),
'validator.regexp' =>
array (
'abstract' => false,
'shared' => false,
'tags' =>
array (
0 =>
array (
'name' => 'validator',
),
),
'extends' => 'validator.abstract',
'class' => 'PGI\\Impact\\PGForm\\Services\\Validators\\RegexpValidator',
),
'validator.array.in' =>
array (
'abstract' => false,
'shared' => false,
'tags' =>
array (
0 =>
array (
'name' => 'validator',
),
),
'extends' => 'validator.abstract',
'class' => 'PGI\\Impact\\PGForm\\Services\\Validators\\ArrayInValidator',
'arguments' =>
array (
0 => '@handler.select',
),
),
'validator.not_empty' =>
array (
'abstract' => false,
'shared' => false,
'tags' =>
array (
0 =>
array (
'name' => 'validator',
),
),
'extends' => 'validator.abstract',
'class' => 'PGI\\Impact\\PGForm\\Services\\Validators\\NotEmptyValidator',
),
'validator.range' =>
array (
'abstract' => false,
'shared' => false,
'tags' =>
array (
0 =>
array (
'name' => 'validator',
),
),
'extends' => 'validator.abstract',
'class' => 'PGI\\Impact\\PGForm\\Services\\Validators\\RangeValidator',
),
'builder.form' =>
array (
'class' => 'PGI\\Impact\\PGForm\\Services\\Builders\\FormBuilder',
'arguments' =>
array (
0 => '@builder.field',
1 => '@logger',
2 => '@aggregator.view',
3 => '%form',
),
),
'builder.field' =>
array (
'class' => 'PGI\\Impact\\PGForm\\Services\\Builders\\FieldBuilder',
'arguments' =>
array (
0 => '@container',
1 => '@builder.validator',
2 => '@aggregator.formatter',
3 => '@handler.behavior',
4 => '@aggregator.view',
5 => '@logger',
6 => '%fields',
7 => '@handler.requirement',
),
),
'builder.validator' =>
array (
'class' => 'PGI\\Impact\\PGForm\\Services\\Builders\\ValidatorBuilder',
'arguments' =>
array (
0 => '@aggregator.validator',
),
),
'aggregator.formatter' =>
array (
'abstract' => false,
'class' => 'PGI\\Impact\\PGFramework\\Components\\Aggregator',
'arguments' =>
array (
0 => '@container',
),
'extends' => 'aggregator.abstract',
'config' =>
array (
'type' => 'formatter',
'interface' => 'PGI\\Impact\\PGForm\\Interfaces\\FormatterInterface',
),
'catch' => 'formatter',
),
'aggregator.validator' =>
array (
'abstract' => false,
'class' => 'PGI\\Impact\\PGFramework\\Components\\Aggregator',
'arguments' =>
array (
0 => '@container',
),
'extends' => 'aggregator.abstract',
'config' =>
array (
'type' => 'validator',
'interface' => 'PGI\\Impact\\PGForm\\Interfaces\\ValidatorInterface',
),
'catch' => 'validator',
),
'log.writer.api' =>
array (
'abstract' => false,
'tags' =>
array (
0 =>
array (
'name' => 'log.writer',
),
1 =>
array (
'name' => 'log.writer.file',
),
),
'extends' => 'log.writer.file.abstract',
'class' => 'PGI\\Impact\\PGLog\\Services\\LogWriters\\FileLogWriter',
'arguments' =>
array (
0 => '@dumper',
1 => '@pathfinder',
),
'config' => '%log.outputs.api.config',
),
'officer.post_payment' =>
array (
'class' => 'PGI\\Impact\\PGWooCommerce\\Services\\Officers\\PostPaymentOfficer',
),
'officer.cart' =>
array (
'class' => 'PGI\\Impact\\PGWooCommerce\\Services\\Officers\\CartOfficer',
'arguments' =>
array (
0 => '@officer.product_variation',
1 => '@logger',
),
),
'upgrade.database.shopified' =>
array (
'abstract' => false,
'tags' =>
array (
0 =>
array (
'name' => 'upgrade',
),
),
'class' => 'PGI\\Impact\\PGShop\\Services\\Upgrades\\DatabaseShopifiedUpgrade',
'extends' => 'upgrade.abstract',
'arguments' =>
array (
0 => '@handler.database',
1 => '@handler.shop',
),
),
'factory.order_state_machine' =>
array (
'class' => 'PGI\\Impact\\PGShop\\Services\\Factories\\OrderStateMachineFactory',
'arguments' =>
array (
0 => '%order.machines',
),
),
'mapper.order_state' =>
array (
'class' => 'PGI\\Impact\\PGShop\\Services\\Mappers\\OrderStateMapper',
'arguments' =>
array (
0 => '%order.states',
),
'catch' =>
array (
'tag' => 'mapper.strategy.order_state',
'method' => 'addMapperStrategy',
'built' => true,
),
),
'strategy.order_state_mapper.settings' =>
array (
'class' => 'PGI\\Impact\\PGShop\\Services\\OrderStateMappingStrategies\\SettingsOrderStateMappingStrategy',
'arguments' =>
array (
0 => '@settings',
),
'calls' =>
array (
0 =>
array (
'method' => 'setOrderStateManager',
'arguments' =>
array (
0 => '@manager.order_state',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'mapper.strategy.order_state',
'options' =>
array (
0 => 'settings',
),
),
),
),
'selector.category.hierarchized' =>
array (
'arguments' =>
array (
0 => '@logger',
),
'abstract' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setTranslator',
'arguments' =>
array (
0 => '@translator',
),
),
1 =>
array (
'method' => 'setCategoryManager',
'arguments' =>
array (
0 => '@manager.category',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'selector',
),
),
'extends' => 'selector.abstract',
'class' => 'PGI\\Impact\\PGShop\\Services\\Selectors\\HierarchizedCategorySelector',
),
'handler.shop' =>
array (
'class' => 'PGI\\Impact\\PGShop\\Services\\Handlers\\ShopHandler',
'arguments' =>
array (
0 => '@logger',
),
'calls' =>
array (
0 =>
array (
'method' => 'setShopManager',
'arguments' =>
array (
0 => '@manager.shop',
),
),
1 =>
array (
'method' => 'setSessionHandler',
'arguments' =>
array (
0 => '@handler.session',
),
),
2 =>
array (
'method' => 'setShopOfficer',
'arguments' =>
array (
0 => '@officer.shop',
),
),
),
),
'repository.shop' =>
array (
'class' => 'PGI\\Impact\\PGWooCommerce\\Services\\Repositories\\ShopRepository',
'arguments' =>
array (
0 => '@handler.shop',
),
),
'repository.cart' =>
array (
'class' => 'PGI\\Impact\\PGWooCommerce\\Services\\Repositories\\CartRepository',
),
'repository.order' =>
array (
'class' => 'PGI\\Impact\\PGWooCommerce\\Services\\Repositories\\OrderRepository',
),
'repository.customer' =>
array (
'class' => 'PGI\\Impact\\PGWooCommerce\\Services\\Repositories\\CustomerRepository',
),
'repository.address' =>
array (
),
'repository.product' =>
array (
'class' => 'PGI\\Impact\\PGWooCommerce\\Services\\Repositories\\ProductRepository',
),
'repository.cart_item' =>
array (
),
'repository.category' =>
array (
'class' => 'PGI\\Impact\\PGWooCommerce\\Services\\Repositories\\CategoryRepository',
),
'repository.order_state' =>
array (
'class' => 'PGI\\Impact\\PGWooCommerce\\Services\\Repositories\\OrderStateRepository',
),
'manager.shop' =>
array (
'class' => 'PGI\\Impact\\PGShop\\Services\\Managers\\ShopManager',
'arguments' =>
array (
0 => '@repository.shop',
),
),
'manager.cart' =>
array (
'class' => 'PGI\\Impact\\PGShop\\Services\\Managers\\CartManager',
'arguments' =>
array (
0 => '@repository.cart',
),
'calls' =>
array (
0 =>
array (
'method' => 'setCartOfficer',
'arguments' =>
array (
0 => '@officer.cart',
),
),
),
),
'manager.order' =>
array (
'class' => 'PGI\\Impact\\PGShop\\Services\\Managers\\OrderManager',
'arguments' =>
array (
0 => '@repository.order',
),
'calls' =>
array (
0 =>
array (
'method' => 'setOrderStateMapper',
'arguments' =>
array (
0 => '@mapper.order_state',
),
),
1 =>
array (
'method' => 'setBroadcaster',
'arguments' =>
array (
0 => '@broadcaster',
),
),
2 =>
array (
'method' => 'setLogger',
'arguments' =>
array (
0 => '@logger',
),
),
),
),
'manager.customer' =>
array (
'class' => 'PGI\\Impact\\PGShop\\Services\\Managers\\CustomerManager',
'arguments' =>
array (
0 => '@repository.customer',
),
),
'manager.address' =>
array (
'class' => 'PGI\\Impact\\PGShop\\Services\\Managers\\AddressManager',
'arguments' =>
array (
0 => '@repository.address',
),
),
'manager.product' =>
array (
'class' => 'PGI\\Impact\\PGShop\\Services\\Managers\\ProductManager',
'arguments' =>
array (
0 => '@repository.product',
),
),
'manager.category' =>
array (
'class' => 'PGI\\Impact\\PGShop\\Services\\Managers\\CategoryManager',
'arguments' =>
array (
0 => '@repository.category',
),
'calls' =>
array (
0 =>
array (
'method' => 'setShopHandler',
'arguments' =>
array (
0 => '@handler.shop',
),
),
),
),
'manager.order_state' =>
array (
'class' => 'PGI\\Impact\\PGShop\\Services\\Managers\\OrderStateManager',
'arguments' =>
array (
0 => '@repository.order_state',
1 => '@factory.order_state_machine',
2 => '@mapper.order_state',
),
),
'scheduler' =>
array (
'abstract' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setLogger',
'arguments' =>
array (
0 => '@logger',
),
),
),
'extends' => 'service.abstract',
'class' => 'PGI\\Impact\\PGCron\\Services\\Scheduler',
'arguments' =>
array (
0 => '@aggregator.cron.tab',
1 => '@builder.cron.task',
),
),
'selector.cron_activation_mode' =>
array (
'arguments' =>
array (
0 => '@logger',
1 => '%data.cron_activation_mode',
),
'abstract' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setTranslator',
'arguments' =>
array (
0 => '@translator',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'selector',
),
),
'extends' => 'selector.abstract',
'class' => 'PGI\\Impact\\PGFramework\\Services\\Selectors\\StaticArraySelector',
),
'listener.cron.tabs.pre_filling' =>
array (
'class' => 'PGI\\Impact\\PGCron\\Services\\Listeners\\PreFillingCronTabsListener',
'arguments' =>
array (
0 => '@aggregator.cron.tab',
1 => '@logger',
),
),
'listener.cron.tabs.cleaning' =>
array (
'class' => 'PGI\\Impact\\PGCron\\Services\\Listeners\\CleaningCronTabsListener',
'arguments' =>
array (
0 => '@aggregator.cron.tab',
1 => '@logger',
),
),
'factory.cron.tab' =>
array (
'class' => 'PGI\\Impact\\PGCron\\Services\\Factories\\CronTabFactory',
'arguments' =>
array (
0 => '%tasks',
),
),
'builder.cron.task' =>
array (
'class' => 'PGI\\Impact\\PGCron\\Services\\Builders\\CronTaskBuilder',
'arguments' =>
array (
0 => '@aggregator.cron.task',
1 => '@parser',
),
'config' =>
array (
'tasks' => '%tasks',
),
),
'aggregator.cron.tab' =>
array (
'abstract' => false,
'class' => 'PGI\\Impact\\PGFramework\\Components\\Aggregator',
'arguments' =>
array (
0 => '@container',
),
'extends' => 'aggregator.abstract',
'config' =>
array (
'type' => 'cron.tab',
'interface' => 'PGI\\Impact\\PGCron\\Interfaces\\CronTabInterface',
),
'catch' => 'cron.tab',
),
'aggregator.cron.task' =>
array (
'abstract' => false,
'class' => 'PGI\\Impact\\PGFramework\\Components\\Aggregator',
'arguments' =>
array (
0 => '@container',
),
'extends' => 'aggregator.abstract',
'config' =>
array (
'type' => 'cron.task',
'interface' => 'PGI\\Impact\\PGCron\\Interfaces\\CronTaskInterface',
),
'catch' => 'cron.task',
),
'handler.log.file' =>
array (
'abstract' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setLogger',
'arguments' =>
array (
0 => '@logger',
),
),
),
'extends' => 'service.abstract',
'class' => 'PGI\\Impact\\PGLog\\Services\\Handlers\\LogFileHandler',
'arguments' =>
array (
0 => '@aggregator.log.writer.file',
1 => '@pathfinder',
),
'config' => '%log.archive.file',
),
'cron.task.log.cleaning' =>
array (
'abstract' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setLogger',
'arguments' =>
array (
0 => '@logger',
),
),
),
'extends' => 'cron.task.abstract',
'shared' => false,
'tags' =>
array (
0 =>
array (
'name' => 'cron.task',
),
),
'class' => 'PGI\\Impact\\PGLog\\Services\\CronTasks\\LogFileCleanerCronTask',
'arguments' =>
array (
0 => '@handler.log.file',
),
),
'cron.task.log.zipping' =>
array (
'abstract' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setLogger',
'arguments' =>
array (
0 => '@logger',
),
),
),
'extends' => 'cron.task.abstract',
'shared' => false,
'tags' =>
array (
0 =>
array (
'name' => 'cron.task',
),
),
'class' => 'PGI\\Impact\\PGLog\\Services\\CronTasks\\LogFileZipperCronTask',
'arguments' =>
array (
0 => '@handler.log.file',
),
),
'log.writer.default' =>
array (
'abstract' => false,
'tags' =>
array (
0 =>
array (
'name' => 'log.writer',
),
1 =>
array (
'name' => 'log.writer.file',
),
),
'extends' => 'log.writer.file.abstract',
'class' => 'PGI\\Impact\\PGLog\\Services\\LogWriters\\FileLogWriter',
'arguments' =>
array (
0 => '@dumper',
1 => '@pathfinder',
),
'config' => '%log.outputs.default.config',
),
'aggregator.log.writer.file' =>
array (
'abstract' => false,
'class' => 'PGI\\Impact\\PGFramework\\Components\\Aggregator',
'arguments' =>
array (
0 => '@container',
),
'extends' => 'aggregator.abstract',
'config' =>
array (
'type' => 'log.writer',
'interface' => 'PGI\\Impact\\PGLog\\Interfaces\\LogWriterFileInterface',
),
'catch' => 'log.writer.file',
),
'view.menu' =>
array (
'class' => 'PGI\\Impact\\BOModule\\Services\\Views\\MenuView',
'shared' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setViewHandler',
'arguments' =>
array (
0 => '@handler.view',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'view',
),
),
'abstract' => false,
'extends' => 'view.basic',
'arguments' =>
array (
0 => '@handler.menu',
1 => '@manager.shop',
2 => '@handler.shop',
3 => '@parameters',
),
),
'view.notifications' =>
array (
'class' => 'PGI\\Impact\\BOModule\\Services\\Views\\NotificationsView',
'shared' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setViewHandler',
'arguments' =>
array (
0 => '@handler.view',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'view',
),
),
'abstract' => false,
'extends' => 'view.basic',
'arguments' =>
array (
0 => '@notifier',
),
),
'view.system.paths' =>
array (
'class' => 'PGI\\Impact\\BOModule\\Services\\Views\\SystemPathsView',
'shared' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setViewHandler',
'arguments' =>
array (
0 => '@handler.view',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'view',
),
),
'abstract' => false,
'extends' => 'view.basic',
'arguments' =>
array (
0 => '@pathfinder',
),
),
'view.block.diagnostics' =>
array (
'class' => 'PGI\\Impact\\BOModule\\Services\\Views\\Blocks\\DiagnosticBlockView',
'shared' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setViewHandler',
'arguments' =>
array (
0 => '@handler.view',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'view',
),
),
'abstract' => false,
'extends' => 'view.basic',
'arguments' =>
array (
0 => '@handler.diagnostic',
),
),
'view.block.logs' =>
array (
'class' => 'PGI\\Impact\\BOModule\\Services\\Views\\Blocks\\LogBlockView',
'shared' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setViewHandler',
'arguments' =>
array (
0 => '@handler.view',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'view',
),
),
'abstract' => false,
'extends' => 'view.basic',
'arguments' =>
array (
0 => '@pathfinder',
),
),
'view.block.server' =>
array (
'class' => 'PGI\\Impact\\BOModule\\Services\\Views\\Blocks\\ServerBlockView',
'shared' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setViewHandler',
'arguments' =>
array (
0 => '@handler.view',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'view',
),
),
'abstract' => false,
'extends' => 'view.basic',
'arguments' =>
array (
0 => '@handler.server',
),
),
'view.block.standardized.config_form' =>
array (
'class' => 'PGI\\Impact\\BOModule\\Services\\Views\\Blocks\\StandardizedConfigurationFormBlockView',
'shared' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setViewHandler',
'arguments' =>
array (
0 => '@handler.view',
),
),
1 =>
array (
'method' => 'setFormBuilder',
'arguments' =>
array (
0 => '@builder.form',
),
),
2 =>
array (
'method' => 'setSettings',
'arguments' =>
array (
0 => '@settings',
),
),
3 =>
array (
'method' => 'setParameters',
'arguments' =>
array (
0 => '@parameters',
),
),
4 =>
array (
'method' => 'setLinkHandler',
'arguments' =>
array (
0 => '@handler.link',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'view',
),
),
'abstract' => false,
'extends' => 'view.basic',
),
'plugin.smarty.bool' =>
array (
'class' => 'PGI\\Impact\\BOModule\\Services\\Plugins\\SmartyBoolPlugin',
'arguments' =>
array (
0 => '@translator',
),
'tags' =>
array (
0 =>
array (
'name' => 'plugin.smarty',
'options' =>
array (
0 => 'pgbool',
1 => 'writeBoolean',
),
),
),
),
'builder.request.backoffice' =>
array (
'class' => 'PGI\\Impact\\PGWordPress\\Services\\Builders\\RequestBuilder',
'arguments' =>
array (
0 => '@superglobal.get',
1 => '@superglobal.post',
2 => '%request_builder.backoffice',
),
),
'server.backoffice' =>
array (
'abstract' => false,
'class' => 'PGI\\Impact\\PGServer\\Services\\Server',
'arguments' =>
array (
0 => '@router',
1 => '@derouter',
2 => '@dispatcher',
3 => '@logger',
4 => '@factory.stage',
5 => '%servers.backoffice',
),
'extends' => 'server.abstract',
),
'cleaner.forward.message_page' =>
array (
'class' => 'PGI\\Impact\\PGServer\\Services\\Cleaners\\ForwardCleaner',
'arguments' =>
array (
0 => 'displayException@backoffice.error',
),
),
'builder.translation_form' =>
array (
'class' => 'PGI\\Impact\\PGIntl\\Services\\Builders\\TranslationFormBuilder',
'arguments' =>
array (
0 => '@builder.form',
1 => '@builder.field',
2 => '%translations',
),
),
'listener.action.shop_context_backoffice' =>
array (
'class' => 'PGI\\Impact\\BOModule\\Services\\Listeners\\ShopContextBackofficeListener',
'arguments' =>
array (
0 => '@notifier',
1 => '@handler.shop',
),
),
'listener.action.display_support_page' =>
array (
'class' => 'PGI\\Impact\\BOModule\\Services\\Listeners\\DisplaySupportPageBackofficeListener',
'arguments' =>
array (
0 => '@notifier',
1 => '@handler.shop',
),
),
'builder.output.back_office_paygreen' =>
array (
'abstract' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setViewHandler',
'arguments' =>
array (
0 => '@handler.view',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'builder.output',
),
),
'extends' => 'builder.output.abstract',
'class' => 'PGI\\Impact\\BOModule\\Services\\OutputBuilders\\BackOfficeOutputBuilder',
'arguments' =>
array (
0 => '@server.backoffice',
1 => '@handler.output',
2 => '@handler.menu',
3 => '@logger',
4 => '@handler.static_file',
5 => '@parameters',
),
),
'controller.backoffice.shop' =>
array (
'abstract' => false,
'shared' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setLogger',
'arguments' =>
array (
0 => '@logger',
),
),
1 =>
array (
'method' => 'setNotifier',
'arguments' =>
array (
0 => '@notifier',
),
),
2 =>
array (
'method' => 'setLinkHandler',
'arguments' =>
array (
0 => '@handler.link',
),
),
3 =>
array (
'method' => 'setSettings',
'arguments' =>
array (
0 => '@settings',
),
),
4 =>
array (
'method' => 'setParameters',
'arguments' =>
array (
0 => '@parameters',
),
),
5 =>
array (
'method' => 'setFormBuilder',
'arguments' =>
array (
0 => '@builder.form',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'controller',
),
),
'extends' => 'controller.abstract',
'class' => 'PGI\\Impact\\BOModule\\Services\\Controllers\\ShopController',
'arguments' =>
array (
0 => '@handler.shop',
1 => '@manager.shop',
2 => '@handler.menu',
),
),
'controller.backoffice.error' =>
array (
'abstract' => false,
'shared' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setLogger',
'arguments' =>
array (
0 => '@logger',
),
),
1 =>
array (
'method' => 'setNotifier',
'arguments' =>
array (
0 => '@notifier',
),
),
2 =>
array (
'method' => 'setLinkHandler',
'arguments' =>
array (
0 => '@handler.link',
),
),
3 =>
array (
'method' => 'setSettings',
'arguments' =>
array (
0 => '@settings',
),
),
4 =>
array (
'method' => 'setParameters',
'arguments' =>
array (
0 => '@parameters',
),
),
5 =>
array (
'method' => 'setFormBuilder',
'arguments' =>
array (
0 => '@builder.form',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'controller',
),
),
'extends' => 'controller.abstract',
'class' => 'PGI\\Impact\\BOModule\\Services\\Controllers\\ErrorController',
),
'controller.backoffice.diagnostic' =>
array (
'abstract' => false,
'shared' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setLogger',
'arguments' =>
array (
0 => '@logger',
),
),
1 =>
array (
'method' => 'setNotifier',
'arguments' =>
array (
0 => '@notifier',
),
),
2 =>
array (
'method' => 'setLinkHandler',
'arguments' =>
array (
0 => '@handler.link',
),
),
3 =>
array (
'method' => 'setSettings',
'arguments' =>
array (
0 => '@settings',
),
),
4 =>
array (
'method' => 'setParameters',
'arguments' =>
array (
0 => '@parameters',
),
),
5 =>
array (
'method' => 'setFormBuilder',
'arguments' =>
array (
0 => '@builder.form',
),
),
6 =>
array (
'method' => 'setDiagnosticHandler',
'arguments' =>
array (
0 => '@handler.diagnostic',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'controller',
),
),
'extends' => 'controller.abstract',
'class' => 'PGI\\Impact\\BOModule\\Services\\Controllers\\DiagnosticController',
),
'controller.backoffice.logs' =>
array (
'abstract' => false,
'shared' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setLogger',
'arguments' =>
array (
0 => '@logger',
),
),
1 =>
array (
'method' => 'setNotifier',
'arguments' =>
array (
0 => '@notifier',
),
),
2 =>
array (
'method' => 'setLinkHandler',
'arguments' =>
array (
0 => '@handler.link',
),
),
3 =>
array (
'method' => 'setSettings',
'arguments' =>
array (
0 => '@settings',
),
),
4 =>
array (
'method' => 'setParameters',
'arguments' =>
array (
0 => '@parameters',
),
),
5 =>
array (
'method' => 'setFormBuilder',
'arguments' =>
array (
0 => '@builder.form',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'controller',
),
),
'extends' => 'controller.abstract',
'class' => 'PGI\\Impact\\BOModule\\Services\\Controllers\\LogsController',
'arguments' =>
array (
0 => '@pathfinder',
),
),
'controller.backoffice.system' =>
array (
'abstract' => false,
'shared' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setLogger',
'arguments' =>
array (
0 => '@logger',
),
),
1 =>
array (
'method' => 'setNotifier',
'arguments' =>
array (
0 => '@notifier',
),
),
2 =>
array (
'method' => 'setLinkHandler',
'arguments' =>
array (
0 => '@handler.link',
),
),
3 =>
array (
'method' => 'setSettings',
'arguments' =>
array (
0 => '@settings',
),
),
4 =>
array (
'method' => 'setParameters',
'arguments' =>
array (
0 => '@parameters',
),
),
5 =>
array (
'method' => 'setFormBuilder',
'arguments' =>
array (
0 => '@builder.form',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'controller',
),
),
'extends' => 'controller.abstract',
'class' => 'PGI\\Impact\\BOModule\\Services\\Controllers\\SystemController',
'arguments' =>
array (
0 => '@facade.application',
1 => '@kernel',
),
),
'controller.backoffice.release_note' =>
array (
'abstract' => false,
'shared' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setLogger',
'arguments' =>
array (
0 => '@logger',
),
),
1 =>
array (
'method' => 'setNotifier',
'arguments' =>
array (
0 => '@notifier',
),
),
2 =>
array (
'method' => 'setLinkHandler',
'arguments' =>
array (
0 => '@handler.link',
),
),
3 =>
array (
'method' => 'setSettings',
'arguments' =>
array (
0 => '@settings',
),
),
4 =>
array (
'method' => 'setParameters',
'arguments' =>
array (
0 => '@parameters',
),
),
5 =>
array (
'method' => 'setFormBuilder',
'arguments' =>
array (
0 => '@builder.form',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'controller',
),
),
'extends' => 'controller.abstract',
'class' => 'PGI\\Impact\\BOModule\\Services\\Controllers\\ReleaseNoteController',
'arguments' =>
array (
0 => '@pathfinder',
1 => '@logger',
),
),
'controller.backoffice.cache' =>
array (
'abstract' => false,
'shared' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setLogger',
'arguments' =>
array (
0 => '@logger',
),
),
1 =>
array (
'method' => 'setNotifier',
'arguments' =>
array (
0 => '@notifier',
),
),
2 =>
array (
'method' => 'setLinkHandler',
'arguments' =>
array (
0 => '@handler.link',
),
),
3 =>
array (
'method' => 'setSettings',
'arguments' =>
array (
0 => '@settings',
),
),
4 =>
array (
'method' => 'setParameters',
'arguments' =>
array (
0 => '@parameters',
),
),
5 =>
array (
'method' => 'setFormBuilder',
'arguments' =>
array (
0 => '@builder.form',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'controller',
),
),
'extends' => 'controller.abstract',
'class' => 'PGI\\Impact\\BOModule\\Services\\Controllers\\CacheController',
'arguments' =>
array (
0 => '@handler.cache',
),
),
'controller.backoffice.cron' =>
array (
'abstract' => false,
'shared' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setLogger',
'arguments' =>
array (
0 => '@logger',
),
),
1 =>
array (
'method' => 'setNotifier',
'arguments' =>
array (
0 => '@notifier',
),
),
2 =>
array (
'method' => 'setLinkHandler',
'arguments' =>
array (
0 => '@handler.link',
),
),
3 =>
array (
'method' => 'setSettings',
'arguments' =>
array (
0 => '@settings',
),
),
4 =>
array (
'method' => 'setParameters',
'arguments' =>
array (
0 => '@parameters',
),
),
5 =>
array (
'method' => 'setFormBuilder',
'arguments' =>
array (
0 => '@builder.form',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'controller',
),
),
'extends' => 'controller.abstract',
'class' => 'PGI\\Impact\\BOModule\\Services\\Controllers\\CronController',
'arguments' =>
array (
0 => '@scheduler',
),
),
'handler.menu' =>
array (
'class' => 'PGI\\Impact\\BOModule\\Services\\Handlers\\MenuHandler',
'arguments' =>
array (
0 => '@handler.route',
1 => '@handler.link',
2 => '%menu',
),
),
'handler.server' =>
array (
'class' => 'PGI\\Impact\\BOModule\\Services\\Handlers\\ServerHandler',
'arguments' =>
array (
0 => '@settings',
),
'calls' =>
array (
0 =>
array (
'method' => 'addServer',
'arguments' =>
array (
0 => 'ClimateKit',
1 => 'tree_api_server',
),
),
1 =>
array (
'method' => 'addServer',
'arguments' =>
array (
0 => 'CharityKit',
1 => 'charity_api_server',
),
),
),
),
'deflector.filter.shop_context' =>
array (
'abstract' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setNotifier',
'arguments' =>
array (
0 => '@notifier',
),
),
1 =>
array (
'method' => 'setLogger',
'arguments' =>
array (
0 => '@logger',
),
),
2 =>
array (
'method' => 'setLinkHandler',
'arguments' =>
array (
0 => '@handler.link',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'deflector',
),
),
'extends' => 'deflector.abstract',
'class' => 'PGI\\Impact\\BOModule\\Services\\Deflectors\\ShopContext',
'arguments' =>
array (
0 => '@handler.route',
),
),
'action.support_configuration.save' =>
array (
'abstract' => false,
'shared' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setLogger',
'arguments' =>
array (
0 => '@logger',
),
),
1 =>
array (
'method' => 'setNotifier',
'arguments' =>
array (
0 => '@notifier',
),
),
2 =>
array (
'method' => 'setLinkHandler',
'arguments' =>
array (
0 => '@handler.link',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'action',
),
),
'extends' => 'action.standardized_save_settings.abstract',
'class' => 'PGI\\Impact\\BOModule\\Services\\Actions\\StandardizedSaveSettingsAction',
'arguments' =>
array (
0 => '@builder.form',
1 => '@settings',
),
'config' =>
array (
'form_name' => 'settings_support',
'redirection' => 'backoffice.support.display',
),
),
'action.home.display' =>
array (
'abstract' => false,
'shared' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setLogger',
'arguments' =>
array (
0 => '@logger',
),
),
1 =>
array (
'method' => 'setNotifier',
'arguments' =>
array (
0 => '@notifier',
),
),
2 =>
array (
'method' => 'setLinkHandler',
'arguments' =>
array (
0 => '@handler.link',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'action',
),
),
'extends' => 'action.standardized_display_page.abstract',
'class' => 'PGI\\Impact\\BOModule\\Services\\Actions\\StandardizedDisplayPageAction',
'arguments' =>
array (
0 => '@handler.block',
),
'config' =>
array (
'page_name' => 'home',
),
),
'action.support.display' =>
array (
'abstract' => false,
'shared' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setLogger',
'arguments' =>
array (
0 => '@logger',
),
),
1 =>
array (
'method' => 'setNotifier',
'arguments' =>
array (
0 => '@notifier',
),
),
2 =>
array (
'method' => 'setLinkHandler',
'arguments' =>
array (
0 => '@handler.link',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'action',
),
),
'extends' => 'action.standardized_display_page.abstract',
'class' => 'PGI\\Impact\\BOModule\\Services\\Actions\\StandardizedDisplayPageAction',
'arguments' =>
array (
0 => '@handler.block',
),
'config' =>
array (
'page_name' => 'support',
'static' =>
array (
'js' =>
array (
0 => '/js/page-support.js',
),
),
),
),
'action.release_note.display' =>
array (
'abstract' => false,
'shared' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setLogger',
'arguments' =>
array (
0 => '@logger',
),
),
1 =>
array (
'method' => 'setNotifier',
'arguments' =>
array (
0 => '@notifier',
),
),
2 =>
array (
'method' => 'setLinkHandler',
'arguments' =>
array (
0 => '@handler.link',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'action',
),
),
'extends' => 'action.standardized_display_page.abstract',
'class' => 'PGI\\Impact\\BOModule\\Services\\Actions\\StandardizedDisplayPageAction',
'arguments' =>
array (
0 => '@handler.block',
),
'config' =>
array (
'page_name' => 'release_note',
),
),
'action.system.display' =>
array (
'abstract' => false,
'shared' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setLogger',
'arguments' =>
array (
0 => '@logger',
),
),
1 =>
array (
'method' => 'setNotifier',
'arguments' =>
array (
0 => '@notifier',
),
),
2 =>
array (
'method' => 'setLinkHandler',
'arguments' =>
array (
0 => '@handler.link',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'action',
),
),
'extends' => 'action.standardized_display_page.abstract',
'class' => 'PGI\\Impact\\BOModule\\Services\\Actions\\StandardizedDisplayPageAction',
'arguments' =>
array (
0 => '@handler.block',
),
'config' =>
array (
'page_name' => 'system',
),
),
'action.products.display' =>
array (
'abstract' => false,
'shared' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setLogger',
'arguments' =>
array (
0 => '@logger',
),
),
1 =>
array (
'method' => 'setNotifier',
'arguments' =>
array (
0 => '@notifier',
),
),
2 =>
array (
'method' => 'setLinkHandler',
'arguments' =>
array (
0 => '@handler.link',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'action',
),
),
'extends' => 'action.standardized_display_page.abstract',
'class' => 'PGI\\Impact\\BOModule\\Services\\Actions\\StandardizedDisplayPageAction',
'arguments' =>
array (
0 => '@handler.block',
),
'config' =>
array (
'page_name' => 'products',
),
),
'action.cron.display' =>
array (
'abstract' => false,
'shared' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setLogger',
'arguments' =>
array (
0 => '@logger',
),
),
1 =>
array (
'method' => 'setNotifier',
'arguments' =>
array (
0 => '@notifier',
),
),
2 =>
array (
'method' => 'setLinkHandler',
'arguments' =>
array (
0 => '@handler.link',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'action',
),
),
'extends' => 'action.standardized_display_page.abstract',
'class' => 'PGI\\Impact\\BOModule\\Services\\Actions\\StandardizedDisplayPageAction',
'arguments' =>
array (
0 => '@handler.block',
),
'config' =>
array (
'page_name' => 'cron',
),
),
'action.cron_configuration.save' =>
array (
'abstract' => false,
'shared' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setLogger',
'arguments' =>
array (
0 => '@logger',
),
),
1 =>
array (
'method' => 'setNotifier',
'arguments' =>
array (
0 => '@notifier',
),
),
2 =>
array (
'method' => 'setLinkHandler',
'arguments' =>
array (
0 => '@handler.link',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'action',
),
),
'extends' => 'action.standardized_save_settings.abstract',
'class' => 'PGI\\Impact\\BOModule\\Services\\Actions\\StandardizedSaveSettingsAction',
'arguments' =>
array (
0 => '@builder.form',
1 => '@settings',
),
'config' =>
array (
'form_name' => 'cron',
'redirection' => 'backoffice.cron.display',
),
),
'builder.request.frontoffice' =>
array (
'class' => 'PGI\\Impact\\PGServer\\Services\\Builders\\RequestBuilder',
'arguments' =>
array (
0 => '@superglobal.get',
1 => '@superglobal.post',
2 => '%request_builder.frontoffice',
),
),
'server.front' =>
array (
'abstract' => false,
'class' => 'PGI\\Impact\\PGServer\\Services\\Server',
'arguments' =>
array (
0 => '@router',
1 => '@derouter',
2 => '@dispatcher',
3 => '@logger',
4 => '@factory.stage',
5 => '%servers.front',
),
'extends' => 'server.abstract',
),
'builder.output.front_office_paygreen' =>
array (
'abstract' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setViewHandler',
'arguments' =>
array (
0 => '@handler.view',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'builder.output',
),
),
'extends' => 'builder.output.abstract',
'class' => 'PGI\\Impact\\FOModule\\Services\\OutputBuilders\\FrontOfficeOutputBuilder',
'arguments' =>
array (
0 => '@server.front',
1 => '@handler.output',
),
),
'builder.output.global_front_office_paygreen' =>
array (
'abstract' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setViewHandler',
'arguments' =>
array (
0 => '@handler.view',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'builder.output',
),
),
'extends' => 'builder.output.abstract.static_files',
'class' => 'PGI\\Impact\\PGModule\\Services\\OutputBuilders\\StaticFilesOutputBuilder',
'config' =>
array (
'css' =>
array (
0 => '/css/global-frontoffice.css',
),
),
),
'builder.output.cron_launcher' =>
array (
'abstract' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setViewHandler',
'arguments' =>
array (
0 => '@handler.view',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'builder.output',
),
),
'extends' => 'builder.output.abstract',
'class' => 'PGI\\Impact\\FOModule\\Services\\OutputBuilders\\CronLauncherOutputBuilder',
'arguments' =>
array (
0 => '@handler.link',
1 => '@settings',
),
),
'controller.front.notification' =>
array (
'abstract' => false,
'shared' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setLogger',
'arguments' =>
array (
0 => '@logger',
),
),
1 =>
array (
'method' => 'setNotifier',
'arguments' =>
array (
0 => '@notifier',
),
),
2 =>
array (
'method' => 'setLinkHandler',
'arguments' =>
array (
0 => '@handler.link',
),
),
3 =>
array (
'method' => 'setSettings',
'arguments' =>
array (
0 => '@settings',
),
),
4 =>
array (
'method' => 'setParameters',
'arguments' =>
array (
0 => '@parameters',
),
),
5 =>
array (
'method' => 'setFormBuilder',
'arguments' =>
array (
0 => '@builder.form',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'controller',
),
),
'extends' => 'controller.abstract',
'class' => 'PGI\\Impact\\FOModule\\Services\\Controllers\\NotificationController',
),
'controller.front.cron' =>
array (
'abstract' => false,
'shared' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setLogger',
'arguments' =>
array (
0 => '@logger',
),
),
1 =>
array (
'method' => 'setNotifier',
'arguments' =>
array (
0 => '@notifier',
),
),
2 =>
array (
'method' => 'setLinkHandler',
'arguments' =>
array (
0 => '@handler.link',
),
),
3 =>
array (
'method' => 'setSettings',
'arguments' =>
array (
0 => '@settings',
),
),
4 =>
array (
'method' => 'setParameters',
'arguments' =>
array (
0 => '@parameters',
),
),
5 =>
array (
'method' => 'setFormBuilder',
'arguments' =>
array (
0 => '@builder.form',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'controller',
),
),
'extends' => 'controller.abstract',
'class' => 'PGI\\Impact\\FOModule\\Services\\Controllers\\CronController',
'arguments' =>
array (
0 => '@scheduler',
),
),
'upgrade.match_green_access_settings' =>
array (
'abstract' => false,
'tags' =>
array (
0 =>
array (
'name' => 'upgrade',
),
),
'class' => 'PGI\\Impact\\PGGreen\\Services\\Upgrades\\MatchGreenAccessSettingsUpgrade',
'extends' => 'upgrade.abstract',
'arguments' =>
array (
0 => '@manager.setting',
1 => '@handler.shop',
2 => '@logger',
),
),
'requirement.tree_access_available' =>
array (
'abstract' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setLogger',
'arguments' =>
array (
0 => '@logger',
),
),
),
'extends' => 'requirement.abstract',
'shared' => false,
'tags' =>
array (
0 =>
array (
'name' => 'requirement',
),
),
'class' => 'PGI\\Impact\\PGTree\\Services\\Requirements\\TreeAccessAvailableRequirement',
'arguments' =>
array (
0 => '@handler.tree_account',
),
),
'requirement.carbon_bot_js' =>
array (
'abstract' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setLogger',
'arguments' =>
array (
0 => '@logger',
),
),
),
'extends' => 'requirement.abstract',
'shared' => false,
'tags' =>
array (
0 =>
array (
'name' => 'requirement',
),
),
'class' => 'PGI\\Impact\\PGTree\\Services\\Requirements\\CarbonBotJSRequirement',
'arguments' =>
array (
0 => '@settings',
),
),
'selector.carrier' =>
array (
'arguments' =>
array (
0 => '@logger',
),
'abstract' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setTranslator',
'arguments' =>
array (
0 => '@translator',
),
),
1 =>
array (
'method' => 'setCarrierManager',
'arguments' =>
array (
0 => '@manager.carrier',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'selector',
),
),
'extends' => 'selector.abstract',
'class' => 'PGI\\Impact\\PGTree\\Services\\Selectors\\CarrierSelector',
),
'selector.equivalence' =>
array (
'arguments' =>
array (
0 => '@logger',
),
'abstract' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setTranslator',
'arguments' =>
array (
0 => '@translator',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'selector',
),
),
'extends' => 'selector.abstract',
'class' => 'PGI\\Impact\\PGTree\\Services\\Selectors\\EquivalenceSelector',
),
'diagnostic.tree_contribution' =>
array (
'abstract' => false,
'tags' =>
array (
0 =>
array (
'name' => 'diagnostic',
),
),
'class' => 'PGI\\Impact\\PGWooTree\\Services\\Diagnostics\\TreeContributionDiagnostic',
'extends' => 'diagnostic.abstract',
'arguments' =>
array (
0 => '@handler.tree_contribution',
1 => '@logger',
2 => '@handler.tree_contribution',
3 => '@logger',
),
),
'listener.setup.tree_contribution_product' =>
array (
'class' => 'PGI\\Impact\\PGTree\\Services\\Listeners\\SetupTreeContributionProductListener',
'arguments' =>
array (
0 => '@handler.tree_contribution',
1 => '@logger',
),
),
'filter.product_reference' =>
array (
'class' => 'PGI\\Impact\\PGTree\\Services\\Filters\\ProductReferenceFilter',
),
'filter.product_name' =>
array (
'class' => 'PGI\\Impact\\PGTree\\Services\\Filters\\ProductNameFilter',
),
'handler.tree_authentication' =>
array (
'class' => 'PGI\\Impact\\PGTree\\Services\\Handlers\\TreeAuthenticationHandler',
'arguments' =>
array (
0 => '@facade.api.tree',
1 => '@factory.api.tree',
2 => '@settings',
3 => '@logger',
4 => '@broadcaster',
),
),
'handler.tree_carbon_offsetting' =>
array (
'class' => 'PGI\\Impact\\PGTree\\Services\\Handlers\\TreeCarbonOffsettingHandler',
'arguments' =>
array (
0 => '@facade.api.tree',
1 => '@handler.tree_footprint_id',
2 => '@handler.requirement',
3 => '@manager.carbon_data',
4 => '@logger',
),
),
'handler.tree_footprint_id' =>
array (
'class' => 'PGI\\Impact\\PGTree\\Services\\Handlers\\TreeFootprintIdHandler',
'arguments' =>
array (
0 => '@handler.cookie',
1 => '@handler.shop',
2 => '@settings',
3 => '@logger',
4 => '@facade.api.tree',
5 => '@handler.tree_footprint_token',
),
),
'handler.tree.catalog' =>
array (
'class' => 'PGI\\Impact\\PGTree\\Services\\Handlers\\TreeCatalogHandler',
'arguments' =>
array (
0 => '@manager.product',
1 => '@handler.cache',
2 => '@translator',
3 => '@filter.product_reference',
4 => '@filter.product_name',
5 => '@parameters',
),
),
'handler.tree_account' =>
array (
'class' => 'PGI\\Impact\\PGTree\\Services\\Handlers\\TreeAccountHandler',
'arguments' =>
array (
0 => '@handler.tree_authentication',
1 => '@facade.api.tree',
2 => '@handler.cache',
3 => '@settings',
4 => '@logger',
),
),
'handler.tree' =>
array (
'class' => 'PGI\\Impact\\PGTree\\Services\\Handlers\\TreeHandler',
'arguments' =>
array (
0 => '@handler.tree_cart',
),
),
'handler.tree_cart' =>
array (
'class' => 'PGI\\Impact\\PGTree\\Services\\Handlers\\TreeCartHandler',
'arguments' =>
array (
0 => '@manager.cart',
1 => '@handler.tree_contribution',
2 => '@manager.product',
3 => '@logger',
),
),
'handler.tree_contribution' =>
array (
'class' => 'PGI\\Impact\\PGTree\\Services\\Handlers\\TreeContributionHandler',
'arguments' =>
array (
0 => '@manager.product',
1 => '@officer.tree_contribution',
2 => '@handler.shop',
),
),
'handler.tree_footprint_token' =>
array (
'class' => 'PGI\\Impact\\PGTree\\Services\\Handlers\\TreeFootprintTokenHandler',
'arguments' =>
array (
0 => '@facade.api.tree',
1 => '@handler.cookie',
2 => '@logger',
),
),
'repository.carbon_data' =>
array (
'abstract' => false,
'arguments' =>
array (
0 => '@handler.database',
1 => '%database.entities.carbon_data',
),
'extends' => 'repository.abstract',
'class' => 'PGI\\Impact\\PGTree\\Services\\Repositories\\CarbonDataRepository',
),
'repository.carrier_equivalence' =>
array (
'abstract' => false,
'arguments' =>
array (
0 => '@handler.database',
1 => '%database.entities.carrier_equivalence',
),
'extends' => 'repository.abstract',
'class' => 'PGI\\Impact\\PGTree\\Services\\Repositories\\CarrierEquivalenceRepository',
),
'manager.carbon_data' =>
array (
'class' => 'PGI\\Impact\\PGTree\\Services\\Managers\\CarbonDataManager',
'arguments' =>
array (
0 => '@repository.carbon_data',
),
),
'manager.carrier' =>
array (
'class' => 'PGI\\Impact\\PGTree\\Services\\Managers\\CarrierManager',
'arguments' =>
array (
0 => '@repository.carrier',
),
),
'manager.carrier_equivalence' =>
array (
'class' => 'PGI\\Impact\\PGTree\\Services\\Managers\\CarrierEquivalenceManager',
'arguments' =>
array (
0 => '@repository.carrier_equivalence',
),
),
'logger.api_tree' =>
array (
'abstract' => false,
'class' => 'PGI\\Impact\\PGLog\\Services\\Logger',
'calls' =>
array (
0 =>
array (
'method' => 'setBehaviorHandler',
'arguments' =>
array (
0 => '@handler.behavior',
),
),
),
'extends' => 'logger.abstract',
'arguments' =>
array (
0 => '@log.writer.api',
),
),
'listener.setup.tree_client_compatibility_checker' =>
array (
'class' => 'PGI\\Impact\\APITree\\Services\\Listeners\\InstallCompatibilityCheckListener',
'arguments' =>
array (
0 => '@facade.api.tree',
),
),
'factory.api.tree' =>
array (
'class' => 'PGI\\Impact\\APITree\\Services\\Factories\\ApiFacadeFactory',
'arguments' =>
array (
0 => '@logger.api_tree',
1 => '@settings',
2 => '@parameters',
3 => '@facade.application',
4 => '@handler.requirement',
),
),
'facade.api.tree' =>
array (
'factory' => 'factory.api.tree',
),
'listener.tree_action.display_backoffice' =>
array (
'class' => 'PGI\\Impact\\BOTree\\Services\\Listeners\\DisplayBackofficeNotificationListener',
'arguments' =>
array (
0 => '@notifier',
1 => '@handler.tree_authentication',
),
),
'listener.tree_action.shipping_address' =>
array (
'class' => 'PGI\\Impact\\BOTree\\Services\\Listeners\\ShippingAddressListener',
'arguments' =>
array (
0 => '@notifier',
1 => '@handler.tree_authentication',
2 => '@settings',
),
),
'listener.tree_action.display_tree_test_mode_expiration_notification' =>
array (
'class' => 'PGI\\Impact\\BOTree\\Services\\Listeners\\DisplayTestModeExpirationNotificationListener',
'arguments' =>
array (
0 => '@notifier',
1 => '@handler.tree_account',
),
),
'controller.backoffice.tree' =>
array (
'abstract' => false,
'shared' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setLogger',
'arguments' =>
array (
0 => '@logger',
),
),
1 =>
array (
'method' => 'setNotifier',
'arguments' =>
array (
0 => '@notifier',
),
),
2 =>
array (
'method' => 'setLinkHandler',
'arguments' =>
array (
0 => '@handler.link',
),
),
3 =>
array (
'method' => 'setSettings',
'arguments' =>
array (
0 => '@settings',
),
),
4 =>
array (
'method' => 'setParameters',
'arguments' =>
array (
0 => '@parameters',
),
),
5 =>
array (
'method' => 'setFormBuilder',
'arguments' =>
array (
0 => '@builder.form',
),
),
6 =>
array (
'method' => 'setTreeAuthenticationHandler',
'arguments' =>
array (
0 => '@handler.tree_authentication',
),
),
7 =>
array (
'method' => 'setTreeAccountHandler',
'arguments' =>
array (
0 => '@handler.tree_account',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'controller',
),
),
'extends' => 'controller.abstract',
'class' => 'PGI\\Impact\\BOTree\\Services\\Controllers\\PluginController',
),
'controller.backoffice.tree_account' =>
array (
'abstract' => false,
'shared' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setLogger',
'arguments' =>
array (
0 => '@logger',
),
),
1 =>
array (
'method' => 'setNotifier',
'arguments' =>
array (
0 => '@notifier',
),
),
2 =>
array (
'method' => 'setLinkHandler',
'arguments' =>
array (
0 => '@handler.link',
),
),
3 =>
array (
'method' => 'setSettings',
'arguments' =>
array (
0 => '@settings',
),
),
4 =>
array (
'method' => 'setParameters',
'arguments' =>
array (
0 => '@parameters',
),
),
5 =>
array (
'method' => 'setFormBuilder',
'arguments' =>
array (
0 => '@builder.form',
),
),
6 =>
array (
'method' => 'setTreeAuthenticationHandler',
'arguments' =>
array (
0 => '@handler.tree_authentication',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'controller',
),
),
'extends' => 'controller.abstract',
'class' => 'PGI\\Impact\\BOTree\\Services\\Controllers\\AccountController',
),
'controller.backoffice.tree_export_product_catalog' =>
array (
'abstract' => false,
'shared' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setLogger',
'arguments' =>
array (
0 => '@logger',
),
),
1 =>
array (
'method' => 'setNotifier',
'arguments' =>
array (
0 => '@notifier',
),
),
2 =>
array (
'method' => 'setLinkHandler',
'arguments' =>
array (
0 => '@handler.link',
),
),
3 =>
array (
'method' => 'setSettings',
'arguments' =>
array (
0 => '@settings',
),
),
4 =>
array (
'method' => 'setParameters',
'arguments' =>
array (
0 => '@parameters',
),
),
5 =>
array (
'method' => 'setFormBuilder',
'arguments' =>
array (
0 => '@builder.form',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'controller',
),
),
'extends' => 'controller.abstract',
'class' => 'PGI\\Impact\\BOTree\\Services\\Controllers\\ExportProductCatalogController',
'arguments' =>
array (
0 => '@generator.csv',
1 => '@handler.tree.catalog',
2 => '@facade.api.tree',
3 => '@handler.requirement',
),
),
'controller.backoffice.delivery_methods' =>
array (
'abstract' => false,
'shared' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setLogger',
'arguments' =>
array (
0 => '@logger',
),
),
1 =>
array (
'method' => 'setNotifier',
'arguments' =>
array (
0 => '@notifier',
),
),
2 =>
array (
'method' => 'setLinkHandler',
'arguments' =>
array (
0 => '@handler.link',
),
),
3 =>
array (
'method' => 'setSettings',
'arguments' =>
array (
0 => '@settings',
),
),
4 =>
array (
'method' => 'setParameters',
'arguments' =>
array (
0 => '@parameters',
),
),
5 =>
array (
'method' => 'setFormBuilder',
'arguments' =>
array (
0 => '@builder.form',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'controller',
),
),
'extends' => 'controller.abstract',
'class' => 'PGI\\Impact\\BOTree\\Services\\Controllers\\DeliveryMethodsController',
'arguments' =>
array (
0 => '@manager.carrier_equivalence',
1 => '@manager.carrier',
),
),
'action.tree_shipping_address.save' =>
array (
'abstract' => false,
'shared' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setLogger',
'arguments' =>
array (
0 => '@logger',
),
),
1 =>
array (
'method' => 'setNotifier',
'arguments' =>
array (
0 => '@notifier',
),
),
2 =>
array (
'method' => 'setLinkHandler',
'arguments' =>
array (
0 => '@handler.link',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'action',
),
),
'extends' => 'action.standardized_save_settings.abstract',
'class' => 'PGI\\Impact\\BOModule\\Services\\Actions\\StandardizedSaveSettingsAction',
'arguments' =>
array (
0 => '@builder.form',
1 => '@settings',
),
'config' =>
array (
'form_name' => 'tree_shipping_address',
'redirection' => 'backoffice.tree_config.display',
),
),
'action.tree_account.display' =>
array (
'abstract' => false,
'shared' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setLogger',
'arguments' =>
array (
0 => '@logger',
),
),
1 =>
array (
'method' => 'setNotifier',
'arguments' =>
array (
0 => '@notifier',
),
),
2 =>
array (
'method' => 'setLinkHandler',
'arguments' =>
array (
0 => '@handler.link',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'action',
),
),
'extends' => 'action.standardized_display_page.abstract',
'class' => 'PGI\\Impact\\BOModule\\Services\\Actions\\StandardizedDisplayPageAction',
'arguments' =>
array (
0 => '@handler.block',
),
'config' =>
array (
'page_name' => 'tree_account',
),
),
'action.tree_config.display' =>
array (
'abstract' => false,
'shared' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setLogger',
'arguments' =>
array (
0 => '@logger',
),
),
1 =>
array (
'method' => 'setNotifier',
'arguments' =>
array (
0 => '@notifier',
),
),
2 =>
array (
'method' => 'setLinkHandler',
'arguments' =>
array (
0 => '@handler.link',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'action',
),
),
'extends' => 'action.standardized_display_page.abstract',
'class' => 'PGI\\Impact\\BOModule\\Services\\Actions\\StandardizedDisplayPageAction',
'arguments' =>
array (
0 => '@handler.block',
),
'config' =>
array (
'page_name' => 'tree_config',
),
),
'action.carbon_bot_config.display' =>
array (
'abstract' => false,
'shared' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setLogger',
'arguments' =>
array (
0 => '@logger',
),
),
1 =>
array (
'method' => 'setNotifier',
'arguments' =>
array (
0 => '@notifier',
),
),
2 =>
array (
'method' => 'setLinkHandler',
'arguments' =>
array (
0 => '@handler.link',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'action',
),
),
'extends' => 'action.standardized_display_page.abstract',
'class' => 'PGI\\Impact\\BOModule\\Services\\Actions\\StandardizedDisplayPageAction',
'arguments' =>
array (
0 => '@handler.block',
),
'config' =>
array (
'page_name' => 'carbon_bot_config',
),
),
'action.tree_bot_form.display' =>
array (
'abstract' => false,
'shared' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setLogger',
'arguments' =>
array (
0 => '@logger',
),
),
1 =>
array (
'method' => 'setNotifier',
'arguments' =>
array (
0 => '@notifier',
),
),
2 =>
array (
'method' => 'setLinkHandler',
'arguments' =>
array (
0 => '@handler.link',
),
),
3 =>
array (
'method' => 'setSettings',
'arguments' =>
array (
0 => '@settings',
),
),
4 =>
array (
'method' => 'setParameters',
'arguments' =>
array (
0 => '@parameters',
),
),
5 =>
array (
'method' => 'setFormBuilder',
'arguments' =>
array (
0 => '@builder.form',
),
),
6 =>
array (
'method' => 'setTranslationHandler',
'arguments' =>
array (
0 => '@handler.translation',
),
),
7 =>
array (
'method' => 'setLocaleHandler',
'arguments' =>
array (
0 => '@handler.locale',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'action',
),
),
'extends' => 'action.abstract',
'class' => 'PGI\\Impact\\BOTree\\Services\\Actions\\DisplayCarbonBotConfigurationFormAction',
),
'action.tree_bot_form.save' =>
array (
'abstract' => false,
'shared' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setLogger',
'arguments' =>
array (
0 => '@logger',
),
),
1 =>
array (
'method' => 'setNotifier',
'arguments' =>
array (
0 => '@notifier',
),
),
2 =>
array (
'method' => 'setLinkHandler',
'arguments' =>
array (
0 => '@handler.link',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'action',
),
),
'extends' => 'action.standardized_save_settings.abstract',
'class' => 'PGI\\Impact\\BOModule\\Services\\Actions\\StandardizedSaveSettingsAction',
'arguments' =>
array (
0 => '@builder.form',
1 => '@settings',
),
'config' =>
array (
'form_name' => 'tree_bot',
'redirection' => 'backoffice.carbon_bot_config.display',
),
),
'action.tree_module_config.display' =>
array (
'abstract' => false,
'shared' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setLogger',
'arguments' =>
array (
0 => '@logger',
),
),
1 =>
array (
'method' => 'setNotifier',
'arguments' =>
array (
0 => '@notifier',
),
),
2 =>
array (
'method' => 'setLinkHandler',
'arguments' =>
array (
0 => '@handler.link',
),
),
3 =>
array (
'method' => 'setSettings',
'arguments' =>
array (
0 => '@settings',
),
),
4 =>
array (
'method' => 'setParameters',
'arguments' =>
array (
0 => '@parameters',
),
),
5 =>
array (
'method' => 'setFormBuilder',
'arguments' =>
array (
0 => '@builder.form',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'action',
),
),
'extends' => 'action.standardized_form_settings_block.abstract',
'class' => 'PGI\\Impact\\BOModule\\Services\\Actions\\StandardizedFormSettingsBlockAction',
'config' =>
array (
'form_name' => 'tree_config',
'form_action' => 'backoffice.tree_config.save',
),
),
'action.tree_shipping_address.display' =>
array (
'abstract' => false,
'shared' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setLogger',
'arguments' =>
array (
0 => '@logger',
),
),
1 =>
array (
'method' => 'setNotifier',
'arguments' =>
array (
0 => '@notifier',
),
),
2 =>
array (
'method' => 'setLinkHandler',
'arguments' =>
array (
0 => '@handler.link',
),
),
3 =>
array (
'method' => 'setSettings',
'arguments' =>
array (
0 => '@settings',
),
),
4 =>
array (
'method' => 'setParameters',
'arguments' =>
array (
0 => '@parameters',
),
),
5 =>
array (
'method' => 'setFormBuilder',
'arguments' =>
array (
0 => '@builder.form',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'action',
),
),
'extends' => 'action.standardized_form_settings_block.abstract',
'class' => 'PGI\\Impact\\BOModule\\Services\\Actions\\StandardizedFormSettingsBlockAction',
'config' =>
array (
'form_name' => 'tree_shipping_address',
'form_action' => 'backoffice.tree_shipping_address.save',
),
),
'action.tree_translations.display' =>
array (
'abstract' => false,
'shared' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setLogger',
'arguments' =>
array (
0 => '@logger',
),
),
1 =>
array (
'method' => 'setNotifier',
'arguments' =>
array (
0 => '@notifier',
),
),
2 =>
array (
'method' => 'setLinkHandler',
'arguments' =>
array (
0 => '@handler.link',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'action',
),
),
'extends' => 'action.standardized_display_page.abstract',
'class' => 'PGI\\Impact\\BOModule\\Services\\Actions\\StandardizedDisplayPageAction',
'arguments' =>
array (
0 => '@handler.block',
),
'config' =>
array (
'page_name' => 'tree_translations',
),
),
'action.tree_translations_form.display' =>
array (
'abstract' => false,
'shared' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setLogger',
'arguments' =>
array (
0 => '@logger',
),
),
1 =>
array (
'method' => 'setNotifier',
'arguments' =>
array (
0 => '@notifier',
),
),
2 =>
array (
'method' => 'setLinkHandler',
'arguments' =>
array (
0 => '@handler.link',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'action',
),
),
'extends' => 'action.standardized_translations_form_block.abstract',
'class' => 'PGI\\Impact\\BOModule\\Services\\Actions\\StandardizedFormTranslationsBlockAction',
'arguments' =>
array (
0 => '@builder.translation_form',
1 => '@handler.translation',
),
'config' =>
array (
'translation_tag' => 'tree',
'form_action' => 'backoffice.tree_translations.save',
),
),
'action.tree_translations_form.save' =>
array (
'abstract' => false,
'shared' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setLogger',
'arguments' =>
array (
0 => '@logger',
),
),
1 =>
array (
'method' => 'setNotifier',
'arguments' =>
array (
0 => '@notifier',
),
),
2 =>
array (
'method' => 'setLinkHandler',
'arguments' =>
array (
0 => '@handler.link',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'action',
),
),
'extends' => 'action.standardized_save_translations_form.abstract',
'class' => 'PGI\\Impact\\BOModule\\Services\\Actions\\StandardizedSaveTranslationsFormAction',
'arguments' =>
array (
0 => '@builder.translation_form',
1 => '@handler.translation',
2 => '@manager.translation',
),
'config' =>
array (
'translation_tag' => 'tree',
'redirect_to' => 'tree_translations',
),
),
'action.tree_bot_translations_form.display' =>
array (
'abstract' => false,
'shared' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setLogger',
'arguments' =>
array (
0 => '@logger',
),
),
1 =>
array (
'method' => 'setNotifier',
'arguments' =>
array (
0 => '@notifier',
),
),
2 =>
array (
'method' => 'setLinkHandler',
'arguments' =>
array (
0 => '@handler.link',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'action',
),
),
'extends' => 'action.standardized_translations_form_block.abstract',
'class' => 'PGI\\Impact\\BOModule\\Services\\Actions\\StandardizedFormTranslationsBlockAction',
'arguments' =>
array (
0 => '@builder.translation_form',
1 => '@handler.translation',
),
'config' =>
array (
'translation_tag' => 'tree_bot',
'form_action' => 'backoffice.tree_bot_translations.save',
),
),
'action.tree_bot_translations_form.save' =>
array (
'abstract' => false,
'shared' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setLogger',
'arguments' =>
array (
0 => '@logger',
),
),
1 =>
array (
'method' => 'setNotifier',
'arguments' =>
array (
0 => '@notifier',
),
),
2 =>
array (
'method' => 'setLinkHandler',
'arguments' =>
array (
0 => '@handler.link',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'action',
),
),
'extends' => 'action.standardized_save_translations_form.abstract',
'class' => 'PGI\\Impact\\BOModule\\Services\\Actions\\StandardizedSaveTranslationsFormAction',
'arguments' =>
array (
0 => '@builder.translation_form',
1 => '@handler.translation',
2 => '@manager.translation',
),
'config' =>
array (
'translation_tag' => 'tree_bot',
'redirect_to' => 'tree_translations',
),
),
'action.tree_configuration.save' =>
array (
'abstract' => false,
'shared' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setLogger',
'arguments' =>
array (
0 => '@logger',
),
),
1 =>
array (
'method' => 'setNotifier',
'arguments' =>
array (
0 => '@notifier',
),
),
2 =>
array (
'method' => 'setLinkHandler',
'arguments' =>
array (
0 => '@handler.link',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'action',
),
),
'extends' => 'action.standardized_save_settings.abstract',
'class' => 'PGI\\Impact\\BOModule\\Services\\Actions\\StandardizedSaveSettingsAction',
'arguments' =>
array (
0 => '@builder.form',
1 => '@settings',
),
'config' =>
array (
'form_name' => 'tree_config',
'redirection' => 'backoffice.support.display',
),
),
'action.tree_user_contribution_config_form.display' =>
array (
'abstract' => false,
'shared' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setLogger',
'arguments' =>
array (
0 => '@logger',
),
),
1 =>
array (
'method' => 'setNotifier',
'arguments' =>
array (
0 => '@notifier',
),
),
2 =>
array (
'method' => 'setLinkHandler',
'arguments' =>
array (
0 => '@handler.link',
),
),
3 =>
array (
'method' => 'setSettings',
'arguments' =>
array (
0 => '@settings',
),
),
4 =>
array (
'method' => 'setParameters',
'arguments' =>
array (
0 => '@parameters',
),
),
5 =>
array (
'method' => 'setFormBuilder',
'arguments' =>
array (
0 => '@builder.form',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'action',
),
),
'extends' => 'action.standardized_form_settings_block.abstract',
'class' => 'PGI\\Impact\\BOModule\\Services\\Actions\\StandardizedFormSettingsBlockAction',
'config' =>
array (
'form_name' => 'tree_user_contribution_config',
'form_action' => 'backoffice.tree_user_contribution_config_form.save',
),
),
'action.tree_user_contribution_config_form.save' =>
array (
'abstract' => false,
'shared' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setLogger',
'arguments' =>
array (
0 => '@logger',
),
),
1 =>
array (
'method' => 'setNotifier',
'arguments' =>
array (
0 => '@notifier',
),
),
2 =>
array (
'method' => 'setLinkHandler',
'arguments' =>
array (
0 => '@handler.link',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'action',
),
),
'extends' => 'action.standardized_save_settings.abstract',
'class' => 'PGI\\Impact\\BOModule\\Services\\Actions\\StandardizedSaveSettingsAction',
'arguments' =>
array (
0 => '@builder.form',
1 => '@settings',
),
'config' =>
array (
'form_name' => 'tree_user_contribution_config',
'redirection' => 'backoffice.tree_config.display',
),
),
'listener.carbon_footprint.finalization' =>
array (
'class' => 'PGI\\Impact\\FOTree\\Services\\Listeners\\CarbonFootprintFinalizationListener',
'arguments' =>
array (
0 => '@handler.tree_carbon_offsetting',
1 => '@repository.carbon_data',
2 => '@handler.tree_contribution',
3 => '@logger',
),
),
'builder.output.carbon_footprint' =>
array (
'abstract' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setViewHandler',
'arguments' =>
array (
0 => '@handler.view',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'builder.output',
),
),
'extends' => 'builder.output.abstract',
'class' => 'PGI\\Impact\\FOTree\\Services\\OutputBuilders\\CarbonFootprintOutputBuilder',
'arguments' =>
array (
0 => '@manager.carbon_data',
1 => '@handler.carbon_rounder',
2 => '@logger',
3 => '@settings',
),
),
'builder.output.carbon_bot' =>
array (
'abstract' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setViewHandler',
'arguments' =>
array (
0 => '@handler.view',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'builder.output',
),
),
'extends' => 'builder.output.abstract',
'class' => 'PGI\\Impact\\FOTree\\Services\\OutputBuilders\\CarbonBotOutputBuilder',
'arguments' =>
array (
0 => '@settings',
1 => '@handler.tree_account',
2 => '@manager.cart',
3 => '@handler.translation',
4 => '@handler.link',
5 => '@logger',
6 => '@parameters',
7 => '@handler.locale',
8 => '@handler.tree',
),
),
'builder.output.user_contribution_block' =>
array (
'abstract' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setViewHandler',
'arguments' =>
array (
0 => '@handler.view',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'builder.output',
),
),
'extends' => 'builder.output.abstract',
'class' => 'PGI\\Impact\\FOTree\\Services\\OutputBuilders\\UserContributionOutputBuilder',
),
'controller.front.tree.climatebot' =>
array (
'abstract' => false,
'shared' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setLogger',
'arguments' =>
array (
0 => '@logger',
),
),
1 =>
array (
'method' => 'setNotifier',
'arguments' =>
array (
0 => '@notifier',
),
),
2 =>
array (
'method' => 'setLinkHandler',
'arguments' =>
array (
0 => '@handler.link',
),
),
3 =>
array (
'method' => 'setSettings',
'arguments' =>
array (
0 => '@settings',
),
),
4 =>
array (
'method' => 'setParameters',
'arguments' =>
array (
0 => '@parameters',
),
),
5 =>
array (
'method' => 'setFormBuilder',
'arguments' =>
array (
0 => '@builder.form',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'controller',
),
),
'extends' => 'controller.abstract',
'class' => 'PGI\\Impact\\FOTree\\Services\\Controllers\\ClimateBotController',
'arguments' =>
array (
0 => '@manager.customer',
1 => '@manager.cart',
2 => '@facade.api.tree',
3 => '@handler.tree_carbon_offsetting',
4 => '@handler.tree_footprint_token',
5 => '@handler.tree_footprint_id',
6 => '@filter.product_reference',
7 => '@manager.carrier_equivalence',
8 => '@handler.cookie',
9 => '@translator',
),
),
'controller.front.tree.usercontribution' =>
array (
'abstract' => false,
'shared' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setLogger',
'arguments' =>
array (
0 => '@logger',
),
),
1 =>
array (
'method' => 'setNotifier',
'arguments' =>
array (
0 => '@notifier',
),
),
2 =>
array (
'method' => 'setLinkHandler',
'arguments' =>
array (
0 => '@handler.link',
),
),
3 =>
array (
'method' => 'setSettings',
'arguments' =>
array (
0 => '@settings',
),
),
4 =>
array (
'method' => 'setParameters',
'arguments' =>
array (
0 => '@parameters',
),
),
5 =>
array (
'method' => 'setFormBuilder',
'arguments' =>
array (
0 => '@builder.form',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'controller',
),
),
'extends' => 'controller.abstract',
'class' => 'PGI\\Impact\\FOTree\\Services\\Controllers\\UserContributionController',
'arguments' =>
array (
0 => '@handler.tree',
1 => '@facade.api.tree',
),
),
'handler.carbon_rounder' =>
array (
'class' => 'PGI\\Impact\\FOTree\\Services\\Handlers\\CarbonRounderHandler',
'arguments' =>
array (
0 => '@handler.locale',
),
),
'officer.charity_gift' =>
array (
'class' => 'PGI\\Impact\\PGWooCharity\\Services\\Officers\\CharityGiftOfficer',
'arguments' =>
array (
0 => '@officer.charity_gift_image',
1 => '@manager.product',
2 => '@translator',
3 => '@parameters',
4 => '@settings',
5 => '@logger',
),
),
'requirement.charity_access_available' =>
array (
'abstract' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setLogger',
'arguments' =>
array (
0 => '@logger',
),
),
),
'extends' => 'requirement.abstract',
'shared' => false,
'tags' =>
array (
0 =>
array (
'name' => 'requirement',
),
),
'class' => 'PGI\\Impact\\PGCharity\\Services\\Requirements\\CharityAccessAvailableRequirement',
'arguments' =>
array (
0 => '@handler.charity_account',
),
),
'diagnostic.charity_gift' =>
array (
'abstract' => false,
'tags' =>
array (
0 =>
array (
'name' => 'diagnostic',
),
),
'class' => 'PGI\\Impact\\PGWooCharity\\Services\\Diagnostics\\CharityGiftDiagnostic',
'extends' => 'diagnostic.abstract',
'arguments' =>
array (
0 => '@handler.charity_gift',
1 => '@logger',
2 => '@handler.charity_gift',
3 => '@logger',
),
),
'listener.setup.charity_gift_product' =>
array (
'class' => 'PGI\\Impact\\PGCharity\\Services\\Listeners\\SetupCharityGiftProductListener',
'arguments' =>
array (
0 => '@handler.charity_gift',
1 => '@logger',
),
),
'handler.charity_authentication' =>
array (
'class' => 'PGI\\Impact\\PGCharity\\Services\\Handlers\\CharityAuthenticationHandler',
'arguments' =>
array (
0 => '@facade.api.charity',
1 => '@factory.api.charity',
2 => '@settings',
3 => '@logger',
4 => '@broadcaster',
),
),
'handler.charity_association' =>
array (
'class' => 'PGI\\Impact\\PGCharity\\Services\\Handlers\\CharityAssociationHandler',
'arguments' =>
array (
0 => '@facade.api.charity',
1 => '@handler.cache',
2 => '@logger',
),
),
'handler.charity_cart' =>
array (
'class' => 'PGI\\Impact\\PGCharity\\Services\\Handlers\\CharityCartHandler',
'arguments' =>
array (
0 => '@manager.cart',
1 => '@handler.charity_gift',
2 => '@manager.product',
3 => '@logger',
),
),
'handler.charity' =>
array (
'class' => 'PGI\\Impact\\PGCharity\\Services\\Handlers\\CharityHandler',
'arguments' =>
array (
0 => '@handler.charity_cart',
1 => '@handler.charity_partnership',
2 => '@handler.charity_gift',
3 => '@facade.api.charity',
4 => '@handler.session',
5 => '@manager.gift',
6 => '@handler.shop',
7 => '@settings',
8 => '@logger',
),
),
'handler.charity_partnership' =>
array (
'class' => 'PGI\\Impact\\PGCharity\\Services\\Handlers\\CharityPartnershipHandler',
'arguments' =>
array (
0 => '@facade.api.charity',
1 => '@handler.cache',
2 => '@settings',
3 => '@logger',
),
),
'handler.charity_gift' =>
array (
'class' => 'PGI\\Impact\\PGCharity\\Services\\Handlers\\CharityGiftHandler',
'arguments' =>
array (
0 => '@manager.product',
1 => '@officer.charity_gift',
2 => '@handler.shop',
),
),
'handler.charity_account' =>
array (
'class' => 'PGI\\Impact\\PGCharity\\Services\\Handlers\\CharityAccountHandler',
'arguments' =>
array (
0 => '@handler.charity_authentication',
1 => '@facade.api.charity',
2 => '@handler.cache',
3 => '@settings',
4 => '@logger',
),
),
'repository.gift' =>
array (
'abstract' => false,
'arguments' =>
array (
0 => '@handler.database',
1 => '%database.entities.gift',
),
'extends' => 'repository.abstract',
'class' => 'PGI\\Impact\\PGCharity\\Services\\Repositories\\GiftRepository',
),
'manager.gift' =>
array (
'class' => 'PGI\\Impact\\PGCharity\\Services\\Managers\\GiftManager',
'arguments' =>
array (
0 => '@repository.gift',
),
),
'logger.api_charity' =>
array (
'abstract' => false,
'class' => 'PGI\\Impact\\PGLog\\Services\\Logger',
'calls' =>
array (
0 =>
array (
'method' => 'setBehaviorHandler',
'arguments' =>
array (
0 => '@handler.behavior',
),
),
),
'extends' => 'logger.abstract',
'arguments' =>
array (
0 => '@log.writer.api',
),
),
'listener.setup.charity_client_compatibility_checker' =>
array (
'class' => 'PGI\\Impact\\APICharity\\Services\\Listeners\\InstallCompatibilityCheckListener',
'arguments' =>
array (
0 => '@facade.api.charity',
),
),
'factory.api.charity' =>
array (
'class' => 'PGI\\Impact\\APICharity\\Services\\Factories\\ApiFacadeFactory',
'arguments' =>
array (
0 => '@logger.api_charity',
1 => '@settings',
2 => '@parameters',
3 => '@facade.application',
4 => '@handler.requirement',
),
),
'facade.api.charity' =>
array (
'factory' => 'factory.api.charity',
),
'view.partnership.line' =>
array (
'class' => 'PGI\\Impact\\BOCharity\\Services\\Views\\PartnershipLineView',
'shared' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setViewHandler',
'arguments' =>
array (
0 => '@handler.view',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'view',
),
),
'abstract' => false,
'extends' => 'view.basic',
'arguments' =>
array (
0 => '@translator',
),
),
'listener.charity_action.display_backoffice' =>
array (
'class' => 'PGI\\Impact\\BOCharity\\Services\\Listeners\\DisplayBackofficeNotificationListener',
'arguments' =>
array (
0 => '@notifier',
1 => '@handler.charity_authentication',
),
),
'listener.charity_action.display_charity_test_mode_expiration_notification' =>
array (
'class' => 'PGI\\Impact\\BOCharity\\Services\\Listeners\\DisplayTestModeExpirationNotificationListener',
'arguments' =>
array (
0 => '@notifier',
1 => '@handler.charity_account',
),
),
'controller.backoffice.charity' =>
array (
'abstract' => false,
'shared' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setLogger',
'arguments' =>
array (
0 => '@logger',
),
),
1 =>
array (
'method' => 'setNotifier',
'arguments' =>
array (
0 => '@notifier',
),
),
2 =>
array (
'method' => 'setLinkHandler',
'arguments' =>
array (
0 => '@handler.link',
),
),
3 =>
array (
'method' => 'setSettings',
'arguments' =>
array (
0 => '@settings',
),
),
4 =>
array (
'method' => 'setParameters',
'arguments' =>
array (
0 => '@parameters',
),
),
5 =>
array (
'method' => 'setFormBuilder',
'arguments' =>
array (
0 => '@builder.form',
),
),
6 =>
array (
'method' => 'setCharityAuthenticationHandler',
'arguments' =>
array (
0 => '@handler.charity_authentication',
),
),
7 =>
array (
'method' => 'setCharityAccountHandler',
'arguments' =>
array (
0 => '@handler.charity_account',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'controller',
),
),
'extends' => 'controller.abstract',
'class' => 'PGI\\Impact\\BOCharity\\Services\\Controllers\\PluginController',
),
'controller.backoffice.charity_account' =>
array (
'abstract' => false,
'shared' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setLogger',
'arguments' =>
array (
0 => '@logger',
),
),
1 =>
array (
'method' => 'setNotifier',
'arguments' =>
array (
0 => '@notifier',
),
),
2 =>
array (
'method' => 'setLinkHandler',
'arguments' =>
array (
0 => '@handler.link',
),
),
3 =>
array (
'method' => 'setSettings',
'arguments' =>
array (
0 => '@settings',
),
),
4 =>
array (
'method' => 'setParameters',
'arguments' =>
array (
0 => '@parameters',
),
),
5 =>
array (
'method' => 'setFormBuilder',
'arguments' =>
array (
0 => '@builder.form',
),
),
6 =>
array (
'method' => 'setCharityAuthenticationHandler',
'arguments' =>
array (
0 => '@handler.charity_authentication',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'controller',
),
),
'extends' => 'controller.abstract',
'class' => 'PGI\\Impact\\BOCharity\\Services\\Controllers\\AccountController',
),
'controller.backoffice.charity_partnerships' =>
array (
'abstract' => false,
'shared' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setLogger',
'arguments' =>
array (
0 => '@logger',
),
),
1 =>
array (
'method' => 'setNotifier',
'arguments' =>
array (
0 => '@notifier',
),
),
2 =>
array (
'method' => 'setLinkHandler',
'arguments' =>
array (
0 => '@handler.link',
),
),
3 =>
array (
'method' => 'setSettings',
'arguments' =>
array (
0 => '@settings',
),
),
4 =>
array (
'method' => 'setParameters',
'arguments' =>
array (
0 => '@parameters',
),
),
5 =>
array (
'method' => 'setFormBuilder',
'arguments' =>
array (
0 => '@builder.form',
),
),
6 =>
array (
'method' => 'setCharityPartnershipHandler',
'arguments' =>
array (
0 => '@handler.charity_partnership',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'controller',
),
),
'extends' => 'controller.abstract',
'class' => 'PGI\\Impact\\BOCharity\\Services\\Controllers\\PartnershipsController',
),
'action.charity_account.display' =>
array (
'abstract' => false,
'shared' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setLogger',
'arguments' =>
array (
0 => '@logger',
),
),
1 =>
array (
'method' => 'setNotifier',
'arguments' =>
array (
0 => '@notifier',
),
),
2 =>
array (
'method' => 'setLinkHandler',
'arguments' =>
array (
0 => '@handler.link',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'action',
),
),
'extends' => 'action.standardized_display_page.abstract',
'class' => 'PGI\\Impact\\BOModule\\Services\\Actions\\StandardizedDisplayPageAction',
'arguments' =>
array (
0 => '@handler.block',
),
'config' =>
array (
'page_name' => 'charity_account',
),
),
'action.charity_partnerships.display' =>
array (
'abstract' => false,
'shared' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setLogger',
'arguments' =>
array (
0 => '@logger',
),
),
1 =>
array (
'method' => 'setNotifier',
'arguments' =>
array (
0 => '@notifier',
),
),
2 =>
array (
'method' => 'setLinkHandler',
'arguments' =>
array (
0 => '@handler.link',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'action',
),
),
'extends' => 'action.standardized_display_page.abstract',
'class' => 'PGI\\Impact\\BOModule\\Services\\Actions\\StandardizedDisplayPageAction',
'arguments' =>
array (
0 => '@handler.block',
),
'config' =>
array (
'page_name' => 'charity_partnerships',
),
),
'action.charity_translations.display' =>
array (
'abstract' => false,
'shared' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setLogger',
'arguments' =>
array (
0 => '@logger',
),
),
1 =>
array (
'method' => 'setNotifier',
'arguments' =>
array (
0 => '@notifier',
),
),
2 =>
array (
'method' => 'setLinkHandler',
'arguments' =>
array (
0 => '@handler.link',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'action',
),
),
'extends' => 'action.standardized_display_page.abstract',
'class' => 'PGI\\Impact\\BOModule\\Services\\Actions\\StandardizedDisplayPageAction',
'arguments' =>
array (
0 => '@handler.block',
),
'config' =>
array (
'page_name' => 'charity_translations',
),
),
'action.charity_translations_block_form.display' =>
array (
'abstract' => false,
'shared' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setLogger',
'arguments' =>
array (
0 => '@logger',
),
),
1 =>
array (
'method' => 'setNotifier',
'arguments' =>
array (
0 => '@notifier',
),
),
2 =>
array (
'method' => 'setLinkHandler',
'arguments' =>
array (
0 => '@handler.link',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'action',
),
),
'extends' => 'action.standardized_translations_form_block.abstract',
'class' => 'PGI\\Impact\\BOModule\\Services\\Actions\\StandardizedFormTranslationsBlockAction',
'arguments' =>
array (
0 => '@builder.translation_form',
1 => '@handler.translation',
),
'config' =>
array (
'translation_tag' => 'charity_block',
'form_action' => 'backoffice.charity_translations_block.save',
),
),
'action.charity_translations_block_form.save' =>
array (
'abstract' => false,
'shared' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setLogger',
'arguments' =>
array (
0 => '@logger',
),
),
1 =>
array (
'method' => 'setNotifier',
'arguments' =>
array (
0 => '@notifier',
),
),
2 =>
array (
'method' => 'setLinkHandler',
'arguments' =>
array (
0 => '@handler.link',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'action',
),
),
'extends' => 'action.standardized_save_translations_form.abstract',
'class' => 'PGI\\Impact\\BOModule\\Services\\Actions\\StandardizedSaveTranslationsFormAction',
'arguments' =>
array (
0 => '@builder.translation_form',
1 => '@handler.translation',
2 => '@manager.translation',
),
'config' =>
array (
'translation_tag' => 'charity_block',
'redirect_to' => 'charity_translations',
),
),
'action.charity_translations_popin_form.display' =>
array (
'abstract' => false,
'shared' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setLogger',
'arguments' =>
array (
0 => '@logger',
),
),
1 =>
array (
'method' => 'setNotifier',
'arguments' =>
array (
0 => '@notifier',
),
),
2 =>
array (
'method' => 'setLinkHandler',
'arguments' =>
array (
0 => '@handler.link',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'action',
),
),
'extends' => 'action.standardized_translations_form_block.abstract',
'class' => 'PGI\\Impact\\BOModule\\Services\\Actions\\StandardizedFormTranslationsBlockAction',
'arguments' =>
array (
0 => '@builder.translation_form',
1 => '@handler.translation',
),
'config' =>
array (
'translation_tag' => 'charity_popin',
'form_action' => 'backoffice.charity_translations_popin.save',
),
),
'action.charity_translations_popin_form.save' =>
array (
'abstract' => false,
'shared' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setLogger',
'arguments' =>
array (
0 => '@logger',
),
),
1 =>
array (
'method' => 'setNotifier',
'arguments' =>
array (
0 => '@notifier',
),
),
2 =>
array (
'method' => 'setLinkHandler',
'arguments' =>
array (
0 => '@handler.link',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'action',
),
),
'extends' => 'action.standardized_save_translations_form.abstract',
'class' => 'PGI\\Impact\\BOModule\\Services\\Actions\\StandardizedSaveTranslationsFormAction',
'arguments' =>
array (
0 => '@builder.translation_form',
1 => '@handler.translation',
2 => '@manager.translation',
),
'config' =>
array (
'translation_tag' => 'charity_popin',
'redirect_to' => 'charity_translations',
),
),
'action.charity_module_config.display' =>
array (
'abstract' => false,
'shared' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setLogger',
'arguments' =>
array (
0 => '@logger',
),
),
1 =>
array (
'method' => 'setNotifier',
'arguments' =>
array (
0 => '@notifier',
),
),
2 =>
array (
'method' => 'setLinkHandler',
'arguments' =>
array (
0 => '@handler.link',
),
),
3 =>
array (
'method' => 'setSettings',
'arguments' =>
array (
0 => '@settings',
),
),
4 =>
array (
'method' => 'setParameters',
'arguments' =>
array (
0 => '@parameters',
),
),
5 =>
array (
'method' => 'setFormBuilder',
'arguments' =>
array (
0 => '@builder.form',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'action',
),
),
'extends' => 'action.standardized_form_settings_block.abstract',
'class' => 'PGI\\Impact\\BOModule\\Services\\Actions\\StandardizedFormSettingsBlockAction',
'config' =>
array (
'form_name' => 'charity_config',
'form_action' => 'backoffice.charity_config.save',
),
),
'action.charity_config.save' =>
array (
'abstract' => false,
'shared' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setLogger',
'arguments' =>
array (
0 => '@logger',
),
),
1 =>
array (
'method' => 'setNotifier',
'arguments' =>
array (
0 => '@notifier',
),
),
2 =>
array (
'method' => 'setLinkHandler',
'arguments' =>
array (
0 => '@handler.link',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'action',
),
),
'extends' => 'action.standardized_save_settings.abstract',
'class' => 'PGI\\Impact\\BOModule\\Services\\Actions\\StandardizedSaveSettingsAction',
'arguments' =>
array (
0 => '@builder.form',
1 => '@settings',
),
'config' =>
array (
'form_name' => 'charity_config',
'redirection' => 'backoffice.support.display',
),
),
'builder.output.charity_block' =>
array (
'abstract' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setViewHandler',
'arguments' =>
array (
0 => '@handler.view',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'builder.output',
),
),
'extends' => 'builder.output.abstract',
'class' => 'PGI\\Impact\\FOCharity\\Services\\OutputBuilders\\CharityBlockOutputBuilder',
'arguments' =>
array (
0 => '@handler.charity',
1 => '@handler.link',
2 => '@settings',
3 => '@handler.charity_partnership',
),
),
'controller.front.charity.popin' =>
array (
'abstract' => false,
'shared' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setLogger',
'arguments' =>
array (
0 => '@logger',
),
),
1 =>
array (
'method' => 'setNotifier',
'arguments' =>
array (
0 => '@notifier',
),
),
2 =>
array (
'method' => 'setLinkHandler',
'arguments' =>
array (
0 => '@handler.link',
),
),
3 =>
array (
'method' => 'setSettings',
'arguments' =>
array (
0 => '@settings',
),
),
4 =>
array (
'method' => 'setParameters',
'arguments' =>
array (
0 => '@parameters',
),
),
5 =>
array (
'method' => 'setFormBuilder',
'arguments' =>
array (
0 => '@builder.form',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'controller',
),
),
'extends' => 'controller.abstract',
'class' => 'PGI\\Impact\\FOCharity\\Services\\Controllers\\CharityPopinController',
'arguments' =>
array (
0 => '@handler.view',
1 => '@handler.charity_partnership',
2 => '@handler.charity',
),
),
'controller.front.charity.gift' =>
array (
'abstract' => false,
'shared' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setLogger',
'arguments' =>
array (
0 => '@logger',
),
),
1 =>
array (
'method' => 'setNotifier',
'arguments' =>
array (
0 => '@notifier',
),
),
2 =>
array (
'method' => 'setLinkHandler',
'arguments' =>
array (
0 => '@handler.link',
),
),
3 =>
array (
'method' => 'setSettings',
'arguments' =>
array (
0 => '@settings',
),
),
4 =>
array (
'method' => 'setParameters',
'arguments' =>
array (
0 => '@parameters',
),
),
5 =>
array (
'method' => 'setFormBuilder',
'arguments' =>
array (
0 => '@builder.form',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'controller',
),
),
'extends' => 'controller.abstract',
'class' => 'PGI\\Impact\\FOCharity\\Services\\Controllers\\CharityGiftController',
'arguments' =>
array (
0 => '@handler.charity',
1 => '@handler.session',
2 => '@manager.cart',
),
),
'controller.backoffice.green_account' =>
array (
'abstract' => false,
'shared' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setLogger',
'arguments' =>
array (
0 => '@logger',
),
),
1 =>
array (
'method' => 'setNotifier',
'arguments' =>
array (
0 => '@notifier',
),
),
2 =>
array (
'method' => 'setLinkHandler',
'arguments' =>
array (
0 => '@handler.link',
),
),
3 =>
array (
'method' => 'setSettings',
'arguments' =>
array (
0 => '@settings',
),
),
4 =>
array (
'method' => 'setParameters',
'arguments' =>
array (
0 => '@parameters',
),
),
5 =>
array (
'method' => 'setFormBuilder',
'arguments' =>
array (
0 => '@builder.form',
),
),
6 =>
array (
'method' => 'setCharityAuthenticationHandler',
'arguments' =>
array (
0 => '@handler.charity_authentication',
),
),
7 =>
array (
'method' => 'setTreeAuthenticationHandler',
'arguments' =>
array (
0 => '@handler.tree_authentication',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'controller',
),
),
'extends' => 'controller.abstract',
'class' => 'PGI\\Impact\\BOGreen\\Services\\Controllers\\AccountController',
),
'officer.database' =>
array (
'class' => 'PGI\\Impact\\PGWordPress\\Services\\Officers\\DatabaseOfficer',
),
'officer.settings.configuration.system' =>
array (
'class' => 'PGI\\Impact\\PGWordPress\\Services\\Officers\\SystemSettingsOfficer',
),
'officer.schedule_event' =>
array (
'abstract' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setLogger',
'arguments' =>
array (
0 => '@logger',
),
),
),
'extends' => 'service.abstract',
'class' => 'PGI\\Impact\\PGWordPress\\Services\\Officers\\ScheduleEventOfficer',
),
'upgrade.database.delta' =>
array (
'abstract' => false,
'tags' =>
array (
0 =>
array (
'name' => 'upgrade',
),
),
'class' => 'PGI\\Impact\\PGWordPress\\Services\\Upgrades\\DatabaseDeltaUpgrade',
'extends' => 'upgrade.abstract',
'arguments' =>
array (
0 => '@handler.database',
),
),
'upgrade.restore.settings' =>
array (
'abstract' => false,
'tags' =>
array (
0 =>
array (
'name' => 'upgrade',
),
),
'class' => 'PGI\\Impact\\PGWordPress\\Services\\Upgrades\\RestoreSettingsUpgrade',
'extends' => 'upgrade.abstract',
'arguments' =>
array (
0 => '@settings',
1 => '@logger',
),
),
'upgrade.page.delete' =>
array (
'abstract' => false,
'tags' =>
array (
0 =>
array (
'name' => 'upgrade',
),
),
'class' => 'PGI\\Impact\\PGWordPress\\Services\\Upgrades\\DeletePageUpgrade',
'extends' => 'upgrade.abstract',
'arguments' =>
array (
0 => '@logger',
),
),
'upgrade.repare_translations_table' =>
array (
'abstract' => false,
'tags' =>
array (
0 =>
array (
'name' => 'upgrade',
),
),
'class' => 'PGI\\Impact\\PGWordPress\\Services\\Upgrades\\RepareTranslationsTableUpgrade',
'extends' => 'upgrade.abstract',
'arguments' =>
array (
0 => '@handler.database',
1 => '@officer.database',
2 => '@manager.shop',
3 => '@handler.translation',
4 => '@parameters',
5 => '@logger',
),
),
'bridge.wordpress' =>
array (
'fixed' => true,
),
'builder.output.frontoffice_override_css' =>
array (
'abstract' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setViewHandler',
'arguments' =>
array (
0 => '@handler.view',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'builder.output',
),
),
'extends' => 'builder.output.abstract.static_files',
'class' => 'PGI\\Impact\\PGModule\\Services\\OutputBuilders\\StaticFilesOutputBuilder',
'config' =>
array (
'css' =>
array (
0 => '/css/frontoffice-override.css',
),
),
),
'compiler.wordpress.resource' =>
array (
'class' => 'PGI\\Impact\\PGWordPress\\Services\\Compilers\\StaticResourceCompiler',
'arguments' =>
array (
0 => '@handler.static_file',
1 => '@facade.application',
2 => '@logger',
),
),
'linker.backoffice' =>
array (
'abstract' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setLogger',
'arguments' =>
array (
0 => '@logger',
),
),
),
'extends' => 'linker.abstract',
'tags' =>
array (
0 =>
array (
'name' => 'linker',
),
),
'class' => 'PGI\\Impact\\PGWordPress\\Services\\Linkers\\BackofficeLinker',
'config' =>
array (
'route' => '%cms.admin.menu.code',
),
),
'linker.home' =>
array (
'abstract' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setLogger',
'arguments' =>
array (
0 => '@logger',
),
),
),
'extends' => 'linker.abstract',
'tags' =>
array (
0 =>
array (
'name' => 'linker',
),
),
'class' => 'PGI\\Impact\\PGWordPress\\Services\\Linkers\\HomeLinker',
),
'linker.frontoffice' =>
array (
'abstract' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setLogger',
'arguments' =>
array (
0 => '@logger',
),
),
),
'extends' => 'linker.home',
'tags' =>
array (
0 =>
array (
'name' => 'linker',
),
),
'class' => 'PGI\\Impact\\PGWordPress\\Services\\Linkers\\HomeLinker',
),
'handler.frontoffice' =>
array (
'class' => 'PGI\\Impact\\PGWordPress\\Services\\Handlers\\FrontofficeHandler',
'arguments' =>
array (
0 => '@compiler.wordpress.resource',
1 => '@logger',
2 => '@provider.output',
),
),
'hook.setup' =>
array (
'abstract' => false,
'tags' =>
array (
0 =>
array (
'name' => 'hook',
),
),
'class' => 'PGI\\Impact\\PGWordPress\\Services\\Hooks\\SetupHook',
'extends' => 'hook.abstract',
'arguments' =>
array (
0 => '@handler.diagnostic',
1 => '@handler.shop',
2 => '@logger',
),
),
'hook.admin.menu' =>
array (
'abstract' => false,
'tags' =>
array (
0 =>
array (
'name' => 'hook',
),
),
'class' => 'PGI\\Impact\\PGWordPress\\Services\\Hooks\\AdminMenuHook',
'extends' => 'hook.abstract',
'arguments' =>
array (
0 => '@handler.hook',
1 => '@parameters',
),
),
'hook.backoffice' =>
array (
'abstract' => false,
'tags' =>
array (
0 =>
array (
'name' => 'hook',
),
),
'class' => 'PGI\\Impact\\PGWordPress\\Services\\Hooks\\BackofficeHook',
'extends' => 'hook.abstract',
'arguments' =>
array (
0 => '@compiler.wordpress.resource',
1 => '@logger',
2 => '@provider.output',
),
),
'hook.filter.template' =>
array (
'abstract' => false,
'tags' =>
array (
0 =>
array (
'name' => 'hook',
),
),
'class' => 'PGI\\Impact\\PGWordPress\\Services\\Hooks\\TemplateFilterHook',
'extends' => 'hook.abstract',
),
'hook.static_files' =>
array (
'abstract' => false,
'tags' =>
array (
0 =>
array (
'name' => 'hook',
),
),
'class' => 'PGI\\Impact\\PGWordPress\\Services\\Hooks\\StaticFilesHook',
'extends' => 'hook.abstract',
'arguments' =>
array (
0 => '@provider.output',
1 => '@compiler.wordpress.resource',
),
),
'hook.insert.footer' =>
array (
'abstract' => false,
'tags' =>
array (
0 =>
array (
'name' => 'hook',
),
),
'class' => 'PGI\\Impact\\PGWordPress\\Services\\Hooks\\InsertFooterHook',
'extends' => 'hook.abstract',
'arguments' =>
array (
0 => '@provider.output',
1 => '@compiler.wordpress.resource',
),
),
'strategy.order_state_mapper.local' =>
array (
'class' => 'PGI\\Impact\\PGWooCommerce\\Services\\Strategies\\OrderStateLocalStrategy',
'tags' =>
array (
0 =>
array (
'name' => 'mapper.strategy.order_state',
'options' =>
array (
0 => 'local',
),
),
),
),
'strategy.order_state_mapper.custom' =>
array (
'class' => 'PGI\\Impact\\PGWooCommerce\\Services\\Strategies\\OrderStateCustomStrategy',
'arguments' =>
array (
0 => '@settings',
),
'tags' =>
array (
0 =>
array (
'name' => 'mapper.strategy.order_state',
'options' =>
array (
0 => 'custom',
),
),
),
),
'officer.shop' =>
array (
'class' => 'PGI\\Impact\\PGWooCommerce\\Services\\Officers\\ShopOfficer',
),
'officer.product_variation' =>
array (
'class' => 'PGI\\Impact\\PGWooCommerce\\Services\\Officers\\ProductVariationOfficer',
'arguments' =>
array (
0 => '@handler.shop',
1 => '@logger',
),
),
'selector.order_state' =>
array (
'arguments' =>
array (
0 => '@logger',
),
'abstract' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setTranslator',
'arguments' =>
array (
0 => '@translator',
),
),
),
'tags' =>
array (
0 =>
array (
'name' => 'selector',
),
),
'extends' => 'selector.abstract',
'class' => 'PGI\\Impact\\PGWooCommerce\\Services\\Selectors\\OrderStateSelector',
),
'listener.setup.primary_shop' =>
array (
'class' => 'PGI\\Impact\\PGWooCommerce\\Services\\Listeners\\InstallPrimaryShopListener',
'arguments' =>
array (
0 => '@settings',
1 => '@logger',
),
),
'linker.checkout' =>
array (
'abstract' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setLogger',
'arguments' =>
array (
0 => '@logger',
),
),
),
'extends' => 'linker.abstract',
'tags' =>
array (
0 =>
array (
'name' => 'linker',
),
),
'class' => 'PGI\\Impact\\PGWooCommerce\\Services\\Linkers\\CheckoutLinker',
),
'linker.order' =>
array (
'abstract' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setLogger',
'arguments' =>
array (
0 => '@logger',
),
),
),
'extends' => 'linker.abstract.order',
'tags' =>
array (
0 =>
array (
'name' => 'linker',
),
),
'arguments' =>
array (
0 => '@manager.order',
),
'class' => 'PGI\\Impact\\PGWooCommerce\\Services\\Linkers\\OrderLinker',
),
'linker.order.confirmation' =>
array (
'abstract' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setLogger',
'arguments' =>
array (
0 => '@logger',
),
),
),
'extends' => 'linker.abstract.order',
'tags' =>
array (
0 =>
array (
'name' => 'linker',
),
),
'arguments' =>
array (
0 => '@manager.order',
),
'class' => 'PGI\\Impact\\PGWooCommerce\\Services\\Linkers\\OrderConfirmationLinker',
),
'linker.order.history' =>
array (
'abstract' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setLogger',
'arguments' =>
array (
0 => '@logger',
),
),
),
'extends' => 'linker.abstract.endpoint',
'tags' =>
array (
0 =>
array (
'name' => 'linker',
),
),
'class' => 'PGI\\Impact\\PGWooCommerce\\Services\\Linkers\\EndpointLinker',
'config' =>
array (
'route' => 'orders',
),
),
'hook.order_state' =>
array (
'abstract' => false,
'tags' =>
array (
0 =>
array (
'name' => 'hook',
),
),
'class' => 'PGI\\Impact\\PGWooCommerce\\Services\\Hooks\\OrderStatesHook',
'extends' => 'hook.abstract',
'arguments' =>
array (
0 => '%order.states',
1 => '@handler.cache',
2 => '@translator',
),
),
'hook.order_state_update' =>
array (
'abstract' => false,
'tags' =>
array (
0 =>
array (
'name' => 'hook',
),
),
'class' => 'PGI\\Impact\\PGWooCommerce\\Services\\Hooks\\OrderStateUpdateHook',
'extends' => 'hook.abstract',
'arguments' =>
array (
0 => '@repository.order',
1 => '@broadcaster',
2 => '@logger',
),
),
'hook.order_confirmation' =>
array (
'abstract' => false,
'tags' =>
array (
0 =>
array (
'name' => 'hook',
),
),
'class' => 'PGI\\Impact\\PGWooCommerce\\Services\\Hooks\\OrderConfirmationHook',
'extends' => 'hook.abstract',
'arguments' =>
array (
0 => '@provider.output',
),
),
'hook.local.order.validation' =>
array (
'abstract' => false,
'tags' =>
array (
0 =>
array (
'name' => 'hook',
),
),
'class' => 'PGI\\Impact\\PGWooCommerce\\Services\\Hooks\\LocalOrderValidationHook',
'extends' => 'hook.abstract',
'arguments' =>
array (
0 => '@broadcaster',
1 => '@repository.order',
),
),
'hook.display_front_funnel_checkout' =>
array (
'abstract' => false,
'tags' =>
array (
0 =>
array (
'name' => 'hook',
),
),
'extends' => 'hook.abstract',
'class' => 'PGI\\Impact\\PGWooCommerce\\Services\\Hooks\\DisplayFrontFunnelCheckoutHook',
'arguments' =>
array (
0 => '@provider.output',
),
),
'repository.carrier' =>
array (
'class' => 'PGI\\Impact\\PGWooCommerce\\Services\\Repositories\\CarrierRepository',
),
'officer.tree_contribution' =>
array (
'class' => 'PGI\\Impact\\PGWooTree\\Services\\Officers\\TreeContributionOfficer',
'arguments' =>
array (
0 => '@officer.tree_contribution_image',
1 => '@manager.product',
2 => '@translator',
3 => '@parameters',
4 => '@settings',
5 => '@logger',
),
),
'officer.tree_contribution_image' =>
array (
'class' => 'PGI\\Impact\\PGWooTree\\Services\\Officers\\TreeContributionImageOfficer',
'arguments' =>
array (
0 => '@pathfinder',
1 => '@parameters',
2 => '@logger',
),
),
'listener.tree_setup.clean_contribution_variations' =>
array (
'abstract' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setLogger',
'arguments' =>
array (
0 => '@logger',
),
),
),
'extends' => 'service.abstract',
'class' => 'PGI\\Impact\\PGWooTree\\Services\\Listeners\\SetupCleanContributionVariationsListener',
'arguments' =>
array (
0 => '@officer.schedule_event',
),
),
'listener.tree.soft_activation' =>
array (
'abstract' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setLogger',
'arguments' =>
array (
0 => '@logger',
),
),
),
'extends' => 'service.abstract',
'class' => 'PGI\\Impact\\PGWooTree\\Services\\Listeners\\TreeSoftActivationListener',
'arguments' =>
array (
0 => '@handler.diagnostic',
),
),
'hook.tree.increment_page_count' =>
array (
'abstract' => false,
'tags' =>
array (
0 =>
array (
'name' => 'hook',
),
),
'class' => 'PGI\\Impact\\PGWooTree\\Services\\Hooks\\IncrementPageCountHook',
'extends' => 'hook.abstract',
'arguments' =>
array (
0 => '@broadcaster',
1 => '@officer.shop',
),
),
'hook.clean_contribution_variations' =>
array (
'abstract' => false,
'tags' =>
array (
0 =>
array (
'name' => 'hook',
),
),
'class' => 'PGI\\Impact\\PGWooTree\\Services\\Hooks\\CleanContributionVariationHook',
'extends' => 'hook.abstract',
'arguments' =>
array (
0 => '@handler.tree_contribution',
1 => '@officer.product_variation',
2 => '@logger',
),
),
'officer.charity_gift_image' =>
array (
'class' => 'PGI\\Impact\\PGWooCharity\\Services\\Officers\\CharityGiftImageOfficer',
'arguments' =>
array (
0 => '@pathfinder',
1 => '@parameters',
2 => '@logger',
),
),
'listener.charity_setup.clean_product_variations' =>
array (
'abstract' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setLogger',
'arguments' =>
array (
0 => '@logger',
),
),
),
'extends' => 'service.abstract',
'class' => 'PGI\\Impact\\PGWooCharity\\Services\\Listeners\\SetupCleanProductVariationsListener',
'arguments' =>
array (
0 => '@officer.schedule_event',
),
),
'listener.charity.soft_activation' =>
array (
'abstract' => false,
'calls' =>
array (
0 =>
array (
'method' => 'setLogger',
'arguments' =>
array (
0 => '@logger',
),
),
),
'extends' => 'service.abstract',
'class' => 'PGI\\Impact\\PGWooCharity\\Services\\Listeners\\CharitySoftActivationListener',
'arguments' =>
array (
0 => '@handler.diagnostic',
),
),
'listener.charity_gift.finalization' =>
array (
'class' => 'PGI\\Impact\\PGWooCharity\\Services\\Listeners\\CharityGiftFinalizationListener',
'arguments' =>
array (
0 => '@handler.charity',
1 => '@repository.gift',
2 => '@logger',
),
),
'hook.clean_gift_variations' =>
array (
'abstract' => false,
'tags' =>
array (
0 =>
array (
'name' => 'hook',
),
),
'class' => 'PGI\\Impact\\PGWooCharity\\Services\\Hooks\\CleanGiftVariationHook',
'extends' => 'hook.abstract',
'arguments' =>
array (
0 => '@handler.charity_gift',
1 => '@officer.product_variation',
2 => '@logger',
),
),
);
