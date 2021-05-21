<?php

namespace App\Repositories\Infocms;

class CultureArticleRepository extends AbstractRepository
{

    public function model()
    {
        return \App\Models\Infocms\CultureArticle::class;
    }
}
