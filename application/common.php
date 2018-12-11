<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

//生成订单号
function createOrderNumber()
{
    $str = date('Ymd') . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
    return $str;
}

//根据时间戳获取周几
function getWeek($time)
{
    $array = ["周日", "周一", "周二", "周三", "周四", "周五", "周六"];
    $time = date("w", $time);
    return $array[$time];
}

/**
 * 根据数组返回图表数据
 * @param $signdata
 * @return array
 */
//function getArr($signdata, $type)
//{
//    $signArr = [];
//    foreach ($signdata as $k => $v) {
//        $signArr['maxdata'][] = $v['integral'];
//        if (getWeek($v['create_time']) == "周一") {
//            if ($type == 0) {
//                $signArr['mon'][] = $v['integral'];
//            } else {
//                $signArr['mon'][] = $v['uid'];
//            }
//        }
//        if (getWeek($v['create_time']) == "周二") {
//            if ($type == 0) {
//                $signArr['tue'][] = $v['integral'];
//            } else {
//                $signArr['tue'][] = $v['uid'];
//            }
//        }
//        if (getWeek($v['create_time']) == "周三") {
//            if ($type == 0) {
//                $signArr['wed'][] = $v['integral'];
//            } else {
//                $signArr['wed'][] = $v['uid'];
//            }
//        }
//        if (getWeek($v['create_time']) == "周四") {
//            if ($type == 0) {
//                $signArr['thu'][] = $v['integral'];
//            } else {
//                $signArr['thu'][] = $v['uid'];
//            }
//        }
//        if (getWeek($v['create_time']) == "周五") {
//            if ($type == 0) {
//                $signArr['fri'][] = $v['integral'];
//            } else {
//                $signArr['fri'][] = $v['uid'];
//            }
//        }
//        if (getWeek($v['create_time']) == "周六") {
//            if ($type == 0) {
//                $signArr['sat'][] = $v['integral'];
//            } else {
//                $signArr['sat'][] = $v['uid'];
//            }
//        }
//        if (getWeek($v['create_time']) == "周日") {
//            if ($type == 0) {
//                $signArr['week'][] = $v['integral'];
//            } else {
//                $signArr['week'][] = $v['uid'];
//            }
//        }
//    }
//    if ($type == 0) {
//        if (isset($signArr['mon'])) {
//            $signArr['monmax'] = max($signArr['mon']);
//        } else {
//            $signArr['monmax'] = 0;
//        }
//        if (isset($signArr['wed'])) {
//            $signArr['tuemax'] = max($signArr['tue']);
//        } else {
//            $signArr['tuemax'] = 0;
//        }
//        if (isset($signArr['web'])) {
//            $signArr['wedmax'] = max($signArr['wed']);
//        } else {
//            $signArr['wedmax'] = 0;
//        }
//        if (isset($signArr['thu'])) {
//            $signArr['thumax'] = max($signArr['thu']);
//        } else {
//            $signArr['thumax'] = 0;
//        }
//        if (isset($signArr['fri'])) {
//            $signArr['frimax'] = max($signArr['fri']);
//        } else {
//            $signArr['frimax'] = 0;
//        }
//        if (isset($signArr['sat'])) {
//            $signArr['satmax'] = max($signArr['sat']);
//        } else {
//            $signArr['satmax'] = 0;
//        }
//        if (isset($signArr['week'])) {
//            $signArr['weekmax'] = max($signArr['week']);
//        } else {
//            $signArr['weekmax'] = 0;
//        }
//
//
//        if (isset($signArr['mon'])) {
//            $signArr['monmin'] = min($signArr['mon']);
//        } else {
//            $signArr['monmin'] = 0;
//        }
//        if (isset($signArr['wed'])) {
//            $signArr['tuemin'] = min($signArr['tue']);
//        } else {
//            $signArr['tuemin'] = 0;
//        }
//        if (isset($signArr['web'])) {
//            $signArr['wedmin'] = min($signArr['wed']);
//        } else {
//            $signArr['wedmin'] = 0;
//        }
//        if (isset($signArr['thu'])) {
//            $signArr['thumin'] = min($signArr['thu']);
//        } else {
//            $signArr['thumin'] = 0;
//        }
//        if (isset($signArr['fri'])) {
//            $signArr['frimin'] = min($signArr['fri']);
//        } else {
//            $signArr['frimin'] = 0;
//        }
//        if (isset($signArr['sat'])) {
//            $signArr['satmin'] = min($signArr['sat']);
//        } else {
//            $signArr['satmin'] = 0;
//        }
//        if (isset($signArr['week'])) {
//            $signArr['weekmin'] = min($signArr['week']);
//        } else {
//            $signArr['weekmin'] = 0;
//        }
//    } else {
//        if (isset($signArr['mon'])) {
//            $signArr['monmax'] = count($signArr['mon']);
//        } else {
//            $signArr['monmax'] = 0;
//        }
//        if (isset($signArr['wed'])) {
//            $signArr['tuemax'] = count($signArr['tue']);
//        } else {
//            $signArr['tuemax'] = 0;
//        }
//        if (isset($signArr['web'])) {
//            $signArr['wedmax'] = count($signArr['wed']);
//        } else {
//            $signArr['wedmax'] = 0;
//        }
//        if (isset($signArr['thu'])) {
//            $signArr['thumax'] = count($signArr['thu']);
//        } else {
//            $signArr['thumax'] = 0;
//        }
//        if (isset($signArr['fri'])) {
//            $signArr['frimax'] = count($signArr['fri']);
//        } else {
//            $signArr['frimax'] = 0;
//        }
//        if (isset($signArr['sat'])) {
//            $signArr['satmax'] = count($signArr['sat']);
//        } else {
//            $signArr['satmax'] = 0;
//        }
//        if (isset($signArr['week'])) {
//            $signArr['weekmax'] = count($signArr['week']);
//        } else {
//            $signArr['weekmax'] = 0;
//        }
//    }
//    return $signArr;
//}

