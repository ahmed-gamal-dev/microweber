<?php

namespace MicroweberPackages\Product\Repositories;

use MicroweberPackages\Core\Repositories\BaseRepository;
use MicroweberPackages\Product\Events\ContentIsCreating;
use MicroweberPackages\Product\Events\ContentIsUpdating;
use MicroweberPackages\Product\Events\ContentWasCreated;
use MicroweberPackages\Product\Events\ContentWasDeleted;
use MicroweberPackages\Product\Events\ContentWasUpdated;
use MicroweberPackages\Product\Product;

class ProductRepository extends BaseRepository
{

    public function __construct(Product $product)
    {
        $this->model = $product;
    }

    public function create($data)
    {
        event($event = new ContentIsCreating($data));

        $product = $this->model->create($data);

        event(new ContentWasCreated($product, $data));

        return $product;
    }

    public function update($data, $id)
    {
        $product = $this->model->find($id);

        event($event = new ContentIsUpdating($product, $data));

        $product->update($data);

        event(new ContentWasUpdated($product, $data));

        return $product;
    }


    public function delete($id)
    {
        $product = $this->model->find($id);

        event(new ContentWasDeleted($product));

        return $product->delete();
    }


    public function destroy($ids)
    {
        event(new ProductWasDestroy($ids));

        return $this->model->destroy($ids);
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

}
