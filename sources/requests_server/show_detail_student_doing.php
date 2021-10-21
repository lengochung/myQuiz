<?php

    require '../helpers/require_for_requests_server.php';

    $conn = new Connect_MySql();

    $users = $conn->load('users');
    $uqa = $conn->load('users_questions_assigns');
    $questions = $conn->load('questions');

    $user = $users->get_ref_table_dl_where_fetch('users_assigns','uid','aid', c_assign()['aid'],'name', $_GET['name']);

    if($user['login']):

        $request = $questions->get_ref_table_dl_where('users_questions_assigns','qid','aid', c_assign()['aid'],'uid',$user['uid']);
        
        $total = $numN = 0;
        foreach ($request as $key => $value) {
            $total++;
            if($value['choose']=='none') { 
                $numN++;
            }
        }


?>
        <small>
            <b><?php echo $user['name']; ?></b>
            <?php if($user['turn_in']): ?>
                <i class="text-success">đã nộp</i>
            <?php else: ?>
                <i class="text-secondary">chưa nộp</i>
            <?php endif; ?>
        </small>
        <div class="float-right pb-2">
            <small><b>Tiến trình:</b></small> <?php echo $numN; ?>/<?php echo $total; ?>
        </div> <br>

<?php
            
            $i = 1;
            foreach ($request as $key => $value) :
?>
            <small><b>Câu <?php echo $i++; ?>:</b></small> <?php echo $value['content']; ?> <br>
            <span class="p-2" style="float: left; width: 25%; display: block; background: <?php if($value['choose']=='A') echo 'grey'; ?>;">
                <span class="text-<?php if($value['answer']=='A') echo 'success'; ?>">A. <?php echo $value['a']; ?></span>
            </span>
            <span class="p-2" style="float: left;width: 25%; display: block; background: <?php if($value['choose']=='B') echo 'grey'; ?>;">
                <span class="text-<?php if($value['answer']=='B') echo 'success'; ?>">B. <?php echo $value['b']; ?></span>
            </span>
            <span class="p-2" style="float: left;width: 25%; display: block; background: <?php if($value['choose']=='C') echo 'grey'; ?>;">
                <span class="text-<?php if($value['answer']=='C') echo 'success'; ?>">C. <?php echo $value['c']; ?></span>
            </span>
            <span class="p-2" style="float: left;width: 25%; display: block; background: <?php if($value['choose']=='D') echo 'grey'; ?>;">
                <span class="text-<?php if($value['answer']=='D') echo 'success'; ?>">D. <?php echo $value['d']; ?></span>
            </span> <br>
        <?php
            endforeach;
        ?>
<?php else: ?>
    <small>
        Rất tiếc! <br>
        Sinh viên <b><?php echo $user['name']; ?></b> chưa đăng nhập để làm bài.
    </small>
<?php
    endif;
?>