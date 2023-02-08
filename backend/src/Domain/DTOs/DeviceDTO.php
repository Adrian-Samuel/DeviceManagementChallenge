<?php

namespace App\Domain\DTOs;
use DateTime;

class DeviceDTO
{
    public string $id;
    public string $model;
    public string $os;
    public string $brand;
    public string $release_date;
    public string $received_datatime;
    public bool $is_new;

    public string $created_datetime;
    public string $update_datetime;
    public function __construct(string $id, $model, $os, $brand, $release_date,DateTime $received_datatime, bool $is_new, DateTime $created_datetime, $update_datetime)
    {
        $this->id = $id;
        $this->model = $model;
        $this->brand = $brand;
        $this->os = $os;
        $this->release_date = $release_date;
        $this->received_datatime = $received_datatime->format('Y-m-d H:i:s');;
        $this->is_new = $is_new;
        $this->created_datetime = $created_datetime->format('Y-m-d H:i:s');
        $this->update_datetime = $update_datetime->format('Y-m-d H:i:s');;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getModel(): string
    {
        return $this->model;
    }

    public function getBrand(): string
    {
        return $this->brand;
    }

    public function getOs(): string
    {
        return $this->os;
    }

    public function getReleaseDate(): string
    {
        return $this->release_date;
    }

    public function getReceivedDatatime(): DateTime
    {
        return $this->received_datatime;
    }

    public function getIsNew(): bool
    {
        return $this->is_new;
    }

    public function getCreatedDatetime(): DateTime
    {
        return $this->created_datetime;
    }

    public function getUpdateDatetime(): DateTime
    {
        return $this->update_datetime;
    }
}