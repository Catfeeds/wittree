<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/27
 * Time: 13:33
 */

namespace app\index\model;


use think\Model;

class ScoreModel extends Model
{
    // 确定链接表名
    protected $name = 'score';
    protected $autoWriteTimestamp = true;
}