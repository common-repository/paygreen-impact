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

namespace PGI\Impact\BOModule\Services\Views\Blocks;

use PGI\Impact\PGModule\Services\Handlers\DiagnosticHandler;
use PGI\Impact\PGView\Services\View;
use Exception;

/**
 * Class DiagnosticBlockView
 * @package BOModule\Services\Views\Blocks
 */
class DiagnosticBlockView extends View
{
    /** @var DiagnosticHandler */
    private $diagnosticHandler;

    private $hasInvalidDiagnostic = false;

    /**
     * @param DiagnosticHandler $diagnosticHandler
     */
    public function __construct(DiagnosticHandler $diagnosticHandler)
    {
        $this->diagnosticHandler = $diagnosticHandler;

        $this->setTemplate('blocks/diagnostics');
    }

    /**
     * @return array
     * @throws Exception
     */
    public function getData()
    {
        $data = parent::getData();

        $data['results'] = $this->buildDiagnosticList();
        $data['hasInvalidDiagnostic'] = $this->hasInvalidDiagnostic;

        return $data;
    }

    /**
     * @return array
     * @throws Exception
     */
    protected function buildDiagnosticList()
    {
        $names = $this->diagnosticHandler->getDiagnosticNames();

        $results = array();

        foreach ($names as $name) {
            $diagnostic = $this->diagnosticHandler->getDiagnostic($name);

            $isValid =  $diagnostic->isValid();

            if (!$isValid) {
                $this->hasInvalidDiagnostic = true;
            }

            $results[] = array(
                'name' => $name,
                'test' => $isValid
            );
        }

        return $results;
    }
}