function getArr($signdata, $type)
{
    $signArr = [];
    foreach ($signdata as $k => $v) {
        $signArr['maxdata'][] = $v['integral'];
        if (getWeek($v['create_time']) == "周一") {
            if ($type == 0) {
                $signArr['mon'][] = $v['integral'];
            } else {
                $signArr['mon'][] = $v['uid'];
            }
        }
        if (getWeek($v['create_time']) == "周二") {
            if ($type == 0) {
                $signArr['tue'][] = $v['integral'];
            } else {
                $signArr['tue'][] = $v['uid'];
            }
        }
        if (getWeek($v['create_time']) == "周三") {
            if ($type == 0) {
                $signArr['wed'][] = $v['integral'];
            } else {
                $signArr['wed'][] = $v['uid'];
            }
        }
        if (getWeek($v['create_time']) == "周四") {
            if ($type == 0) {
                $signArr['thu'][] = $v['integral'];
            } else {
                $signArr['thu'][] = $v['uid'];
            }
        }
        if (getWeek($v['create_time']) == "周五") {
            if ($type == 0) {
                $signArr['fri'][] = $v['integral'];
            } else {
                $signArr['fri'][] = $v['uid'];
            }
        }
        if (getWeek($v['create_time']) == "周六") {
            if ($type == 0) {
                $signArr['sat'][] = $v['integral'];
            } else {
                $signArr['sat'][] = $v['uid'];
            }
        }
        if (getWeek($v['create_time']) == "周日") {
            if ($type == 0) {
                $signArr['week'][] = $v['integral'];
            } else {
                $signArr['week'][] = $v['uid'];
            }
        }
    }
    if ($type == 0) {
        if (isset($signArr['mon'])) {
            $signArr['monsum'] = array_sum($signArr['mon']);
        } else {
            $signArr['monsum'] = 0;
        }
        if (isset($signArr['wed'])) {
            $signArr['tuesum'] = array_sum($signArr['tue']);
        } else {
            $signArr['tuesum'] = 0;
        }
        if (isset($signArr['web'])) {
            $signArr['wedsum'] = array_sum($signArr['wed']);
        } else {
            $signArr['wedsum'] = 0;
        }
        if (isset($signArr['thu'])) {
            $signArr['thusum'] = array_sum($signArr['thu']);
        } else {
            $signArr['thusum'] = 0;
        }
        if (isset($signArr['fri'])) {
            $signArr['frisum'] = array_sum($signArr['fri']);
        } else {
            $signArr['frisum'] = 0;
        }
        if (isset($signArr['sat'])) {
            $signArr['satsum'] = array_sum($signArr['sat']);
        } else {
            $signArr['satsum'] = 0;
        }
        if (isset($signArr['week'])) {
            $signArr['weeksum'] = array_sum($signArr['week']);
        } else {
            $signArr['weeksum'] = 0;
        }

    } else {
        if (isset($signArr['mon'])) {
            $signArr['monsum'] = count($signArr['mon']);
        } else {
            $signArr['monsum'] = 0;
        }
        if (isset($signArr['wed'])) {
            $signArr['tuesum'] = count($signArr['tue']);
        } else {
            $signArr['tuesum'] = 0;
        }
        if (isset($signArr['web'])) {
            $signArr['wedsum'] = count($signArr['wed']);
        } else {
            $signArr['wedsum'] = 0;
        }
        if (isset($signArr['thu'])) {
            $signArr['thusum'] = count($signArr['thu']);
        } else {
            $signArr['thusum'] = 0;
        }
        if (isset($signArr['fri'])) {
            $signArr['frisum'] = count($signArr['fri']);
        } else {
            $signArr['frisum'] = 0;
        }
        if (isset($signArr['sat'])) {
            $signArr['satsum'] = count($signArr['sat']);
        } else {
            $signArr['satsum'] = 0;
        }
        if (isset($signArr['week'])) {
            $signArr['weeksum'] = count($signArr['week']);
        } else {
            $signArr['weeksum'] = 0;
        }
    }
    return $signArr;
}

