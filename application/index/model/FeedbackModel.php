<?php
/**
 * Created by PhpStorm.
 * CustomerModel: Administrator
 * Date: 2018/11/14
 * Time: 14:09
 */

namespace app\index\model;

use think\Model;

class FeedbackModel extends Model
{
    // 确定链接表名
    protected $name = 'feedback';
    protected $autoWriteTimestamp = true;
    protected $auto = ['create_time'];

    //返回原有数据  不自动进行时间转换
    public function getCreateTimeAttr($time)
    {
        return $time;
    }

    /**
     * 添加反馈信息
     * @param $param
     */
    public function addFeedback($param)
    {
        try {
            $result = $this->save($param);
            if (false === $result) {
                // 验证失败 输出错误信息
                return json(['code'=>-1,'data'=>'','msg'=>$this->getError()]);
            } else {
                return json(['code'=>-1,'data'=>'','msg'=>'添加反馈信息成功']);
            }
        } catch (\Exception $e) {
            return json(['code'=>-1,'data'=>'','msg'=>$e->getMessage()]);
        }
    }

    /**
     * 编辑反馈信息信息
     * @param $param
     */
    public function editFeedback($param)
    {
        try {
            $result = $this->validate('FeedbackValidate')->save($param, ['id' => $param['id']]);
            if (false === $result) {
                // 验证失败 输出错误信息
                return msg(-1, '', $this->getError());
            } else {

                return msg(1, url('Feedback/index'), '编辑反馈信息成功');
            }
        } catch (\Exception $e) {
            return msg(-2, '', $e->getMessage());
        }
    }

    /**
     * 根据反馈信息的id 获取反馈信息的信息
     * @param $id
     */
    public function getOneFeedback($id)
    {
        return $this->alias('a')
            ->field('a.*,b.id customer_id,b.username')
            ->join(['wit_customer' => 'b'], 'a.uid=b.id', 'left')
            ->where('a.id', $id)
            ->find();
    }

    /**
     * 删除反馈信息
     * @param $id
     */
    public function delFeedback($id)
    {
        try {
            $this->where('id', $id)->delete();
            return msg(1, '', '删除反馈信息成功');
        } catch (\Exception $e) {
            return msg(-1, '', $e->getMessage());
        }
    }
}
