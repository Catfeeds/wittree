<?php
/**
 * Created by PhpStorm.
 * CustomerModel: Administrator
 * Date: 2018/11/14
 * Time: 14:09
 */
namespace app\admin\model;

use think\Model;

class TurnModel extends Model
{
    // 确定链接表名
    protected $name = 'turn';
    protected $autoWriteTimestamp = true;

    protected $auto = ['create_time'];

    //返回原有数据  不自动进行时间转换
    public function getCreateTimeAttr($time)
    {
        return $time;
    }

    /**
     * 查询轮播图
     * @param $where
     * @param $offset
     * @param $limit
     */
    public function getTurnByWhere($where, $offset, $limit)
    {
        return $this->where($where)->limit($offset, $limit)->order('id desc')->select();
    }

    /**
     * 根据搜索条件获取所有的轮播图数量
     * @param $where
     */
    public function getAllTurn($where)
    {
        return $this->where($where)->count();
    }

    /**
     * 添加轮播图
     * @param $param
     */
    public function addTurn($param)
    {
        try{
            $result = $this->validate('TurnValidate')->save($param);
            if(false === $result){
                // 验证失败 输出错误信息
                return msg(-1, '', $this->getError());
            }else{

                return msg(1, url('Turn/index'), '添加轮播图成功');
            }
        }catch (\Exception $e){
            return msg(-2, '', $e->getMessage());
        }
    }

    /**
     * 编辑轮播图信息
     * @param $param
     */
    public function editTurn($param)
    {
        try{
            $result = $this->validate('TurnValidate')->save($param, ['id' => $param['id']]);
            if(false === $result){
                // 验证失败 输出错误信息
                return msg(-1, '', $this->getError());
            }else{

                return msg(1, url('Turn/index'), '编辑轮播图成功');
            }
        }catch(\Exception $e){
            return msg(-2, '', $e->getMessage());
        }
    }

    /**
     * 根据轮播图的id 获取轮播图的信息
     * @param $id
     */
    public function getOneTurn($id)
    {
        return $this->where('id', $id)->find();
    }

    /**
     * 删除轮播图
     * @param $id
     */
    public function delTurn($id)
    {
        try{
            $this->where('id', $id)->delete();
            return msg(1, '', '删除轮播图成功');
        }catch(\Exception $e){
            return msg(-1, '', $e->getMessage());
        }
    }
}
