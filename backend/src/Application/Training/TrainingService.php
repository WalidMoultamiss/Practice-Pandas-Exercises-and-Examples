<?php

namespace App\Application\Training;

use App\Domain\Training\Training;
use App\Domain\Training\TrainingRepositoryInterface;

class TrainingService
{
    private TrainingRepositoryInterface $trainingRepository;

    public function __construct(TrainingRepositoryInterface $trainingRepository)
    {
        $this->trainingRepository = $trainingRepository;
    }

    public function createTraining(string $name, string $type, \DateTime $date): Training
    {
        // For now, we'll just create a new Training object.
        // In the future, we'll use the repository to save it to the database.
        return new Training($name, $type, $date);
    }

    public function getTraining(int $id): ?Training
    {
        // For now, this is just a placeholder.
        // In the future, we'll use the repository to fetch the training from the database.
        return null;
    }
}
