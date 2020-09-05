<?php

namespace App\Services;

use phpDocumentor\Reflection\Types\Boolean;

class BaseService
{
    /**
     * @var model
     */
    protected $model;

    /**
     * Get list
     *
     * @return dataObject
     */
    public function getData()
    {
        return $this->model->get();
    }

    /**
     * @param $request
     * @return insert_id
     */
    public function create($request)
    {
        return $this->model->create($request);
    }

    /**
     * Get single data object
     *
     * @param int $id
     * @return dataObject
     */
    public function find($id)
    {
        return $this->model->find($id);
    }

    /**
     * Update data
     *
     * @param $request
     * @param int $id
     * @return boolean
     */
    public function update($request, $id)
    {
        return $this->model->find($id)->update($request);
    }

    /**
     * Delete data
     *
     * @param int $id
     * @return boolean
     */
    public function delete($id)
    {
        return $this->model->find($id)->delete();
    }

}
