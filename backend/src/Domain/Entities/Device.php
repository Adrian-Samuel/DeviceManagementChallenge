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
    private string $id;
    #[Column(type:'string')]
    private string $model;
    #[Column(type:'string')]
    private string $brand;
    #[Column(type:'string', nullable:true)]
    private string $release_date;
    #[Column(type:'string', nullable:true)]
    private string $os;
    #[Column(type:'boolean', nullable:true, default: false)]
    private bool $is_new;
    #[Column(type:'datetime', nullable:true, columnDefinition:"DATETIME DEFAULT CURRENT_TIMESTAMP" )]
    private datetime $received_datatime;
}
