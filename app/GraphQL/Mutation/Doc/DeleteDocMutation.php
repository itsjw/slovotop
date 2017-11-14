<?php
declare(strict_types=1);

namespace App\GraphQL\Mutation\Doc;

use App\Models\Doc;
use App\Models\Menu;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;

/**
 * Class DeleteDocMutation
 *
 * @package App\GraphQL\Mutation
 */
class DeleteDocMutation extends Mutation
{
    /**
     * @var array
     */
    protected $attributes = [
        'name'        => 'DeleteDocMutation',
        'description' => 'A mutation',
    ];

    /**
     * @return mixed
     */
    public function type()
    {
        return \GraphQL::type('DocType');
    }

    /**
     * @return array
     */
    public function args()
    {
        return [
            'items' => [
                'name' => 'items',
                'type' => Type::string(),
            ],
        ];
    }

    /**
     * @apiVersion    0.1.0
     * @apiGroup      Doc
     * @apiPermission auth
     * @api           {post} v1 Doc-Delete
     * @apiName       Doc-Delete
     * @apiParam {String{1,2,3..}} items items
     * @apiParamExample {json} Request-Example:
     * {"query":"mutation { DeleteDocMutation (items:"1,2,3") { id } }"}
     * @apiSuccess {Array} id ['id' => id ,'notify' => trans('data.notifyOK')]
     *
     * @param $root
     * @param $args
     * @param \Rebing\GraphQL\Support\SelectFields $fields
     * @param \GraphQL\Type\Definition\ResolveInfo $info
     *
     * @return array
     */
    public function resolve($root, $args, SelectFields $fields, ResolveInfo $info)
    {
        if (Menu::getAccessMenu('docs') == 2) {

            $items = explode(',', $args['items']);

            foreach ($items as $key) {
                $doc = Doc::findOrfail($key);
                $doc->roles()->detach();
                $doc->delete();
            }

            return [
                'id'     => $doc->id,
                'notify' => trans('data.notifyOK'),
            ];

        }

        return [];
    }
}