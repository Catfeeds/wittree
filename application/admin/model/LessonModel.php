<?php
/**
 * Created by PhpStorm.
 * CustomerModel: Administrator
 * Date: 2018/11/14
 * Time: 14:09
 */

namespace app\admin\model;

use think\Model;

class LessonModel extends Model
{
    // 确定链接表名
    protected $name = 'lesson';
    protected $autoWriteTimestamp = true;
    protected $auto = ['create_time'];

    //返回原有数据  不自动进行时间转换
    public function getCreateTimeAttr($time)
    {
        return $time;
    }

    /**
     * 查询课时
     * @param $where
     * @param $offset
     * @param $limit
     */
    public function getLessonByWhere($where, $offset, $limit)
    {
        return $this->alias('a')
            ->field('a.*,b.id course_id,b.title as course_title,c.id chapter_id,c.title as chapter_title')
            ->join(['wit_course' => 'b'], 'a.course_id=b.id', 'left')
            ->join(['wit_chapter' => 'c'], 'a.chapter_id=c.id', 'left')
            ->where($where)
            ->limit($offset, $limit)
            ->order('a.id desc')
            ->select();
    }

    /**
     * 根据搜索条件获取所有的课时数量
     * @param $where
     */
    public function getAllLesson($where)
    {
        return $this->alias('a')
            ->field('a.*,b.id course_id,b.title as course_title,c.id chapter_id,c.title as chapter_title')
            ->join(['wit_course' => 'b'], 'a.course_id=b.id', 'left')
            ->join(['wit_chapter' => 'c'], 'a.chapter_id=c.id', 'left')
            ->where($where)
            ->order('a.id desc')
            ->count();
    }

    /**
     * 根据课程id获取所有的课时数据
     * @param $where
     * @param $offset
     * @param $limit
     * @return false|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getLessonByCourseIdData($where, $offset, $limit){
        return $this->where($where)
            ->limit($offset, $limit)
            ->select();
    }

    /**
     * 根据课程id获取所有的课时数量
     * @param $where
     * @return false|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getAllLessonByCourseId($where){
        return $this->where($where)
            ->select();
    }

    /**
     * 添加课时
     * @param $param
     */
    public function addLesson($param)
    {
        try {
            $result = $this->validate('LessonValidate')->save($param);
            if (false === $result) {
                // 验证失败 输出错误信息
                return msg(-1, '', $this->getError());
            } else {

                return msg(1, url('Lesson/index'), '添加课时成功');
            }
        } catch (\Exception $e) {
            return msg(-2, '', $e->getMessage());
        }
    }

    /**
     * 编辑课时信息
     * @param $param
     */
    public function editLesson($param)
    {
        try {
            $result = $this->validate('LessonValidate')->save($param, ['id' => $param['id']]);
            if (false === $result) {
                // 验证失败 输出错误信息
                return msg(-1, '', $this->getError());
            } else {

                return msg(1, url('Lesson/index'), '编辑课时成功');
            }
        } catch (\Exception $e) {
            return msg(-2, '', $e->getMessage());
        }
    }

    /**
     * 根据课时的id 获取课时的信息
     * @param $id
     */
    public function getOneLesson($id)
    {
        return $this->where('id', $id)->find();
    }

    /**
     * 删除课时
     * @param $id
     */
    public function delLesson($id)
    {
        try {

            $this->where('id', $id)->delete();
            return msg(1, '', '删除课时成功');

        } catch (\Exception $e) {
            return msg(-1, '', $e->getMessage());
        }
    }

    /**
     * 根据课程id获取课时总量
     * @param $course_id
     * @return int|string
     * @throws \think\Exception
     */
    public function getLessonCountByCourseId($course_id)
    {
        return $this->where('course_id',$course_id)->count('id');
    }
}
