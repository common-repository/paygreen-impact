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

    <div class="pgdiv_flex_row pg_justify_content_between pg_align_items-flex_start pgclimate_home_block">
        <h2 class="pgblock__shadow__title pg__mtop-md">
            {'blocks.tree.title'|pgtrans}
        </h2>
    </div>
    <article>
    {if $treeActivated == true }

        {if
            $treeKitInfos['is_mandate_signed'] == false &&
            $treeKitInfos['is_test_mode_expired']
        }
            {'misc.tree_account.notifications.test_mode.expired'|pgtrans}
        {elseif
            $treeKitInfos['is_mandate_signed'] == false
        }
            {'misc.tree_account.notifications.mandate.unsigned'|pgtrans}
        {else}
            {include
            file="toggle.tpl"
            title="blocks.tree_mode.title"
            description=$description
            action="backoffice.tree_test_mode.activation"
            active=!$treeKitInfos["is_test_mode_activated"]}
        {/if}
        {if $addressNeeded == true }
            <div class="pgblock pg__success_container">
                <p>
                    {'blocks.tree.shipping_address.text1'|pgtrans}
                    <a href="{'backoffice.tree_config.display'|toback}">
                        {'blocks.tree.shipping_address.link'|pgtrans}
                    </a>
                    {'blocks.tree.shipping_address.text2'|pgtrans}
                </p>
            </div>
        {/if}
        <div class="pgblock pg__danger_container">
            {include file="tree_account/block-logout.tpl"}
        </div>
    {else}
        <ul>
            <li>
                {'blocks.tree.text1'|pgtrans}
            </li>
            <li class="pg__mtop">
                {'blocks.tree.text2'|pgtrans}
            </li>
            <li class="pg__mtop">
                {'blocks.tree.text3'|pgtrans}
            </li>
        </ul>
        {if $connected == true }
        <div class="pgdiv_flex_row">
            <div class="pgbutton__container">
                <a
                        target="_blank"
                        href="https://charitykit.paygreen.fr/user/spaces"
                        class="pgbutton pg__default"
                >
                    {'blocks.tree.activate'|pgtrans}
                </a>
            </div>
            <div class="pgbutton__container">
                <a
                        href="{'backoffice.tree_account.connect'|toback}"
                        class="pgbutton pg__success"
                >
                    {'blocks.tree.connect'|pgtrans}
                </a>
            </div>
        </div>
        <p>
            {'blocks.tree.description'|pgtrans}
        </p>
        {else}
            <div class="pgbutton__container pg__mtop-lg">
                <a
                        target="_blank"
                        href="https://www.paygreen.io/climatekit/"
                        class="pgbutton pg__default"
                >
                    {'blocks.tree.learnmore'|pgtrans}
                </a>
            </div>
        {/if}
    {/if}
    </article>