<?php
declare(strict_types=1);

namespace App\GraphQL\Privacy;

use Rebing\GraphQL\Support\Privacy;

/**
 * Class AdminPrivacy
 *
 * @package App\GraphQL\Privacy
 */
class AdminPrivacy extends Privacy
{

    /**
     * @param array $args
     *
     * @return mixed
     */
    public function validate(array $args)
    {
        return \Auth::user()->hasRole(1);
    }
}