/**
 * 根据数组返回推荐人图表数据
 * @param $signdata
 * @return array
 */
//function getCountArr($signdata)
//{
//    $signArr = [];
//    foreach ($signdata as $k => $v) {
//        if (getWeek($v['create_time']) == "周一") {
//            $signArr['mon'][] = $v['id'];
//        }
//        if (getWeek($v['create_time']) == "周二") {
//            $signArr['tue'][] = $v['id'];
//        }
//        if (getWeek($v['create_time']) == "周三") {
//            $signArr['wed'][] = $v['id'];
//        }
//        if (getWeek($v['create_time']) == "周四") {
//            $signArr['thu'][] = $v['id'];
//        }
//        if (getWeek($v['create_time']) == "周五") {
//            $signArr['fri'][] = $v['id'];
//        }
//        if (getWeek($v['create_time']) == "周六") {
//            $signArr['sat'][] = $v['id'];
//        }
//        if (getWeek($v['create_time']) == "周日") {
//            $signArr['week'][] = $v['id'];
//        }
//    }
//    if (isset($signArr['mon'])) {
//        $signArr['monmax'] = count($signArr['mon']);
//    } else {
//        $signArr['monmax'] = 0;
//    }
//    if (isset($signArr['wed'])) {
//        $signArr['tuemax'] = count($signArr['tue']);
//    } else {
//        $signArr['tuemax'] = 0;
//    }
//    if (isset($signArr['web'])) {
//        $signArr['wedmax'] = count($signArr['wed']);
//    } else {
//        $signArr['wedmax'] = 0;
//    }
//    if (isset($signArr['thu'])) {
//        $signArr['thumax'] = count($signArr['thu']);
//    } else {
//        $signArr['thumax'] = 0;
//    }
//    if (isset($signArr['fri'])) {
//        $signArr['frimax'] = count($signArr['fri']);
//    } else {
//        $signArr['frimax'] = 0;
//    }
//    if (isset($signArr['sat'])) {
//        $signArr['satmax'] = count($signArr['sat']);
//    } else {
//        $signArr['satmax'] = 0;
//    }
//    if (isset($signArr['week'])) {
//        $signArr['weekmax'] = count($signArr['week']);
//    } else {
//        $signArr['weekmax'] = 0;
//    }
////    halt($signArr);
//    return $signArr;
//}
function getCountArr($signdata)
{
    $signArr = [];
    foreach ($signdata as $k => $v) {
        if (getWeek($v['create_time']) == "周一") {
            $signArr['mon'][] = $v['id'];
        }
        if (getWeek($v['create_time']) == "周二") {
            $signArr['tue'][] = $v['id'];
        }
        if (getWeek($v['create_time']) == "周三") {
            $signArr['wed'][] = $v['id'];
        }
        if (getWeek($v['create_time']) == "周四") {
            $signArr['thu'][] = $v['id'];
        }
        if (getWeek($v['create_time']) == "周五") {
            $signArr['fri'][] = $v['id'];
        }
        if (getWeek($v['create_time']) == "周六") {
            $signArr['sat'][] = $v['id'];
        }
        if (getWeek($v['create_time']) == "周日") {
            $signArr['week'][] = $v['id'];
        }
    }
    if (isset($signArr['mon'])) {
        $signArr['monsum'] = count($signArr['mon']);
    } else {
        $signArr['monsum'] = 0;
    }
    if (isset($signArr['wed'])) {
        $signArr['tuesum'] = count($signArr['tue']);
    } else {
        $signArr['tuesum'] = 0;
    }
    if (isset($signArr['web'])) {
        $signArr['wedsum'] = count($signArr['wed']);
    } else {
        $signArr['wedsum'] = 0;
    }
    if (isset($signArr['thu'])) {
        $signArr['thusum'] = count($signArr['thu']);
    } else {
        $signArr['thusum'] = 0;
    }
    if (isset($signArr['fri'])) {
        $signArr['frisum'] = count($signArr['fri']);
    } else {
        $signArr['frisum'] = 0;
    }
    if (isset($signArr['sat'])) {
        $signArr['satsum'] = count($signArr['sat']);
    } else {
        $signArr['satsum'] = 0;
    }
    if (isset($signArr['week'])) {
        $signArr['weeksum'] = count($signArr['week']);
    } else {
        $signArr['weeksum'] = 0;
    }
//    halt($signArr);
    return $signArr;
}

