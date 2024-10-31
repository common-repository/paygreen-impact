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

namespace PGI\Impact\BOModule\Foundations\Blocks;

use PGI\Impact\PGView\Components\Box as BoxComponent;
use PGI\Impact\PGView\Services\View;

/**
 * Class AbstractStandardizedBlock
 * @package BOModule\Foundations\Blocks
 */
abstract class AbstractStandardizedBlock extends View
{
    /**
     * AbstractStandardizedBlock constructor.
     */
    public function __construct()
    {
        $this->setTemplate('blocks/layout');
    }

    /**
     * @return array
     */
    public function getData()
    {
        $data = parent::getData();

        $data['content'] = $this->buildContent($data);

        return $data;
    }

    /**
     * @param array $data
     * @return BoxComponent
     */
    abstract protected function buildContent(array $data);
}
