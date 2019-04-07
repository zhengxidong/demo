
<table border='1' cellspacing="0" cellpadding="5" style="width: 100%">
　　　　<?php 
        /*$dbms='mysql';     //数据库类型
		$host='192.168.0.171'; //数据库主机名
		$dbName='ceshi';    //使用的数据库
		$user='root';      //数据库连接用户名
		$pass='root';          //对应的密码
		$dsn="$dbms:host=$host;dbname=$dbName";

		$pdo = new PDO($dsn, $user, $pass); //初始化一个PDO对象

         $where = null;

        $query = "SELECT * FROM `parking_calendar_work_range` WHERE provider_id=1 AND city_id=35 ";
        $result = $pdo->prepare($query);

        var_dump($result);
        exit;
　　　　$result->execute();*/
        //$mysqli=new mysqli("192.168.0.171","root","root","parking_meter");  
        $mysqli=new mysqli("192.168.0.171","root","root","ceshi");  
        $query = "SELECT * FROM `parking_calendar_work_range` WHERE provider_id=1 AND city_id=35 ";

        $res=$mysqli->query($query);

        $queryData = [];
        while ($row=$res->fetch_object())
        {
        	$queryData[] = $row;
        }
        if (empty($queryData))
        {
            return false;
        }

        //var_dump($queryData);
        //exit;
        
        $providerWorkRange = [];
        
        foreach ($queryData as $item)
        {
            $id = $item->id;
            $roadType = $item->road_type;
            $dateType = $item->day_type;
            $startTime = $item->start_time;
            $endTime = $item->end_time;
            $providerWorkRange[$id] = [
                'roadType' => $roadType,
                'dateType' => $dateType,
                'startTime' => $startTime,
                'endTime' => $endTime
            ];
        } ?>
            <tr>
            <td>idx索引</td>
            <td>索引</td>
            <td>费率ID</td>
            <td>日期类型</td>
            <td>工作时间范围</td>
            <td>规则标题</td>
            <td>开始时间：</td>
            <td>结束时间</td>
            <td>停放范围</td>
            <td>每隔</td>
            <td>----</td>
            <td>----</td>
            <td>价钱</td>
            </tr>
        <?php $nowDateTime = date('Y-m-d H:i:s');
        $returnData  = [];
        /*try {*/
        //var_dump($nowDateTime);
        foreach ($providerWorkRange as $workId=>$workSetting)
        {
            // 查询
            $dateType = $workSetting['dateType'];
            $roadType = $workSetting['roadType'];

            $query = "SELECT pt.parking_tariff_id as tariffid,pt.name,pt.start_date,pt.end_date,ptrr.title,ptrr.on_time,ptrr.off_time,".
                "       ptrr.scope,ptrr.timing_unit,ptrr.begin_time_code,ptrr.stop_time_code,ptrr.price,ptrr.priority,ptrr.calendar_date_type,ptrr.work_range_id ".
                " FROM parking_tariff as pt ".
                " LEFT JOIN parking_tariff_range_rule as ptrr on pt.parking_tariff_id=ptrr.parking_tariff_id ".
                " WHERE (pt.provider_id=1 AND pt.city_id=35 AND ptrr.work_range_id={$workId} AND ptrr.calendar_date_type={$dateType} AND pt.status=1) ".
                " ORDER BY ptrr.priority DESC ";

            $res=$mysqli->query($query);
            //$tariffInfo = self::find_by_sql($query);
            $tariffInfo = [];
			while ($row=$res->fetch_object())
			        {
			        	$tariffInfo[] = $row;
			        }

            if (empty($tariffInfo))
            {
                continue;
            } 
 			//var_dump($tariffInfo);
            ?>
            
            <?php foreach ($tariffInfo as $idx=>$tariffItem)
            {

                $tariffStartDate = (!empty($tariffItem->start_date)) ? $tariffItem->start_date : null;
                $tariffEndDate   = (!empty($tariffItem->end_date)) ? $tariffItem->end_date : null;
                //var_dump($tariffStartDate);
                //var_dump($tariffEndDate);
                if (empty($tariffStartDate)
                    || (!empty($tariffStartDate) && $tariffStartDate> $nowDateTime)
                    || (!empty($tariffEndDate) && $tariffEndDate < $nowDateTime))
                {
                    continue;
                }
            
                $price = $tariffItem->price;
                $notFreeFlag = true;
                if ($notFreeFlag == true)
                {
                    if ($price == 0 && $tariffItem->begin_time_code == 0) {

                        //echo 1;
                        //exit;
                        $i = $idx;

                        do {
                            //echo "索引:" . $i . "\n";
                            //var_dump(count($tariffInfo));
                            //var_dump($i);
                            //防止最后一条记录价钱为0,进入死循环
                            if(empty($tariffInfo[$i]))
                            {
                            	break;
                            }
                            $price = $tariffInfo[$i]->price; ?>
                            
                           <tr>
                            <!-- echo 'idx索引：'.$idx.
                                '索引：'.$i.
                                '费率ID:'.$tariffInfo[$i]->tariffid.
                                '日期类型:'.$tariffInfo[$i]->calendar_date_type.
                                '工作时间范围:'.$tariffInfo[$i]->work_range_id.
                                '规则标题:'.$tariffInfo[$i]->title.
                                '开始时间：'.$tariffInfo[$i]->on_time.
                                '结束时间:'.$tariffInfo[$i]->off_time.
                                '停放范围:'.$tariffInfo[$i]->scope.
                                '每隔'.$tariffInfo[$i]->timing_unit.
                                '---'.$tariffInfo[$i]->begin_time_code.
                                '---'.$tariffInfo[$i]->stop_time_code.
                                '价钱:'.$tariffInfo[$i]->price."\n\n"; -->


                                <td><?php echo $idx; ?></td>
	                            <td><?php echo $i; ?></td>
	                            <td><?php echo $tariffInfo[$i]->tariffid; ?></td>
	                            <td><?php echo $tariffInfo[$i]->calendar_date_type; ?></td>
	                            <td><?php echo $tariffInfo[$i]->work_range_id; ?></td>
	                            <td><?php echo $tariffInfo[$i]->title; ?></td>
	                            <td><?php echo $tariffInfo[$i]->on_time; ?></td>
	                            <td><?php echo $tariffInfo[$i]->off_time; ?></td>
	                            <td><?php echo $tariffInfo[$i]->scope; ?></td>
	                            <td><?php echo $tariffInfo[$i]->timing_unit; ?></td>
	                            <td><?php echo $tariffInfo[$i]->begin_time_code; ?></td>
	                            <td><?php echo $tariffInfo[$i]->stop_time_code; ?></td>
	                            <td><?php echo $tariffInfo[$i]->price; ?></td>
                            </tr>
                            <?php $i++;
                            
                        } while ($price == 0);
                        //throw new Exception($i);
                    }
                }

                $returnData[$dateType][$tariffItem->tariffid][] = [
                    'onTime' => $tariffItem->on_time,
                    'offTime' => $tariffItem->off_time,
                    'scope' => $tariffItem->scope,
                    'timingUnit' => $tariffItem->timing_unit,
                    'beginTimeCode' => $tariffItem->begin_time_code,
                    'stopTimeCode' => $tariffItem->stop_time_code,
                    'price' => $price,
                    'priority' => $tariffItem->priority,
                ];
            }
        } 
		/*} catch (Exception $e) {   
		print $e->getMessage();   
		exit();   
		}   */
        //print_r($returnData);



        ?>
