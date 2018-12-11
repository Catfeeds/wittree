<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/26
 * Time: 11:43
 */

namespace app\index\model;


use think\Model;

class NewsModel extends Model
{
    // 确定链接表名
    protected $name = 'news';
    protected $autoWriteTimestamp = true;

    /**
     * 获取首页新闻数据
     * @param $limit
     * @return false|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getNewslist($limit)
    {
        return $this->field('id,url,desc')
            ->limit($limit)
            ->select();
    }
}