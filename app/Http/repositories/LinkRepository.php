<?php

namespace App\Http\repositories;

use App\Http\common\Repositories\CommonRepository;

class LinkRepository
{
    private $commonRepository;

    public function __construct(CommonRepository $commonRepository)
    {
        $this->commonRepository = $commonRepository;
    }

    public function remove($userAccount, $linkId)
    {
    }
}
