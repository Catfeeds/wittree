<?php
/**
 * Created by PhpStorm.
 * CustomerModel: Administrator
 * Date: 2018/11/14
 * Time: 14:09
 */
namespace app\admin\model;

use think\Model;

class NewsModel extends Model
{
    // 确定链接表名
    protected $name = 'news';
    protected $autoWriteTimestamp = true;
    protected $auto = ['create_time'];

    //返回原有数据  不自动进行时间转换
    public function getCreateTimeAttr($time)
    {
        return $time;
    }

    /**
     * 查询活动新闻
     * @param $where
     * @param $offset
     * @param $limit
     */
    public function getNewsByWhere($where, $offset, $limit)
    {
        return $this->where($where)->limit($offset, $limit)->order('id desc')->select();
    }

    /**
     * 根据搜索条件获取所有的活动新闻数量
     * @param $where
     */
    public function getAllNews($where)
    {
        return $this->where($where)->count();
    }

    /**
     * 添加活动新闻
     * @param $param
     */
    public function addNews($param)
    {
        try{
            $result = $this->validate('NewsValidate')->save($param);
            if(false === $result){
                // 验证失败 输出错误信息
                return msg(-1, '', $this->getError());
            }else{

                return msg(1, url('News/index'), '添加活动新闻成功');
            }
        }catch (\Exception $e){
            return msg(-2, '', $e->getMessage());
        }
    }

    /**
     * 编辑活动新闻信息
     * @param $param
     */
    public function editNews($param)
    {
        try{
            $result = $this->validate('NewsValidate')->save($param, ['id' => $param['id']]);
            if(false === $result){
                // 验证失败 输出错误信息
                return msg(-1, '', $this->getError());
            }else{

                return msg(1, url('News/index'), '编辑活动新闻成功');
            }
        }catch(\Exception $e){
            return msg(-2, '', $e->getMessage());
        }
    }

    /**
     * 根据活动新闻的id 获取活动新闻的信息
     * @param $id
     */
    public function getOneNews($id)
    {
        return $this->where('id', $id)->find();
    }

    /**
     * 删除活动新闻
     * @param $id
     */
    public function delNews($id)
    {
        try{
            $this->where('id', $id)->delete();
            return msg(1, '', '删除活动新闻成功');
        }catch(\Exception $e){
            return msg(-1, '', $e->getMessage());
        }
    }
}
