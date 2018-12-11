<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/26
 * Time: 13:57
 */

namespace app\index\model;


use think\Model;

class CourseModel extends Model
{
    // 确定链接表名
    protected $name = 'course';
    protected $autoWriteTimestamp = true;

    public function getCourseList($where, $limit)
    {
        return $this->field('id,title,cat_id,thumb,desc,price')
            ->where($where)
            ->limit($limit)
            ->select();
    }

    /**
     * 根据分类id获取课程列表
     * @param $where
     * @param $offset
     * @param $limit
     * @return false|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getCourseListByCatId($where, $offset, $limit)
    {
        return $this->field('id,title,cat_id,thumb,desc')
            ->where($where)
            ->limit($offset, $limit)
            ->order('id desc')
            ->select();
    }

    public function getCourseListByCatIdCount($where, $offset, $limit)
    {
        return $this->field('id,title,cat_id,thumb,desc')
            ->where($where)
            ->limit($offset, $limit)
            ->order('id desc')
            ->count();
    }

    /**
     * 根据课程id获取课程数据
     * @param $course_id
     */
    public function getCourseDataByCourseId($course_id)
    {
        $map['status'] = 0;
        $map['id'] = $course_id;
        $data =  $this->where($map)->find();
        return $data;
    }

}