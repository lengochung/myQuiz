<?php

    require '../helpers/require_for_requests_server.php';

    $conn = new Connect_MySql();

    $questions = $conn->load('questions');

    $question = $questions->get_ref_table_dl_where('users_questions_assigns', 'qid', 'aid', c_assign()['aid'], 'uid', user()['uid']);
    $ques = [];
    foreach ($question as $key => $value) {
      if($value['qid'] == $_GET['qid']) {
        $ques = $value;
        break;
      }
    }
?>

<div class="">
    <b>Câu <?php echo $_GET['num']; ?>:</b> <?php echo $ques['content']; ?>
    <form action="" method="post" class="" name="form">
      <div class="float-right text-success"><small><i id="message_update_answer"></i></small></div>
        <fieldset class="ml-5 mt-2">
          <div class="form-check">
              <label class="form-check-label">
              <input onclick="updateanswer(<?php echo $ques['qid']; ?>,this.value)" type="radio" class="form-check-input" name="answer" id="" value="A" <?php if($ques['choose']=='A') echo 'checked'; ?>>
              A. <?php echo $ques['a']; ?>
            </label>
          </div>
          <div class="form-check">
              <label class="form-check-label">
              <input onclick="updateanswer(<?php echo $ques['qid']; ?>,this.value)" type="radio" class="form-check-input" name="answer" id="" value="B" <?php if($ques['choose']=='B') echo 'checked'; ?>>
              B. <?php echo $ques['b']; ?>
            </label>
          </div>
          <div class="form-check">
              <label class="form-check-label">
              <input onclick="updateanswer(<?php echo $ques['qid']; ?>,this.value)" type="radio" class="form-check-input" name="answer" id="" value="C" <?php if($ques['choose']=='C') echo 'checked'; ?>>
              C. <?php echo $ques['c']; ?>
            </label>
          </div>
          <div class="form-check">
              <label class="form-check-label">
              <input onclick="updateanswer(<?php echo $ques['qid']; ?>,this.value)" type="radio" class="form-check-input" name="answer" id="" value="D" <?php if($ques['choose']=='D') echo 'checked'; ?>>
              D. <?php echo $ques['d']; ?>
            </label>
          </div>
          <div class="form-check border-top">
              <label class="form-check-label float-right">
              <input onclick="updateanswer(<?php echo $ques['qid']; ?>,this.value)" type="radio" class="form-check-input" name="answer" id="" value="none" <?php if($ques['choose']=='none') echo 'checked'; ?>>
              None/ Bỏ chọn/ Đánh dấu
            </label>
          </div>
        </fieldset>
      </form>

</div>
