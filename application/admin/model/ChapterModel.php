<?php
/**
 * Created by PhpStorm.
 * CustomerModel: Administrator
 * Date: 2018/11/14
 * Time: 14:09
 */

namespace app\admin\model;

use think\Model;

class ChapterModel extends Model
{
    // 确定链接表名
    protected $name = 'chapter';
    protected $autoWriteTimestamp = true;

    protected $auto = ['create_time'];

    //返回原有数据  不自动进行时间转换
    public function getCreateTimeAttr($time)
    {
        return $time;
    }

    /**
     * 查询课程章节
     * @param $where
     * @param $offset
     * @param $limit
     */
    public function getChapterByWhere($where, $offset, $limit)
    {
        return $this->alias('a')
            ->field('a.*,b.id course_id,b.title as course_title')
            ->join(['wit_course' => 'b'], 'a.course_id=b.id', 'left')
            ->where($where)
            ->limit($offset, $limit)
            ->order('a.id desc')
            ->select();
    }

    /**
     * 根据搜索条件获取所有的课程章节数量
     * @param $where
     */
    public function getAllChapter($where)
    {
        return$this->alias('a')
            ->field('a.*,b.id course_id,b.title as course_title')
            ->join(['wit_course' => 'b'], 'a.course_id=b.id', 'left')
            ->where($where)
            ->order('a.id desc')
            ->count();
    }

    /**
     * 添加课程章节
     * @param $param
     */
    public function addChapter($param)
    {
        try {
            $result = $this->validate('ChapterValidate')->save($param);
            if (false === $result) {
                // 验证失败 输出错误信息
                return msg(-1, '', $this->getError());
            } else {

                return msg(1, url('Chapter/index'), '添加课程章节成功');
            }
        } catch (\Exception $e) {
            return msg(-2, '', $e->getMessage());
        }
    }

    /**
     * 编辑课程章节信息
     * @param $param
     */
    public function editChapter($param)
    {
        try {
            $result = $this->validate('ChapterValidate')->save($param, ['id' => $param['id']]);
            if (false === $result) {
                // 验证失败 输出错误信息
                return msg(-1, '', $this->getError());
            } else {

                return msg(1, url('Chapter/index'), '编辑课程章节成功');
            }
        } catch (\Exception $e) {
            return msg(-2, '', $e->getMessage());
        }
    }

    /**
     * 根据课程章节的id 获取课程章节的信息
     * @param $id
     */
    public function getOneChapter($id)
    {
        $data = $this->where('id', $id)->find();
        return $data;
    }

    /**
     * 获取所有的课程章节
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
     * 删除课程章节
     * @param $id
     */
    public function delChapter($id)
    {
        try {

            $this->where('id', $id)->delete();
            return msg(1, '', '删除课程章节成功');

        } catch (\Exception $e) {
            return msg(-1, '', $e->getMessage());
        }
    }
}
