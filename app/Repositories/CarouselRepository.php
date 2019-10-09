<?php

namespace App\Repositories;

use App\Exceptions\CarouselNotFoundException;
use App\Models\Carousel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use App\Exceptions\CreateCarouselErrorException;
use App\Repositories\Interfaces\CarouselRepositoryInterface;

/**
 * Class CarouselRepository.
 */
class CarouselRepository extends BaseRepository implements CarouselRepositoryInterface
{
    /**
     * CarouselRepository constructor.
     *
     * @param \App\Models\Carousel $model
     */
    public function __construct(Carousel $model)
    {
        parent::__construct($model);
    }

    /**
     * @param array $data
     *
     * @return Carousel
     *
     * @throws CreateCarouselErrorException
     */
    public function createCarousel(array $data): Carousel
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateCarouselErrorException($e);
        }
    }

    /**
     * @param int $id
     * @return Carousel
     * @throws CarouselNotFoundException
     */
    public function findCarousel(int $id) : Carousel
    {
        try {
            return $this->model->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new CarouselNotFoundException($e);
        }
    }
}
