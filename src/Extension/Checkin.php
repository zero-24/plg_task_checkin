<?php
/**
 * TaskCheckin Plugin
 *
 * @copyright  Copyright (C) 2022 Tobias Zulauf All rights reserved.
 * @license    http://www.gnu.org/licenses/gpl-2.0.txt GNU General Public License Version 2 or Later
 */

namespace Joomla\Plugin\Task\Checkin\Extension;

use Exception;
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\Component\Scheduler\Administrator\Event\ExecuteTaskEvent;
use Joomla\Component\Scheduler\Administrator\Task\Status as TaskStatus;
use Joomla\Component\Scheduler\Administrator\Traits\TaskPluginTrait;
use Joomla\Event\DispatcherInterface;
use Joomla\Event\SubscriberInterface;

defined('_JEXEC') or die;

/**
 * Task plugin with routines to make HTTP requests.
 * At the moment, offers a single routine for GET requests.
 *
 * @since  1.0.0
 */
class Checkin extends CMSPlugin implements SubscriberInterface
{
    use TaskPluginTrait;

    /**
     * Load the language file on instantiation.
     *
     * @var    boolean
     * @since  1.0.0
     */
    protected $autoloadLanguage = true;

    /**
     * Returns an array of events this subscriber will listen to.
     *
     * @var    string[]
     * @since  1.0.0
     */
    protected const TASKS_MAP = [
        'plg_task_checkin' => [
            'langConstPrefix' => 'PLG_TASK_CHECKIN_TASK',
            'method'          => 'doCheckin',
        ],
    ];

    /**
     * Returns an array of events this subscriber will listen to.
     *
     * @return string[]
     *
     * @since  1.0.0
     */
    public static function getSubscribedEvents(): array
    {
        return [
            'onTaskOptionsList'    => 'advertiseRoutines',
            'onExecuteTask'        => 'standardRoutineHandler',
            'onContentPrepareForm' => 'enhanceTaskItemForm',
        ];
    }

    /**
     * Constructor.
     *
     * @param   DispatcherInterface  $dispatcher     The dispatcher
     * @param   array                $config         An optional associative array of configuration settings
     *
     * @since   4.2.0
     */
    public function __construct(DispatcherInterface $dispatcher, array $config)
    {
        parent::__construct($dispatcher, $config);
    }

    /**
     * Standard routine method for the get request routine.
     *
     * @param   ExecuteTaskEvent  $event  The onExecuteTask event
     *
     * @return  integer  The exit code
     *
     * @since   1.0.0
     */
    protected function doCheckin(ExecuteTaskEvent $event): int
    {
        /** @var \Joomla\Component\Checkin\Administrator\Model\CheckinModel $checkinModel */
        $checkinModel = Factory::getApplication()->bootComponent('com_checkin')
            ->getMVCFactory()->createModel('Checkin', 'Administrator');

		// Get all items to be checked in
        $items = $checkinModel->getItems();

		// Checkin all items
		$checkedInItems = $checkinModel->checkin(array_keys($items));

        $this->snapshot['output'] = Text::plural('PLG_TASK_CHECKIN_N_ITEMS_CHECKED_IN', $checkedInItems);

        return TaskStatus::OK;
    }
}
