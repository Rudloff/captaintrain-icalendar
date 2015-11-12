<?php
/**
 * Export iCalendar feed with Captain Train trips
 *
 * PHP version 5.6
 *
 * @category CaptainTrainIcalendar
 * @package  CaptainTrainIcalendar
 * @author   Pierre Rudloff <contact@rudloff.pro>
 * @license  GPL https://www.gnu.org/licenses/gpl.html
 * @link     https://github.com/Rudloff/captaintrain-icalendar
 */
require_once 'vendor/autoload.php';
use CaptainTrainIcalendar\Config;
use Eluceo\iCal\Component\Calendar;
use Eluceo\iCal\Component\Event;

$config = Config::getInstance();
$session = new \CaptainTrain\Session($config->email, $config->password);
$vCalendar = new Calendar('captaintrain-icalendar');
foreach ($session->getTrips() as $trip) {
    $vEvent = new Event();
    $vEvent
        ->setDtStart($trip->departureDate)
        ->setDtEnd($trip->arrivalDate)
        ->setSummary(
            $trip->departureStation->name.' - '.$trip->arrivalStation->name
        );
    $vCalendar->addComponent($vEvent);
}
header('Content-Type: text/calendar');
echo $vCalendar->render();