/**
 * 课时统计
 */
function getCourseArr($signdata) {
    $signArr = [];
    foreach ($signdata as $k => $v) {
        if (getWeek($v['create_time']) == "周一") {
            $signArr['mon'][] = $v['id'];
        }
        if (getWeek($v['create_time']) == "周二") {
            $signArr['tue'][] = $v['id'];
        }
        if (getWeek($v['create_time']) == "周三") {
            $signArr['wed'][] = $v['id'];
        }
        if (getWeek($v['create_time']) == "周四") {
            $signArr['thu'][] = $v['id'];
        }
        if (getWeek($v['create_time']) == "周五") {
            $signArr['fri'][] = $v['id'];
        }
        if (getWeek($v['create_time']) == "周六") {
            $signArr['sat'][] = $v['id'];
        }
        if (getWeek($v['create_time']) == "周日") {
            $signArr['week'][] = $v['id'];
        }
    }
    if (isset($signArr['mon'])) {
        $signArr['monsum'] = array_sum($signArr['mon']);
    } else {
        $signArr['monsum'] = 0;
    }
    if (isset($signArr['wed'])) {
        $signArr['tuesum'] = array_sum($signArr['tue']);
    } else {
        $signArr['tuemax'] = 0;
    }
    if (isset($signArr['web'])) {
        $signArr['wedsum'] = array_sum($signArr['wed']);
    } else {
        $signArr['wedsum'] = 0;
    }
    if (isset($signArr['thu'])) {
        $signArr['thusum'] = array_sum($signArr['thu']);
    } else {
        $signArr['thusum'] = 0;
    }
    if (isset($signArr['fri'])) {
        $signArr['frisum'] = array_sum($signArr['fri']);
    } else {
        $signArr['frisum'] = 0;
    }
    if (isset($signArr['sat'])) {
        $signArr['satsum'] = array_sum($signArr['sat']);
    } else {
        $signArr['satsum'] = 0;
    }
    if (isset($signArr['week'])) {
        $signArr['weeksum'] = array_sum($signArr['week']);
    } else {
        $signArr['weeksum'] = 0;
    }
//    halt($signArr);
    return $signArr;
}

