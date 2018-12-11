<?php
/**
 * Created by PhpStorm.
 * CustomerModel: Administrator
 * Date: 2018/11/14
 * Time: 14:09
 */

namespace app\admin\model;

use think\Model;

class CourseModel extends Model
{
    // 确定链接表名
    protected $name = 'course';
    protected $autoWriteTimestamp = true;

    protected $auto = ['create_time'];

    //返回原有数据  不自动进行时间转换
    public function getCreateTimeAttr($time)
    {
        return $time;
    }

    /**
     * 查询课程
     * @param $where
     * @param $offset
     * @param $limit
     */
    public function getCourseByWhere($where, $offset, $limit)
    {
        return $this->alias('a')
            ->field('a.*,b.id cat_id,b.cat_name')
            ->join(['wit_category' => 'b'], 'a.cat_id = b.id', 'left')
            ->where($where)
            ->limit($offset, $limit)
            ->order('id desc')
            ->select();
    }

    /**
     * 根据搜索条件获取所有的课程数量
     * @param $where
     */
    public function getAllCourse($where)
    {
        return $this->alias('a')
            ->field('a.*,b.id cat_id,b.cat_name')
            ->join(['wit_category' => 'b'], 'a.cat_id = b.id', 'left')
            ->where($where)
            ->count();
    }

    /**
     * 获取所有的课程
     */
    public function getAllCourseData()
    {
        $data = $this->field('id,title')->select();
        return $data;
    }

    /**
     * 添加课程
     * @param $param
     */
    public function addCourse($param)
    {
        try {
            $result = $this->validate('CourseValidate')->save($param);
            if (false === $result) {
                // 验证失败 输出错误信息
                return msg(-1, '', $this->getError());
            } else {

                return msg(1, url('Course/index'), '添加课程成功');
            }
        } catch (\Exception $e) {
            return msg(-2, '', $e->getMessage());
        }
    }

    /**
     * 编辑课程信息
     * @param $param
     */
    public function editCourse($param)
    {
        try {
            $result = $this->validate('CourseValidate')->save($param, ['id' => $param['id']]);
            if (false === $result) {
                // 验证失败 输出错误信息
                return msg(-1, '', $this->getError());
            } else {

                return msg(1, url('Course/index'), '编辑课程成功');
            }
        } catch (\Exception $e) {
            return msg(-2, '', $e->getMessage());
        }
    }

    /**
     * 根据课程的id 获取课程的信息
     * @param $id
     */
    public function getOneCourse($id)
    {
        return $this->alias('a')
            ->field('a.*,b.id admin_id,b.user_name admin_name')
            ->join(['wit_user' => 'b'], 'a.admin_id=b.id', 'left')
            ->where('a.id', $id)->find();
    }

    /**
     * 删除课程
     * @param $id
     */
    public function delCourse($id)
    {
        try {

            $this->where('id', $id)->delete();
            return msg(1, '', '删除课程成功');

        } catch (\Exception $e) {
            return msg(-1, '', $e->getMessage());
        }
    }
}
