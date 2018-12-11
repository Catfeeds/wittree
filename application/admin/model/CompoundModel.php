<?php
/**
 * Created by PhpStorm.
 * CustomerModel: Administrator
 * Date: 2018/11/14
 * Time: 14:09
 */
namespace app\admin\model;

use think\Model;

class CompoundModel extends Model
{
    // 确定链接表名
    protected $name = 'compound';
    protected $autoWriteTimestamp = true;

    protected $auto = ['create_time'];

    //返回原有数据  不自动进行时间转换
    public function getCreateTimeAttr($time)
    {
        return $time;
    }

    /**
     * 根据搜索条件获取复利配置列表信息
     * @param $where
     * @param $offset
     * @param $limit
     */
    public function getCompoundsByWhere($where, $offset, $limit)
    {
        return $this->where($where)->limit($offset, $limit)->order('id desc')->select();
    }

    /**
     * 根据搜索条件获取所有的复利配置数量
     * @param $where
     */
    public function getAllCompounds($where)
    {
        return $this->where($where)->count();
    }

    /**
     * 插入复利配置信息
     * @param $param
     */
    public function insertCompound($param)
    {
        try{

            $result =  $this->validate('CompoundValidate')->save($param);
            if(false === $result){
                // 验证失败 输出错误信息
                return msg(-1, '', $this->getError());
            }else{

                return msg(1, url('Compound/index'), '添加复利配置成功');
            }
        }catch(PDOException $e){

            return msg(-2, '', $e->getMessage());
        }
    }

    /**
     * 编辑复利配置信息
     * @param $param
     */
    public function editCompound($param)
    {
        try{

            $result =  $this->validate('CompoundValidate')->save($param, ['id' => $param['id']]);

            if(false === $result){
                // 验证失败 输出错误信息
                return msg(-1, '', $this->getError());
            }else{

                return msg(1, url('Compound/index'), '编辑签到成功');
            }
        }catch(PDOException $e){
            return msg(-2, '', $e->getMessage());
        }
    }

    /**
     * 删除复利配置
     * @param $id
     */
    public function delCompound($id)
    {
        try{

            $this->where('id', $id)->delete();
            return msg(1, '', '删除复利配置成功');

        }catch( PDOException $e){
            return msg(-1, '', $e->getMessage());
        }
    }

    /**
     * 根据复利配置id获取复利配置信息
     * @param $id
     */
    public function getOneCompound($id)
    {
        return $this->where('id', $id)->find();
    }

}
