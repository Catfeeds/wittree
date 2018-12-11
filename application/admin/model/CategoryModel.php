<?php
/**
 * Created by PhpStorm.
 * CustomerModel: Administrator
 * Date: 2018/11/14
 * Time: 14:09
 */

namespace app\admin\model;

use think\Model;

class CategoryModel extends Model
{
    // 确定链接表名
    protected $name = 'category';
    protected $autoWriteTimestamp = true;

    protected $auto = ['create_time'];

    //返回原有数据  不自动进行时间转换
    public function getCreateTimeAttr($time)
    {
        return $time;
    }

    /**
     * 查询课程分类
     * @param $where
     * @param $offset
     * @param $limit
     */
    public function getCategoryByWhere($where, $offset, $limit)
    {
        return $this->where($where)->limit($offset, $limit)->order('id desc')->select();
    }

    /**
     * 根据搜索条件获取所有的课程分类数量
     * @param $where
     */
    public function getAllCategory($where)
    {
        return $this->where($where)->count();
    }

    /**
     * 添加课程分类
     * @param $param
     */
    public function addCategory($param)
    {
        try {
            $result = $this->validate('CategoryValidate')->save($param);
            if (false === $result) {
                // 验证失败 输出错误信息
                return msg(-1, '', $this->getError());
            } else {

                return msg(1, url('Category/index'), '添加课程分类成功');
            }
        } catch (\Exception $e) {
            return msg(-2, '', $e->getMessage());
        }
    }

    /**
     * 编辑课程分类信息
     * @param $param
     */
    public function editCategory($param)
    {
        try {
            $result = $this->validate('CategoryValidate')->save($param, ['id' => $param['id']]);
            if (false === $result) {
                // 验证失败 输出错误信息
                return msg(-1, '', $this->getError());
            } else {

                return msg(1, url('Category/index'), '编辑课程分类成功');
            }
        } catch (\Exception $e) {
            return msg(-2, '', $e->getMessage());
        }
    }

    /**
     * 根据课程分类的id 获取课程分类的信息
     * @param $id
     */
    public function getOneCategory($id)
    {
        return $this->where('id', $id)->find();
    }

    /**
     * 获取所有的课程分类
     * @return false|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getAllCate()
    {
        return $this->select();
    }

    /**
     * 删除课程分类
     * @param $id
     */
    public function delCategory($id)
    {
        try {

            $this->where('id', $id)->delete();
            return msg(1, '', '删除课程分类成功');

        } catch (\Exception $e) {
            return msg(-1, '', $e->getMessage());
        }
    }
}
