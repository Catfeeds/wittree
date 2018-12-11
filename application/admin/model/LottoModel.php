<?php
/**
 * Created by PhpStorm.
 * CustomerModel: Administrator
 * Date: 2018/11/14
 * Time: 14:09
 */
namespace app\admin\model;

use think\Model;

class LottoModel extends Model
{
    // 确定链接表名
    protected $name = 'lotto';
    protected $autoWriteTimestamp = true;
    protected $auto = ['create_time'];

    //返回原有数据  不自动进行时间转换
    public function getCreateTimeAttr($time)
    {
        return $time;
    }

    /**
     * 查询积分设置
     * @param $where
     * @param $offset
     * @param $limit
     */
    public function getLottoByWhere($where, $offset, $limit)
    {
        return $this->where($where)->limit($offset, $limit)->order('id desc')->select();
    }

    /**
     * 根据搜索条件获取所有的积分设置数量
     * @param $where
     */
    public function getAllLotto($where)
    {
        return $this->where($where)->count();
    }

    /**
     * 添加积分设置
     * @param $param
     */
    public function addLotto($param)
    {
        try{
            $result = $this->validate('LottoValidate')->save($param);
            if(false === $result){
                // 验证失败 输出错误信息
                return msg(-1, '', $this->getError());
            }else{

                return msg(1, url('Lotto/index'), '添加积分设置成功');
            }
        }catch (\Exception $e){
            return msg(-2, '', $e->getMessage());
        }
    }

    /**
     * 编辑积分设置信息
     * @param $param
     */
    public function editLotto($param)
    {
        try{
            $result = $this->validate('LottoValidate')->save($param, ['id' => $param['id']]);
            if(false === $result){
                // 验证失败 输出错误信息
                return msg(-1, '', $this->getError());
            }else{

                return msg(1, url('Lotto/index'), '编辑积分设置成功');
            }
        }catch(\Exception $e){
            return msg(-2, '', $e->getMessage());
        }
    }

    /**
     * 根据积分设置的id 获取积分设置的信息
     * @param $id
     */
    public function getOneLotto($id)
    {
        return $this->where('id', $id)->find();
    }

    /**
     * 删除积分设置
     * @param $id
     */
    public function delLotto($id)
    {
        try{

            $this->where('id', $id)->delete();
            return msg(1, '', '删除积分设置成功');

        }catch(\Exception $e){
            return msg(-1, '', $e->getMessage());
        }
    }
}