//生成推广码
function GetRandStr($len)
{
    $chars = array(
        "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k",
        "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v",
        "w", "x", "y", "z", "A", "B", "C", "D", "E", "F", "G",
        "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R",
        "S", "T", "U", "V", "W", "X", "Y", "Z", "0", "1", "2",
        "3", "4", "5", "6", "7", "8", "9"
    );
    $charsLen = count($chars) - 1;
    shuffle($chars);
    $output = "";
    for ($i = 0; $i < $len; $i++) {
        $output .= $chars[mt_rand(0, $charsLen)];
    }
    return $output;

}

/**
 * 统一返回信息
 * @param $code
 * @param $data
 * @param $msge
 */
function msg($code, $data, $msg)
{
    return compact('code', 'data', 'msg');
}

/** 
 *      *@desc 给定二维数组按照指定的键进行排序
 *      *@param array
 *      *@return array
 *      **/
function array_sort($arr, $keys, $stype = 'asc')
{
    $keysvalue = $new_array = array();
    foreach ($arr as $k => $v) {
        $keysvalue[$k] = $v[$keys];
    }

    if ($stype == 'asc') {
        asort($keysvalue);
    } else {
        arsort($keysvalue);
    }
    reset($keysvalue);
    foreach ($keysvalue as $k => $v) {
        $new_array[$k] = $arr[$k];
    }
    return $new_array;
}

/**
 * 对数组按照键值倒叙排序,实现mysql order by的机制，先按照up字段降序排序，然后按照date字段的值降序排序
 * @param $array
 * @return mixed
 */
function arraySort($array)
{
    $up = [];
    $date = [];
    foreach ($array as $key => $row) {
        $up[$key] = $row['up'];
        $date[$key] = $row['dateline'];
    }
    array_multisort($up, SORT_DESC, $date, SORT_DESC, $array);
    return $array;
}

//身份证验证
function CheckIsIDCard($id_card)
{
    if (mb_strlen($id_card) != 18) return false;
    //校验位列表
    $remainder_list = [1, 0, 'X', 9, 8, 7, 6, 5, 4, 3, 2];
    //加权除以11的余数
    $square_remainder = [7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2];
    //取得身份证号码最后一位校验位
    $check_num = mb_substr($id_card, 17);
    //身份证参与校验的前17位
    $id_card = mb_substr($id_card, 0, 17);
    //参与校验的必须是数字
    if (!is_numeric($id_card)) return false;
    $square_sum = 0;//每一位参与校验数乘以加权数的累加和
    $number_sum = 0;//每一位参与校验数乘以加权除以11的余数的累加和
    for ($i = 0; $i < 17; $i++) {
        //累加结果
        $square_sum += intval($id_card[$i]) * pow(2, 17 - $i);
        //累加结果
        $number_sum += intval($id_card[$i]) * $square_remainder[$i];
    }
    //从校验位列表中获取加权乘积和得到的校验位
    $check_get_square_remainder = isset($remainder_list[$square_sum % 11]) ? $remainder_list[$square_sum % 11] : -1;
    //从校验位列表中获取加权余数乘积和得到的校验位
    $check_get_number_remainder = isset($remainder_list[$number_sum % 11]) ? $remainder_list[$number_sum % 11] : -1;
    if ($check_get_square_remainder == $check_num && $check_get_number_remainder == $check_num) return true;
    return false;
}

/**
 * 格式化时间
 * @param $time
 * @return string
 */
function format_date($time)
{
    $t = time() - $time;
    $f = array(
        '31536000' => '年',
        '2592000' => '个月',
        '604800' => '星期',
        '86400' => '天',
        '3600' => '小时',
        '60' => '分钟',
        '1' => '秒'
    );
    foreach ($f as $k => $v) {
        if (0 != $c = floor($t / (int)$k)) {
            return $c . $v . '前';
        }
    }
}

