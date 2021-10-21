<?php

    require '../helpers/require_for_requests_server.php';

    $conn = new Connect_MySql();

    $questions = $conn->load('questions');

    $list_questions = $questions->get_ref_table_dl_where('users_questions_assigns', 'qid', 'aid', c_assign()['aid'], 'uid', user()['uid']);
?>
<?php $i = 1; ?>
<?php 
    foreach(list_questions() as $key => $value): 
        foreach($list_questions as $key => $ques): 
            if($value['qid']==$ques['qid']):
                if($ques['choose']=='none'):
?>
        
            <button onclick="showquestionfordo(<?php echo $value['qid'] . ',' . $i;?>)" type="button" class="btn btn-outline-secondary">
                <?php echo $i++; ?>
            </button>

<?php           else: ?>
       
            <button onclick="showquestionfordo(<?php echo $value['qid'] . ',' . $i;?>)" type="button" class="btn btn-primary">
                <?php echo $i++; ?><?php echo $ques['choose']; ?>
            </button>

<?php

                endif;
                break;
            endif;
        endforeach;   
    endforeach; 
?>
