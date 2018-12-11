<?php
/**
 * Created by PhpStorm.
 * CustomerModel: Administrator
 * Date: 2018/11/14
 * Time: 14:09
 */
namespace app\admin\model;

use think\Model;

class IntegralConfigModel extends Model
{
    // 确定链接表名
    protected $name = 'integral_config';
    protected $autoWriteTimestamp = true;
    protected $auto = ['create_time'];

    //返回原有数据  不自动进行时间转换
    public function getCreateTimeAttr($time)
    {
        return $time;
    }
    /**
     * 根据搜索条件获取签到配置列表信息
     * @param $where
     * @param $offset
     * @param $limit
     */
    public function getIntegralConfigsByWhere($where, $offset, $limit)
    {
        return $this->where($where)->limit($offset, $limit)->order('id desc')->select();
    }

    /**
     * 根据搜索条件获取所有的签到配置数量
     * @param $where
     */
    public function getAllIntegralConfigs($where)
    {
        return $this->where($where)->count();
    }

    /**
     * 插入签到配置信息
     * @param $param
     */
    public function insertIntegralConfig($param)
    {
        try{

            $result =  $this->validate('IntegralConfigValidate')->save($param);
            if(false === $result){
                // 验证失败 输出错误信息
                return msg(-1, '', $this->getError());
            }else{

                return msg(1, url('Integralconfig/index'), '添加签到配置成功');
            }
        }catch(PDOException $e){

            return msg(-2, '', $e->getMessage());
        }
    }

    /**
     * 编辑签到配置信息
     * @param $param
     */
    public function editIntegralConfig($param)
    {
        try{

            $result =  $this->validate('IntegralConfigValidate')->save($param, ['id' => $param['id']]);

            if(false === $result){
                // 验证失败 输出错误信息
                return msg(-1, '', $this->getError());
            }else{

                return msg(1, url('integralconfig/index'), '编辑签到成功');
            }
        }catch(PDOException $e){
            return msg(-2, '', $e->getMessage());
        }
    }

    /**
     * 删除签到配置
     * @param $id
     */
    public function delIntegralConfig($id)
    {
        try{

            $this->where('id', $id)->delete();
            return msg(1, '', '删除签到配置成功');

        }catch( PDOException $e){
            return msg(-1, '', $e->getMessage());
        }
    }

    /**
     * 根据签到配置id获取签到配置信息
     * @param $id
     */
    public function getOneIntegralConfig($id)
    {
        return $this->where('id', $id)->find();
    }

}
