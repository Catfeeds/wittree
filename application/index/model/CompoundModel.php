<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/29
 * Time: 14:17
 */

namespace app\index\model;


use think\Model;

class CompoundModel extends Model
{
// 确定链接表名
    protected $name = 'compound';
    protected $autoWriteTimestamp = true;

    public function getAllCompoundData()
    {
        return $this->field('id,from_money,end_money,rate')->select();
    }
}