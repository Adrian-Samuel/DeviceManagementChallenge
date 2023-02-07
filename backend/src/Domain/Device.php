<?php

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;

#[Entity, Table(name: 'devices')]
final class Device
{
    #[Id, Column(type: 'string', unique: true), GeneratedValue(strategy: 'AUTO')]
    private $id;
    #[Column(type:'string')]
    private $model;
    #[Column(type:'string')]
    private $brand;
    #[Column(type:'string', nullable:true)]
    private $release_date;
    #[Column(type:'string', nullable:true)]
    private $os;
    #[Column(type:'boolean', nullable:true, default: false)]
    private $is_new;
    #[Column(type:'datetime', nullable:true, columnDefinition:"DATETIME DEFAULT CURRENT_TIMESTAMP" )]
    private $received_datatime;
}
