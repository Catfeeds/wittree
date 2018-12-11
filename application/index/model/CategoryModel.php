<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/26
 * Time: 13:52
 */

namespace app\index\model;

use think\Model;

class CategoryModel extends Model
{
    // 确定链接表名
    protected $name = 'category';
    protected $autoWriteTimestamp = true;

    /**
     * 获取首页课程分类
     * @param $limit
     * @return false|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getCateList($limit)
    {
        return $this->field('id,cat_name,url')
            ->limit($limit)
            ->select();
    }

    /**
     * 获取专区分类数据
     * @param $where
     * @return false|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getCateListByWhere($where){
        return $this->field('id,cat_name')
            ->limit($where)
            ->select();
    }
}