<?php

namespace App\Domain\Entities;

use Doctrine\ORM\Mapping\Column;
use DateTime;
abstract class BaseTableDefaults
{
    public function __construct(DateTime $currenTime)
    {
        $this->created_datetime = $currenTime;
        $this->update_datetime = $currenTime;
    }
    #[Column(type:'datetime', nullable:true)]
    protected DateTime $created_datetime;
    #[Column(type:'datetime', nullable:true)]
    protected DateTime $update_datetime;

    public function setUpdateDatetime(): void
    {
        $this->update_datetime = new DateTime();
    }
}
