<?php
    header('content-type:text/html charset:utf-8');
    $dir_base = "./files/";     //�ļ��ϴ���Ŀ¼
    //û�гɹ��ϴ��ļ��������˳���
    $output = "<textarea>";
    $index = 0;        //$_FILES ���ļ�nameΪ�����±꣬������foreach($_FILES as $index=>$file)
    foreach($_FILES as $file){
        $upload_file_name = 'upload_file' . $index;        //��Ӧindex.html FomData�е��ļ�����
        $filename = $_FILES[$upload_file_name]['name'];
        $gb_filename = iconv('utf-8','gb2312',$filename);    //����ת����gb2312����
        //�ļ������ڲ��ϴ�
        if(!file_exists($dir_base.$gb_filename)) {
            $isMoved = false;  //Ĭ���ϴ�ʧ��
            $MAXIMUM_FILESIZE = 1 * 1024 * 1024;     //�ļ���С����    1M = 1 * 1024 * 1024 B;
            $rEFileTypes = "/^\.(jpg|jpeg|gif|png){1}$/i"; 
            if ($_FILES[$upload_file_name]['size'] <= $MAXIMUM_FILESIZE && 
                preg_match($rEFileTypes, strrchr($gb_filename, '.'))) {
                $isMoved = @move_uploaded_file ( $_FILES[$upload_file_name]['tmp_name'], $dir_base.$gb_filename);        //�ϴ��ļ�
            }
        }else{
            $isMoved = true;    //�Ѵ����ļ�����Ϊ�ϴ��ɹ�
        }
        if($isMoved){
            //���ͼƬ�ļ�<img>��ǩ
            //ע����һЩϵͳsrc������Ҫurlencode��������ͼƬ�޷���ʾ��
            //�볢�� urlencode($gb_filename) �� urlencode($filename)��������鿴HTML����ʾ��src����������
            $output .= "<img src='{$dir_base}{$filename}' title='{$filename}' alt='{$filename}'/>";
        }else {
            //�ϴ�ʧ�����error.jpg���ظ�ǰ��
            $output .= "<img src='{$dir_base}error.jpg' title='{$filename}' alt='{$filename}'/>";
        }
        $index++;
    }
    echo $output."</textarea>";
    
//End_php