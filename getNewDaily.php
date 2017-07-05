<?php
/**
 * 获取知乎日报中最新一条瞎扯
 * 数据来源：zhihu.com
 * 作者：leafrainy （leafrainy.cc）
 * 时间：2017-07-05
 */
date_default_timezone_set('Asia/Shanghai');

class getNewDaily {


    //获取最新一条知乎瞎扯
    public function getNewDaily(){
        $rs = $this->get("http://news-at.zhihu.com/api/7/section/2");
        $rsArray = json_decode($rs,1);
        $lastNewDate = $rsArray['stories']['0']['date'];
        $nowDate = date("Ymd",time());
        if($nowDate == $lastNewDate){
            return "http://daily.zhihu.com/story/".$rsArray['stories']['0']['id'];
        }
    }
    
    //get请求
    private function get($url, $timeoutMs = 3000) {
        $options = array(
            CURLOPT_URL                 => $url,
            CURLOPT_RETURNTRANSFER      => TRUE,
            CURLOPT_HEADER              => 0,
            CURLOPT_CONNECTTIMEOUT_MS   => $timeoutMs,
        );
        $ch = curl_init();
        curl_setopt_array( $ch, $options);
        $rs = curl_exec($ch);
        curl_close($ch);
        return $rs;
    }

}

