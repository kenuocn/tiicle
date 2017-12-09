<?php
/**
 * YICMS
 * ============================================================================
 * 版权所有 2014-2017 YICMS，并保留所有权利。
 * 网站地址: http://www.yicms.vip
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * Created by PhpStorm.
 * Author: kenuo
 * Date: 2017/12/9
 * Time: 下午3:03
 */

namespace App\Observers;


use App\Models\Category;

class CategoryObserver
{
    public function saving(Category $category)
    {
        // 这样写扩展性更高，只有空的时候才指定默认头像
        if (empty($category->pic)) {
            $category->pic = '/uploads/categorys/category_default.png';
        }
    }
}