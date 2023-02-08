<?php

namespace App\Domain\Entities;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;
use DateTime;

#[Entity('device'), Table(name: 'devices')]
class Device
{

    public function __construct(string $brand, $model, $os, $release_date, bool $is_new)
    {
        $this->brand = $brand;
        $this->model = $model;
        $this->os = $os;
        $this->release_date = $release_date;
        $this->is_new = $is_new;
    }

    #[Id, Column(type: 'string', unique: true), GeneratedValue(strategy: 'AUTO')]
    private string $id;
    #[Column(type:'string')]
    private string $model;
    #[Column(type:'string')]
    private string $brand;
    #[Column(type:'string', nullable:true)]
    private ?string $release_date;
    #[Column(type:'string', nullable:true)]
    private ?string $os;
    #[Column(type:'boolean', nullable:true)]
    private bool $is_new = false;
    #[Column(type:'datetime', nullable:true)]
    private DateTime $received_datatime;


    public function getId(): string {
        return $this->id;
    }
    public function setModelName(string $model): void
    {
        $this->model = $model;
    }
}
