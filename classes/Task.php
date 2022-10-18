<?php

class Task
{
    public const STATUS_NEW = 'new';
    const STATUS_CANCELED = 'canceled';
    const STATUS_IN_PROGRESS = 'inprogress';
    const STATUS_DONE = 'done';
    const STATUS_FAILED = 'failed';

    const ACTION_RESPOND = 'respond';
    const ACTION_CANCEL = 'cancel';
    const ACTION_APPROVE = 'approve';
    const ACTION_START = 'start';
    const ACTION_REFUSE = 'refuse';

    private $executorId = null;
    private $customerId = null;

    public $status = self::STATUS_NEW;
    public $availableActions = [];

    public function getStatusMap()
    {
        $statusMap = [
            self::STATUS_NEW => 'Новое',
            self::STATUS_CANCELED => 'Отменено',
            self::STATUS_IN_PROGRESS => 'В работе',
            self::STATUS_DONE => 'Выполнено',
            self::STATUS_FAILED => 'Провалено'
        ];

        return $statusMap;

    }

    public function getActionMap()
    {
        $actionMap = [
            self::ACTION_RESPOND => 'Откликнуться',
            self::ACTION_CANCEL => 'Отменить',
            self::ACTION_APPROVE => 'Выполнить',
            self::ACTION_START => 'Начать',
            self::ACTION_REFUSE => 'Отказаться'
        ];

        return $actionMap;

    }

    public function __construct($status, $customerId, $executorId = null)
    {
        $this->executorId = $executorId;
        $this->customerId = $customerId;
        $this->status = $status;
    }

    public function getStatusAfterAction($action)
    {
        switch ($action) {
            case self::ACTION_RESPOND:
                return self::STATUS_NEW;
            case self::ACTION_CANCEL:
                return self::STATUS_CANCELED;
            case self::ACTION_APPROVE:
                return self::STATUS_DONE;
            case self::ACTION_REFUSE:
                return self::STATUS_FAILED;
        }

        return null;
    }

    public function getAvailableActions($status, $currentUserId)
    {
        switch ($status) {
            case self::STATUS_NEW:
                if ($currentUserId === $this->customerId) {
                    return [
                        self::ACTION_START,
                        self::ACTION_CANCEL,
                    ];
                }
                return [
                    self::ACTION_RESPOND
                ];
            case self::STATUS_IN_PROGRESS:
                if ($currentUserId === $this->customerId) {
                    return [
                        self::ACTION_APPROVE
                    ];
                }
                if ($currentUserId === $this->executorId) {
                    return [
                        self::ACTION_REFUSE
                    ];
                }
        }

        return [];
    }

}
