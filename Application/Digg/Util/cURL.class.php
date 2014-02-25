<?php

class Curl { 
 
    /*
     * get ��ʽ��ȡ����ָ����ַ
     * @param  string url Ҫ���ʵĵ�ַ
     * @param  string cookie cookie�Ĵ�ŵ�ַ,û���򲻷���cookie
     * @return string curl_exec()��ȡ����Ϣ
     * @author andy
     **/ 
    public function get( $url, $cookie='' ) 
    { 
        // ��ʼ��һ��cURL�Ự  
        $curl = curl_init($url); 
        // ����ʾheader��Ϣ  
        curl_setopt($curl, CURLOPT_HEADER, 1); 
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        	'Host: book.douban.com')); 
        // �� curl_exec()��ȡ����Ϣ���ļ�������ʽ���أ�������ֱ�������  
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
        // ʹ���Զ���ת  
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); 
        if(!empty($cookie)) { 
            // ����cookie���ݵ��ļ�����cookie�ļ��ĸ�ʽ������Netscape��ʽ������ֻ�Ǵ�HTTPͷ����Ϣ�����ļ���  
            curl_setopt($curl, CURLOPT_COOKIEFILE, $cookie); 
        } 
        // �Զ�����Referer  
        curl_setopt($curl, CURLOPT_AUTOREFERER, 1); 
        // ִ��һ��curl�Ự  
        $tmp = curl_exec($curl); 
        // �ر�curl�Ự  
        curl_close($curl); 
        return $tmp; 
    } 
 
    /*
     * post ��ʽģ������ָ����ַ
     * @param  string url   �����ָ����ַ
     * @param  array  params ����������
     * #patam  string cookie cookie��ŵ�ַ
     * @return string curl_exec()��ȡ����Ϣ
     * @author andy
     **/ 
    public function post( $url, $params, $cookie ) 
    { 
        $curl = curl_init($url); 
        curl_setopt($curl, CURLOPT_HEADER, 0); 
        // ����֤֤����Դ�ļ�飬0��ʾ��ֹ��֤��ĺϷ��Եļ�顣  
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); 
        // ��֤���м��SSL�����㷨�Ƿ����  
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 1); 
        //ģ���û�ʹ�õ����������HTTP�����а���һ����user-agent��ͷ���ַ�����  
        curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        //curl_setopt($curl, CURLOPT_USERAGENT, 'User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.1 (KHTML, like Gecko) Chrome/21.0.1180.89 Safari/537.1'); 
        //����һ�������POST��������Ϊ��application/x-www-form-urlencoded��������ύ��һ����  
        curl_setopt($curl, CURLOPT_POST, 1); 
        // �� curl_exec()��ȡ����Ϣ���ļ�������ʽ���أ�������ֱ�������  
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
        // ʹ���Զ���ת  
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);  
        // �Զ�����Referer  
        curl_setopt($curl, CURLOPT_AUTOREFERER, 1); 
        // Cookie��ַ  
        curl_setopt($curl, CURLOPT_COOKIEJAR, $cookie); 
        // ȫ������ʹ��HTTPЭ���е�"POST"���������͡�Ҫ�����ļ���  
        // ���ļ���ǰ�����@ǰ׺��ʹ������·���������������ͨ��urlencoded����ַ���  
        // ����'para1=val1?2=val2&...'��ʹ��һ�����ֶ���Ϊ��ֵ���ֶ�����Ϊֵ������  
        // ���value��һ�����飬Content-Typeͷ���ᱻ���ó�multipart/form-data��  
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($params)); 
        $result = curl_exec($curl); 
        curl_close($curl); 
        return $result; 
    } 
 
    /**
     * Զ������
     * @param string $remote Զ��ͼƬ��ַ
     * @param string $local ���ر���ĵ�ַ
     * @param string $cookie cookie��ַ ��ѡ������
     * ��ĳЩ��վ����Ҫcookie����������վ�ϵ�ͼƬ��
     * ������Ҫ����cookie
     * @return void
     * @author andy
     */ 
    public function reutersload($remote, $local, $cookie= '') { 
        $cp = curl_init($remote); 
        $fp = fopen($local,"w"); 
        curl_setopt($cp, CURLOPT_FILE, $fp); 
        curl_setopt($cp, CURLOPT_HEADER, 0); 
        if($cookie != '') { 
            curl_setopt($cp, CURLOPT_COOKIEFILE, $cookie); 
        } 
        curl_exec($cp); 
        curl_close($cp); 
        fclose($fp); 
    } 
 
	} 

?>