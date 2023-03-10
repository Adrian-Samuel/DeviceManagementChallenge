<?php

namespace App\src\Domain\Entities;

require_once __DIR__ . '/BaseTableDefaults.php';

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;
use Ramsey\Uuid\Uuid;
use DateTime;

#[Entity('device'), Table(name: 'devices')]
class Device extends BaseTableDefaults
{

    public function __construct($brand, $model, $os, $release_date, $is_new)
    {
        parent::__construct(new DateTime());
        $this->id = Uuid::uuid4()->toString();
        $this->brand = $brand;
        $this->model = $model;
        $this->os = $os ?? $this->getOs();
        $this->release_date = $release_date ?? $this->getReleaseDate();
        $this->is_new = $is_new ?? $this->getIsNew();
    }

    #[Id, Column(type: 'string', unique: true)]
    protected string $id;
    #[Column(type: 'string')]
    protected string $model;
    #[Column(type: 'string')]
    public string $brand;
    #[Column(type: 'string', nullable: true)]
    protected string $release_date;
    #[Column(type: 'string', nullable: true)]
    protected string $os;
    #[Column(type: 'boolean', nullable: true)]
    protected bool $is_new;
    #[Column(type: 'datetime', nullable: true)]
    public DateTime $received_datatime;


    public function setModelName(string $model): void
    {
        $this->model = $model;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getBrand(): string
    {
        return $this->brand;
    }

    public function getModel(): string
    {
        return $this->model;
    }

    public function getOs(): string
    {
        return $this->os ?? '';
    }


    public function getIsNew(): bool
    {
        return $this->is_new ?? false;
    }

    public function getCreatedDatetime(): DateTime
    {
        return $this->created_datetime;
    }

    public function getReceivedDatatime(): DateTime
    {
        return $this->received_datatime ?? new DateTime();
    }

    public function getReleaseDate(): string
    {
        $date = new DateTime();
        return $this->release_date ?? $date->format('Y-m');
    }

    public function getUpdateDatetime(): DateTime
    {
        return $this->update_datetime;
    }
}
