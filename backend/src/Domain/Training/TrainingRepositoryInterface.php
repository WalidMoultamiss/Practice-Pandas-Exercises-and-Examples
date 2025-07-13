<?php

namespace App\Domain\Training;

interface TrainingRepositoryInterface
{
    public function save(Training $training): void;
    public function findById(int $id): ?Training;
}
