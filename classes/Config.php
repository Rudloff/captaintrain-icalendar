<?php
/**
 * Config class
 *
 * PHP version 5.6
 *
 * @category CaptainTrainIcalendar
 * @package  CaptainTrainIcalendar
 * @author   Pierre Rudloff <contact@rudloff.pro>
 * @license  GPL https://www.gnu.org/licenses/gpl.html
 * @link     https://github.com/Rudloff/captaintrain-icalendar
 */
namespace CaptainTrainIcalendar;
use Symfony\Component\Yaml\Yaml;
/**
 * Manage configuration
 *
 * PHP version 5.6
 *
 * @category CaptainTrainIcalendar
 * @package  CaptainTrainIcalendar
 * @author   Pierre Rudloff <contact@rudloff.pro>
 * @license  GPL https://www.gnu.org/licenses/gpl.html
 * @link     https://github.com/Rudloff/captaintrain-icalendar
 */
Class Config
{
    private static $_instance;

    public $email = '';
    public $password = '';

    /**
     * Config constructor
     */
    private function __construct()
    {
        $yaml = Yaml::parse(__DIR__.'/../config.yml');
        if (isset($yaml) && is_array($yaml)) {
            foreach ($yaml as $param=>$value) {
                if (isset($this->$param)) {
                    $this->$param = $value;
                }
            }
        }
    }

    /**
     * Get singleton instance
     * @return Config
     */
    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new Config();
        }
        return self::$_instance;
    }
}