　　</table>
<table>
<tr>
 <td>费率ID</td>
<!--<td>日期类型</td>
<td>工作时间范围ID</td>
<td>标题</td> -->
<td>开始时间</td>
<td>结束时间</td>
<td>停放范围</td>
<td>每隔</td>
<td>---</td>
<td>---</td>
<td>价钱</td>
<td>优先级</td>
</tr>
        <?php
        foreach ($returnData as $key => $value) {
        	foreach ($value as $k => $va) {
        		/*print_r($va);
        		exit;*/
        		?>
        		<tr>
        		 <td><?php echo $k; ?></td>
        		                <!--<td><?php echo $va['calendar_date_type']; ?></td> 
                <td><?php echo $va['work_range_id']; ?></td>
                <td><?php echo $va['title']; ?></td>-->
                <td><?php echo $va[0]['onTime']; ?></td>
                <td><?php echo $va[0]['offTime']; ?></td>
                <td><?php echo $va[0]['scope']; ?></td>
                <td><?php echo $va[0]['timingUnit']; ?></td>
                <td><?php echo $va[0]['beginTimeCode']; ?></td>
                <td><?php echo $va[0]['stopTimeCode']; ?></td>
                <td><?php echo $va[0]['price']; ?></td>
                <td><?php echo $va[0]['priority']; ?></td>
                </tr>
        	<?php } 
        	
        } ?>
　　</table>