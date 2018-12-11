<?php
/**
 * Created by PhpStorm.
 * CustomerModel: Administrator
 * Date: 2018/11/14
 * Time: 14:09
 */

namespace app\admin\model;

use think\Model;

class MessageModel extends Model
{
    // 确定链接表名
    protected $name = 'Message';
    protected $autoWriteTimestamp = true;
    protected $auto = ['create_time'];

    //返回原有数据  不自动进行时间转换
    public function getCreateTimeAttr($time)
    {
        return $time;
    }

    /**
     * 查询消息
     * @param $where
     * @param $offset
     * @param $limit
     */
    public function getMessageByWhere($where, $offset, $limit)
    {
        return $this->alias('a')
            ->limit($offset, $limit)
            ->order('a.id desc')
            ->select();
    }

    /**
     * 根据搜索条件获取所有的消息数量
     * @param $where
     */
    public function getAllMessage($where)
    {
        return $this->alias('a')
            ->where($where)
            ->order('a.id desc')
            ->count();
    }

    /**
     * 添加Message
     * @param $param
     */
//    public function addMessage($param)
//    {
//        halt($param);
//        try {
//            $result = $this->validate('MessageValidate')->save($param);
//            if (false === $result) {
//                // 验证失败 输出错误信息
//                return msg(-1, '', $this->getError());
//            } else {
//
//                return msg(1, url('Message/index'), '添加消息成功');
//            }
//        } catch (\Exception $e) {
//            return msg(-2, '', $e->getMessage());
//        }
//    }

    public function addMessage($param)
    {
        $savedata['content'] = $param['content'];
        $savedata['create_time'] = time();
        try {
            $result = $this->validate('MessageValidate')->save($savedata);
            if (false === $result) {
                // 验证失败 输出错误信息
                return msg(-1, '', $this->getError());
            } else {
                $data['uid'] = $param['uid'];
                $data['message_id'] = $this->getLastInsID();
                $data['create_time'] = time();
                db('customer_message')->insert($data);
                return msg(1, url('Message/index'), '添加消息成功');
            }
        } catch (\Exception $e) {
            return msg(-2, '', $e->getMessage());
        }
    }

    /**
     * 编辑消息信息
     * @param $param
     */
    public function editMessage($param)
    {
        try {
            $result = $this->validate('MessageValidate')->save($param, ['id' => $param['id']]);
            if (false === $result) {
                // 验证失败 输出错误信息
                return msg(-1, '', $this->getError());
            } else {

                return msg(1, url('Message/index'), '编辑消息成功');
            }
        } catch (\Exception $e) {
            return msg(-2, '', $e->getMessage());
        }
    }

    /**
     * 根据消息的id 获取Message的信息
     * @param $id
     */
    public function getOneMessage($id)
    {
        return $this->where('id', $id)->find();
    }

    /**
     * 删除消息
     * @param $id
     */
    public function delMessage($id)
    {
        try {
            $this->where('id', $id)->delete();
            return msg(1, '', '删除消息成功');
        } catch (\Exception $e) {
            return msg(-1, '', $e->getMessage());
        }
    }
}
