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
'settings' =>
array (
'entries' =>
array (
'behavior_detailed_logs' =>
array (
'type' => 'bool',
'system' => true,
'default' => false,
'alias' => 'pgimpact_behavior_detailed_logs',
),
'use_cache' =>
array (
'type' => 'bool',
'system' => true,
'default' => true,
'alias' => 'pgimpact_use_cache',
),
'last_update' =>
array (
'type' => 'string',
'system' => true,
'alias' => 'pgimpact_last_update',
),
'crontab_global' =>
array (
'type' => 'array',
'global' => true,
),
'crontab_shop' =>
array (
'type' => 'array',
),
'ssl_security_skip' =>
array (
'type' => 'bool',
'global' => true,
'default' => false,
),
'shop_identifier' =>
array (
'type' => 'string',
),
'cron_activation' =>
array (
'type' => 'bool',
'default' => true,
'global' => true,
),
'cron_activation_mode' =>
array (
'type' => 'string',
'default' => 'AJAX',
'global' => true,
),
'tree_activation' =>
array (
'type' => 'bool',
'default' => false,
),
'tree_client_id' =>
array (
'type' => 'string',
'private' => true,
),
'tree_client_username' =>
array (
'type' => 'string',
'private' => true,
),
'shipping_address_line_1' =>
array (
'type' => 'string',
'default' => '',
),
'shipping_address_line_2' =>
array (
'type' => 'string',
'default' => '',
),
'shipping_address_zipcode' =>
array (
'type' => 'string',
'default' => '',
),
'shipping_address_city' =>
array (
'type' => 'string',
'default' => '',
),
'shipping_address_country' =>
array (
'type' => 'string',
'default' => 'fr',
),
'tree_details_url' =>
array (
'type' => 'string',
'default' => '',
),
'tree_bot_color' =>
array (
'type' => 'string',
'default' => '#33AD73',
),
'tree_bot_side' =>
array (
'type' => 'string',
'default' => 'RIGHT',
),
'tree_test_mode' =>
array (
'type' => 'bool',
'default' => true,
),
'tree_user_contribution' =>
array (
'type' => 'bool',
'default' => true,
),
'tree_bot_displayed' =>
array (
'type' => 'int',
'default' => 0,
),
'tree_access_token' =>
array (
'type' => 'string',
'private' => true,
),
'tree_access_token_validity' =>
array (
'type' => 'string',
),
'tree_refresh_token' =>
array (
'type' => 'string',
'private' => true,
),
'tree_refresh_token_validity' =>
array (
'type' => 'string',
),
'tree_api_server' =>
array (
'type' => 'string',
'default' => 'PROD',
),
'tree_use_https' =>
array (
'type' => 'bool',
'global' => true,
'default' => true,
),
'charity_activation' =>
array (
'type' => 'bool',
'default' => false,
),
'charity_client_id' =>
array (
'type' => 'string',
'private' => true,
),
'charity_client_username' =>
array (
'type' => 'string',
'private' => true,
),
'charity_partnerships_positions' =>
array (
'type' => 'array',
'default' =>
array (
),
),
'charity_test_mode' =>
array (
'type' => 'bool',
'default' => true,
),
'charity_access_token' =>
array (
'type' => 'string',
'private' => true,
),
'charity_access_token_validity' =>
array (
'type' => 'string',
),
'charity_refresh_token' =>
array (
'type' => 'string',
'private' => true,
),
'charity_refresh_token_validity' =>
array (
'type' => 'string',
),
'charity_api_server' =>
array (
'type' => 'string',
'default' => 'PROD',
),
'charity_use_https' =>
array (
'type' => 'bool',
'global' => true,
'default' => true,
),
'tree_contribution_id' =>
array (
'type' => 'int',
'default' => null,
),
'charity_gift_id' =>
array (
'type' => 'int',
'default' => null,
),
),
'officers' =>
array (
'basic' => 'officer.settings.database.basic',
'global' => 'officer.settings.database.global',
'system' => 'officer.settings.configuration.system',
),
),
'listeners' =>
array (
'run_diagnostics' =>
array (
'event' =>
array (
0 => 'module.install',
1 => 'module.upgrade',
),
'service' => 'handler.diagnostic',
'priority' => 750,
),
'upgrade_static_files' =>
array (
'event' =>
array (
0 => 'module.install',
1 => 'module.upgrade',
),
'service' => 'listener.setup.static_files',
'method' => 'installStaticFiles',
),
'upgrade_module' =>
array (
'service' => 'listener.upgrade',
'event' => 'module.upgrade',
'priority' => 25,
),
'install_module_database' =>
array (
'event' =>
array (
0 => 'module.install',
),
'service' => 'listener.database.runner',
'priority' => 50,
'config' =>
array (
'script' =>
array (
0 => 'PGModule:setting/clean.sql',
1 => 'PGModule:setting/install.sql',
),
),
),
'install_default_settings' =>
array (
'event' => 'module.install',
'service' => 'listener.settings.install_default',
'priority' => 150,
),
'uninstall_settings' =>
array (
'event' => 'module.uninstall',
'service' => 'listener.settings.uninstall',
'priority' => 900,
),
'uninstall_module_database' =>
array (
'event' =>
array (
0 => 'module.uninstall',
),
'service' => 'listener.database.runner',
'priority' => 950,
'config' =>
array (
'script' => 'PGModule:setting/clean.sql',
),
),
'install_intl_database' =>
array (
'event' =>
array (
0 => 'module.install',
),
'service' => 'listener.database.runner',
'priority' => 50,
'config' =>
array (
'script' =>
array (
0 => 'PGIntl:translation/clean.sql',
1 => 'PGIntl:translation/install.sql',
),
),
),
'install_default_translations' =>
array (
'event' =>
array (
0 => 'module.install',
),
'service' => 'listener.setup.install_default_translations',
),
'reset_translation_cache' =>
array (
'event' =>
array (
0 => 'module.upgrade',
),
'service' => 'listener.setup.reset_translation_cache',
),
'uninstall_intl_database' =>
array (
'event' =>
array (
0 => 'module.uninstall',
),
'service' => 'listener.database.runner',
'priority' => 950,
'config' =>
array (
'script' => 'PGIntl:translation/clean.sql',
),
),
'clear_smarty_cache' =>
array (
'event' => 'module.upgrade',
'service' => 'listener.upgrade.clear_smarty_cache',
),
'pre_filling_cron_tabs' =>
array (
'event' =>
array (
0 => 'module.install',
1 => 'module.upgrade',
),
'service' => 'listener.cron.tabs.pre_filling',
),
'cleaning_cron_tabs' =>
array (
'event' =>
array (
0 => 'module.upgrade',
),
'service' => 'listener.cron.tabs.cleaning',
),
'display_shop_context_requirement' =>
array (
'event' => 'action.backoffice.system.display',
'service' => 'listener.action.shop_context_backoffice',
),
'display_support_page' =>
array (
'event' => 'action.backoffice.support.display',
'service' => 'listener.action.display_support_page',
),
'install_tree_database' =>
array (
'event' =>
array (
0 => 'module.install',
),
'service' => 'listener.database.runner',
'priority' => 50,
'config' =>
array (
'script' =>
array (
0 => 'PGTree:carbon_data/clean.sql',
1 => 'PGTree:carbon_data/install.sql',
2 => 'PGTree:carrier_equivalence/clean.sql',
3 => 'PGTree:carrier_equivalence/install.sql',
),
),
),
'uninstall_tree_database' =>
array (
'event' =>
array (
0 => 'module.uninstall',
),
'service' => 'listener.database.runner',
'priority' => 950,
'config' =>
array (
'script' =>
array (
0 => 'PGTree:carbon_data/clean.sql',
1 => 'PGTree:carrier_equivalence/clean.sql',
),
),
),
'install_tree_contribution_product' =>
array (
'event' => 'module.install',
'service' => 'listener.setup.tree_contribution_product',
'method' => 'installContributionProduct',
),
'uninstall_tree_contribution_product' =>
array (
'event' => 'module.uninstall',
'service' => 'listener.setup.tree_contribution_product',
'method' => 'uninstallContributionProduct',
),
'tree_check_client_compatibility' =>
array (
'event' => 'module.install',
'service' => 'listener.setup.tree_client_compatibility_checker',
'method' => 'checkCompatibility',
'priority' => 100,
),
'display_tree_shipping_address_requirement' =>
array (
'event' =>
array (
0 => 'action.backoffice.tree_config.display',
1 => 'action.backoffice.tree_translations.display',
2 => 'action.backoffice.carbon_bot_config.display',
),
'service' => 'listener.tree_action.shipping_address',
'requirements' =>
array (
0 => 'tree_activation',
),
),
'display_tree_test_mode_expiration_notification' =>
array (
'event' =>
array (
0 => 'action.backoffice.home.display',
1 => 'action.backoffice.tree_config.display',
2 => 'action.backoffice.tree_translations.display',
3 => 'action.backoffice.carbon_bot_config.display',
),
'service' => 'listener.tree_action.display_tree_test_mode_expiration_notification',
'requirements' =>
array (
0 => 'tree_activation',
),
),
'carbon_footprint_finalization' =>
array (
'event' => 'LOCAL.ORDER.VALIDATION',
'service' => 'listener.carbon_footprint.finalization',
'requirements' =>
array (
0 => 'tree_access_available',
),
),
'install_charity_database' =>
array (
'event' =>
array (
0 => 'module.install',
),
'service' => 'listener.database.runner',
'priority' => 50,
'config' =>
array (
'script' =>
array (
0 => 'PGCharity:gift/clean.sql',
1 => 'PGCharity:gift/install.sql',
),
),
),
'uninstall_charity_database' =>
array (
'event' =>
array (
0 => 'module.uninstall',
),
'service' => 'listener.database.runner',
'priority' => 950,
'config' =>
array (
'script' =>
array (
0 => 'PGCharity:gift/clean.sql',
),
),
),
'install_charity_gift_product' =>
array (
'event' => 'module.install',
'service' => 'listener.setup.charity_gift_product',
'method' => 'installGiftProduct',
),
'uninstall_charity_gift_product' =>
array (
'event' => 'module.uninstall',
'service' => 'listener.setup.charity_gift_product',
'method' => 'uninstallGiftProduct',
),
'charity_check_client_compatibility' =>
array (
'event' => 'module.install',
'service' => 'listener.setup.charity_client_compatibility_checker',
'method' => 'checkCompatibility',
'priority' => 100,
),
'display_charity_test_mode_expiration_notification' =>
array (
'event' =>
array (
0 => 'action.backoffice.home.display',
1 => 'action.backoffice.charity_partnerships.display',
2 => 'action.backoffice.charity_translations.display',
),
'service' => 'listener.charity_action.display_charity_test_mode_expiration_notification',
'requirements' =>
array (
0 => 'charity_activation',
),
),
'set_primary_shop' =>
array (
'service' => 'listener.setup.primary_shop',
'method' => 'createPrimaryShop',
'event' => 'module.install',
),
'install_clean_contribution_variations' =>
array (
'service' => 'listener.tree_setup.clean_contribution_variations',
'method' => 'install',
'event' => 'module.install',
'priority' => 50,
),
'uninstall_clean_contribution_variations' =>
array (
'service' => 'listener.tree_setup.clean_contribution_variations',
'method' => 'uninstall',
'event' => 'module.uninstall',
'priority' => 950,
),
'check_contribution_availability' =>
array (
'service' => 'listener.tree.soft_activation',
'method' => 'checkContributionAvailability',
'event' => 'product_activation.soft.climate',
),
'install_clean_product_variations' =>
array (
'service' => 'listener.charity_setup.clean_product_variations',
'method' => 'install',
'event' => 'module.install',
'priority' => 50,
),
'uninstall_clean_product_variations' =>
array (
'service' => 'listener.charity_setup.clean_product_variations',
'method' => 'uninstall',
'event' => 'module.uninstall',
'priority' => 950,
),
'check_gift_availability' =>
array (
'service' => 'listener.charity.soft_activation',
'method' => 'checkGiftAvailability',
'event' => 'product_activation.soft.charity',
),
'charity_gift.finalization' =>
array (
'event' => 'LOCAL.ORDER.VALIDATION',
'service' => 'listener.charity_gift.finalization',
'requirements' =>
array (
0 => 'charity_activation',
),
),
),
'behaviors' =>
array (
'detailed_logs' =>
array (
'type' => 'service',
'service' => 'behavior.detailed_logs',
'method' => 'isDetailedLogActivated',
),
),
'media' =>
array (
'baseurl' => '${PGIMPACT_CONTENT_URL}/uploads/paygreen',
),
'cache' =>
array (
'entries' =>
array (
'translations-fr' =>
array (
'ttl' => 604800,
'format' => 'array',
),
'translations-en' =>
array (
'ttl' => 604800,
'format' => 'array',
),
'carbon_footprint_catalog' =>
array (
'ttl' => 259200,
),
'tree_account_data' =>
array (
'ttl' => 21600,
'format' => 'object',
),
'tree_user_data' =>
array (
'ttl' => 21600,
'format' => 'object',
),
'charity_associations' =>
array (
'ttl' => 259200,
'format' => 'array',
),
'charity_partnerships' =>
array (
'ttl' => 21600,
'format' => 'object',
),
'charity_account_data' =>
array (
'ttl' => 21600,
'format' => 'object',
),
'charity_user_data' =>
array (
'ttl' => 21600,
'format' => 'object',
),
'custom-order-states' =>
array (
'ttl' => 86400,
'format' => 'array',
),
),
),
'setup' =>
array (
'older' => null,
),
'upgrades' =>
array (
'1.2.0' =>
array (
0 =>
array (
'type' => 'database',
'config' =>
array (
'script' => 'PGTree:carrier_equivalence/upgrades/001-creation-carrier-table.sql',
),
),
1 =>
array (
'type' => 'translations.install_default_values',
'config' =>
array (
'codes' =>
array (
0 => 'message_carbon_offset',
),
),
),
),
'1.1.0' =>
array (
0 =>
array (
'type' => 'match_green_access_settings',
),
1 =>
array (
'type' => 'translations.install_default_values',
'config' =>
array (
'codes' =>
array (
0 => 'message_find_out_more',
),
),
),
),
'1.3.1' =>
array (
'type' => 'database',
'config' =>
array (
'script' =>
array (
0 => 'PGCharity:gift/clean.sql',
1 => 'PGCharity:gift/install.sql',
),
),
),
),
'outputs' =>
array (
'back_office_paygreen' =>
array (
'target' => 'BACK.PAYGREEN',
'builder' => 'back_office_paygreen',
'clean' => false,
),
'front_office_paygreen' =>
array (
'target' => 'FRONT.PAYGREEN',
'builder' => 'front_office_paygreen',
'clean' => false,
),
'global_front_office_paygreen' =>
array (
'target' => 'FRONT.HEAD',
'builder' => 'global_front_office_paygreen',
'clean' => false,
),
'global_cron_launcher' =>
array (
'target' => 'FRONT.HEAD',
'builder' => 'cron_launcher',
'clean' => true,
'requirements' =>
array (
0 => 'cron_activation',
),
),
'carbon_footprint' =>
array (
'target' => 'FRONT.FUNNEL.CONFIRMATION',
'builder' => 'carbon_footprint',
'clean' => true,
'requirements' =>
array (
0 => 'tree_access_available',
),
),
'carbon_bot' =>
array (
'target' => 'FRONT.HEAD',
'builder' => 'carbon_bot',
'clean' => true,
'requirements' =>
array (
0 => 'tree_access_available',
1 => 'carbon_bot_js',
),
),
'user_contribution_block' =>
array (
'target' => 'FRONT.FUNNEL.CHECKOUT',
'builder' => 'user_contribution_block',
'clean' => true,
'requirements' =>
array (
0 => 'tree_user_contribution',
),
),
'charity_block' =>
array (
'target' => 'FRONT.FUNNEL.CHECKOUT',
'builder' => 'charity_block',
'clean' => true,
'requirements' =>
array (
0 => 'charity_access_available',
),
),
'frontoffice_override_css' =>
array (
'target' => 'FRONT.HEAD',
'builder' => 'frontoffice_override_css',
),
),
'database' =>
array (
'entities' =>
array (
'setting' =>
array (
'class' => 'PGI\\Impact\\PGModule\\Entities\\Setting',
'table' => '${PGIMPACT_DB_PREFIX}pgimpact_paygreen_settings',
'primary' => 'id',
'fields' =>
array (
'id' =>
array (
'type' => 'int',
),
'id_shop' =>
array (
'type' => 'string',
'default' => null,
),
'name' =>
array (
'type' => 'string',
),
'value' =>
array (
'type' => 'string',
),
),
),
'fingerprint' =>
array (
'table' => '${PGIMPACT_DB_PREFIX}pgimpact_paygreen_fingerprint',
),
'carbon_data' =>
array (
'table' => '${PGIMPACT_DB_PREFIX}pgimpact_paygreen_carbon_data',
'class' => 'PGI\\Impact\\PGTree\\Entities\\CarbonData',
'primary' => 'id',
'fields' =>
array (
'id' =>
array (
'type' => 'int',
),
'id_order' =>
array (
'type' => 'int',
),
'id_user' =>
array (
'type' => 'int',
),
'id_fingerprint' =>
array (
'type' => 'string',
),
'footprint' =>
array (
'type' => 'float',
),
'carbon_offset' =>
array (
'type' => 'float',
),
'created_at' =>
array (
'type' => 'datetime',
),
),
),
'gift' =>
array (
'table' => '${PGIMPACT_DB_PREFIX}pgimpact_paygreen_gifts',
'class' => 'PGI\\Impact\\PGCharity\\Entities\\Gift',
'primary' => 'id',
'fields' =>
array (
'id' =>
array (
'type' => 'int',
),
'reference' =>
array (
'type' => 'string',
),
'amount' =>
array (
'type' => 'int',
),
'id_cart' =>
array (
'type' => 'string',
),
'id_partnership' =>
array (
'type' => 'int',
),
'created_at' =>
array (
'type' => 'datetime',
),
'status' =>
array (
'type' => 'string',
),
),
),
'translation' =>
array (
'class' => 'PGI\\Impact\\PGIntl\\Entities\\Translation',
'table' => '${PGIMPACT_DB_PREFIX}pgimpact_paygreen_translations',
'primary' => 'id',
'fields' =>
array (
'id' =>
array (
'type' => 'int',
),
'id_shop' =>
array (
'type' => 'string',
'default' => null,
),
'code' =>
array (
'type' => 'string',
),
'language' =>
array (
'type' => 'string',
),
'text' =>
array (
'type' => 'string',
),
),
),
'carrier_equivalence' =>
array (
'table' => '${PGIMPACT_DB_PREFIX}pgimpact_paygreen_carrier_equivalence',
'primary' => 'id',
'fields' =>
array (
'id' =>
array (
'type' => 'int',
),
'id_carrier' =>
array (
'type' => 'int',
),
'equivalence' =>
array (
'type' => 'string',
),
),
),
),
),
'translations' =>
array (
'message_carbon_offsetting' =>
array (
'label' => 'translations.message_carbon_offsetting.field.label',
'help' => 'translations.message_carbon_offsetting.field.help',
'tags' =>
array (
0 => 'tree',
),
'default' =>
array (
'fr' => '',
'en' => '',
),
),
'message_carbon_footprint' =>
array (
'label' => 'translations.message_carbon_footprint.field.label',
'help' => 'translations.message_carbon_footprint.field.help',
'tags' =>
array (
0 => 'tree_bot',
),
'default' =>
array (
'fr' => 'Mon achat contribuant à la neutralité carbone',
'en' => 'My purchase contributing to carbon neutrality',
),
),
'message_find_out_more' =>
array (
'label' => 'translations.message_find_out_more.field.label',
'help' => 'translations.message_find_out_more.field.help',
'tags' =>
array (
0 => 'tree_bot',
),
'default' =>
array (
'fr' => 'Nous finançons des projets de réduction et de séquestration de GES à hauteur de vos émissions.',
'en' => 'We finance GHG reduction and sequestration projects up to the amount of your emissions.',
),
),
'message_carbon_offset' =>
array (
'label' => 'translations.message_carbon_offset.field.label',
'help' => 'translations.message_carbon_offset.field.help',
'tags' =>
array (
0 => 'tree_bot',
),
'default' =>
array (
'fr' => 'Financer un projet climatique à hauteur de {estimatedPrice}',
'en' => 'Fund a climate project up to {estimatedPrice}',
),
),
'charity_block_title' =>
array (
'label' => 'translations.charity_block_title.field.label',
'tags' =>
array (
0 => 'charity_block',
),
'default' =>
array (
'fr' => 'Et si vous aviez un impact positif ?',
'en' => 'What if you had a positive impact?',
),
),
'charity_block_message' =>
array (
'label' => 'translations.charity_block_message.field.label',
'tags' =>
array (
0 => 'charity_block',
),
'default' =>
array (
'fr' => 'Arrondir le montant de mon panier au profit d\'une association avec un don de',
'en' => 'Round up the amount of my basket to benefit an association with a donation of',
),
),
'charity_popin_title' =>
array (
'label' => 'translations.charity_popin_title.field.label',
'tags' =>
array (
0 => 'charity_popin',
),
'default' =>
array (
'fr' => 'Et si vous aviez un impact positif ?',
'en' => 'What if you had a positive impact?',
),
),
'charity_popin_subtitle' =>
array (
'label' => 'translations.charity_popin_subtitle.field.label',
'help' => 'translations.charity_popin_subtitle.field.help',
'tags' =>
array (
0 => 'charity_popin',
),
'default' =>
array (
'fr' => 'Veuillez cliquer pour choisir une association :',
'en' => 'Please click to select an association:',
),
),
'charity_popin_message' =>
array (
'label' => 'translations.charity_popin_message.field.label',
'help' => 'translations.charity_popin_message.field.help',
'tags' =>
array (
0 => 'charity_popin',
),
'default' =>
array (
'fr' => 'Arrondir le montant de mon panier au profit d\'une association avec un don de',
'en' => 'Round up the amount of my basket to benefit an association with a donation of',
),
),
),
'logo' =>
array (
'path' => 'PGImpact:logo-impact.svg',
'template' => 'block-menu-logo-impact.tpl',
),
'static' =>
array (
'public' => '${PGIMPACT_CONTENT_URL}/plugins/paygreen-impact/static',
'path' => 'static',
'install' =>
array (
'target' => null,
'envs' =>
array (
),
),
'swap' =>
array (
),
),
'db' =>
array (
'var' =>
array (
'prefix' => '${PGIMPACT_DB_PREFIX}',
'engine' => 'InnoDB',
),
),
'mime_types' =>
array (
'aac' => 'audio/aac',
'abw' => 'application/x-abiword',
'arc' => 'application/octet-stream',
'avi' => 'video/x-msvideo',
'azw' => 'application/vnd.amazon.ebook',
'bin' => 'application/octet-stream',
'bz' => 'application/x-bzip',
'bz2' => 'application/x-bzip2',
'csh' => 'application/x-csh',
'css' => 'text/css',
'csv' => 'text/csv',
'doc' => 'application/msword',
'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
'eot' => 'application/vnd.ms-fontobject',
'epub' => 'application/epub+zip',
'gif' => 'image/gif',
'htm' => 'text/html',
'html' => 'text/html',
'ico' => 'image/x-icon',
'ics' => 'text/calendar',
'jar' => 'application/java-archive',
'jpeg' => 'image/jpeg',
'jpg' => 'image/jpeg',
'js' => 'application/javascript',
'json' => 'application/json',
'log' => 'text/plain',
'mid' => 'audio/midi',
'midi' => 'audio/midi',
'mpeg' => 'video/mpeg',
'mpkg' => 'application/vnd.apple.installer+xml',
'odp' => 'application/vnd.oasis.opendocument.presentation',
'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
'odt' => 'application/vnd.oasis.opendocument.text',
'oga' => 'audio/ogg',
'ogv' => 'video/ogg',
'ogx' => 'application/ogg',
'otf' => 'font/otf',
'png' => 'image/png',
'pdf' => 'application/pdf',
'ppt' => 'application/vnd.ms-powerpoint',
'pptx' => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
'rar' => 'application/x-rar-compressed',
'rtf' => 'application/rtf',
'sh' => 'application/x-sh',
'svg' => 'image/svg+xml',
'swf' => 'application/x-shockwave-flash',
'tar' => 'application/x-tar',
'tif' => 'image/tiff',
'tiff' => 'image/tiff',
'ts' => 'application/typescript',
'ttf' => 'font/ttf',
'vsd' => 'application/vnd.visio',
'wav' => 'audio/x-wav',
'weba' => 'audio/webm',
'webm' => 'video/webm',
'webp' => 'image/webp',
'woff' => 'font/woff',
'woff2' => 'font/woff2',
'xhtml' => 'application/xhtml+xml',
'xls' => 'application/vnd.ms-excel',
'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
'xml' => 'application/xml',
'xul' => 'application/vnd.mozilla.xul+xml',
'zip' => 'application/zip',
'3gp' => 'video/3gpp',
'3g2' => 'video/3gpp2',
'7z' => 'application/x-7z-compressed',
),
'routing' =>
array (
'areas' =>
array (
'front' =>
array (
'patterns' =>
array (
0 => 'front.*',
),
),
'backoffice' =>
array (
'patterns' =>
array (
0 => 'backoffice.*',
),
),
),
'routes' =>
array (
'backoffice.cron.display' =>
array (
'target' => 'cron.display',
'requirements' =>
array (
0 => 'shop_context',
),
),
'backoffice.cron.run' =>
array (
'target' => 'runScheduler@backoffice.cron',
'requirements' =>
array (
0 => 'shop_context',
),
),
'backoffice.cron.save_config' =>
array (
'target' => 'cron_configuration.save',
),
'backoffice.system.display' =>
array (
'target' => 'system.display',
),
'backoffice.support.save_support_config' =>
array (
'target' => 'support_configuration.save',
),
'backoffice.logs.download' =>
array (
'target' => 'downloadLogFile@backoffice.logs',
),
'backoffice.logs.delete' =>
array (
'target' => 'deleteLogFile@backoffice.logs',
),
'backoffice.shop.select' =>
array (
'target' => 'setCurrentShop@backoffice.shop',
),
'backoffice.support.display' =>
array (
'target' => 'support.display',
),
'backoffice.release_note.display' =>
array (
'target' => 'release_note.display',
),
'backoffice.diagnostic.run' =>
array (
'target' => 'run@backoffice.diagnostic',
),
'backoffice.home.display' =>
array (
'target' => 'home.display',
'requirements' =>
array (
0 => 'shop_context',
),
),
'backoffice.cache.reset' =>
array (
'target' => 'resetCache@backoffice.cache',
),
'front.cron.run' =>
array (
'target' => 'runScheduler@front.cron',
'requirements' =>
array (
0 => 'cron_activation',
),
),
'backoffice.tree_test_mode.activation' =>
array (
'target' => 'treeTestModeActivation@backoffice.tree',
'requirements' =>
array (
0 => 'shop_context',
),
),
'backoffice.tree_account.connect' =>
array (
'target' => 'connect@backoffice.tree_account',
'requirements' =>
array (
0 => 'shop_context',
),
),
'backoffice.tree_config.display' =>
array (
'target' => 'tree_config.display',
'requirements' =>
array (
0 => 'shop_context',
1 => 'tree_activation',
),
),
'backoffice.carbon_bot_config.display' =>
array (
'target' => 'carbon_bot_config.display',
'requirements' =>
array (
0 => 'shop_context',
),
),
'backoffice.tree_config.save' =>
array (
'target' => 'tree_configuration.save',
'requirements' =>
array (
0 => 'shop_context',
),
),
'backoffice.tree_bot_form.save' =>
array (
'target' => 'tree_bot_form.save',
'requirements' =>
array (
0 => 'shop_context',
),
),
'backoffice.tree_shipping_address.save' =>
array (
'target' => 'tree_shipping_address.save',
'requirements' =>
array (
0 => 'shop_context',
),
),
'backoffice.tree_translations.display' =>
array (
'target' => 'tree_translations.display',
'requirements' =>
array (
0 => 'shop_context',
),
),
'backoffice.tree_translations.save' =>
array (
'target' => 'tree_translations_form.save',
'requirements' =>
array (
0 => 'shop_context',
),
),
'backoffice.tree_bot_translations.save' =>
array (
'target' => 'tree_bot_translations_form.save',
'requirements' =>
array (
0 => 'shop_context',
),
),
'backoffice.tree_config.download_product_catalog' =>
array (
'target' => 'downloadProductCatalog@backoffice.tree_export_product_catalog',
'requirements' =>
array (
0 => 'shop_context',
),
),
'backoffice.tree_config.generate_product_catalog' =>
array (
'target' => 'generateProductCatalog@backoffice.tree_export_product_catalog',
'requirements' =>
array (
0 => 'shop_context',
),
),
'backoffice.tree_config.export_product_catalog' =>
array (
'target' => 'exportProductCatalog@backoffice.tree_export_product_catalog',
'requirements' =>
array (
0 => 'shop_context',
1 => 'tree_connexion',
),
),
'backoffice.tree_user_contribution_config_form.save' =>
array (
'target' => 'tree_user_contribution_config_form.save',
'requirements' =>
array (
0 => 'shop_context',
1 => 'tree_connexion',
),
),
'backoffice.delivery_methods.save' =>
array (
'target' => 'saveDeliveryMethods@backoffice.delivery_methods',
'requirements' =>
array (
0 => 'shop_context',
1 => 'tree_connexion',
),
),
'front.tree.save_contribution' =>
array (
'target' => 'saveContribution@front.tree.usercontribution',
'requirements' =>
array (
0 => 'tree_access_available',
),
),
'front.tree.cancel_contribution' =>
array (
'target' => 'cancelContribution@front.tree.usercontribution',
'requirements' =>
array (
0 => 'tree_access_available',
),
),
'front.tree.contribution_explanation' =>
array (
'target' => 'displayContributionExplanationPage@front.tree.usercontribution',
),
'front.tree.create_footprint' =>
array (
'target' => 'createFootprint@front.tree.climatebot',
'requirements' =>
array (
0 => 'tree_access_available',
),
),
'backoffice.charity_account.connect' =>
array (
'target' => 'connect@backoffice.charity_account',
'requirements' =>
array (
0 => 'shop_context',
),
),
'backoffice.charity_test_mode.activation' =>
array (
'target' => 'charityTestModeActivation@backoffice.charity',
'requirements' =>
array (
0 => 'shop_context',
),
),
'backoffice.charity_partnerships.display' =>
array (
'target' => 'charity_partnerships.display',
'requirements' =>
array (
0 => 'shop_context',
1 => 'charity_activation',
2 => 'charity_access_available',
),
),
'backoffice.charity_partnerships.refresh' =>
array (
'target' => 'refreshPartnerships@backoffice.charity_partnerships',
'requirements' =>
array (
0 => 'shop_context',
1 => 'charity_activation',
2 => 'charity_access_available',
),
),
'backoffice.charity_partnerships.update_positions' =>
array (
'target' => 'updatePartnershipsPositions@backoffice.charity_partnerships',
'requirements' =>
array (
0 => 'shop_context',
),
),
'backoffice.charity_translations.display' =>
array (
'target' => 'charity_translations.display',
'requirements' =>
array (
0 => 'shop_context',
),
),
'backoffice.charity_translations_block.save' =>
array (
'target' => 'charity_translations_block_form.save',
'requirements' =>
array (
0 => 'shop_context',
),
),
'backoffice.charity_translations_popin.save' =>
array (
'target' => 'charity_translations_popin_form.save',
'requirements' =>
array (
0 => 'shop_context',
),
),
'backoffice.charity_config.save' =>
array (
'target' => 'charity_config.save',
'requirements' =>
array (
0 => 'shop_context',
),
),
'front.charity.display_popin' =>
array (
'target' => 'display@front.charity.popin',
'requirements' =>
array (
0 => 'charity_access_available',
),
),
'front.charity.save_gift' =>
array (
'target' => 'saveGift@front.charity.gift',
'requirements' =>
array (
0 => 'charity_access_available',
),
),
'front.charity.cancel_gift' =>
array (
'target' => 'cancelGift@front.charity.gift',
'requirements' =>
array (
0 => 'charity_access_available',
),
),
'front.charity.gift_explanation' =>
array (
'target' => 'displayGiftExplanationPage@front.charity.gift',
),
'backoffice.green_account.connect' =>
array (
'target' => 'connect@backoffice.green_account',
),
'backoffice.green_account.disconnectTree' =>
array (
'target' => 'disconnectTree@backoffice.green_account',
),
'backoffice.green_account.disconnectCharity' =>
array (
'target' => 'disconnectCharity@backoffice.green_account',
),
),
),
'request_builder' =>
array (
'default' =>
array (
),
'backoffice' =>
array (
'strict' => false,
),
'frontoffice' =>
array (
'strict' => false,
),
),
'http_codes' =>
array (
100 => 'Continue',
101 => 'Switching Protocols',
102 => 'Processing',
200 => 'OK',
201 => 'Created',
202 => 'Accepted',
203 => 'Non-Authoritative Information',
204 => 'No Content',
205 => 'Reset Content',
206 => 'Partial Content',
207 => 'Multi-Status',
208 => 'Already Reported',
226 => 'IM Used',
300 => 'Multiple Choices',
301 => 'Moved Permanently',
302 => 'Found',
303 => 'See Other',
304 => 'Not Modified',
305 => 'Use Proxy',
306 => 'Switch Proxy',
307 => 'Temporary Redirect',
308 => 'Permanent Redirect',
400 => 'Bad Request',
401 => 'Unauthorized',
402 => 'Payment Required',
403 => 'Forbidden',
404 => 'Not Found',
405 => 'Method Not Allowed',
406 => 'Not Acceptable',
407 => 'Proxy Authentication Required',
408 => 'Request Timeout',
409 => 'Conflict',
410 => 'Gone',
411 => 'Length Required',
412 => 'Precondition Failed',
413 => 'Request Entity Too Large',
414 => 'Request-URI Too Long',
415 => 'Unsupported Media Type',
416 => 'Requested Range Not Satisfiable',
417 => 'Expectation Failed',
418 => 'I"m a teapot',
419 => 'Authentication Timeout',
420 => 'Enhance Your Calm (Twitter) / Method Failure (Spring Framework)',
422 => 'Unprocessable Entity',
423 => 'Locked',
424 => 'Failed Dependency (WebDAV; RFC 4918) / Method Failure (WebDAV)',
425 => 'Unordered Collection',
426 => 'Upgrade Required',
428 => 'Precondition Required',
429 => 'Too Many Requests',
431 => 'Request Header Fields Too Large',
444 => 'No Response',
449 => 'Retry With',
450 => 'Blocked by Windows Parental Controls',
451 => 'Redirect (Microsoft) / Unavailable For Legal Reasons (Internet draft)',
494 => 'Request Header Too Large',
495 => 'Cert Error',
496 => 'No Cert',
497 => 'HTTP to HTTPS',
499 => 'Client Closed Request',
500 => 'Internal Server Error',
501 => 'Not Implemented',
502 => 'Bad Gateway',
503 => 'Service Unavailable',
504 => 'Gateway Timeout',
505 => 'HTTP Version Not Supported',
506 => 'Variant Also Negotiates',
507 => 'Insufficient Storage',
508 => 'Loop Detected',
509 => 'Bandwidth Limit Exceeded',
510 => 'Not Extended',
511 => 'Network Authentication Required',
598 => 'Network read timeout error',
599 => 'Network connect timeout error',
),
'intl' =>
array (
'native_languages' =>
array (
0 => 'en',
1 => 'fr',
),
),
'fields' =>
array (
'models' =>
array (
'collection.translations' =>
array (
'model' => 'collection',
'default' =>
array (
0 =>
array (
'text' => '',
'language' => 'fr',
),
),
'validators' =>
array (
'not_empty' => null,
),
'child' =>
array (
'model' => 'object',
'children' =>
array (
'text' =>
array (
'type' => 'basic',
'format' => 'string',
'required' => true,
'validators' =>
array (
'not_empty' => null,
),
'view' =>
array (
'name' => 'field',
'data' =>
array (
'attr' =>
array (
'type' => 'text',
),
'placeholder' => 'forms.translations.placeholder.text',
),
'template' => 'fields/partials/input',
),
),
'language' =>
array (
'type' => 'basic',
'format' => 'string',
'required' => true,
'validators' =>
array (
'not_empty' => null,
),
'view' =>
array (
'name' => 'field.choice.contracted',
'data' =>
array (
'choices' => 'language',
'translate' => true,
'multiple' => false,
'placeholder' => 'forms.translations.placeholder.lang',
'attr' =>
array (
'class' => 'pg_translated_field_language_selector',
),
),
'template' => 'fields/partials/select',
),
),
),
'view' =>
array (
'name' => 'field.object',
'data' =>
array (
'class' => null,
'label' => 'forms.button.fields.image.label',
),
'template' => 'fields/partials/object',
),
),
),
'string' =>
array (
'format' => 'string',
'view' =>
array (
'name' => 'field',
'data' =>
array (
'class' => null,
'attr' =>
array (
'type' => 'text',
),
),
'template' => 'fields/input-bloc',
),
),
'collection' =>
array (
'type' => 'collection',
'format' => 'array',
'view' =>
array (
'name' => 'field.collection',
'data' =>
array (
'class' => null,
'allowCreation' => true,
'allowDeletion' => true,
),
'template' => 'fields/bloc-collection',
),
),
'int' =>
array (
'format' => 'int',
'view' =>
array (
'name' => 'field',
'data' =>
array (
'class' => null,
'attr' =>
array (
'type' => 'number',
),
),
'template' => 'fields/input-bloc',
),
),
'float' =>
array (
'format' => 'float',
'view' =>
array (
'name' => 'field',
'data' =>
array (
'class' => null,
'attr' =>
array (
'type' => 'text',
),
),
'template' => 'fields/input-bloc',
),
),
'object' =>
array (
'type' => 'object',
'format' => 'object',
),
'bool' =>
array (
'format' => 'bool',
'view' =>
array (
'name' => 'field.bool.checkbox',
'data' =>
array (
'class' => null,
),
'template' => 'fields/input-bloc',
),
),
'hidden' =>
array (
'format' => 'string',
'view' =>
array (
'name' => 'field',
'data' =>
array (
'attr' =>
array (
'type' => 'hidden',
),
),
'template' => 'fields/partials/input',
),
),
'choice.expanded.single' =>
array (
'format' => 'string',
'view' =>
array (
'name' => 'field.choice.expanded',
'data' =>
array (
'class' => null,
'translate' => false,
'multiple' => false,
),
'template' => 'fields/bloc-choice-expanded',
),
),
'choice.expanded.multiple' =>
array (
'format' => 'array',
'view' =>
array (
'name' => 'field.choice.expanded',
'data' =>
array (
'class' => null,
'translate' => false,
'multiple' => true,
),
'template' => 'fields/bloc-choice-expanded',
),
),
'choice.contracted.single' =>
array (
'format' => 'string',
'view' =>
array (
'name' => 'field.choice.contracted',
'data' =>
array (
'class' => null,
'translate' => false,
'multiple' => false,
),
'template' => 'fields/bloc-choice-contracted',
),
),
'choice.contracted.multiple' =>
array (
'format' => 'array',
'view' =>
array (
'name' => 'field.choice.contracted',
'data' =>
array (
'class' => null,
'translate' => false,
'multiple' => true,
),
'template' => 'fields/bloc-choice-contracted',
),
),
'choice.double.bool' =>
array (
'format' => 'array',
'view' =>
array (
'name' => 'field.choice.double.bool',
'data' =>
array (
'class' => null,
'translate' =>
array (
'horizontal_choices' => false,
'vertical_choices' => false,
),
'axis' => 'both',
'multiple' => true,
'radio' => false,
'filter' => true,
'filterPlaceholder' => 'misc.forms.default.input.search.placeholder',
),
'template' => 'fields/bloc-double-choice-boolean',
),
),
'bool.switch' =>
array (
'format' => 'bool',
'view' =>
array (
'name' => 'field',
'data' =>
array (
'class' => null,
),
'template' => 'fields/bloc-switch',
),
),
'bool.check' =>
array (
'format' => 'bool',
'view' =>
array (
'name' => 'field.bool.checkbox',
'data' =>
array (
'class' => null,
),
'template' => 'fields/basic-boolean',
),
),
'colorpicker' =>
array (
'format' => 'string',
'view' =>
array (
'name' => 'field',
'data' =>
array (
'class' => null,
'attr' =>
array (
'data-js' => 'colorpicker',
'class' => 'pgform__field__colorpicker',
),
),
'template' => 'fields/bloc-colorpicker',
),
),
),
'default' =>
array (
'type' => 'basic',
'enabled' => true,
),
'types' =>
array (
'basic' => 'PGI\\Impact\\PGForm\\Components\\Fields\\Basic',
'object' => 'PGI\\Impact\\PGForm\\Components\\Fields\\Composite',
'collection' => 'PGI\\Impact\\PGForm\\Components\\Fields\\Collection',
),
),
'languages' =>
array (
0 => 'ab',
1 => 'aa',
2 => 'af',
3 => 'ak',
4 => 'sq',
5 => 'de',
6 => 'am',
7 => 'en',
8 => 'ar',
9 => 'an',
10 => 'hy',
11 => 'as',
12 => 'av',
13 => 'ae',
14 => 'ay',
15 => 'az',
16 => 'ba',
17 => 'bm',
18 => 'eu',
19 => 'bn',
20 => 'bi',
21 => 'be',
22 => 'my',
23 => 'bs',
24 => 'br',
25 => 'bg',
26 => 'ca',
27 => 'ch',
28 => 'ny',
29 => 'zh',
30 => 'ko',
31 => 'kw',
32 => 'co',
33 => 'cr',
34 => 'hr',
35 => 'da',
36 => 'dz',
37 => 'es',
38 => 'eo',
39 => 'et',
40 => 'ee',
41 => 'fo',
42 => 'fj',
43 => 'fi',
44 => 'nl',
45 => 'fr',
46 => 'fy',
47 => 'gd',
48 => 'gl',
49 => 'om',
50 => 'cy',
51 => 'lg',
52 => 'ka',
53 => 'gu',
54 => 'el',
55 => 'kl',
56 => 'gn',
57 => 'ht',
58 => 'ha',
59 => 'he',
60 => 'hz',
61 => 'hi',
62 => 'ho',
63 => 'hu',
64 => 'io',
65 => 'ig',
66 => 'id',
67 => 'iu',
68 => 'ik',
69 => 'ga',
70 => 'is',
71 => 'it',
72 => 'ja',
73 => 'jv',
74 => 'kn',
75 => 'kr',
76 => 'ks',
77 => 'kk',
78 => 'km',
79 => 'ki',
80 => 'ky',
81 => 'kv',
82 => 'kg',
83 => 'ku',
84 => 'kj',
85 => 'bh',
86 => 'lo',
87 => 'la',
88 => 'lv',
89 => 'li',
90 => 'ln',
91 => 'lt',
92 => 'lu',
93 => 'lb',
94 => 'mk',
95 => 'ms',
96 => 'ml',
97 => 'dv',
98 => 'mg',
99 => 'mt',
100 => 'gv',
101 => 'mi',
102 => 'mr',
103 => 'mh',
104 => 'ro',
105 => 'mn',
106 => 'na',
107 => 'nv',
108 => 'nd',
109 => 'nr',
110 => 'ng',
111 => 'ne',
112 => 'no',
113 => 'nb',
114 => 'nn',
115 => 'oc',
116 => 'oj',
117 => 'or',
118 => 'os',
119 => 'ug',
120 => 'ur',
121 => 'uz',
122 => 'ps',
123 => 'pi',
124 => 'pa',
125 => 'fa',
126 => 'ff',
127 => 'pl',
128 => 'pt',
129 => 'qu',
130 => 'rm',
131 => 'rn',
132 => 'ru',
133 => 'rw',
134 => 'se',
135 => 'sm',
136 => 'sg',
137 => 'sa',
138 => 'sc',
139 => 'sr',
140 => 'sn',
141 => 'sd',
142 => 'si',
143 => 'sk',
144 => 'sl',
145 => 'so',
146 => 'st',
147 => 'su',
148 => 'sv',
149 => 'sw',
150 => 'ss',
151 => 'tg',
152 => 'tl',
153 => 'ty',
154 => 'ta',
155 => 'tt',
156 => 'cs',
157 => 'ce',
158 => 'cv',
159 => 'te',
160 => 'th',
161 => 'bo',
162 => 'ti',
163 => 'to',
164 => 'ts',
165 => 'tn',
166 => 'tr',
167 => 'tk',
168 => 'tw',
169 => 'uk',
170 => 've',
171 => 'vi',
172 => 'cu',
173 => 'vo',
174 => 'wa',
175 => 'wo',
176 => 'xh',
177 => 'ii',
178 => 'yi',
179 => 'yo',
180 => 'za',
181 => 'zu',
),
'countries' =>
array (
0 => 'af',
1 => 'al',
2 => 'ag',
3 => 'an',
4 => 'ao',
5 => 'av',
6 => 'ac',
7 => 'ar',
8 => 'am',
9 => 'aa',
10 => 'at',
11 => 'as',
12 => 'au',
13 => 'aj',
14 => 'bf',
15 => 'ba',
16 => 'bg',
17 => 'bb',
18 => 'bs',
19 => 'bo',
20 => 'be',
21 => 'bh',
22 => 'bn',
23 => 'bd',
24 => 'bt',
25 => 'bl',
26 => 'bk',
27 => 'bc',
28 => 'bv',
29 => 'br',
30 => 'io',
31 => 'vi',
32 => 'bx',
33 => 'bu',
34 => 'uv',
35 => 'bm',
36 => 'by',
37 => 'cb',
38 => 'cm',
39 => 'ca',
40 => 'cv',
41 => 'cj',
42 => 'ct',
43 => 'cd',
44 => 'ci',
45 => 'ch',
46 => 'kt',
47 => 'ip',
48 => 'ck',
49 => 'co',
50 => 'cn',
51 => 'cf',
52 => 'cg',
53 => 'cw',
54 => 'cr',
55 => 'cs',
56 => 'iv',
57 => 'hr',
58 => 'cu',
59 => 'cy',
60 => 'ez',
61 => 'da',
62 => 'dj',
63 => 'do',
64 => 'dr',
65 => 'tt',
66 => 'ec',
67 => 'eg',
68 => 'es',
69 => 'ek',
70 => 'er',
71 => 'en',
72 => 'et',
73 => 'eu',
74 => 'fk',
75 => 'fo',
76 => 'fj',
77 => 'fi',
78 => 'fr',
79 => 'fg',
80 => 'fp',
81 => 'fs',
82 => 'gb',
83 => 'ga',
84 => 'gz',
85 => 'gg',
86 => 'gm',
87 => 'gh',
88 => 'gi',
89 => 'go',
90 => 'gr',
91 => 'gl',
92 => 'gj',
93 => 'gp',
94 => 'gt',
95 => 'gk',
96 => 'gv',
97 => 'pu',
98 => 'gy',
99 => 'ha',
100 => 'hm',
101 => 'ho',
102 => 'hk',
103 => 'hu',
104 => 'ic',
105 => 'in',
106 => 'id',
107 => 'ir',
108 => 'iz',
109 => 'ei',
110 => 'im',
111 => 'is',
112 => 'it',
113 => 'jm',
114 => 'jn',
115 => 'ja',
116 => 'je',
117 => 'jo',
118 => 'ju',
119 => 'kz',
120 => 'ke',
121 => 'kr',
122 => 'ku',
123 => 'kg',
124 => 'la',
125 => 'lg',
126 => 'le',
127 => 'lt',
128 => 'li',
129 => 'ly',
130 => 'ls',
131 => 'lh',
132 => 'lu',
133 => 'mc',
134 => 'mk',
135 => 'ma',
136 => 'mi',
137 => 'my',
138 => 'mv',
139 => 'ml',
140 => 'mt',
141 => 'rm',
142 => 'mb',
143 => 'mr',
144 => 'mp',
145 => 'mf',
146 => 'mx',
147 => 'fm',
148 => 'md',
149 => 'mn',
150 => 'mg',
151 => 'mh',
152 => 'mo',
153 => 'mz',
154 => 'wa',
155 => 'nr',
156 => 'np',
157 => 'nl',
158 => 'nt',
159 => 'nc',
160 => 'nz',
161 => 'nu',
162 => 'ng',
163 => 'ni',
164 => 'ne',
165 => 'nm',
166 => 'nf',
167 => 'kn',
168 => 'no',
169 => 'mu',
170 => 'pk',
171 => 'ps',
172 => 'pm',
173 => 'pp',
174 => 'pa',
175 => 'pe',
176 => 'rp',
177 => 'pc',
178 => 'pl',
179 => 'po',
180 => 'qa',
181 => 're',
182 => 'ro',
183 => 'rs',
184 => 'rw',
185 => 'sh',
186 => 'sc',
187 => 'st',
188 => 'sb',
189 => 'vc',
190 => 'ws',
191 => 'sm',
192 => 'tp',
193 => 'sa',
194 => 'sg',
195 => 'yi',
196 => 'se',
197 => 'sl',
198 => 'sn',
199 => 'lo',
200 => 'si',
201 => 'bp',
202 => 'so',
203 => 'sf',
204 => 'sx',
205 => 'ks',
206 => 'sp',
207 => 'pg',
208 => 'ce',
209 => 'su',
210 => 'ns',
211 => 'sv',
212 => 'wz',
213 => 'sw',
214 => 'sz',
215 => 'sy',
216 => 'tw',
217 => 'ti',
218 => 'tz',
219 => 'th',
220 => 'to',
221 => 'tl',
222 => 'tn',
223 => 'td',
224 => 'te',
225 => 'ts',
226 => 'tu',
227 => 'tx',
228 => 'tk',
229 => 'tv',
230 => 'ug',
231 => 'up',
232 => 'ae',
233 => 'uk',
234 => 'uy',
235 => 'uz',
236 => 'nh',
237 => 'vt',
238 => 've',
239 => 'vm',
240 => 'wf',
241 => 'we',
242 => 'wi',
243 => 'ym',
244 => 'za',
245 => 'zi',
),
'form' =>
array (
'definitions' =>
array (
'translations' =>
array (
'model' => 'basic',
'fields' =>
array (
),
'view' =>
array (
'data' =>
array (
'validate' => 'misc.forms.default.buttons.save',
),
),
),
'cron' =>
array (
'model' => 'basic',
'fields' =>
array (
'cron_activation' =>
array (
'model' => 'bool.switch',
'view' =>
array (
'data' =>
array (
'label' => 'forms.cron.fields.cron_activation.label',
'help' => 'forms.cron.fields.cron_activation.help',
),
),
),
'cron_activation_mode' =>
array (
'model' => 'choice.contracted.single',
'default' => 'URL',
'requirements' =>
array (
0 => 'cron_activation',
),
'validators' =>
array (
'array.in' => 'cron_activation_mode',
),
'view' =>
array (
'data' =>
array (
'choices' => 'cron_activation_mode',
'label' => 'forms.cron.fields.cron_activation_mode.label',
'help' => 'forms.cron.fields.cron_activation_mode.help',
'translate' => true,
),
),
),
),
'view' =>
array (
'data' =>
array (
'validate' => 'misc.forms.default.buttons.save',
),
),
),
'settings_support' =>
array (
'model' => 'basic',
'fields' =>
array (
'behavior_detailed_logs' =>
array (
'model' => 'bool.switch',
'view' =>
array (
'data' =>
array (
'label' => 'forms.settings_support.fields.detailed_logs.label',
'help' => 'forms.settings_support.fields.detailed_logs.help',
),
),
),
),
'view' =>
array (
'data' =>
array (
'validate' => 'misc.forms.default.buttons.save',
),
),
),
'tree_user_contribution_config' =>
array (
'model' => 'basic',
'fields' =>
array (
'tree_user_contribution' =>
array (
'model' => 'bool.switch',
'view' =>
array (
'data' =>
array (
'label' => 'forms.tree_user_contribution_config_form.fields.tree_user_contribution.label',
'help' => 'forms.tree_user_contribution_config_form.fields.tree_user_contribution.help',
),
),
),
),
'view' =>
array (
'data' =>
array (
'validate' => 'misc.forms.default.buttons.save',
),
),
),
'delivery_methods' =>
array (
'model' => 'basic',
'fields' =>
array (
'delivery_methods' =>
array (
'model' => 'choice.double.bool',
'default' =>
array (
),
'view' =>
array (
'data' =>
array (
'horizontal_choices' => 'equivalence',
'vertical_choices' => 'carrier',
'axis' => 'vertical',
'multiple' => false,
'filter' => false,
'radio' => true,
),
),
),
),
'view' =>
array (
'data' =>
array (
'validate' => 'misc.forms.default.buttons.save',
),
),
),
'tree_shipping_address' =>
array (
'model' => 'basic',
'fields' =>
array (
'shipping_address_line_1' =>
array (
'model' => 'string',
'required' => true,
'view' =>
array (
'data' =>
array (
'label' => 'forms.tree_shipping_address.fields.line_1.label',
),
),
),
'shipping_address_line_2' =>
array (
'model' => 'string',
'required' => false,
'view' =>
array (
'data' =>
array (
'label' => 'forms.tree_shipping_address.fields.line_2.label',
),
),
),
'shipping_address_zipcode' =>
array (
'model' => 'string',
'required' => true,
'view' =>
array (
'data' =>
array (
'label' => 'forms.tree_shipping_address.fields.zipcode.label',
),
),
),
'shipping_address_city' =>
array (
'model' => 'string',
'required' => true,
'view' =>
array (
'data' =>
array (
'label' => 'forms.tree_shipping_address.fields.city.label',
),
),
),
'shipping_address_country' =>
array (
'model' => 'choice.contracted.single',
'validators' =>
array (
'array.in' => 'countries',
),
'required' => true,
'view' =>
array (
'data' =>
array (
'choices' => 'countries',
'translate' => true,
'label' => 'forms.tree_shipping_address.fields.country.label',
),
),
),
),
'view' =>
array (
'data' =>
array (
'validate' => 'misc.forms.default.buttons.save',
),
),
),
'tree_bot' =>
array (
'model' => 'basic',
'fields' =>
array (
'tree_bot_color' =>
array (
'model' => 'colorpicker',
'view' =>
array (
'data' =>
array (
'label' => 'forms.tree_bot.fields.tree_bot_color.label',
),
),
),
'tree_bot_displayed' =>
array (
'model' => 'choice.expanded.single',
'format' => 'int',
'view' =>
array (
'data' =>
array (
'choices' =>
array (
0 => 'forms.carbon_bot_config_global.fields.tree_bot_displayed.show',
1 => 'forms.carbon_bot_config_global.fields.tree_bot_displayed.desktop',
2 => 'forms.carbon_bot_config_global.fields.tree_bot_displayed.hidden',
),
'translate' => true,
'label' => 'forms.carbon_bot_config_global.fields.tree_bot_displayed.title',
),
),
),
'tree_bot_side' =>
array (
'model' => 'choice.contracted.single',
'validators' =>
array (
'array.in' =>
array (
0 => 'LEFT',
1 => 'RIGHT',
),
),
'view' =>
array (
'data' =>
array (
'translate' => true,
'choices' =>
array (
'LEFT' => 'forms.tree_bot.fields.tree_bot_side.choices.LEFT',
'RIGHT' => 'forms.tree_bot.fields.tree_bot_side.choices.RIGHT',
),
'label' => 'forms.tree_bot.fields.tree_bot_side.label',
),
),
),
'tree_details_url' =>
array (
'model' => 'string',
'view' =>
array (
'data' =>
array (
'label' => 'forms.tree_bot.fields.tree_details_url.label',
'help' => 'forms.tree_bot.fields.tree_details_url.help',
),
),
),
),
'view' =>
array (
'data' =>
array (
'validate' => 'misc.forms.default.buttons.save',
),
),
),
'green_authentication' =>
array (
'model' => 'basic',
'fields' =>
array (
'client_id' =>
array (
'model' => 'string',
'required' => true,
'view' =>
array (
'data' =>
array (
'label' => 'forms.green_authentication.fields.client_id.label',
),
),
),
'login' =>
array (
'model' => 'string',
'required' => true,
'view' =>
array (
'data' =>
array (
'label' => 'forms.green_authentication.fields.login.label',
),
),
),
'password' =>
array (
'model' => 'string',
'required' => true,
'view' =>
array (
'data' =>
array (
'label' => 'forms.green_authentication.fields.password.label',
),
),
),
),
'view' =>
array (
'data' =>
array (
'validate' => 'misc.forms.default.buttons.save',
),
),
),
),
'default' =>
array (
),
'models' =>
array (
'basic' =>
array (
'view' =>
array (
'name' => 'form',
'data' =>
array (
'attr' =>
array (
'method' => 'post',
),
),
'template' => 'form',
),
),
'multipart' =>
array (
'view' =>
array (
'name' => 'form',
'data' =>
array (
'attr' =>
array (
'method' => 'post',
'enctype' => 'multipart/form-data',
),
),
'template' => 'form',
),
),
),
),
'log' =>
array (
'outputs' =>
array (
'view' =>
array (
'config' =>
array (
'file' => 'log:/view.log',
'format' => '<datetime> | *<type>* | <text>',
),
),
'api' =>
array (
'config' =>
array (
'file' => 'log:/api.log',
'format' => '<datetime> | *<type>* | <text>',
),
),
'default' =>
array (
'config' =>
array (
'file' => 'log:/module.log',
'format' => '<datetime> | *<type>* | <text>',
),
),
),
'archive' =>
array (
'file' =>
array (
'folder' => 'var:/chronicles',
'file' => '<name>_<date>_<time>.zip',
'max_size' => 10485760,
),
),
),
'blocks' =>
array (
'diagnostics' =>
array (
'target' => 'support',
'view' => 'block.diagnostics',
),
'logs' =>
array (
'target' => 'support',
'view' => 'block.logs',
),
'config_form_support' =>
array (
'target' => 'support',
'view' => 'block.standardized.config_form',
'data' =>
array (
'title' => 'blocks.config_form_support.title',
'class' => 'pgblock__max__md',
'name' => 'settings_support',
'action' => 'backoffice.support.save_support_config',
),
),
'cache_reset' =>
array (
'target' => 'support',
'template' => 'cache/block-reset',
'data' =>
array (
'class' => 'pgblock__max__md',
'title' => 'blocks.cache.reset.title',
'description' => 'blocks.cache.reset.description',
),
),
'servers' =>
array (
'target' => 'support',
'view' => 'block.server',
),
'system_module_informations' =>
array (
'target' => 'system',
'action' => 'displayModuleSystemInformations@backoffice.system',
'data' =>
array (
'class' => 'pgblock pgblock__max__xl',
'title' => 'blocks.system.title',
'subtitle' => 'blocks.system.platform.title',
),
),
'system_paths_informations' =>
array (
'target' => 'system',
'view' => 'system.paths',
),
'releases_notes_list' =>
array (
'target' => 'release_note',
'action' => 'displayList@backoffice.release_note',
'data' =>
array (
'class' => 'pgblock__full__xl',
),
),
'cron_tasks' =>
array (
'target' => 'cron',
'action' => 'displayTasks@backoffice.cron',
'data' =>
array (
'class' => 'pgblock__xl',
),
),
'config_form_cron' =>
array (
'target' => 'cron',
'view' => 'block.standardized.config_form',
'data' =>
array (
'title' => 'blocks.config_form_cron.title',
'class' => 'pgblock__max__md',
'name' => 'cron',
'action' => 'backoffice.cron.save_config',
),
),
'cron_control' =>
array (
'target' => 'cron',
'action' => 'displayControl@backoffice.cron',
'data' =>
array (
'class' => 'pgblock__xl',
),
),
'tree_kit_header' =>
array (
'position' => 4,
'target' => 'home',
'action' => 'display@backoffice.tree',
'data' =>
array (
'class' => 'pgblock__max__md pgblock__shadow',
),
),
'tree_account_logout' =>
array (
'target' => 'tree_account',
'template' => 'tree_account/block-logout',
'data' =>
array (
'class' => 'pgblock__max__md pg__danger',
),
'requirements' =>
array (
0 => 'tree_connexion',
),
),
'tree_bot_form' =>
array (
'target' => 'carbon_bot_config',
'action' => 'tree_bot_form.display',
'data' =>
array (
'title' => 'blocks.tree_bot_form.title',
),
'requirements' =>
array (
0 => 'tree_connexion',
),
),
'tree_shipping_address_form' =>
array (
'target' => 'tree_config',
'action' => 'tree_shipping_address.display',
'data' =>
array (
'title' => 'blocks.tree_shipping_address_form.title',
'description' => 'blocks.tree_shipping_address_form.description',
'class' => 'pgblock__max__md',
),
),
'form_tree_translations_management' =>
array (
'target' => 'tree_translations',
'action' => 'tree_translations_form.display',
'data' =>
array (
'class' => 'pgblock pgblock__max__lg',
'title' => 'pages.translations.frontoffice.title',
'description' => 'pages.translations.frontoffice.description',
),
),
'form_tree_bot_translations_management' =>
array (
'target' => 'tree_translations',
'action' => 'tree_bot_translations_form.display',
'data' =>
array (
'class' => 'pgblock pgblock__lg',
'title' => 'blocks.tree_bot_translations_management.title',
'description' => 'pages.translations.frontoffice.description',
),
),
'tree_generate_product_catalog' =>
array (
'target' => 'tree_config',
'action' => 'displayTreeGenerateProductCatalogButton@backoffice.tree_export_product_catalog',
'data' =>
array (
'class' => 'pgblock pgblock__max__sm',
'title' => 'blocks.tree_generate_product_catalog.title',
),
),
'tree_export_product_catalog' =>
array (
'target' => 'tree_config',
'action' => 'displayTreeExportProductCatalogButton@backoffice.tree_export_product_catalog',
'data' =>
array (
'class' => 'pgblock pgblock__max__sm',
'title' => 'blocks.tree_export_product_catalog.title',
),
),
'form_delivery_methods' =>
array (
'target' => 'tree_config',
'action' => 'displayFormDeliveryMethods@backoffice.delivery_methods',
'data' =>
array (
'class' => 'pgblock pgblock__max__lg',
'title' => 'forms.tree_carrier_equivalence.title',
'description' => 'forms.tree_carrier_equivalence.explain',
),
),
'tree_user_contribution' =>
array (
'target' => 'tree_config',
'action' => 'tree_user_contribution_config_form.display',
'data' =>
array (
'title' => 'blocks.tree_user_contribution_config_form.title',
'class' => 'pgblock__md',
),
),
'charity_kit_header' =>
array (
'position' => 5,
'target' => 'home',
'action' => 'display@backoffice.charity',
'data' =>
array (
'class' => 'pgblock__max__md pgblock__shadow',
),
),
'charity_account_logout' =>
array (
'target' => 'charity_account',
'template' => 'charity_account/block-logout',
'data' =>
array (
'class' => 'pgblock__max__md pg__danger',
),
'requirements' =>
array (
0 => 'charity_connexion',
),
),
'charity_partnerships_list' =>
array (
'target' => 'charity_partnerships',
'action' => 'displayList@backoffice.charity_partnerships',
'data' =>
array (
'title' => 'blocks.charity_partnerships_list.title',
'description' => 'blocks.charity_partnerships_list.description',
'class' => 'pgblock__min__xxl',
),
),
'charity_partnerships_disclaimer' =>
array (
'target' => 'charity_partnerships',
'template' => 'charity_partnerships/block-partnerships-disclaimer',
'data' =>
array (
'subtitle' => 'blocks.charity_partnerships_disclaimer.title',
'class' => 'pg_layout pgblock__max__md pg__default',
),
),
'form_charity_translations_block_management' =>
array (
'target' => 'charity_translations',
'action' => 'charity_translations_block_form.display',
'data' =>
array (
'class' => 'pgblock pgblock__max__lg',
'title' => 'pages.charity_translations.block.title',
'description' => 'pages.charity_translations.block.description',
),
),
'form_charity_translations_popin_management' =>
array (
'target' => 'charity_translations',
'action' => 'charity_translations_popin_form.display',
'data' =>
array (
'class' => 'pgblock pgblock__max__lg',
'title' => 'pages.charity_translations.popin.title',
'description' => 'pages.charity_translations.popin.description',
),
),
'green_account_create' =>
array (
'target' => 'home',
'position' => 2,
'template' => 'green_account/block-create',
'data' =>
array (
'class' => 'pgblock__max__lg pgblock__default',
),
'requirements' =>
array (
0 => '!tree_connexion',
1 => '!charity_connexion',
),
),
'green_account_login' =>
array (
'target' => 'home',
'position' => 3,
'action' => 'displayAccountLogin@backoffice.green_account',
'data' =>
array (
'class' => 'pgblock__max__md',
),
'requirements' =>
array (
0 => '!tree_connexion',
1 => '!charity_connexion',
),
),
'green_account_infos' =>
array (
'target' => 'home',
'position' => 6,
'action' => 'displayAccountInfos@backoffice.green_account',
'data' =>
array (
'class' => 'pgblock__max__md',
),
'requirements' =>
array (
0 => 'tree_connexion',
1 => 'charity_connexion',
),
),
),
'smarty' =>
array (
'builder' =>
array (
'service' => 'builder.smarty',
'path' => 'PGWordPress:/_vendors/smarty/libs/Smarty.class.php',
'template_folders' =>
array (
0 => 'templates:/',
),
),
'null_stream' => 'PGI\\Impact\\PGView\\Components\\NullStream',
),
'requirements' =>
array (
'cron_activation' =>
array (
'name' => 'generic.setting',
'config' =>
array (
'setting' => 'cron_activation',
),
),
'shop_context' =>
array (
'name' => 'generic.bridge',
'config' =>
array (
'service' => 'handler.shop',
'method' => 'isShopContext',
),
),
'tree_connexion' =>
array (
'name' => 'generic.bridge',
'config' =>
array (
'service' => 'handler.tree_authentication',
'method' => 'isConnected',
),
),
'tree_activation' =>
array (
'name' => 'generic.setting',
'config' =>
array (
'setting' => 'tree_activation',
),
'requirements' =>
array (
0 => 'tree_connexion',
),
),
'tree_prod_available' =>
array (
'name' => 'generic.bridge',
'config' =>
array (
'service' => 'handler.tree_account',
'method' => 'isMandateSigned',
),
'requirements' =>
array (
0 => 'tree_activation',
),
),
'tree_access_available' =>
array (
'requirements' =>
array (
0 => 'tree_activation',
),
),
'carbon_bot_js' =>
array (
'requirements' =>
array (
0 => 'tree_activation',
),
),
'tree_user_contribution' =>
array (
'name' => 'generic.setting',
'config' =>
array (
'setting' => 'tree_user_contribution',
),
'requirements' =>
array (
0 => 'tree_activation',
),
),
'charity_connexion' =>
array (
'name' => 'generic.bridge',
'config' =>
array (
'service' => 'handler.charity_authentication',
'method' => 'isConnected',
),
),
'charity_activation' =>
array (
'name' => 'generic.setting',
'config' =>
array (
'setting' => 'charity_activation',
),
'requirements' =>
array (
0 => 'charity_connexion',
),
),
'charity_prod_available' =>
array (
'name' => 'generic.bridge',
'config' =>
array (
'service' => 'handler.charity_account',
'method' => 'isMandateSigned',
),
'requirements' =>
array (
0 => 'charity_activation',
),
),
'charity_access_available' =>
array (
'requirements' =>
array (
0 => 'charity_activation',
),
),
),
'data' =>
array (
'cron_activation_mode' =>
array (
'URL' => 'data.cron_activation_mode.url',
'AJAX' => 'data.cron_activation_mode.ajax',
),
'backoffice' =>
array (
'template' => 'backoffice-script',
),
'tree_contribution' =>
array (
'name' => 'Climate contribution',
'reference' => 'pgimpact-climate-contribution',
'image_path' => 'static:/pictures/FOTree/logo-tree-contribution.png',
),
'delivery' =>
array (
'equivalence' =>
array (
0 => 'DEFAULT',
1 => 'SHOP',
2 => 'COLISSIMO',
),
),
'carbon_bot' =>
array (
'carbon_bot_preview' => 'tree/block-tree-preview',
'carbon_bot_preview_js' => '/js/page-tree-preview.js',
'carbon_bot_front' => '/js/climatebot.js',
),
'charity_gift' =>
array (
'name' => 'Charity Gift',
'reference' => 'pgimpact-charity-gift',
'image_path' => 'static:/pictures/FOCharity/logo-charity-kit.png',
),
),
'tasks' =>
array (
'log_zipping_module' =>
array (
'task' => 'log.zipping',
'frequency' => 'P1D',
'tab' => 'global',
),
'log_cleaning' =>
array (
'task' => 'log.cleaning',
'frequency' => 'P7D',
'tab' => 'global',
),
),
'servers' =>
array (
'backoffice' =>
array (
'areas' =>
array (
0 => 'backoffice',
),
'request_builder' => 'builder.request.backoffice',
'deflectors' =>
array (
0 => 'filter.shop_context',
),
'cleaners' =>
array (
'not_found' => 'cleaner.forward.message_page',
'unauthorized_access' => 'cleaner.forward.message_page',
'server_error' => 'cleaner.forward.message_page',
'bad_request' => 'cleaner.forward.message_page',
'rendering_error' => 'cleaner.forward.message_page',
),
'rendering' =>
array (
0 =>
array (
'if' =>
array (
'class' => 'PGI\\Impact\\PGServer\\Components\\Responses\\Template',
),
'do' => 'return',
'with' => 'renderer.processor.output_template',
),
1 =>
array (
'if' =>
array (
'instance' => 'PGI\\Impact\\PGServer\\Components\\Responses\\PaygreenModule',
),
'do' => 'continue',
'with' => 'renderer.transformer.paygreen_module_2_array',
),
2 =>
array (
'if' =>
array (
'instance' => 'PGI\\Impact\\PGServer\\Components\\Responses\\Collection',
),
'do' => 'continue',
'with' => 'renderer.transformer.array_2_http',
),
3 =>
array (
'if' =>
array (
'class' => 'PGI\\Impact\\PGServer\\Components\\Responses\\File',
),
'do' => 'continue',
'with' => 'renderer.transformer.file_2_http',
),
4 =>
array (
'if' =>
array (
'instance' => 'PGI\\Impact\\PGServer\\Components\\Responses\\Redirection',
),
'do' => 'continue',
'with' => 'renderer.transformer.redirection_2_http',
),
5 =>
array (
'if' =>
array (
'class' => 'PGI\\Impact\\PGServer\\Components\\Responses\\HTTP',
),
'do' => 'stop',
'with' => 'renderer.processor.write_http',
),
),
),
'front' =>
array (
'areas' =>
array (
0 => 'front',
),
'request_builder' => 'builder.request.frontoffice',
'cleaners' =>
array (
'not_found' => 'cleaner.basic_http.not_found',
'unauthorized_access' => 'cleaner.basic_http.unauthorized_access',
'server_error' => 'cleaner.basic_http.server_error',
'bad_request' => 'cleaner.basic_http.bad_request',
'rendering_error' => 'cleaner.basic_http.server_error',
),
'rendering' =>
array (
0 =>
array (
'if' =>
array (
'class' => 'PGI\\Impact\\PGServer\\Components\\Responses\\Template',
),
'do' => 'return',
'with' => 'renderer.processor.output_template',
),
1 =>
array (
'if' =>
array (
'instance' => 'PGI\\Impact\\PGServer\\Components\\Responses\\PaygreenModule',
),
'do' => 'continue',
'with' => 'renderer.transformer.paygreen_module_2_array',
),
2 =>
array (
'if' =>
array (
'instance' => 'PGI\\Impact\\PGServer\\Components\\Responses\\Collection',
),
'do' => 'continue',
'with' => 'renderer.transformer.array_2_http',
),
3 =>
array (
'if' =>
array (
'instance' => 'PGI\\Impact\\PGServer\\Components\\Responses\\File',
),
'do' => 'continue',
'with' => 'renderer.transformer.file_2_http',
),
4 =>
array (
'if' =>
array (
'instance' => 'PGI\\Impact\\PGServer\\Components\\Responses\\Redirection',
),
'do' => 'continue',
'with' => 'renderer.transformer.redirection_2_http',
),
5 =>
array (
'if' =>
array (
'instance' => 'PGI\\Impact\\PGServer\\Components\\Responses\\HTTP',
),
'do' => 'stop',
'with' => 'renderer.processor.write_http',
),
),
),
),
'menu' =>
array (
'shop_selector' => false,
'entries' =>
array (
'home' =>
array (
'action' => 'backoffice.home.display',
'name' => 'pages.home.name',
'title' => 'pages.home.title',
),
'payment' =>
array (
'name' => 'menu.payment.name',
'title' => 'menu.payment.title',
'children' =>
array (
),
),
'tree' =>
array (
'name' => 'menu.tree.name',
'title' => 'menu.tree.title',
'children' =>
array (
'carbon_bot_config' =>
array (
'action' => 'backoffice.carbon_bot_config.display',
'name' => 'pages.carbon_bot_config.name',
'title' => 'pages.carbon_bot_config.title',
),
'tree_config' =>
array (
'action' => 'backoffice.tree_config.display',
'name' => 'pages.tree_config.name',
'title' => 'pages.tree_config.title',
),
'tree_translations' =>
array (
'action' => 'backoffice.tree_translations.display',
'name' => 'pages.translations.name',
'title' => 'pages.translations.title',
),
),
),
'charity' =>
array (
'children' =>
array (
'charity_partnerships' =>
array (
'action' => 'backoffice.charity_partnerships.display',
'name' => 'pages.charity_partnerships.name',
'title' => 'pages.charity_partnerships.title',
),
'charity_translations' =>
array (
'action' => 'backoffice.charity_translations.display',
'name' => 'pages.charity_translations.name',
'title' => 'pages.charity_translations.title',
),
),
'name' => 'menu.charity.name',
'title' => 'menu.charity.title',
),
'config' =>
array (
'name' => 'menu.config.name',
'title' => 'menu.config.title',
'children' =>
array (
'cron' =>
array (
'action' => 'backoffice.cron.display',
'name' => 'pages.cron.name',
'title' => 'pages.cron.title',
),
),
),
'help' =>
array (
'name' => 'menu.help.name',
'title' => 'menu.help.title',
'children' =>
array (
'system' =>
array (
'action' => 'backoffice.system.display',
'name' => 'pages.system.name',
'title' => 'pages.system.title',
),
'support' =>
array (
'action' => 'backoffice.support.display',
'name' => 'pages.support.name',
'title' => 'pages.support.title',
),
'release_note' =>
array (
'action' => 'backoffice.release_note.display',
'name' => 'pages.release_note.name',
'title' => 'pages.release_note.title',
'enabled' => false,
),
),
),
'error' =>
array (
'title' => 'pages.error.title',
),
),
),
'catalog_export' =>
array (
'excluded_products' =>
array (
0 => 'paygreen-climate-contribution',
1 => 'paygreen-charity-gift',
2 => 'pgimpact-charity-gift',
3 => 'pgimpact-climate-contribution',
),
),
'api' =>
array (
'tree' =>
array (
'clients' =>
array (
'curl' =>
array (
'allow_redirection' => true,
'verify_peer' => true,
'verify_host' => 2,
'timeout' => 30,
'http_version' => '1.1',
),
),
'requests' =>
array (
'oauth_access' =>
array (
'method' => 'POST',
'url' => '{host}/login',
'private' => false,
'validity' => '200,400,401',
),
'oauth_refresh_access' =>
array (
'method' => 'POST',
'url' => '{host}/login',
'private' => false,
'validity' => '200,400',
),
'get_account_infos' =>
array (
'method' => 'GET',
'url' => '{host}/account/{account_id}',
'private' => true,
),
'get_user_data' =>
array (
'method' => 'GET',
'url' => '{host}/account/{account_id}/user/{username}',
'private' => true,
),
'get_all_users' =>
array (
'method' => 'GET',
'url' => '{host}/account/{account_id}/user',
'private' => true,
),
'get_user' =>
array (
'method' => 'GET',
'url' => '{host}/account/{account_id}/user/{username}',
'private' => true,
),
'create_user' =>
array (
'method' => 'POST',
'url' => '{host}/account/{account_id}/user',
'private' => true,
),
'update_user' =>
array (
'method' => 'PATCH',
'url' => '{host}/account/{account_id}/user/{username}',
'private' => true,
),
'delete_user' =>
array (
'method' => 'DELETE',
'url' => '{host}/account/{account_id}/user/{username}',
'private' => true,
),
'get_ccarbon_transports_mode' =>
array (
'method' => 'GET',
'url' => '{host}/carbon/transportation-mode',
'private' => true,
),
'add_web_carbon_emission' =>
array (
'method' => 'POST',
'url' => '{host}/carbon/web',
'private' => true,
),
'add_transportation_carbon_emission' =>
array (
'method' => 'POST',
'url' => '{host}/carbon/footprints/{fingerprint}/delivery',
'private' => true,
),
'remove_transportation_carbon_emission' =>
array (
'method' => 'DELETE',
'url' => '{host}/carbon/footprints/{fingerprint}/delivery',
'private' => true,
'validity' => '204',
),
'get_all_carbon_footprints' =>
array (
'method' => 'GET',
'url' => '{host}/carbon/footprints',
'private' => true,
),
'create_carbon_footprints' =>
array (
'method' => 'POST',
'url' => '{host}/carbon/footprints',
'private' => true,
'validity' => '201',
),
'get_carbon_footprint_estimation' =>
array (
'method' => 'GET',
'url' => '{host}/carbon/footprints/{fingerprint}?detailed={detailed}',
'private' => true,
),
'update_carbon_footprint_status' =>
array (
'method' => 'PATCH',
'url' => '{host}/carbon/footprints/{fingerprint}',
'private' => true,
),
'get_all_carbon_purchases' =>
array (
'method' => 'GET',
'url' => '{host}/carbon/purchases',
'private' => true,
),
'get_carbon_purchase' =>
array (
'method' => 'GET',
'url' => '{host}/carbon/purchases/{fingerprint}',
'private' => true,
),
'get_carbon_statistics_report' =>
array (
'method' => 'GET',
'url' => '{host}/carbon/statistics/report',
'private' => true,
),
'export_product_catalog' =>
array (
'method' => 'POST',
'url' => '{host}/carbon/products/catalog',
'private' => true,
'class' => 'PGI\\Impact\\PGClient\\Components\\Response',
),
'create_product_reference' =>
array (
'method' => 'POST',
'url' => '{host}/carbon/products/references',
'private' => true,
),
'add_product_carbon_emission' =>
array (
'method' => 'POST',
'url' => '{host}/carbon/footprints/{idFootprint}/products',
'private' => true,
),
'add_products_carbon_emission' =>
array (
'method' => 'POST',
'url' => '{host}/carbon/footprints/{idFootprint}/product-cart',
'private' => true,
),
'delete_product_carbon_emission' =>
array (
'method' => 'DELETE',
'url' => '{host}/carbon/footprints/{idFootprint}/products',
'private' => true,
'validity' => '204',
),
'get_favorite_project' =>
array (
'method' => 'GET',
'url' => '{host}/carbon/public/projects?idUser={idUser}',
'private' => false,
),
'get_temporary_token' =>
array (
'method' => 'GET',
'url' => '{host}/tokens/footprint/{idFootprint}',
'private' => true,
),
'reserve_carbon' =>
array (
'method' => 'POST',
'url' => '{host}/carbon/footprints/{idFootprint}/contribution',
'private' => true,
),
),
'responses' =>
array (
'class' => 'PGI\\Impact\\PGClient\\Components\\ResponseJSON',
'validity' => '200-299',
),
),
'charity' =>
array (
'responses' =>
array (
'class' => 'PGI\\Impact\\PGClient\\Components\\ResponseJSON',
'validity' => '200-299',
),
'clients' =>
array (
'curl' =>
array (
'allow_redirection' => true,
'verify_peer' => true,
'verify_host' => 2,
'timeout' => 30,
'http_version' => '1.1',
),
),
'requests' =>
array (
'oauth_access' =>
array (
'method' => 'POST',
'url' => '{host}/login',
'private' => false,
'validity' => '200,400,401',
),
'oauth_refresh_access' =>
array (
'method' => 'POST',
'url' => '{host}/login',
'private' => false,
'validity' => '200,400',
),
'get_account_infos' =>
array (
'method' => 'GET',
'url' => '{host}/account/{account_id}',
'private' => true,
),
'get_user_data' =>
array (
'method' => 'GET',
'url' => '{host}/account/{account_id}/user/{username}',
'private' => true,
),
'list_available_associations' =>
array (
'method' => 'GET',
'url' => '{host}/association',
'private' => true,
),
'get_association' =>
array (
'method' => 'GET',
'url' => '{host}/association/{association_id}',
'private' => true,
),
'list_partnerships' =>
array (
'method' => 'GET',
'url' => '{host}/partnership',
'private' => true,
),
'get_partnership' =>
array (
'method' => 'GET',
'url' => '{host}/partnership/{partnership_id}',
'private' => true,
),
'request_partnership' =>
array (
'method' => 'POST',
'url' => '{host}/partnership',
'private' => true,
),
'cancel_partnership' =>
array (
'method' => 'DELETE',
'url' => '{host}/partnership/{partnership_id}',
'private' => true,
),
'update_partnership' =>
array (
'method' => 'PUT',
'url' => '{host}/partnership/{partnership_id}',
'private' => true,
),
'list_partnership_groups' =>
array (
'method' => 'GET',
'url' => '{host}/partnership-group',
'private' => true,
),
'get_partnership_group' =>
array (
'method' => 'GET',
'url' => '{host}/partnership-group/{external_id}',
'private' => true,
),
'get_partnership_default_group' =>
array (
'method' => 'GET',
'url' => '{host}/partnership-group?isDefault=1',
'private' => true,
),
'create_partnership_group' =>
array (
'method' => 'POST',
'url' => '{host}/partnership-group',
'private' => true,
),
'cancel_partnership_group' =>
array (
'method' => 'DELETE',
'url' => '{host}/partnership-group/{external_id}',
'private' => true,
),
'update_partnership_group' =>
array (
'method' => 'PUT',
'url' => '{host}/partnership-group/{external_id}',
'private' => true,
),
'list_partnership_group_rules' =>
array (
'method' => 'GET',
'url' => '{host}/partnership-group-rule',
'private' => true,
),
'get_partnership_group_rule' =>
array (
'method' => 'GET',
'url' => '{host}/partnership-group-rule/{partnership_group_rule_id}',
'private' => true,
),
'create_partnership_group_rule' =>
array (
'method' => 'POST',
'url' => '{host}/partnership-group-rule',
'private' => true,
),
'deactivate_partnership_group_rule' =>
array (
'method' => 'DELETE',
'url' => '{host}/partnership-group-rule/{partnership_group_rule_id}',
'private' => true,
),
'get_current_partnership_group_rule' =>
array (
'method' => 'GET',
'url' => '{host}/partnership-group-rule-current',
'private' => true,
),
'list_donations' =>
array (
'method' => 'GET',
'url' => '{host}/donation',
'private' => true,
),
'get_donation' =>
array (
'method' => 'GET',
'url' => '{host}/donation/{donation_id}',
'private' => true,
),
'create_donation' =>
array (
'method' => 'POST',
'url' => '{host}/donation',
'private' => true,
),
'refund_donation' =>
array (
'method' => 'DELETE',
'url' => '{host}/donation/{donation_id}',
'private' => true,
),
'fulfill_pledged_donation' =>
array (
'method' => 'PATCH',
'url' => '{host}/donation/{donation_id}',
'private' => true,
),
'list_donations_history' =>
array (
'method' => 'GET',
'url' => '{host}/history/user-donation',
'private' => true,
),
'list_donation_displays' =>
array (
'method' => 'GET',
'url' => '{host}/donation-display',
'private' => true,
),
'record_donation_display' =>
array (
'method' => 'POST',
'url' => '{host}/donation-display',
'private' => true,
),
'get_donation_display' =>
array (
'method' => 'GET',
'url' => '{host}/donation-display/{donation_display_id}',
'private' => true,
),
'get_donation_report' =>
array (
'method' => 'GET',
'url' => '{host}/donation/statistics/reports',
'private' => true,
),
'round_up_number' =>
array (
'method' => 'POST',
'url' => '{host}/calc/round-up',
'private' => true,
),
),
),
),
'urls' =>
array (
'climatekit' =>
array (
'PROD' => 'solidaire.paygreen.fr',
'SANDBOX' => 'sb-api-climatekit.paygreen.fr',
'RECETTE' => 'rc-api-climatekit.paygreen.fr',
),
'bo_climatekit' =>
array (
'PROD' => 'climatekit.paygreen.fr',
'SANDBOX' => 'sb-climatekit.paygreen.fr',
'RECETTE' => 'rc-climatekit.paygreen.fr',
),
'charitykit' =>
array (
'PROD' => 'solidaire.paygreen.fr',
'SANDBOX' => 'sb-api-climatekit.paygreen.fr',
'RECETTE' => 'rc-api-climatekit.paygreen.fr',
),
'bo_charitykit' =>
array (
'PROD' => 'charitykit.paygreen.fr',
'SANDBOX' => 'sb-charitykit.paygreen.fr',
'RECETTE' => 'rc-charitykit.paygreen.fr',
),
),
'cms' =>
array (
'admin' =>
array (
'menu' =>
array (
'code' => 'pgimpact-backoffice',
'title' => 'Impact',
'icon' => 'dashicons-admin-site',
),
),
),
'wp' =>
array (
'hooks' =>
array (
0 =>
array (
'filter' => 'admin_menu',
'hook' => 'admin.menu',
'method' => 'display',
),
1 =>
array (
'filter' => 'wp',
'hook' => 'static_files',
'method' => 'register',
),
2 =>
array (
'filter' => 'frontpage_template',
'hook' => 'filter.template',
'priority' => '${PHP_INT_MAX}',
),
3 =>
array (
'filter' => 'template_include',
'hook' => 'filter.template',
'priority' => '${PHP_INT_MAX}',
),
4 =>
array (
'filter' => 'wp_footer',
'hook' => 'insert.footer',
'method' => 'insertIntoFooter',
'priority' => 11,
),
5 =>
array (
'filter' => 'plugins_loaded',
'hook' => 'order_state',
'method' => 'register',
),
6 =>
array (
'filter' => 'wc_order_statuses',
'hook' => 'order_state',
'method' => 'addOrderStates',
'direct' => true,
),
7 =>
array (
'filter' => 'woocommerce_before_thankyou',
'hook' => 'order_confirmation',
'method' => 'displayOrderConfirmationBlock',
),
8 =>
array (
'filter' => 'woocommerce_thankyou',
'hook' => 'order_confirmation',
'method' => 'displayOrderConfirmationBlock',
),
9 =>
array (
'filter' => 'woocommerce_payment_complete',
'hook' => 'local.order.validation',
'method' => 'sendLocalOrderValidationEvent',
),
10 =>
array (
'filter' => 'woocommerce_order_status_changed',
'hook' => 'order_state_update',
'method' => 'validateLocalOrder',
'args' => 3,
),
11 =>
array (
'filter' => 'woocommerce_before_checkout_form',
'hook' => 'display_front_funnel_checkout',
'method' => 'displayFrontFunnelCheckout',
),
12 =>
array (
'filter' => 'paygreen_clean_contribution_variations',
'hook' => 'clean_contribution_variations',
'method' => 'cleanContributionVariations',
),
13 =>
array (
'filter' => 'paygreen_clean_gift_variations',
'hook' => 'clean_gift_variations',
'method' => 'cleanGiftVariations',
),
),
),
'order' =>
array (
'states' =>
array (
),
),
);
