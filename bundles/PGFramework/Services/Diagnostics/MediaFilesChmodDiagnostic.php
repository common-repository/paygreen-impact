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

namespace PGI\Impact\PGFramework\Services\Diagnostics;

use PGI\Impact\PGFramework\Foundations\AbstractDiagnostic;
use PGI\Impact\PGFramework\Services\Handlers\PictureHandler;
use PGI\Impact\PGFramework\Tools\SystemFile as SystemFileTool;
use PGI\Impact\PGSystem\Services\Pathfinder;
use Exception;

/**
 * Class MediaFilesChmodDiagnostic
 * @package PGFramework\Services\Diagnostics
 */
class MediaFilesChmodDiagnostic extends AbstractDiagnostic
{
    /** @var Pathfinder */
    private $pathfinder;

    public function __construct(Pathfinder $pathfinder)
    {
        $this->pathfinder = $pathfinder;
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function isValid()
    {
        return (!$this->isFolderExists() || $this->isFilesChmodIsValid());
    }

    /**
     * @return bool
     * @throws Exception
     */
    protected function isFolderExists()
    {
        $path = $this->getMediaPath();

        return (file_exists($path) && is_dir($path));
    }

    /**
     * @return bool
     * @throws Exception
     */
    protected function isFilesChmodIsValid()
    {
        $this->requirements();

        $folder = $this->getMediaPath();
        $files = scandir($folder);

        $result = true;

        if ($files) {
            foreach ($files as $file) {
                $path = $folder . DIRECTORY_SEPARATOR . $file;

                if (!is_dir($path)) {
                    $chmod = SystemFileTool::getChmod($path);

                    if ($chmod !== PictureHandler::MEDIA_FILE_CHMOD) {
                        $result = false;
                    }
                }
            }
        }

        return $result;
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function resolve()
    {
        $this->requirements();

        $folder = $this->getMediaPath();
        $files = scandir($folder);

        $result = true;

        if ($files) {
            foreach ($files as $file) {
                $path = $folder . DIRECTORY_SEPARATOR . $file;

                if (!is_dir($path)) {
                    $chmodFile = SystemFileTool::getChmod($path);
                    $chmodConfig = PictureHandler::MEDIA_FILE_CHMOD;

                    if (($chmodFile !== $chmodConfig) && !chmod($path, $chmodConfig)) {
                        $result = false;
                    }
                }
            }
        }

        return $result;
    }

    /**
     * @return string
     * @throws Exception
     */
    protected function getMediaPath()
    {
        return $this->pathfinder->toAbsolutePath('media');
    }

    /**
     * @throws Exception
     */
    private function requirements()
    {
        $path = $this->getMediaPath();

        if (!is_dir($path)) {
            throw new Exception("PayGreen media folder not found: $path");
        }
    }
}
