{*
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
 *}
<div class="pgdiv_flex_column">
    <p>{"blocks.tree_export_product_catalog.buttons.file_export.description"|pgtranslines}</p>

    <div class="pgtreeexport__button pgbutton__container {if ($empty_cache)}pgbutton__hidden{/if}">
        <a
            href="{'backoffice.tree_config.download_product_catalog'|toback}"
            class="pgbutton"
        >
            {'blocks.tree_export_product_catalog.buttons.file_export.label'|pgtrans}
        </a>
    </div>
    {if ($tree_access_available)}
        <div class="pgtreeexport__button {if ($empty_cache)}pgbutton__hidden{/if}">
            <p>{"blocks.tree_export_product_catalog.buttons.send.description"|pgtranslines}</p>

            <div class="pgbutton__container">
                <a
                        href="{'backoffice.tree_config.export_product_catalog'|toback}"
                        class="pgbutton"
                >
                    {'blocks.tree_export_product_catalog.buttons.send.label'|pgtrans}
                </a>
            </div>
        </div>
    {/if}
</div>

