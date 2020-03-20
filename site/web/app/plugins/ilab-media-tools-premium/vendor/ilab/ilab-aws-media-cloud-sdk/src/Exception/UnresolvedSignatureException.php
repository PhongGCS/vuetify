<?php
namespace ILABAmazon\Exception;

use ILABAmazon\HasMonitoringEventsTrait;
use ILABAmazon\MonitoringEventsInterface;

class UnresolvedSignatureException extends \RuntimeException implements
    MonitoringEventsInterface
{
    use HasMonitoringEventsTrait;
}
