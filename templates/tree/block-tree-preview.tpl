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
<div class="pgdiv_flex_row">
    <div class="pgblock__max__sm">
        <div class="pg__mbottom-lg">
            {$form}
        </div>

        <div class="pgblock pg__default">
            <p>
                Pour modifier les textes du CarbonBot, rendez-vous sur la page
                <a href="{'backoffice.tree_translations.display'|toback}">
                    Textes et traductions
                </a>
            </p>

        </div>

    </div>
    <div class="pg__mleft-lg" style="min-width: 475px; min-height: 661px">
        {include
            file="tree-bot.tpl"
            attr=[
            'color' => $color,
            'detailsUrl' => $detailsUrl,
            'title' => $title,
            'description' => $description,
            'offset' => $offset]
        }
    </div>
</div>