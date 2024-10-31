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
<div data-paygreen-carbon-bot="personalize"></div>
<div class="pgclimatebot__banner" data-paygreen-carbon-banner></div>

<script src="https://carbonbot.paygreen.fr/1.2/carbon-bot.js"></script>

<script>
    carbonBot.init({
        endpoint: null,
        showDemoData: true,
        bot: {
            position: "inline",
            colors: {
                primary: "{$color}",
            },
            engagementLink: "{$detailsUrl|escape:'html':'UTF-8'}",
            shopName: "Ma boutique",
        },
        banner: {
            addContributionAction: "#",
            removeContributionAction: "#",
            hasContributionInCart: true,
            displayed: true,
        },
        translations: {
            "en": {
                title: {$title},
                engagementDescription: {$description},
                offset: {$offset},
            },
            "fr": {
                title: {$title},
                engagementDescription: {$description},
                offset: {$offset},
            }
        },
    });

    window.carbonBot = carbonBot;

</script>
