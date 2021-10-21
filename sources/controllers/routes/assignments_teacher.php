<?php

    function assignments_teacher () {

        $conn = new Connect_MySql();

        $assigns = $conn->load('assignments');
        $group = $conn->load('classs');
        $users_assigns = $conn->load('users_assigns');
        $nof = $conn->load('notifications');
        $questions = $conn->load('questions');
        $uqa = $conn->load('users_questions_assigns');

        // 
        $exists_assign = $assigns->exists_ref_table('class', 'cid', 'tid', user()['uid']);
       
        if($exists_assign):
            $fetch = $group->get_ref_table_fkey_where_fetch('assignments', 'cid', 'tid', user()['uid']);

            $aname = empty($_GET['assignments']) ? $fetch['aname'] : $_GET['assignments'];
            
            set_current_assignment($assigns->get_column_value_fetch('aname', $aname));
            set_current_group($group->get_column_value_fetch('cid', c_assign()['cid'])); 
        endif;   

        // 
        if(isset($_POST['delete_assign'])):

            $users_assigns->delete_column_value('aid', $_POST['delete_assign']);
            $uqa->delete_column_value('aid', $_POST['delete_assign']);
            $questions->delete_column_value('aid', $_POST['delete_assign']);
            $assigns->delete_column_value('aid', $_POST['delete_assign']);
            $nof->insert_into(null, current_group()['cid'], user()['name'], 'đã xóa bài thi', c_assign()['aname'], null);
            
            send_message('Bài thi ' . c_assign()['aname'] . ' đã được xóa!', 'success');
            header('location: ./');
        endif;
        // 
        if(isset($_POST['export'])):
            require Path_pro . '/sources/PHPExcel1-8/PHPExcel.php';

            $excel = new PHPExcel();
            
            $excel->setActiveSheetIndex(0);
            $sheet = $excel->getActiveSheet()->setTitle('Sheet1');

            $row = 1;
            $sheet->setCellValue('A'.$row, 'STT');
            $sheet->setCellValue('B'.$row, 'Họ tên');
            $sheet->setCellValue('C'.$row, '');
            $sheet->setCellValue('D'.$row, 'Đúng');
            $sheet->setCellValue('E'.$row, 'Sai');
            $sheet->setCellValue('F'.$row, 'None');
            $sheet->setCellValue('G'.$row, 'Điểm');

            $extract = $users_assigns->get_ref_table_fkey_where_asc('users','uid','aid',c_assign()['aid'],'name');
            
            foreach ($extract as $key => $value) {
                $each = $questions->get_ref_table_dl_where('users_questions_assigns','qid','aid', c_assign()['aid'],'uid',$value['uid']);
        
                    $total = $numN = $numR = $numF = 0;
                    foreach ($each as $key => $e) {
                        $total++;
                        if($e['choose']=='none') { 
                            $numN++;
                        }
                        if($e['choose']==$e['answer']) { 
                            $numR++;
                        }
                    }

                $turn_in = $value['turn_in'] ? 'đã nộp' : 'chưa nộp';

                $row++;
                $sheet->setCellValue('A'.$row, $row - 1);
                $sheet->setCellValue('B'.$row, $value['name']);
                $sheet->setCellValue('C'.$row, $turn_in);
                $sheet->setCellValue('D'.$row, $numR);
                $sheet->setCellValue('E'.$row, $total - $numR - $numN);
                $sheet->setCellValue('F'.$row, $numN);
                $sheet->setCellValue('G'.$row, round($value['result'], 2));
            }
            $writer = new PHPExcel_Writer_Excel2007($excel);
                
            $filename = c_assign()['aname'] . '.xlsx';
            $writer->save($filename);

            header("Content-Disposition: attachment; filename=" . $filename);
            header("Content-Type: application/vnd.openxmlformatsofficedocument.spreadsheetml.sheet");
            header("Content-Length: " . filesize($filename));
            header("Content-Transfer-Encoding: binary");
            header("Cache-Control: must-revalidate");
            header("Pragma: no-cache");
            readfile($filename);

            return;
            
        endif;

        // 
        if(isset($_POST['deletequestion'])):

            $uqa->delete_column_value('qid', $_POST['deletequestion']);
            $questions->delete_column_value('qid', $_POST['deletequestion']);
            
            send_message('Bạn vừa xóa một câu hỏi!', 'success');
        endif;

        if(isset($_POST['importquestions'])):
            $filename = $_FILES['file']['name'];
            $fileType = explode('.', $filename)[1];

            if($fileType=='xlsx') {
                $file = $_FILES['file']['tmp_name'];

                require Path_pro . '/sources/PHPExcel1-8/PHPExcel.php';

                $reader = PHPExcel_IOFactory::createReaderForFile($file);
            
                $data = $reader->load($file);

                $sheet = $data->getActiveSheet()->toArray(null, true, true, true);
                $highestRow = $data->setActiveSheetIndex()->getHighestRow();
                $highestCol = $data->setActiveSheetIndex()->getHighestColumn();

                $count = 0;
                for ($row = 2; $row <= $highestRow; $row++) { 
                    if($sheet[$row]['A']!='') {
                        $count++;

                        if(empty($sheet[$row]['B'])) $sheet[$row]['B'] = 'Vui lòng kiểm tra dữ liệu file Excel';
                        if(empty($sheet[$row]['C'])) $sheet[$row]['C'] = 'Vui lòng kiểm tra dữ liệu file Excel';
                        if(empty($sheet[$row]['D'])) $sheet[$row]['D'] = 'Vui lòng kiểm tra dữ liệu file Excel';
                        if(empty($sheet[$row]['E'])) $sheet[$row]['E'] = 'Vui lòng kiểm tra dữ liệu file Excel';
                        if(empty($sheet[$row]['F'])) $sheet[$row]['F'] = 'F';

                        $questions->insert_into(null, c_assign()['aid'], $sheet[$row]['A'], $sheet[$row]['B'], $sheet[$row]['C'], $sheet[$row]['D'], $sheet[$row]['E'], $sheet[$row]['F']);
                        
                        $qid = $questions->max('qid');
                        
                        $list_students = $users_assigns->get_column_value_fetchAll('aid', c_assign()['aid']);
                        foreach ($list_students as $key => $value) {
                            $uqa->insert_into(null, c_assign()['aid'], $value['uid'], $qid, 'none');
                        }
                    }
                }

                send_message("$count dòng được thực thi!", 'success');
            } else {
                send_message("Vui lòng chọn file '.xlsx'", 'danger');
            }
        endif;
        


        render_role('assignments_teacher', [
            'title' => 'Assignments',
            "active" => 3,

            'group' => $group,
            'assign' => $assigns,
            'users_assigns' => $users_assigns,
            'questions' => $questions,

            'exists_assign' => $exists_assign

            
        ]);
    }