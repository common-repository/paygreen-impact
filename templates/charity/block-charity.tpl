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

<div class="pgdiv_flex_row pg_justify_content_between pg_align_items-flex_start pgcharity_home_block">
    <h2 class="pgblock__shadow__title pg__mtop-md">
        {'blocks.charity.title'|pgtrans}
    </h2>
</div>
<article>
    {if $charityActivated == true }

        {if
            $charityKitInfos['is_mandate_signed'] == false &&
            $charityKitInfos['is_test_mode_expired']
        }
            {'misc.charity_account.notifications.test_mode.expired'|pgtrans}
        {elseif
            $charityKitInfos['is_mandate_signed'] == false
        }
            {'misc.charity_account.notifications.mandate.unsigned'|pgtrans}
        {else}
            {include
            file="toggle.tpl"
            title="blocks.charity_mode.title"
            description=$description
            action="backoffice.charity_test_mode.activation"
            active=!$charityKitInfos["is_test_mode_activated"]}
        {/if}
        <div class="pgblock pg__success_container">
            <p>
            <div class="pgbutton__container">
                <a
                        target="_blank"
                        href="https://charitykit.paygreen.fr/login"
                        class="pgbutton pg__default"
                >
                    {'blocks.charity.space'|pgtrans}
                </a>
            </div>
            <p>
                {'blocks.charity.space_description'|pgtrans}
            </p>
        </div>
        <div class="pgblock pg__danger_container">
            {include file="charity_account/block-logout.tpl"}
        </div>
    {else}
        <ul>
            <li>
                {'blocks.charity.text1'|pgtrans}
            </li>
            <li class="pg__mtop">
                {'blocks.charity.text2'|pgtrans}
            </li>
            <li class="pg__mtop">
                {'blocks.charity.text3'|pgtrans}
            </li>
        </ul>
        {if $connected == true }
            <div class="pgdiv_flex_row">
                <div class="pgbutton__container">
                    <a
                            target="_blank"
                            href="https://climatekit.paygreen.fr/user/spaces"
                            class="pgbutton pg__default"
                    >
                        {'blocks.charity.activate'|pgtrans}
                    </a>
                </div>
                <div class="pgbutton__container">
                    <a
                            href="{'backoffice.charity_account.connect'|toback}"
                            class="pgbutton pg__success"
                    >
                        {'blocks.charity.connect'|pgtrans}
                    </a>
                </div>
            </div>
            <p>
                {'blocks.charity.description'|pgtrans}
            </p>
        {else}
            <div class="pgbutton__container pg__mtop-lg">
                <a
                        target="_blank"
                        href="https://www.paygreen.io/arrondi-en-ligne/"
                        class="pgbutton pg__default"
                >
                    {'blocks.charity.learnmore'|pgtrans}
                </a>
            </div>
        {/if}
    {/if}
</article>