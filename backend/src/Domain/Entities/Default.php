<?php

namespace App\Domain\Entities;

use Doctrine\ORM\Mapping\Column;
abstract class BaseTableDefaults
{
    public function __construct(DateTime $created_datetime)
    {
        $this->created_datetime = new DateTime();
        $this->update_datetime = new DateTime();
    }
    #[Column(type:'datetime', nullable:true)]
    protected DateTime $created_datetime;
    #[Column(type:'datetime', nullable:true)]
    protected DateTime $update_datetime;

    public function update_datetime(): void
    {
        $this->update_datetime = new DateTime();
    }

}
