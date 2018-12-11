<?php
/**
 * Created by PhpStorm.
 * CustomerModel: Administrator
 * Date: 2018/11/14
 * Time: 14:09
 */
namespace app\admin\model;

use think\Model;

class AwardModel extends Model
{
    // 确定链接表名
    protected $name = 'award';
    protected $autoWriteTimestamp = true;

    protected $auto = ['create_time'];

    //返回原有数据  不自动进行时间转换
    public function getCreateTimeAttr($time)
    {
        return $time;
    }

    /**
     * 查询推荐人奖励设置
     * @param $where
     * @param $offset
     * @param $limit
     */
    public function getAwardByWhere($where, $offset, $limit)
    {
        return $this->where($where)->limit($offset, $limit)->order('id desc')->select();
    }

    /**
     * 根据搜索条件获取所有的推荐人奖励设置数量
     * @param $where
     */
    public function getAllAward($where)
    {
        return $this->where($where)->count();
    }

    /**
     * 添加推荐人奖励设置
     * @param $param
     */
    public function addAward($param)
    {
        try{
            $result = $this->validate('AwardValidate')->save($param);
            if(false === $result){
                // 验证失败 输出错误信息
                return msg(-1, '', $this->getError());
            }else{

                return msg(1, url('Award/index'), '添加推荐人奖励设置成功');
            }
        }catch (\Exception $e){
            return msg(-2, '', $e->getMessage());
        }
    }

    /**
     * 编辑推荐人奖励设置信息
     * @param $param
     */
    public function editAward($param)
    {
        try{
            $result = $this->validate('AwardValidate')->save($param, ['id' => $param['id']]);
            if(false === $result){
                // 验证失败 输出错误信息
                return msg(-1, '', $this->getError());
            }else{

                return msg(1, url('Award/index'), '编辑推荐人奖励设置成功');
            }
        }catch(\Exception $e){
            return msg(-2, '', $e->getMessage());
        }
    }

    /**
     * 根据推荐人奖励设置的id 获取推荐人奖励设置的信息
     * @param $id
     */
    public function getOneAward($id)
    {
        return $this->where('id', $id)->find();
    }

    /**
     * 删除推荐人奖励设置
     * @param $id
     */
    public function delAward($id)
    {
        try{
            $this->where('id', $id)->delete();
            return msg(1, '', '删除推荐人奖励设置成功');
        }catch(\Exception $e){
            return msg(-1, '', $e->getMessage());
        }
    }
}
