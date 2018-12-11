<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/30
 * Time: 16:45
 */

namespace app\index\model;


use think\Model;

class IntegralConfigModel extends Model
{
// 确定链接表名
    protected $name = 'integral_config';
    protected $autoWriteTimestamp = true;

    public function getIntegralData()
    {
        return $this->field('id,day,integral')->select();
    }
}