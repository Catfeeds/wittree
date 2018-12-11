<?php
/**
 * Created by PhpStorm.
 * CustomerModel: Administrator
 * Date: 2018/11/14
 * Time: 14:09
 */

namespace app\admin\controller;

use app\admin\model\FeedbackModel;

class Feedback extends Base
{
    // 反馈信息列表
    public function index()
    {
        if (request()->isAjax()) {
            $param = input('param.');
            $limit = $param['pageSize'];
            $offset = ($param['pageNumber'] - 1) * $limit;
            $where = [];
            if (!empty($param['searchText'])) {
                $where['b.username'] = ['like', '%' . $param['searchText'] . '%'];
            }
            $Feedback = new FeedbackModel();
            $selectResult = $Feedback->getFeedbackByWhere($where, $offset, $limit);
            $feedback = config('feed_back_type');
            $feedbackstatus = config('feed_back_status');
            foreach ($selectResult as $key => $vo) {
                $selectResult[$key]['url'] = '<img src="' . $vo['url'] . '" width="40px" height="40px">';
                $selectResult[$key]['type'] = $feedback[$vo['type']];
                $selectResult[$key]['status'] = $feedbackstatus[$vo['status']];
                $selectResult[$key]['operate'] = showOperate($this->makeButton($vo['id']));
                $selectResult[$key]['create_time'] = date('Y-m-d H:i:s', $vo['create_time']);
            }
            $return['total'] = $Feedback->getAllFeedback($where);  // 总数据
            $return['rows'] = $selectResult;
            return json($return);
        }
        return $this->fetch();
    }

    // 添加反馈信息
    public function FeedbackAdd()
    {
        if (request()->isPost()) {
            $param = input('post.');
            unset($param['file']);
            $Feedback = new FeedbackModel();
            $flag = $Feedback->addFeedback($param);
            return json(msg($flag['code'], $flag['data'], $flag['msg']));
        }
        return $this->fetch('feedbackadd');
    }

    public function FeedbackEdit()
    {
        $Feedback = new FeedbackModel();
        if (request()->isPost()) {
            $param = input('post.');
            unset($param['file']);
            $flag = $Feedback->editFeedback($param);
            return json(msg($flag['code'], $flag['data'], $flag['msg']));
        }
        $id = input('param.id');
        $this->assign([
            'Feedback' => $Feedback->getOneFeedback($id)
        ]);
        return $this->fetch('feedbackedit');
    }

    //查看页面
    public function checkfeed()
    {
        $Feedback = new FeedbackModel();
        if (request()->isPost()) {
            $param = input('post.');
            unset($param['file']);
            $flag = $Feedback->editFeedback($param);
            return json(msg($flag['code'], $flag['data'], $flag['msg']));
        }
        $id = input('param.id');
        $feedback = $Feedback->getOneFeedback($id);
        $feedbacktype = config('feed_back_type');
        $feedback['type'] = $feedbacktype[$feedback['type']];
        $this->assign([
            'feedback' =>$feedback,
            'feedbackstatus' => config('feed_back_status'),
        ]);
        return $this->fetch();
    }

    public function FeedbackDel()
    {
        $id = input('param.id');
        $Feedback = new FeedbackModel();
        $flag = $Feedback->delFeedback($id);
        return json(msg($flag['code'], $flag['data'], $flag['msg']));
    }

    /**
     * 反馈处理
     * @return \think\response\Json
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function check_feed_back()
    {
        if ($this->request->isAjax()) {
            $param = input('param.');
            $res = db('feedback')->where('id', $param['feed_id'])->update(['status'=>$param['status']]);
            if ($res) {
                return json(msg(1, '', '处理成功！'));
            } else {
                return json(msg(-1, '', '处理失败！'));
            }
        }
    }

    // 上传缩略图
    public function uploadImg()
    {
        if (request()->isAjax()) {

            $file = request()->file('file');
            // 移动到框架应用根目录/public/uploads/ 目录下
            $info = $file->move(ROOT_PATH . 'public' . DS . 'upload/Feedback');
            if ($info) {
                $src = '/upload/feedback' . '/' . date('Ymd') . '/' . $info->getFilename();
                return json(msg(0, ['src' => $src], ''));
            } else {
                // 上传失败获取错误信息
                return json(msg(-1, '', $file->getError()));
            }
        }
    }

    /**
     * 拼装操作按钮
     * @param $id
     * @return array
     */
    private function makeButton($id)
    {
        return [
            '查看' => [
                'auth' => 'feedback/checkfeed',
                'href' => url('Feedback/checkfeed', ['id' => $id]),
                'btnStyle' => 'primary',
                'icon' => 'fa fa-paste'
            ],
            '删除' => [
                'auth' => 'feedback/feedbackdel',
                'href' => "javascript:feedbackDel(" . $id . ")",
                'btnStyle' => 'danger',
                'icon' => 'fa fa-trash-o'
            ]
        ];
    }
}
