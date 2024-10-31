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

/**
 * MySQL Resource
 * Resource Implementation based on the Custom API to use
 * MySQL as the storage resource for Smarty's templates and configs.
 * Note that this MySQL implementation fetches the source and timestamps in
 * a single database query, instead of two separate like resource.mysql.php does.
 * Table definition:
 * <pre>CREATE TABLE IF NOT EXISTS `templates` (
 *   `name` varchar(100) NOT NULL,
 *   `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 *   `source` text,
 *   PRIMARY KEY (`name`)
 * ) ENGINE=InnoDB DEFAULT CHARSET=utf8;</pre>
 * Demo data:
 * <pre>INSERT INTO `templates` (`name`, `modified`, `source`) VALUES ('test.tpl', "2010-12-25 22:00:00", '{$x="hello
 * world"}{$x}');</pre>
 *
 *
 * @package Resource-examples
 * @author  Rodney Rehm
 */
class Smarty_Resource_Mysqls extends Smarty_Resource_Custom
{
    /**
     * PDO instance
     *
     * @var \PDO
     */
    protected $db;

    /**
     * prepared fetch() statement
     *
     * @var \PDOStatement
     */
    protected $fetch;

    /**
     * Smarty_Resource_Mysqls constructor.
     *
     * @throws \SmartyException
     */
    public function __construct()
    {
        try {
            $this->db = new PDO("mysql:dbname=test;host=127.0.0.1", "smarty");
        } catch (PDOException $e) {
            throw new SmartyException('Mysql Resource failed: ' . $e->getMessage());
        }
        $this->fetch = $this->db->prepare('SELECT modified, source FROM templates WHERE name = :name');
    }

    /**
     * Fetch a template and its modification time from database
     *
     * @param string  $name   template name
     * @param string  $source template source
     * @param integer $mtime  template modification timestamp (epoch)
     *
     * @return void
     */
    protected function fetch($name, &$source, &$mtime)
    {
        $this->fetch->execute(array('name' => $name));
        $row = $this->fetch->fetch();
        $this->fetch->closeCursor();
        if ($row) {
            $source = $row[ 'source' ];
            $mtime = strtotime($row[ 'modified' ]);
        } else {
            $source = null;
            $mtime = null;
        }
    }
}