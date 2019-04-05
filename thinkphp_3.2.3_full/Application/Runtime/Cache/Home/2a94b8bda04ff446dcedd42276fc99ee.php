<?php if (!defined('THINK_PATH')) exit();?><html>
    <div>
        <ul>
            <li><a href="<?php echo U('Export/index');?>" style="cursor: pointer;">导出Excel</a></li>
            <li><a href="<?php echo U('Export/index');?>">导出csv</a></li>
            <li><a href="">导出csv(将数据分割保存在多个csv文件中，并且最后压缩成zip文件提供下载) - 未测试</a></li>
            <li><a href="">导出csv(分批查询数据库导出数据) - 未测试</a></li>
            <li><a href="">发送邮件 - 未测试</a></li>
        </ul>
    </div>
</html>