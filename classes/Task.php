<?php

class Task
{
    const STATUS_NEW = 'new';
    const STATUS_CANCELED = 'canceled';
    const STATUS_IN_PROGRESS = 'inprogress';
    const STATUS_DONE = 'done';
    const STATUS_FAILED = 'failed';

    const ACTION_RESPOND = 'respond';
    const ACTION_CANCEL = 'cancel';
    const ACTION_EXECUTE = 'execute';
    const ACTION_REFUSE = 'refuse';

    public $currentStatus = STATUS_NEW;

    public function getStatusMap()
    {
        $statusMap = [
            'new' => 'Новое',
            'canceled' => 'Отменено',
            'inprogress' => 'В работе',
            'done' => 'Выполнено',
            'failed' => 'Провалено'
        ];

        return $statusMap;

    }

    public function getActionMap()
    {
        $actionMap = [
            'respond' => 'Откликнуться',
            'cancel' => 'Отменить',
            'execute' => 'Выполнить',
            'refuse' => 'Отказаться'
        ];

        return $actionMap;

    }

    private $idExecutor = 0;
    private $idCustomer = 0;

    public function __construct($idExecutor, $idCustomer)
    {
        $this->idExecutor = $idExecutor;
        $this->idCustomer = $idCustomer;
        $this->currentStatus = $currentStatus;
    }

    public function getStatus($action)
    {
        if($action === $this->ACTION_RESPOND) {
            $this->current_status = $this->STATUS_IN_PROGRESS;
        }

        if($action === $this->ACTION_CANCEL) {
            $this->current_status = $this->STATUS_CANCELED;
        }

        if($action === $this->ACTION_EXECUTE) {
            $this->current_status = $this->STATUS_DONE;
        }

        if($action === $this->ACTION_REFUSE) {
            $this->current_status = $this->STATUS_FAILED;
        }

        return $this->current_status;
    }

    public function geActions($status)
    {
        if($action === $this->ACTION_RESPOND) {
            $this->current_status = $this->STATUS_IN_PROGRESS;
        }

        if($action === $this->ACTION_CANCEL) {
            $this->current_status = $this->STATUS_CANCELED;
        }

        if($action === $this->ACTION_EXECUTE) {
            $this->current_status = $this->STATUS_DONE;
        }

        if($action === $this->ACTION_REFUSE) {
            $this->current_status = $this->STATUS_FAILED;
        }

        return $this->current_status;
    }

}
